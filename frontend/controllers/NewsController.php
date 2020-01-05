<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\News;
use common\models\CategoryNews;
use common\models\Banner;
use common\models\Ads;
use common\models\Youtube;
use common\models\Posts;
use common\models\PostViews;
use common\models\VwPosts;
use common\models\VwTag;
use common\models\Postmeta;
use common\models\TermRelationships;
use yii\data\Pagination;
use yii\db\Expression;
use yii\helpers\Url;

/**
 * Site controller
 */
class NewsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionDetail($id = null, $category = null) {
        $model = Posts::find()->where(['ID' => $id])->one();
        $click = Yii::$app->MData->clickPost($id);
//        $related = VwPosts::find()->where(['NOT IN', 'ID', [$id]])->andwhere(['term_taxonomy_id'=>$category])->orderBy(['post_date'=>SORT_DESC])->limit(3)->all();
        $tag = VwTag::find()->where(['ID' => [$id]])->all();
        $id_tag = array();
        $id_relate = array();
        $related = '';
        if (!empty($tag)) {
            foreach ($tag as $index => $value) {
                $id_tag[] = $value['id_tag'];
            }
            if (!empty($id_tag)) {
                $data_tag = VwTag::find()->where(['NOT IN', 'ID', [$id]])->andFilterWhere(['IN', 'id_tag', $id_tag])->orderBy(['ID' => SORT_DESC])->limit(3)->all();
                if (!empty($data_tag)) {
                    foreach ($data_tag as $index => $value) {
                        $id_relate[] = $value['ID'];
                    }
                    $related_data = VwPosts::find()->where(['NOT IN', 'ID', [$id]])->andFilterWhere(['IN','ID',$id_relate])->orderBy(['post_date'=>SORT_DESC])->all();
                    $newid=array();
                    foreach($related_data as $index => $val){
                        $newid[$val->ID] = array('ID'=>$val->ID,'term_taxonomy_id'=>$val->term_taxonomy_id);
                    }
                    $value_related = VwPosts::find()->orderBy(['post_date'=>SORT_DESC]);
                    foreach($newid as $index => $val){
                        $val_id = $val['ID'];
                        $val_term_taxonomy_id = $val['term_taxonomy_id'];
                        $value_related =  $value_related->orWhere("(ID = $val_id and term_taxonomy_id=$val_term_taxonomy_id)");
                    }
                    $related = $value_related->all();
                }
            }
        }

        $data = Yii::$app->MData->getPost($category);
        $checkTerm = TermRelationships::find()->select('term_taxonomy_id')->where(['object_id'=>$id])->all();
        $array_checkTerm = [];
        if($checkTerm){
            foreach ($checkTerm as $key => $value) {
                $array_checkTerm[$key] = $value->term_taxonomy_id;
            }
        }
        $ads = Banner::find()->where(['active' => 'active'])->orderBy(new Expression('rand()'))->all();
        // $ads = Banner::find()->where(['active' => 'active'])->orderBy(new Expression('rand()'))->all();
        $youtube = Youtube::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();

        if(!$model){
            return $this->render('not-found', [
                        'ads' => $ads,
                        'youtube' => $youtube,
            ]);
        }

        return $this->render('news-detail', [
                    'model' => $model,
                    'youtube'=>$youtube,
                    'related' => $related,
                    'checkTerm' => $array_checkTerm,
                    'ads' => $ads,
                    'page' => $data[0],
                    'name' => $data[1],
        ]);
    }

    public function actionIndex($id = null, $tag = null) {
        if (!empty($_POST["cate_id"])) {
            return $this->redirect(Url::to(['news/index', 'id' => $_POST["cate_id"]]));
        }

        $ads = Banner::find()->where(['active' => 'active'])->orderBy(new Expression('rand()'))->all();
        $youtube = Youtube::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();
        $filterSearch = '';
        // Search
        if (!empty($_GET['search-submit']) && !empty($_GET['filterSearch'])) {
            $filterSearch = $_GET['filterSearch'];
            $id = array();
            $post_search = VwPosts::find()->distinct()->select(['ID'])->where(['active' => 'active'])
                    ->andFilterWhere(['or',
                        ['like', 'name', $filterSearch],
                        ['like', 'post_content', $filterSearch],
                        ['like', 'post_title', $filterSearch]
                    ])
                    ->all();
            if ($post_search) {
                foreach ($post_search as $index => $val) {
                    $id[$val->ID] = $val->ID;
                }
            }
            $tag_search = VwTag::find()->distinct()->select(['ID'])->filterWhere(['like', 'name_tag', $filterSearch])->all();
            if ($tag_search) {
                foreach ($tag_search as $index => $val) {
                    $id[$val->ID] = $val->ID;
                }
            }
//            var_dump($id);
//            exit();
        }
        // End Search

        if (!empty($id) || !empty($tag)) {
            if (!empty($_GET['search-submit']) && !empty($_GET['filterSearch'])) {
                $data = Yii::$app->MData->getSearchPost($id, $filterSearch);
            } else {
                $data = Yii::$app->MData->getPost($id, $tag);
                if ($data[3] == 'magazine') {
                    return $this->redirect(Url::to(['magazine/index', 'id' => $id]));
                }
            }
            if (!$data) {
                return $this->render('not-found', [
                            'ads' => $ads,
                            'youtube' => $youtube,
                ]);
            }
            $countQuery = clone $data[2];
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
            $models = $data[2]->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
            return $this->render('news', [
                        'news' => $models,
                        'ads' => $ads,
                        'youtube' => $youtube,
                        'pages' => $pages,
                        'countQuery' => $countQuery,
                        'page' => $data[0],
                        'name' => $data[1],
            ]);
        }
        return $this->render('not-found', [
                    'ads' => $ads,
                    'youtube' => $youtube,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionMagazine() {
        return $this->render('magazine');
    }

    public function actionMagazinedetail() {
        return $this->render('magazine-detail');
    }

    public function actionNews() {
        return $this->render('news');
    }

    public function actionNewsdetail() {
        return $this->render('news-detail');
    }

    public function actionPortal() {
        return $this->render('portal');
    }

    public function actionPortaldetail() {
        return $this->render('portal-detail');
    }

    public function actionProduct() {
        return $this->render('product');
    }

    public function actionProductdetail() {
        return $this->render('product-detail');
    }

    public function actionRegister() {
        return $this->render('register');
    }

    public function actionTelevition() {
        return $this->render('televition');
    }

    public function actionTips() {
        return $this->render('tips');
    }

    public function actionTipsdetail() {
        return $this->render('tips-detail');
    }

}

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
use common\models\Customer;
use common\models\HotNewsIndex;
use common\models\Banner;
use common\models\Ads;
use common\models\Youtube;
use common\models\Partner;
use common\models\VwPosts;
use yii\data\Pagination;
use yii\db\Expression;
use common\models\Bank;
use common\models\Popup;
use common\models\Promotions;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
    public function actions()
    {
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

    public function actionAds($id)
    {
        $ads = Promotions::find()->where(['id'=>$id])->one();
        $link = Yii::$app->MData->getLink($ads->ads_link);
        $ads->ads_click = $ads->ads_click+1;
        if($ads->save(false)){
            return $this->redirect($link);
        } else {

        }
    }

    public function actionBanner($id)
    {
        $banner = Banner::find()->where(['id'=>$id])->one();
        $link = Yii::$app->MData->getLink($banner->banner_link);
        $banner->banner_click = $banner->banner_click+1;
        if($banner->save(false)){
            return $this->redirect($link);
        } else {

        }
    }

    public function actionIndex()
    {
        $newsUpdate = VwPosts::find()->filterWhere(['in','term_taxonomy_id',array(2,9)])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->groupBy('ID')->limit(7)->all();
        // $magazine = VwPosts::find()->filterWhere(['in','term_taxonomy_id',array(10,15,16,17,18,43,47,48,56)])->andwhere(['active'=>'active'])->orderBy(['post_date'=>SORT_DESC])->limit(7)->all();
        $reasearch_special_Pin = VwPosts::find()->where(['term_taxonomy_id'=>64])->andwhere(['active'=>'active'])->andwhere(['post_pin'=>'1'])->orderBy(['post_pin'=>SORT_DESC])->limit(1)->all();
        if($reasearch_special_Pin){
            $magazine = VwPosts::find()->filterWhere(['in','term_taxonomy_id',array(10)])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->limit(6)->all();
        }else{
            $magazine = VwPosts::find()->filterWhere(['in','term_taxonomy_id',array(10)])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->limit(7)->all();
        }
        $moneyProduct = VwPosts::find()->filterWhere(['in','term_taxonomy_id',array(12,53)])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->groupBy('ID')->limit(2)->all();
        $moneyTipsIndex = VwPosts::find()->where(['term_taxonomy_id'=>13])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->limit(2)->all();
        $moneySaveTipsIndex = VwPosts::find()->where(['term_taxonomy_id'=>62])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->limit(2)->all();
        $reasearch_special_Index = VwPosts::find()->where(['term_taxonomy_id'=>64])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->limit(1)->all();
        $customer = Customer::find()->filterWhere(['active'=>'active'])->orderBy(['ID'=>SORT_DESC])->groupBy('ID')->limit(1)->all();

        $limit_reasearch = 2;
        if($reasearch_special_Index && $customer){
            $limit_reasearch = 1;
        }
        $reasearchIndex = VwPosts::find()->where(['term_taxonomy_id'=>61])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->limit($limit_reasearch)->all();
        
        $fintechIndex = VwPosts::find()->where(['term_taxonomy_id'=>63])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->limit(2)->all();
        $insuranceIndex = VwPosts::find()->filterWhere(['in','term_taxonomy_id',array(5,23,38)])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->groupBy('ID')->limit(2)->all();
        $newsPrIndex = VwPosts::find()->filterWhere(['in','term_taxonomy_id',array(4,7,49)])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->groupBy('ID')->limit(5)->all();
        $whoNewsIndex = VwPosts::find()->where(['term_taxonomy_id'=>11])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->limit(8)->all();
        $eventNewsIndex = VwPosts::find()->where(['term_taxonomy_id'=>55])->andwhere(['active'=>'active'])->orderBy(['post_pin'=>SORT_DESC])->limit(5)->all();
        $hotNewsIndex = VwPosts::find()->where(['active'=>'active'])->andwhere(['post_pin'=>'1'])->limit(100)->all();
        $bannerImg = Banner::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();
        $bannerImgSuff = Banner::find()->where(['active'=>'active'])->orderBy(new Expression('rand()'))->all();
        $promotionImg = Promotions::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();
        $ads = Ads::find()->where(['active'=>'active'])->orderBy(new Expression('rand()'))->all();
        $youtube = Youtube::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();
        $partner = Partner::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();
        $bankImg = Bank::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();
        $date = date('Y-m-d 00:00:00');

        $AllPopup=Popup::find()->where(['active'=>'active'])->andwhere(['<=','start_date',$date])->andwhere(['>=','end_date',$date])->orderBy(['sort_order'=>SORT_ASC])->all();

        
        return $this->render('index',[
            'newsUpdate' => $newsUpdate,
            'reasearch_special_Pin' =>$reasearch_special_Pin,
            'magazine' => $magazine,
            'moneyProduct' => $moneyProduct,
            'moneyTipsIndex' => $moneyTipsIndex,
            'moneySaveTipsIndex' => $moneySaveTipsIndex,
            'reasearch_special_Index' => $reasearch_special_Index,
            'reasearchIndex' => $reasearchIndex,
            'insuranceIndex' => $insuranceIndex,
            'fintechIndex' => $fintechIndex,
            'newsPrIndex' => $newsPrIndex,
            'whoNewsIndex' => $whoNewsIndex,
            'eventNewsIndex' => $eventNewsIndex,
            'hotNewsIndex' => $hotNewsIndex,
            'bannerImg' => $bannerImg,
            'bannerImgSuff' => $bannerImgSuff,
            'promotionImg' => $promotionImg,
            'youtube' => $youtube,
            'partner' => $partner,
            'bankImg' => $bankImg,
            'AllPopup' => $AllPopup,
            'customer'=>$customer
        ]);
    }

    public function actionTelevition()
    {
        $query = Youtube::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>10]);
        // var_dump($pages);exit();
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('televition', [
             'youtube' => $models,
             'pages' => $pages,
        ]);

        // $youtube = Youtube::find()->orderBy(['sort_order'=>SORT_DESC])->all();            
        // return $this->render('televition',[
        //         'youtube' => $youtube,
        //     ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
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
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
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
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
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
    public function actionRequestPasswordReset()
    {
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
    public function actionResetPassword($token)
    {
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

    public function actionMagazine()
    {
        return $this->render('magazine');
    }
    public function actionMagazinedetail()
    {
        return $this->render('magazine-detail');
    }
    public function actionNews()
    {
        return $this->render('news');
    }
    public function actionNewsdetail()
    {
        return $this->render('news-detail');
    }
    public function actionPortal()
    {
        return $this->render('portal');
    }
    public function actionPortaldetail()
    {
        return $this->render('portal-detail');
    }
    public function actionProduct()
    {
        return $this->render('product');
    }
    public function actionProductdetail()
    {
        return $this->render('product-detail');
    }
    public function actionRegister()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }
    public function actionTips()
    {
        return $this->render('tips');
    }
    public function actionTipsdetail()
    {
        return $this->render('tips-detail');
    }
}

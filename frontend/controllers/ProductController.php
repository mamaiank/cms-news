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
use common\models\Posts;
use common\models\PostViews;
use common\models\CategoryNews;
use common\models\Banner;
use common\models\Ads;
use common\models\Youtube;

/**
 * Site controller
 */
class ProductController extends Controller
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

    public function actionDetail($id,$category)
    {
        $model = Posts::find()->where(['ID'=>$id])->one();
        $Ymd = date('Ymd');
        $Ym = date('Ym');
        $Y = date('Y');
        $viewYmd = PostViews::find()->where(['id'=>$id,'period'=>$Ymd])->one();
        if($viewYmd){
            $viewYmd->count = $viewYmd->count+1;
            $viewYmd->save(false);
        } else {
            $createYmd = new PostViews;
            $createYmd->id = $id;
            $createYmd->type = 0;
            $createYmd->period = $Ymd;
            $createYmd->count =1 ;
            $createYmd->save();
        }
        $viewYm = PostViews::find()->where(['id'=>$id,'period'=>$Ym])->one();
        if($viewYm){
            $viewYm->count = $viewYm->count+1;
            $viewYm->save(false);
        } else {
            $createYm = new PostViews;
            $createYm->id = $id;
            $createYm->type = 2;
            $createYm->period = $Ym;
            $createYm->count =1 ;
            $createYm->save();
        }
        $viewY = PostViews::find()->where(['id'=>$id,'period'=>$Y])->one();
        if($viewY){
            $viewY->count = $viewY->count+1;
            $viewY->save(false);
        } else {
            $createY = new PostViews;
            $createY->id = $id;
            $createY->type = 3;
            $createY->period = $Y;
            $createY->count =1 ;
            $createY->save();
        }
        $viewTotal = PostViews::find()->where(['id'=>$id,'period'=>'total'])->one();
        if($viewTotal){
            $viewTotal->count = $viewTotal->count+1;
            $viewTotal->save(false);
        } else {
            $createTotal = new PostViews;
            $createTotal->id = $id;
            $createTotal->type = 4;
            $createTotal->period = 'total';
            $createTotal->count =1;
            $createTotal->save();
        }
        $category = CategoryNews::find()->where(['cate_news_name'=>$category])->one();
        $related = News::find()->where(['NOT IN', 'id', [$id]])->orderBy(['create_date'=>SORT_DESC])->all();
        return $this->render('product-detail',[
                'model'=>$model,
                'category'=>$category,
                'related' => $related,
            ]);
    }

    public function actionIndex($id)
    {
        $news = News::find()->orderBy(['create_date'=>SORT_DESC])->all();
        // $newspost = NewsPost::find()->where(['category'=>'isb001|1'])->all();
        // var_dump($newspost);exit();
        $ads = Ads::find()->orderBy(['create_date'=>SORT_DESC])->all();
        return $this->render('product',[
            'news' => $news,
            'ads' => $ads,
        ]);
    }

}

<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Promotions;
use common\models\Banner;
use yii\db\Expression;
use common\models\Youtube;
/**
 * Site controller
 */
class PromotionsController extends Controller
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

    public function actionDetail($id)
    {
        $model = Promotions::find()->where(['ID'=>$id])->one();
        $ads = Banner::find()->where(['active'=>'active'])->orderBy(new Expression('rand()'))->all();
        $youtube = Youtube::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();

        if(!$model){
            return $this->render('not-found', [
                'ads' => $ads,
                'youtube' => $youtube,
            ]);
        }

        if($model->ads_type=='intra'){
            $model->ads_click = $model->ads_click+1;
            $model->save(false);
            return $this->render('promotions-detail',[
                'model'=>$model,
                'ads'=>$ads,
                'youtube' => $youtube,
                'page' => 'ads',
                'name' => 'asd',
            ]);            
        } else {
            $link = Yii::$app->MData->getLink($model->ads_link);
            if($link == ''){
                return $this->render('not-found', [
                    'ads' => $ads,
                    'youtube' => $youtube,
                ]);       
            } else {
                $model->ads_click = $model->ads_click+1;
                $model->save(false);
                return $this->redirect($link);
            }
        }

    }

    public function actionIndex()
    {
        return $this->render('promotions',[
        ]);
    }

}

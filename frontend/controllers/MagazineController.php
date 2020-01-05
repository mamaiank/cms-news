<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\VwPosts;
use common\models\VwTag;
use common\models\Posts;
use common\models\Banner;
use common\models\Youtube;
use yii\data\Pagination;
use yii\db\Expression;
use common\models\TermRelationships;
/**
 * Site controller
 */
class MagazineController extends Controller
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
        $model = Posts::find()->where(['ID' => $id])->one();
        $click = Yii::$app->MData->clickPost($id);
        $data = Yii::$app->MData->getPost($category);
//        $related = VwPosts::find()->where(['NOT IN', 'ID', [$id]])->andwhere(['term_taxonomy_id'=>$category])->andwhere(['active'=>'active'])->orderBy(['post_date'=>SORT_DESC])->limit(3)->all();
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
        
        $checkTerm = TermRelationships::find()->select('term_taxonomy_id')->where(['object_id'=>$id])->all();
        $array_checkTerm = [];
        if($checkTerm){
            foreach ($checkTerm as $key => $value) {
                $array_checkTerm[$key] = $value->term_taxonomy_id;
            }
        }
        $ads = Banner::find()->where(['active'=>'active'])->orderBy(new Expression('rand()'))->all();
        $youtube = Youtube::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();

        if(!$model) {
                return $this->render('not-found', [
                    'ads' => $ads,
                    'youtube' => $youtube,
                ]);
            }

        return $this->render('magazine-detail',[
                'model'=>$model,
                'related' => $related,
                'youtube' => $youtube,
                'ads'=>$ads,
                'checkTerm' => $array_checkTerm,
                'page' => $data[0],
                'name' => $data[1],
            ]);
    }

    public function actionIndex($id = null)
    {
        $checkTerm = TermRelationships::find()->select('term_taxonomy_id')->where(['object_id'=>$id])->all();
        $array_checkTerm = [];
        if($checkTerm){
            foreach ($checkTerm as $key => $value) {
                $array_checkTerm[$key] = $value->term_taxonomy_id;
            }
        }
        $ads = Banner::find()->where(['active'=>'active'])->orderBy(new Expression('rand()'))->all();
        $youtube = Youtube::find()->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();
        if($id != null){
            $data = Yii::$app->MData->getPost($id);    

            if(!$data) {
                return $this->render('not-found', [
                    'ads' => $ads,
                    'youtube' => $youtube,
                ]);
            }
            $countQuery = clone $data[2];
            $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>10]);
            $models = $data[2]->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            
            return $this->render('magazine',[
                'news' => $models,
                'ads' => $ads,
                'checkTerm' => $array_checkTerm,
                'youtube' => $youtube,
                'pages' => $pages,
                'page' => $data[0],
                'name' => $data[1],
                'countQuery' => $countQuery,
            ]);
        } else {
            return $this->render('not-found', [
                'ads' => $ads,
                'youtube' => $youtube,
            ]);
        }
        
    }
}

<?php

namespace backend\controllers;

use Yii;
use common\models\News;
use common\models\NewsSearch;
use common\models\Posts;
use common\models\Terms;
use common\models\TermRelationships;
use common\models\PostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CategoryNews;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\data\ActiveDataProvider;
use common\models\VwPosts;
use common\models\Tag;
use common\models\TagRelationship;
use backend\models\Slim;
use yii\data\ArrayDataProvider;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!empty($_POST["status_id"])) {
            $model = Posts::find()->where(['ID' => $_POST["status_id"]])->one();

            if($model->active == "active"){
                $model->active = "un_active";
                $value = 'ปิด';
            } else {
                $model->active = "active";
                $value = 'เปิด';
            }
            $model->save(false);
            
            return $value;
        }

        if(!empty($_POST["pin_id"])) {
            $model = Posts::find()->where(['ID' => $_POST["pin_id"]])->one();

            if($model->post_pin == 1){
                $model->post_pin = 0;
                $value = 0;
            } else {
                $model->post_pin = 1;
                $value = 1;
            }
            $model->save(false);
            
            return $value;
        }
         
        $searchModel = new PostsSearch();
        // $query = News::find();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        //     'pagination' => [ 'pageSize' => 10 ],
        // ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionIndexSpecial()
    {
        if(!empty($_POST["status_id"])) {
            $model = Posts::find()->where(['ID' => $_POST["status_id"]])->one();

            if($model->active == "active"){
                $model->active = "un_active";
                $value = 'ปิด';
            } else {
                $model->active = "active";
                $value = 'เปิด';
            }
            $model->save(false);
            
            return $value;
        }

        if(!empty($_POST["pin_id"])) {
            $model = Posts::find()->where(['ID' => $_POST["pin_id"]])->one();

            if($model->post_pin == 1){
                $model->post_pin = 0;
                $value = 0;
            } else {
                $model->post_pin = 1;
                $value = 1;
            }
            $model->save(false);
            
            return $value;
        }
        $data_special = VwPosts::find()->where(['term_taxonomy_id'=>64])->orderBy(['post_pin'=>SORT_DESC])->all();
        $array_id = array();
        foreach($data_special as $key => $value){
            $array_id[$value->ID] = $value->ID;
        }
        if(count($array_id)==0){
            $array_id[] = 0;
        }
        $searchModel = new PostsSearch();
        $searchModel->array_id = $array_id;
//        $_POST['PostsSearch']['ID']=$array_id;
        // $query = News::find();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        var_dump($searchModel);exit();
//        $dataProvider = new ArrayDataProvider([
//            'allModels' => $searchModel,
//        ]);
        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        //     'pagination' => [ 'pageSize' => 10 ],
        // ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        ini_set('memory_limit', '-1');
        $model = new Posts();
        
        $cate = Terms::find()->where(['active'=>'active'])->all();
        $tagCur = Tag::find()->all();
        $array_tag=array();
        foreach ($tagCur as $key => $value) {
            $array_tag[$key] = $value->name;
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $tag_data = $model->tag;
            if(is_array($tag_data)){
                foreach ($tag_data as $key => $value) {
                    $check = Tag::find()->where(['name'=>$value])->one();
                    if(!$check){
                        $tag = new Tag;
                        $tag->name = $value;
                        $tag->save();
                    }
                }
            }
            if($model->contributor == 'active'){
                $img = Slim::getImages('contributor_pic');
                $save_img_contributor = Yii::$app->MData->getImg($img);
                if($save_img_contributor != NULL){
                    $model->contributor_pic = $save_img_contributor;
                }
            }
            $img = Slim::getImages();
            $save_img = Yii::$app->MData->getImg($img);
            if($save_img != NULL){
                $model->post_pic = $save_img;
            }
            $model->post_date = date('Y-m-d H:i:s');
            $model->post_date_gmt = date('Y-m-d H:i:s');
            $model->create_by = Yii::$app->user->id;
            if($model->save()){
                if(is_array($tag_data)){
                    foreach ($tag_data as $key => $value) {
                        $tag_post = new TagRelationship;
                        $check = Tag::find()->where(['name'=>$value])->one();
                        $tag_post->post_id = $model->ID;
                        $tag_post->tag_id = $check->id;
                        $tag_post->save();
                    }
                }
                if(isset($model->news_type_tag)){
                    if(is_array($model->news_type_tag)){
                        foreach ($model->news_type_tag as $key => $value) {
                            $model_term = new TermRelationships;
                            $model_term->object_id = $model->ID;
                            $model_term->term_taxonomy_id = $value;
                            $model_term->save();
                        }
                    }
                } else {
                    $model_term = new TermRelationships;
                    $model_term->object_id = $model->ID;
                    $model_term->term_taxonomy_id = 1;
                    $model_term->save();
                }  
                // exit();
                // if(isset($pic)){   
                //     $path = 'uploads/news/'. $model->ID;         
                //     FileHelper::createDirectory($path);
                //     $pic->saveAs($path.'/'.$time.'.'.$pic->extension);
                // }
                return $this->redirect(['index']);
            } 
        }
        
        return $this->render('create', [
            'model' => $model,
            'cate'=>$cate,
            'array_tag' => $array_tag,
            'special' => 0
        ]);
    }

     public function actionCreateSpecial()
    {
        ini_set('memory_limit', '-1');
        $model = new Posts();
        
        $cate = Terms::find()->where(['active'=>'active'])->all();
        $tagCur = Tag::find()->all();
        $array_tag=array();
        foreach ($tagCur as $key => $value) {
            $array_tag[$key] = $value->name;
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           
            $tag_data = $model->tag;
            if(is_array($tag_data)){
                foreach ($tag_data as $key => $value) {
                    $check = Tag::find()->where(['name'=>$value])->one();
                    if(!$check){
                        $tag = new Tag;
                        $tag->name = $value;
                        $tag->save();
                    }
                }
            }
            if($model->contributor == 'active'){
                $img = Slim::getImages('contributor_pic');
                $save_img_contributor = Yii::$app->MData->getImg($img);
                if($save_img_contributor != NULL){
                    $model->contributor_pic = $save_img_contributor;
                }
            }
            $img = Slim::getImages();
            $save_img = Yii::$app->MData->getImg($img);
            if($save_img != NULL){
                $model->post_pic = $save_img;
            }
            $model->post_date = date('Y-m-d H:i:s');
            $model->post_date_gmt = date('Y-m-d H:i:s');
            $model->create_by = Yii::$app->user->id;
            if($model->save()){
                if(is_array($tag_data)){
                    foreach ($tag_data as $key => $value) {
                        $tag_post = new TagRelationship;
                        $check = Tag::find()->where(['name'=>$value])->one();
                        $tag_post->post_id = $model->ID;
                        $tag_post->tag_id = $check->id;
                        $tag_post->save();
                    }
                }
                if (!in_array("64", $model->news_type_tag)) {
                    $model->news_type_tag[] = "64";
                }
                if(isset($model->news_type_tag)){
                    if(is_array($model->news_type_tag)){
                        foreach ($model->news_type_tag as $key => $value) {
                            $model_term = new TermRelationships;
                            $model_term->object_id = $model->ID;
                            $model_term->term_taxonomy_id = $value;
                            $model_term->save();
                        }
                    }
                } else {
                    $model_term = new TermRelationships;
                    $model_term->object_id = $model->ID;
                    $model_term->term_taxonomy_id = 1;
                    $model_term->save();
                }  
                // exit();
                // if(isset($pic)){   
                //     $path = 'uploads/news/'. $model->ID;         
                //     FileHelper::createDirectory($path);
                //     $pic->saveAs($path.'/'.$time.'.'.$pic->extension);
                // }
                return $this->redirect(['index-special']);
            } 
        }
        
        return $this->render('create', [
            'model' => $model,
            'cate'=>$cate,
            'array_tag' => $array_tag,
            'special' => 1
        ]);
    }
    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        ini_set('memory_limit', '-1');
        $model = $this->findModel($id);
        $term = VwPosts::find()->select('term_taxonomy_id')->where(['ID'=>$id])->all();
        $cate = Terms::find()->where(['active'=>'active'])->all();

        $tagCur = Tag::find()->all();
        $array_tag=[];
        foreach ($tagCur as $key => $value) {
            $array_tag[$key] = $value->name;
        }
        $tagPost = TagRelationship::find()->where(['post_id'=>$id])->all();
        $array_tag_post = [];
        foreach ($tagPost as $key => $value) {
                $array_tag_post[$key] = $value->tag;
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {     
            $tag_data = $model->tag;
            if(is_array($tag_data)){
                foreach ($tag_data as $key => $value) {
                    $check = Tag::find()->where(['name'=>$value])->one();
                    if(!$check){
                        $tag = new Tag;
                        $tag->name = $value;
                        $tag->save();
                    }
                }
            }
            if($model->contributor == 'active'){
                $img = Slim::getImages('contributor_pic');
                $save_img_contributor = Yii::$app->MData->getImg($img);
                if($save_img_contributor != NULL){
                    $model->contributor_pic = $save_img_contributor;
                }
            }       
            $img = Slim::getImages();
            $save_img = Yii::$app->MData->getImg($img);
            if($save_img != NULL){
                $model->post_pic = $save_img;
            }
            $model->post_modified = date('Y-m-d H:i:s');
            $model->post_modified_gmt = date('Y-m-d H:i:s');
            $model->update_by = Yii::$app->user->id;
            if($model->save()){
                $del_term = new TermRelationships;
                $del_term->deleteall(['object_id'=>$id]);
                $del_tag = new TagRelationship;
                $del_tag->deleteall(['post_id'=>$id]);
                if(is_array($tag_data)){
                    foreach ($tag_data as $key => $value) {
                        $tag_post = new TagRelationship;
                        $check = Tag::find()->where(['name'=>$value])->one();
                        $tag_post->post_id = $model->ID;
                        $tag_post->tag_id = $check->id;
                        $tag_post->save();
                    }
                }
                if(isset($model->news_type_tag)){
                    if(is_array($model->news_type_tag)){
                        foreach ($model->news_type_tag as $key => $value) {
                            $model_term = new TermRelationships;
                            $model_term->object_id = $model->ID;
                            $model_term->term_taxonomy_id = $value;
                            $model_term->save();
                        }
                    }
                } else {
                    $model_term = new TermRelationships;
                    $model_term->object_id = $model->ID;
                    $model_term->term_taxonomy_id = 1;
                    $model_term->save();
                }  
                return $this->redirect(['index']);
            }
        }
        $array_term=array();
        foreach ($term as $k => $value) {
            $array_term[] = $value->term_taxonomy_id;
        }
        return $this->render('update', [
            'model' => $model,
            'cate'=>$cate,
            'term'=>$array_term,
            'array_tag'=>$array_tag,
            'array_tag_post'=>$array_tag_post,
            'special' => 0
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

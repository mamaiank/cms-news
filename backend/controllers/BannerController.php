<?php

namespace backend\controllers;

use Yii;
use common\models\Banner;
use common\models\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use backend\models\Slim;
use richardfan\sortable\SortableAction;
use common\models\Terms;
use common\models\BannerRelationships;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
{
    /**
     * @inheritdoc
     */

    public function actions(){ 
        return [ 
            'sortItem' => [ 
                'class' => SortableAction::className(), 
                'activeRecordClassName' => Banner::className(), 
                'orderColumn' => 'sort_order', 
            ], 
        ]; 
    }

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
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!empty($_POST["status_id"])) {
            $model = Banner::find()->where(['id' => $_POST["status_id"]])->one();

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

        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
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
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();
        $cate = Terms::find()->where(['active'=>'active'])->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $vdo = '';
            $time = date('His');
            $name = rand(10,100);
            $model->start_date = date('Y-m-d', strtotime($model->start_date));
            $model->end_date = date('Y-m-d', strtotime($model->end_date));
            if($model->type == 1){
                $img = Slim::getImages('banner_pic_file');
                $save_img = Yii::$app->MData->getImg($img);
            } else {
                $imganimate = UploadedFile::getInstance($model,'animate');
                $model->banner_pic_file = $time.$name.'.'.$imganimate->extension;
            }
            
            if(!empty($save_img)){
                $model->banner_pic_file = $save_img;
            }
            ///////// img hover //////////
            if($model->banner_type == 'video'){
                $vdo = UploadedFile::getInstance($model,'vdo');
                if($vdo != NULL){
                    $model->banner_pic_hover = $time.$name.'.'.$vdo->extension;
                }
            }else{
                $img_hover = Slim::getImages('banner_pic_hover');
                $save_img_hover = Yii::$app->MData->getImg($img_hover);
                if($save_img_hover != NULL){
                    $model->banner_pic_hover = $save_img_hover;
                }
            }
            
            /////// end img hover /////////
            $model->create_date = date('Y-m-d H:i:s');
            $model->create_by = Yii::$app->user->id;
            // $model->banner_link = urlencode($model->banner_link);
            if($model->save()){
                if($vdo != ''){
                    $vdo->saveAs('../upload/media/'.$time.$name.'.'.$vdo->extension);
                }
                if($imganimate != ''){
                    $imganimate->saveAs('../upload/slim/'.$time.$name.'.'.$imganimate->extension);
                }
                if(isset($model->banner_relate_detail)){
                    if(is_array($model->banner_relate_detail)){
                        foreach ($model->banner_relate_detail as $key => $value) {
                            $model_term = new BannerRelationships;
                            $model_term->banner_id = $model->id;
                            $model_term->term_taxonomy_id = $value;
                            $model_term->term_type = 'detail';
                            $model_term->save();
                        }
                    }
                }
                if(isset($model->banner_relate_index)){
                    if(is_array($model->banner_relate_index)){
                        foreach ($model->banner_relate_index as $key => $value) {
                            $model_term = new BannerRelationships;
                            $model_term->banner_id = $model->id;
                            $model_term->term_taxonomy_id = $value;
                            $model_term->term_type = 'index';
                            $model_term->save();
                        }
                    }
                }
                return $this->redirect(['index']);
            } 
        }
        return $this->render('create', [
            'model' => $model,
            'cate'=>$cate,
        ]);
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cate = Terms::find()->where(['active'=>'active'])->all();
        $term_detail = BannerRelationships::find()->where(['banner_id'=>$id,'term_type'=>'detail'])->all();
        $term_index = BannerRelationships::find()->where(['banner_id'=>$id,'term_type'=>'index'])->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $vdo = '';
            $time = date('His');
            $name = rand(10,100);
            $img = Slim::getImages('banner_pic_file');
            $save_img = Yii::$app->MData->getImg($img);
            if($save_img != NULL){
                $model->banner_pic_file = $save_img;
            }
            ///////// img hover //////////
            if($model->banner_type == 'video'){
                $vdo = UploadedFile::getInstance($model,'vdo');
                if($vdo != NULL){
                    $model->banner_pic_hover = $time.$name.'.'.$vdo->extension;
                }
            }else{
                $img_hover = Slim::getImages('banner_pic_hover');
                $save_img_hover = Yii::$app->MData->getImg($img_hover);
                if($save_img_hover != NULL){
                    $model->banner_pic_hover = $save_img_hover;
                }
            }
            
            /////// end img hover /////////
            $model->update_date = date('Y-m-d H:i:s');
            $model->update_by = Yii::$app->user->id;
            // $model->banner_link = urlencode($model->banner_link);
            if($model->save()){
                if($vdo != ''){
                    $vdo->saveAs('../upload/media/'.$time.$name.'.'.$vdo->extension);
                }

                $del_term = new BannerRelationships;
                $del_term->deleteall(['banner_id'=>$id,'term_type'=>'detail']);
                if(isset($model->banner_relate_detail)){
                    if(is_array($model->banner_relate_detail)){
                        foreach ($model->banner_relate_detail as $key => $value) {
                            $model_term = new BannerRelationships;
                            $model_term->banner_id = $model->id;
                            $model_term->term_taxonomy_id = $value;
                            $model_term->term_type = 'detail';
                            $model_term->save();
                        }
                    }
                }

                $del_term = new BannerRelationships;
                $del_term->deleteall(['banner_id'=>$id,'term_type'=>'index']);
                if(isset($model->banner_relate_index)){
                    if(is_array($model->banner_relate_index)){
                        foreach ($model->banner_relate_index as $key => $value) {
                            $model_term = new BannerRelationships;
                            $model_term->banner_id = $model->id;
                            $model_term->term_taxonomy_id = $value;
                            $model_term->term_type = 'index';
                            $model_term->save();
                        }
                    }
                }
            return $this->redirect(['view', 'id' => $model->id]);
            } 
        }
        $array_term_detail=array();
        foreach ($term_detail as $k => $value) {
            $array_term_detail[] = $value->term_taxonomy_id;
        }
        $array_term_index=array();
        foreach ($term_index as $k => $value) {
            $array_term_index[] = $value->term_taxonomy_id;
        }
        return $this->render('update', [
            'model' => $model,
            'cate'=>$cate,
            'term_detail'=>$array_term_detail,
            'term_index'=>$array_term_index,
        ]);
    }

    /**
     * Deletes an existing Banner model.
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
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

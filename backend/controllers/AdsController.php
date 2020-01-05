<?php

namespace backend\controllers;

use Yii;
use common\models\Ads;
use common\models\AdsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use backend\models\Slim;
use richardfan\sortable\SortableAction;
/**
 * AdsController implements the CRUD actions for Ads model.
 */
class AdsController extends Controller
{
    public function actions(){ 
        return [ 
            'sortItem' => [ 
                'class' => SortableAction::className(), 
                'activeRecordClassName' => Ads::className(), 
                'orderColumn' => 'sort_order', 
            ], 
        ]; 
    } 
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
     * Lists all Ads models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!empty($_POST["status_id"])) {
            $model = Ads::find()->where(['id' => $_POST["status_id"]])->one();

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

        $searchModel = new AdsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ads model.
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
     * Creates a new Ads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ads();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $img = Slim::getImages();
            $save_img = Yii::$app->MData->getImg($img);
            if($save_img != NULL){
                $model->ads_pic_file = $save_img;
            }
            $model->create_date = date('Y-m-d H:i:s');
            $model->start_date = date('Y-m-d', strtotime($model->start_date));
            $model->end_date = date('Y-m-d', strtotime($model->end_date));
            $model->create_by = Yii::$app->user->id;
            if($model->save()){
                return $this->redirect(['index']);
            } 
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $img = Slim::getImages();
            $save_img = Yii::$app->MData->getImg($img);
            if($save_img != NULL){
                $model->ads_pic_file = $save_img;
            }
            $model->update_date = date('Y-m-d H:i:s');
            $model->start_date = date('Y-m-d', strtotime($model->start_date));
            $model->end_date = date('Y-m-d', strtotime($model->end_date));
            $model->update_by = Yii::$app->user->id;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }        
            return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Ads model.
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
     * Finds the Ads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ads::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

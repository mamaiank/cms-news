<?php

namespace backend\controllers;

use Yii;
use common\models\Youtube;
use common\models\YoutubeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use richardfan\sortable\SortableAction;

class VideoController extends \yii\web\Controller
{
    public function actions(){ 
        return [ 
            'sortItem' => [ 
                'class' => SortableAction::className(), 
                'activeRecordClassName' => Youtube::className(), 
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
     * Lists all Youtube models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!empty($_POST["status_id"])) {
            $model = Youtube::find()->where(['id' => $_POST["status_id"]])->one();

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

        $searchModel = new YoutubeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Youtube model.
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
     * Creates a new Youtube model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Youtube();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->linkF != ''){
                $model->youtube_link = $model->linkF;
            } else if($model->linkY != ''){
                $model->youtube_link = $model->linkY;
            }

            $model->create_date = date('Y-m-d H:i:s');
            $model->create_by = Yii::$app->user->id;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Youtube model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

            if($model->youtube_link != ''){
                if($model->link_type == 'youtube'){
                    $model->linkY = $model->youtube_link;
                } else if($model->link_type == 'facebook'){
                    $model->linkF = $model->youtube_link;
                }
            }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            if($model->linkF != ''){
                $model->youtube_link = $model->linkF;
            } else if($model->linkY != ''){
                $model->youtube_link = $model->linkY;
            } else {
                $model->youtube_link = '';
            }

            $model->update_date = date('Y-m-d H:i:s');
            $model->update_by = Yii::$app->user->id;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Youtube model.
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
     * Finds the Youtube model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Youtube the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Youtube::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

<?php

namespace backend\controllers;

use Yii;
use common\models\Partner;
use common\models\PartnerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Slim;
use richardfan\sortable\SortableAction;

/**
 * PartnerController implements the CRUD actions for Partner model.
 */
class PartnerController extends Controller
{
    public function actions(){ 
        return [ 
            'sortItem' => [ 
                'class' => SortableAction::className(), 
                'activeRecordClassName' => Partner::className(), 
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
     * Lists all Partner models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!empty($_POST["status_id"])) {
            $model = Partner::find()->where(['id' => $_POST["status_id"]])->one();

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

        $searchModel = new PartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Partner model.
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
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Partner();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $img = Slim::getImages();
            $save_img = Yii::$app->MData->getImg($img);
            if($save_img != NULL){
                $model->partner_pic = $save_img;
            }
            $model->create_date = date('Y-m-d H:i:s');
            $model->create_by = Yii::$app->user->id;
            if($model->save()){
                return $this->redirect(['index']);
            } 
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Partner model.
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
                $model->partner_pic = $save_img;
            }
            $model->update_date = date('Y-m-d H:i:s');
            $model->update_by = Yii::$app->user->id;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Partner model.
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
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

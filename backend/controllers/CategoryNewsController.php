<?php

namespace backend\controllers;

use Yii;
use common\models\Terms;
use common\models\TermsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use richardfan\sortable\SortableAction;

/**
 * CategoryNewsController implements the CRUD actions for CategoryNews model.
 */
class CategoryNewsController extends Controller
{
    public function actions(){ 
        return [ 
            'sortItem' => [ 
                'class' => SortableAction::className(), 
                'activeRecordClassName' => Terms::className(), 
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'create', 'update','view','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CategoryNews models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!empty($_POST["status_id"])) {
            $model = Terms::find()->where(['term_id' => $_POST["status_id"]])->one();

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

        $searchModel = new TermsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryNews model.
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
     * Creates a new CategoryNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Terms();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // $model->create_date = date('Y-m-d H:i:s');
            if($model->save()){
            return $this->redirect(['index']);
            } 
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Updates an existing CategoryNews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            // $model->update_date = date('Y-m-d H:i:s');
            if($model->save()){
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CategoryNews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $models = News::find()->all();
    //     var_dump($id);
    //     foreach ($models as $key => $model) {
    //         $data = explode(',',$model->news_type_tag);
    //         foreach ($data as $key => $value) {
    //             if($value == $id){
    //                 echo 'ลบไม่สำเร็จ กรุณาลบเนื้อหาที่เกี่ยวข้องก่อน';
    //                 return $this->redirect(['index']);
    //             }
    //         }
    //     }
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the CategoryNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Terms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

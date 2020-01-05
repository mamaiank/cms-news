<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\User;
use common\models\UserSearch;
use common\models\Profile;

/**
 * Site controller
 */
class MemberController extends Controller
{
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new User();
        $profile = new Profile();
        if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->created_at = strtotime(date('Y-m-d H:i:s'));
            $model->create_by = Yii::$app->user->id;
            $model->updated_at = strtotime(date('Y-m-d H:i:s'));
            if($model->save() && $profile->save())
            {  
                return $this->redirect(['index']); 
            }
        }

        return $this->render('create', [
            'model' => $model,
            'profile' => $profile,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $profile = $model->profile;
        if ($model->load(Yii::$app->request->post())) {
            if($model->newPassword != ''){
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->newPassword);
            }
            $model->updated_at = strtotime(date('Y-m-d H:i:s'));
            $model->update_by = Yii::$app->user->id;
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
        // var_dump($model);exit();
        return $this->render('update', [
            'model' => $model,
            'profile' => $profile,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

}

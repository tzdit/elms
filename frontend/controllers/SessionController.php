<?php

namespace frontend\controllers;

use Yii;
use common\models\Session;
use common\models\Sessionsearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SessionController implements the CRUD actions for Session model.
 */
class SessionController extends Controller
{
    /**
     * {@inheritdoc}
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
            'access' => [
                'class' => AccessControl::className(),
            'rules' => [
                  
                [
                    'actions' => [
                        'index'
                       
                    ],
                    'allow' => true,
                    'roles' => ['SYS_ADMIN','SUPER_ADMIN'],
                ],
            ]
            ]
        ];
    }

    /**
     * Lists all Session models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Sessionsearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('activesessions', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

  
    protected function findModel($id)
    {
        if (($model = Session::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

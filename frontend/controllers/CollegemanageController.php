<?php

namespace frontend\controllers;

use Yii;
use common\models\College;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;

/**
 * CollegemanageController implements the CRUD actions for College model.
 */
class CollegemanageController extends Controller
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
                            'index',
                            'view',
                            'update',
                            'delete',
                            'create',
                        ],
                        'allow' => true,
                        'roles' => ['SYS_ADMIN','SUPER_ADMIN'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all College models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => College::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single College model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new College model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new College();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '<i class="fa fa-info-circle"></i> College Added Successfully !');
        }
        else
        {
            Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> College Adding Failed ! '.Html::errorSummary($model));
        }

        return $this->redirect(yii::$app->request->referrer);

    }

    /**
     * Updates an existing College model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->request->isPost)
        {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '<i class="fa fa-info-circle"></i> College Updated Successfully !');
            return $this->redirect(yii::$app->request->referrer);
        }
        else
        {
            Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> College Updating Failed ! '.Html::errorSummary($model));
            return $this->redirect(yii::$app->request->referrer);
        }
    }

       

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing College model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()){
        Yii::$app->session->setFlash('success', '<i class="fa fa-info-circle"></i> College Deleted Successfully !');
        return $this->redirect(yii::$app->request->referrer);
    }
    else
    {
        Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> College Deleting Failed ! '.Html::errorSummary($model));
        return $this->redirect(yii::$app->request->referrer);
    }

        return $this->redirect(['index']);
    }

    /**
     * Finds the College model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return College the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = College::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace frontend\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\helpers\Url;
class HomeController extends \yii\web\Controller
{
        /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'=>['dashboard'],
                'rules' => [
                    [
                        'actions' => ['dashboard'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }
     public function actionDashboard()
    {

    if (Yii::$app->user->can('SUPER_ADMIN')) {
         return $this->redirect(Url::to(['/super-admin/dashboard']));
     }else if (Yii::$app->user->can('SYS_ADMIN')) {
        return $this->redirect(Url::to(['/admin/dashboard']));
    }
     else if (Yii::$app->user->can('INSTRUCTOR')) {
          return $this->redirect(Url::to(['/instructor/dashboard']));
      }
      else if (Yii::$app->user->can('STUDENT')) {
        return $this->redirect(Url::to(['/student/dashboard']));
    }
        
}
    
   

}

<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class HodController extends \yii\web\Controller
{
	//public $layout = 'instructor';
	public $defaultAction = 'dashboard';
	 public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['dashboard','error'],
                        'allow' => true,
                        'roles'=> ['HOD']
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
   
    
    public function actionDashboard()
    {
        return $this->render('index');
    }

}

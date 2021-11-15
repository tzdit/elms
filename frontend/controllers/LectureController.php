<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\AuthItem;
use common\models\User;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use Yii;
use yii\helpers\Url;
use common\helpers\Security;
use frontend\models\LectureRoom;

class LectureController extends \yii\web\Controller
{
    //public $layout = 'instructor';
       /**
     * {@inheritdoc}
     */
//################################# public $layout = 'admin'; #####################################

public $defaultAction = 'dashboard';
  public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'lecture-room',
                 

                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR']
                        

                    ],
// ############################### THIS PART FOR 'INSTRUCTOR $ HOD ROLE' ######################################
                    [
                        'actions' => [
                            'lecture-room',
                           
                           
                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR & HOD']
                        

                    ],
                    
                ],
            ],
             'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'dropcourse' => ['post'],
                ],
            ],
        ];
    }

public function actionLectureRoom()
{
 

  //more parameters will be set in the future according to need

 
    return $this->render('lectureRoom');

  




}

public function actionSession($sessionid)
{

}

public function actionNewSession()
{

  $lectureroommanager=new LectureRoom();
  $lectureroommanager->meetingId=yii::$app->session->get('ccode');
  $lectureroommanager->meetingName=yii::$app->session->get('ccode')." Lecture ".date('d-m-Y');
  $lectureroommanager->attendeePassword=yii::$app->session->get('ccode')."student";
  $lectureroommanager->moderatorPassword=yii::$app->session->get('ccode')."lecturer";

}
  
}
<?php

namespace frontend\controllers;
use frontend\models\ClassRoomSecurity;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Student;
use common\models\AuthItem;
use frontend\models\StudentLectureroom;
use BigBlueButton\BigBlueButton;

use common\models\StudentGroup;
use yii\helpers\ArrayHelper;

use Yii;
use yii\web\NotFoundHttpException;


class StudentLectureroomController extends \yii\web\Controller
{
	//public $layout = 'student';
	public $defaultAction = 'lectures';

	 public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['lectures','join-lecture'
                        ],
                        

                       'allow' => true,
                        'roles'=>['STUDENT']
                    ],
                     //for students registration
                    [
                        'actions' => ['register'],
                        

                       'allow' => true,
                        'roles'=>['?']
                    ],

                    

            
            ],
        ],
       
        ];
    
    }


  public function actionLectures()
  {
      $lectures=(new StudentLectureroom)->findAllLectures();
      return $this->render("onlinelectures",["lectures"=>$lectures]);
  } 
  public function actionJoinLecture($session,$student)
  {
    $lectureroommanager=new StudentLectureroom();
    $door_open_registar= $lectureroommanager->joinSession($session,$student);
    $rooms_master=new BigBlueButton();
      //now heading to the classroom like a boss
    header('status: 301 Moved Permanently',false,301);
    return $this->redirect($rooms_master->getJoinMeetingURL($door_open_registar));
   
  }



}

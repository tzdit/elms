<?php

namespace frontend\controllers;
use frontend\models\ClassRoomSecurity;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Student;
use common\models\AuthItem;
use frontend\models\StudentLectureroom;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Responses\ApiVersionResponse;
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
                        'actions' => ['lectures','join-lecture','play-recording'
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
      $serverstatus=true;
      $servermaster=(new BigBlueButton())->getApiVersion();
      if(!($servermaster instanceof ApiVersionResponse)){$serverstatus=false;}
      $lectures=(new StudentLectureroom)->findLectureSchedule();
      $recordings=(new StudentLectureroom)->recordings();
      $roomstatus=(new StudentLectureroom)->getRoomInfos();
      return $this->render("lectureRoom",["lectures"=>$lectures,"recordings"=>$recordings,"room"=>$roomstatus,"serverstatus"=>$serverstatus]);
  } 
  public function actionJoinLecture()
  {
    $lectureroommanager=new StudentLectureroom();
    $door_open_registar= $lectureroommanager->joinSession();

    if($door_open_registar==null) //room closed
    {
      yii::$app->session->setFlash("info","<i class='fa fa-info-circle'></i> The Room is still closed, Your Instructor has to open it first !");
      return $this->redirect(yii::$app->request->referrer);
    }
    $rooms_master=new BigBlueButton();
      //now heading to the classroom like a boss
    header('status: 301 Moved Permanently',false,301);
    return $this->redirect($rooms_master->getJoinMeetingURL($door_open_registar));
   
  }

  public function actionPlayRecording($playbackurl)
  {
    return $this->redirect($playbackurl);
  }



}

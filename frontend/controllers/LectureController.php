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
use common\models\LiveLecture;
use common\models\Lectureroominfo;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Responses\ApiVersionResponse;


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
                            'new-session',
                            'session',
                            'start-session',
                            'class-podium'
                 

                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR']
                        

                    ],
// ############################### THIS PART FOR 'INSTRUCTOR $ HOD ROLE' ######################################
                    [
                        'actions' => [
                            'lecture-room',
                            'new-session',
                            'session',
                            'start-session',
                            'class-podium'
                           
                           
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
 
    $serverstatus=true;
    $servermaster=(new BigBlueButton())->getApiVersion();
    if(!($servermaster instanceof ApiVersionResponse)){$serverstatus=false;}
    $year=(yii::$app->session->get("currentAcademicYear"))->yearID;
    $lectures=LiveLecture::find()->where(['course_code'=>yii::$app->session->get('ccode'),'yearID'=>$year])->all();
 
    return $this->render('lectureRoom',['lectures'=>$lectures,'serverstatus'=>$serverstatus]);

}

public function actionSession($sessionid)
{
    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $sessionid=Yii::$app->getSecurity()->decryptByPassword($sessionid, $secretKey);

    $session=Lectureroominfo::find()->where(['lectureID'=>$sessionid])->one();

    return $this->render('session',['session'=>$session]);
}

public function actionNewSession()
{

  
  $lectureroommanager=new LectureRoom();
  if($lectureroommanager->load(yii::$app->request->post()) && $lectureroommanager->validate())
  {
  $lectureroommanager->meetingId=yii::$app->session->get('ccode');
  $lectureroommanager->attendeePassword=yii::$app->session->get('ccode')."student";
  $lectureroommanager->moderatorPassword=yii::$app->session->get('ccode')."lecturer";

  $return=$lectureroommanager->holdRoomState();
  if($return===true)
  {
    Yii::$app->session->setFlash('success', 'Lecture Created successfully');
    return $this->redirect('lecture-room');


  }
  else
  {
    Yii::$app->session->setFlash('error',$return);
   
    return $this->redirect('lecture-room');
  
  }

  }

}
public function actionStartSession($session)
{
    $sessioninfo=Lectureroominfo::findOne($session);
    $rooms_master=new BigBlueButton();
    $roomid=$sessioninfo->meetingID;
    $mpw=$sessioninfo->mpw;
    $instructor_name=$sessioninfo->lecture->instructor->full_name;
    $door_open_registar=new JoinMeetingParameters($roomid,$instructor_name,$mpw);
    $door_open_registar->setRedirect(true);
    
    //now heading to the classroom like a boss
    header('status: 301 Moved Permanently',false,301);
    return $this->redirect($rooms_master->getJoinMeetingURL($door_open_registar));
   

}

}
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
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Responses\ApiVersionResponse;
use frontend\models\ClassRoomSecurity;
use yii\base\Exception;
use BigBlueButton\Parameters\DeleteRecordingsParameters;


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
                            'class-podium',
                            'delete-session',
                            'delete-recording',
                            'play-recording',
                            'close-room',
                            'logout'
                 

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
                            'class-podium',
                            'delete-session',
                            'delete-recording',
                            'play-recording',
                            'close-room',
                            'logout'
                           
                           
                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR & HOD']
                        

                    ],
                    [
                        'actions' => [
                 
                            'logout'
                           
                           
                        ],
                        'allow' => true,
                        'roles' => ['STUDENT']
                        

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
    $lectures=(new Lectureroom)->findLectureSchedule();
    $recordings=(new Lectureroom)->recordings();
    $roomstatus=(new Lectureroom)->getRoomInfos();
    return $this->render("lectureRoom",["lectures"=>$lectures,"recordings"=>$recordings,"room"=>$roomstatus,"serverstatus"=>$serverstatus]);

}

public function actionSession($sessionid)
{
  
    $sessionid=ClassRoomSecurity::decrypt($sessionid);

    $session=LiveLecture::find()->where(['lectureID'=>$sessionid])->one();

    return $this->render('session',['session'=>$session]);
}

public function actionNewSession()
{

  
  $lectureroommanager=new LectureRoom();
  $lectureroommanager->lecture=0;
 
  if($lectureroommanager->load(yii::$app->request->post()) && $lectureroommanager->validate())
  {
  $lectureroommanager->meetingId=yii::$app->session->get('ccode');
  $lectureroommanager->attendeePassword=yii::$app->session->get('ccode')."student";
  $lectureroommanager->moderatorPassword=yii::$app->session->get('ccode')."lecturer";

  $return=$lectureroommanager->holdRoomState();
  if($return===true)
  {
    Yii::$app->session->setFlash('success', '<i class="fa fa-info-circle"></i> Session Created successfully');
    return $this->redirect('lecture-room');


  }
  else
  {
    Yii::$app->session->setFlash('error',$return);
   
    return $this->redirect('lecture-room');
  
  }

  }

}
public function actionStartSession()
{
    $lectureroommanager=new LectureRoom();
    $rooms_master=new BigBlueButton();
    if($lectureroommanager->load(yii::$app->request->post()))
    {
 
    $door_open_registar=null;
        try
        {
            $door_open_registar= $lectureroommanager->joinSession();
               //now heading to the classroom like a boss
            header('status: 301 Moved Permanently',false,301);
            return $this->redirect($rooms_master->getJoinMeetingURL($door_open_registar));
        }
        catch(Exception $e)
        {
            try
            {
            $room=$lectureroommanager->createLectureRoom();
            $door_open_registar= $lectureroommanager->joinSession();
               //now heading to the classroom like a boss
            header('status: 301 Moved Permanently',false,301);
            return $this->redirect($rooms_master->getJoinMeetingURL($door_open_registar));
            }
            catch(Exception $d)
            {
            yii::$app->session->setFlash("error","An error occured while opening lecture room, try again later!");
            return $this->redirect(yii::$app->request->referrer);
            }
        }
        
   

    
   
}
else
{
    //print_r($lectureroommanager->getErrors());  return false;
    yii::$app->session->setFlash("error","An error occured while opening lecture room, try again later!");
    return $this->redirect(yii::$app->request->referrer);
}
   

}

public function actionDeleteSession($sessionid)
{
    $sessionid=ClassRoomSecurity::decrypt($sessionid);
    $lecture=LiveLecture::findOne($sessionid);
    if($lecture->delete())
    {
        yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i>Session deleted succefully!");
        return $this->redirect(yii::$app->request->referrer); 
    }
    else
    {
        yii::$app->session->setFlash("error","An error occured while deleting session, try again later!");
        return $this->redirect(yii::$app->request->referrer);  
    }
}

public function actionDeleteRecording($recording)
{
    $recording=ClassRoomSecurity::decrypt($recording);
    $parameters=new DeleteRecordingsParameters($recording);

    $recmanager=new BigBlueButton();

    try
    {
    $deleteres=$recmanager->deleteRecordings($parameters);
    if($deleteres->isDeleted())
    {
        yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i>Recording deleted succefully!");
        return $this->redirect(yii::$app->request->referrer);   
    }
    else
    {
        yii::$app->session->setFlash("error","An error occured while deleting Recording, try again later!");
        return $this->redirect(yii::$app->request->referrer);    
    }
    }
    catch(\RuntimeException $r)
    {
        yii::$app->session->setFlash("error","An error occured while deleting Recording, try again later!");
        return $this->redirect(yii::$app->request->referrer);   
    }
}
public function actionPlayRecording($playbackurl)
{
  return $this->redirect($playbackurl);
}

public function actionLogout()
{
    $role=Yii::$app->authManager->getRolesByUser(yii::$app->user->getId());
    $rolename=array_keys($role)[0];
    if($rolename=="STUDENT")
    {
        return $this->redirect(Url::to(["/student-lectureroom/lectures"]));
    }
    else
    {
        return $this->redirect(Url::to(["/lecture/lecture-room"])); 
    }
}
public function actionCloseRoom($room)
{
 print($room);
 print(ClassRoomSecurity::decrypt($room));
}

}

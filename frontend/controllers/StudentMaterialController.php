<?php

namespace frontend\Controllers;

use \yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Course;
use common\models\Assignment;
use common\models\Program;
use common\models\Submit;
use common\models\Material;
use common\models\User;
use common\models\Groups;
use common\models\Student;
use common\models\StudentCourse;
use common\models\InstructorCourse;
use frontend\models\UploadAssignment;
use frontend\models\AddGroup;
use frontend\models\UploadTutorial;
use frontend\models\UploadLab;
use frontend\models\UploadMaterial;
use frontend\models\CarryCourseSearch;
use common\models\StudentGroup;
use yii\helpers\ArrayHelper;
use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\helpers\Security;
use yii\widgets\ActiveForm;

class StudentMaterialController extends Controller
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['videos'],
                        'allow' => true,
                        'roles'=>['STUDENT']
                    ],
                    
                    
                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //         'changePassword' => ['post'],
            //     ],
            // ],
        ];
    }



    public function actionIndex()
    {
        return $this->render('index');
    }




    /**
     * view all video of the course
     */

     public function actionVideos($cid){
        //  $model = Material::find()->where('course_code = :course_code AND material_type = :material_type', [':course_code' => $cid, ':material_type' => 'videos'])->orderBy(['material_id' => SORT_DESC])->all();

         return $this->render('index');
     }

}

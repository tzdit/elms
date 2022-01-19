<?php

namespace frontend\controllers;

use common\models\Module;
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

class VideosAndNotesController extends \yii\web\Controller
{

    public $defaultAction = 'dashboard';

    public function behaviors()
    {
        
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['videos','notes','download_video_and_notes','view_document','modules'],
                        'allow' => true,
                        'roles'=>['STUDENT']
                    ],
                    
                    
                ],
            ],
             'verbs' => [
                 'class' => VerbFilter::className(),
                 'actions' => [
                     'logout' => ['post'],
                     'changePassword' => ['post'],

                 ],
             ],
        ];
    }


    public function actionModules($cid){

        $modules = Module::find()->where('course_code = :cid', [':cid' => $cid])->orderBy(['moduleID' => SORT_DESC])->asArray()->all();

        return $this->render('materials', ['materials' => $modules, 'cid' => $cid]);

    }



    public function actionVideos($cid)
    {
        $model = Material::find()->where('course_code = :course_code AND material_type = :material_type', [':course_code' => $cid, ':material_type' => 'videos'])->orderBy(['material_id' => SORT_DESC]);


        $dataProvider = new ActiveDataProvider([
            'query' => $model,
        ]);

        // echo '<pre>';
        // var_dump($model);
        // echo '</pre>';
        // exit;

         return $this->render('video_file', ['dataProvider' => $dataProvider,'cid' => $cid]);
    }


    public function actionNotes($cid)
    {

        $model = Material::find()->where('course_code = :course_code AND material_type = :material_type', [':course_code' => $cid, ':material_type' => 'notes'])->orderBy(['material_id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $model,
        ]);

        // echo '<pre>';
        // var_dump($model);
        // echo '</pre>';
        // exit;

         return $this->render('notes', ['dataProvider' => $dataProvider,'cid' => $cid]);
    }



    /**
     * download video
     */

    public function actionDownload_video_and_notes($material_ID) {
        $model = Material::findOne($material_ID);
    
        // This will need to be the path relative to the root of your app.
        $filePath = '/web/storage/temp';
        $completePath = Yii::getAlias('@app'.$filePath.'/'.$model->fileName);
    
        return Yii::$app->response->sendFile($completePath, $model->fileName);
    }


      /**
     * View document in the browser
     */
    public function actionView_document($material_ID)
    {
        $model = Material::findOne($material_ID);
    
        // This will need to be the path relative to the root of your app.
        $filePath = '/web/storage/temp';
        $completePath = Yii::getAlias('@app'.$filePath.'/'.$model->fileName);

        if(file_exists($completePath))
        {
            // Set up PDF headers
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $completePath . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($completePath));
            header('Accept-Ranges: bytes');

            // Render the file
            readfile($completePath);
        }
        else
        {
            throw new NotFoundHttpException(Yii::t('app', 'The requested file does not exist.'));
        }
    }

}

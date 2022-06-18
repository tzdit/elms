<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use common\models\Instructor;
use common\models\Student;
use common\models\Admin;
use common\models\Session;
use common\models\User;
use common\models\Course;
use common\models\Assignment;
use common\models\Quiz;
use common\models\Material;
class SuperAdminController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['dashboard'],
                        'allow' => true,
                        'roles' =>['SUPER_ADMIN']
                        
                    ],
                    
                    
                    
                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }
    public function actionDashboard()
    {
        $instructors=count(Instructor::find()->all());
        $admin=count(Admin::find()->all());
        $students=count(Student::find()->all());
        $opensessions=count(Session::find()->all());
        $users=count(User::find()->all());
        $courses=count(Course::find()->all());
        $materials=count(Material::find()->all());
        $assignments=count(Assignment::find()->all());
        $tests=count(Quiz::find()->all());
        return $this->render('index',[
            'instructors'=>$instructors,
            'admins'=>$admin,
            'students'=>$students,
            'opensessions'=>$opensessions,
            'users'=>$users,
            'courses'=>$courses,
            'materials'=>$materials,
            'assignments'=>$assignments,
            'tests'=>$tests
        ]);
    }

}

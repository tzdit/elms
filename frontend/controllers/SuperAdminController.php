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
use common\models\Program;
use common\models\TblAuditEntry;
use yii;
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
        $students=count(Student::find()->all());
        $opensessions=count(Session::find()->all());
        $users=count(User::find()->all());
        $courses=count(Course::find()->all());
        $materials=count(Material::find()->all());
        $tests=count(Quiz::find()->all());
        $programs=count(Program::find()->all());

        $topactivities=TblAuditEntry::findBySql("select audit_entry_user_id,audit_entry_model_name,audit_entry_operation,COUNT(audit_entry_operation) AS frequency
   from tbl_audit_entry group by audit_entry_model_name,audit_entry_operation order by frequency DESC limit 5")->all();
   $topusers=TblAuditEntry::findBySql("select audit_entry_user_id,COUNT(audit_entry_user_id) AS frequency
   from tbl_audit_entry group by audit_entry_user_id order by frequency DESC limit 5")->all();
        return $this->render('index',[
            'instructors'=>$instructors,
            'students'=>$students,
            'opensessions'=>$opensessions,
            'users'=>$users,
            'courses'=>$courses,
            'materials'=>$materials,
            'tests'=>$tests,
            'topusers'=>$topusers,
            'topactivities'=>$topactivities,
            'programs'=>$programs
        ]);
    }

}

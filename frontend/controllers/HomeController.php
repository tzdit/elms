<?php

namespace frontend\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use frontend\models\ChangePasswordForm;
use frontend\models\AddEmailForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;
class HomeController extends \yii\web\Controller
{
        /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'=>['dashboard'],
                'rules' => [
                    [
                        'actions' => ['dashboard','changePassword','add_email'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }
     public function actionDashboard()
    {

    if (Yii::$app->user->can('SUPER_ADMIN')) {
         return $this->redirect(Url::to(['/super-admin/dashboard']));
     }else if (Yii::$app->user->can('SYS_ADMIN')) {
        return $this->redirect(Url::to(['/admin/dashboard']));
    }
     else if (Yii::$app->user->can('INSTRUCTOR')) {
          return $this->redirect(Url::to(['/instructor/dashboard']));
      }
      else if (Yii::$app->user->can('STUDENT')) {
        return $this->redirect(Url::to(['/student/dashboard']));
    }

    else if (Yii::$app->user->can('HOD')) {
        return $this->redirect(Url::to(['/hod/dashboard']));
    }
        
}

public function actionChangepassword(){
    
    
    $models = new ChangePasswordForm;

    // VarDumper::dump($models->changePassword());

    try{
        if($models->load(Yii::$app->request->post())){
           // VarDumper::dump($models->changePassword());
            if($models->changePassword()){
                Yii::$app->session->setFlash('success', 'Password change successfully');
                Yii::$app->user->logout();
                $destroySession = true;
        
                return $this->redirect(['auth']);
            }else{
                Yii::$app->session->setFlash('error', 'Wrong current password');
            }
       
                
         } 
        
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something wente wrong'.$e->getMessage());
    }

    return $this->render('changePassword',['model' => $models]);
}

public function actionAdd_email(){
    
    
    $models = new AddEmailForm;

    // VarDumper::dump($models->changePassword());

    try{
        if($models->load(Yii::$app->request->post())){
           // VarDumper::dump($models->addEmail());
            if($models->addEmail()){
                Yii::$app->session->setFlash('success', 'Email added successfully');
            }else{
                Yii::$app->session->setFlash('error', 'Something went Wrong!');
            }
       
                
         } 
        
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something wente wrong'.$e->getMessage());
    }

    return $this->render('addEmail',['model' => $models]);
}
    
    
   

}

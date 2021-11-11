<?php

namespace frontend\controllers;
use common\models\Student;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\VerifyEmailForm;
class AuthController extends \yii\web\Controller
{
        /**
     * {@inheritdoc}
     */
    public $defaultAction = 'login';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','requestpasswordreset'],
                        'allow' => true,
                        
                    ],
                    [
                        'actions' => ['logout', 'error','requestPasswordResetToken','resertPassword','resendVerificationEmail','verify_email'],
                        'allow' => true,
                        'roles' =>['@']
                        
                    ],
                    
                    
                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
   
    
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
      if (!Yii::$app->user->isGuest) {
            //return $this->goHome();
             return $this->redirect(['/home/dashboard']);
       }
     $this->layout = 'login';
      $model = new LoginForm();
      if ($model->load(Yii::$app->request->post()) && $model->login()) {


          $yearOfStudy = Student::find()->select('YOS')->where('reg_no = :reg_no', [':reg_no' =>  Yii::$app->user->identity->username])->one();

          $session = Yii::$app->session;

          $session->set('yos',$yearOfStudy->YOS);

           return $this->redirect(['/home/dashboard']);
          
     }

       return $this->render('login', ['model'=>$model]);
        
    }
     /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {

     $session = Yii::$app->session;
         if ($session->isActive){
             $session->destroy();
         }
        Yii::$app->user->logout();

        return $this->redirect(['auth/login']);
    }



    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestpasswordreset()
    {
        $this->layout = 'login';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerify_email($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    
    

}

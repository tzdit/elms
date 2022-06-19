<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $id
 * @property string|null $sessionid
 * @property int|null $userID
 * @property string|null $username
 * @property string|null $role
 * @property string|null $college
 * @property string|null $prog_or_dept
 * @property int|null $year
 *
 * @property User $user
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userID', 'year'], 'integer'],
            [['sessionid'], 'string', 'max' => 500],
            [['username'], 'string', 'max' => 200],
            [['role', 'college'], 'string', 'max' => 20],
            [['prog_or_dept'], 'string', 'max' => 50],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sessionid' => 'Sessionid',
            'userID' => 'User ID',
            'username' => 'Username',
            'role' => 'User Type',
            'college' => 'College',
            'prog_or_dept' => 'Program Or Depart.',
            'year' => 'Year',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userID']);
    }

    public function setDbSession($user)
    {
           $username=$user->username;
           $role=null;
           $college=null;
           $prog_or_dept=null;
           $year=null;

           if($user->instructor)
           {
             $college=$user->instructor->department->college->college_abbrev;
             $prog_or_dept=$user->instructor->department->depart_abbrev;
             $role="Instructor";
           }
           else if($user->student)
           {
            $college=$user->student->program->department->college->college_abbrev;
            $prog_or_dept=$user->student->programCode;
            $year=$user->student->YOS;
            $role="Student";  
           }
           else
           {
               //reserved
           }
           $this->sessionid=yii::$app->session->getId();
           $this->userID=yii::$app->user->id;
           $this->username=$username;
           $this->college=$college;
           $this->prog_or_dept=$prog_or_dept;
           $this->year=$year;
           $this->role=$role;
           $this->clearDbSession(); //we make sure no other records still there
           $this->save();
    }

    public function clearDbSession()
    {
        $userid=yii::$app->user->id;
        $session=$this->find()->where(['userID'=>$userid])->one();
        if($session!=null)
        $session->delete();
    }
}

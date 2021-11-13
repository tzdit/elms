<?php

namespace frontend\models;

use common\models\Student;
use common\models\User;
use Yii;


/**
 * This is the model class for table "user".
 *

 * @property string $username

 * @property Student[] $students
 */
class ChangeRegNoForm extends \yii\db\ActiveRecord
{

    public $username;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'required'],

            [['username'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

            'username' => 'Username',
        ];
    }



    /**
     * Change Regno
     *
     * @return bool whether the Regno is added.
     */
    public function changeRegno()
    {
        //get authManager instance
        $auth = Yii::$app->authManager;
        if (!$this->validate()) {
            return false;
        }

        $id = Yii::$app->user->getId();
        $reg_no = Yii::$app->user->identity->username;

        $user = User::findIdentity($id);
        $student = Student::findReg_no($reg_no);


        /* save the new password to the database */
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $user->username = $this->username;
            if($user->save()){
                $student->reg_no = $this->username;
                if($student->save()){
                    $transaction->commit();
                    return true;
                }

            }

        }catch(\Throwable $e){
            $transaction->rollBack();
            return $e->getMessage();
        }
        return false;
    }

}

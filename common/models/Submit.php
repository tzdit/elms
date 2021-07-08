<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "submit".
 *
 * @property int $submitID
 * @property string|null $reg_no
 * @property int|null $assID
 * @property string $fileName
 * @property float|null $score
 * @property string $submit_date
 * @property string $submit_time
 * @property string|null $comment
 *
 * @property QMarks[] $qMarks
 * @property Assignment $ass
 * @property Student $regNo
 */
class Submit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'submit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assID'], 'integer'],
            [['fileName'], 'required'],
            [['score'], 'number'],
            [['submit_date', 'submit_time'], 'safe'],
            [['reg_no', 'fileName'], 'string', 'max' => 20],
            [['comment'], 'string', 'max' => 200],
            [['assID'], 'exist', 'skipOnError' => true, 'targetClass' => Assignment::className(), 'targetAttribute' => ['assID' => 'assID']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'submitID' => 'Submit ID',
            'reg_no' => 'Reg No',
            'assID' => 'Ass ID',
            'fileName' => 'File Name',
            'score' => 'Score',
            'submit_date' => 'Submit Date',
            'submit_time' => 'Submit Time',
            'comment' => 'Comment',
        ];
    }

    /**
     * Gets query for [[QMarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQMarks()
    {
        return $this->hasMany(QMarks::className(), ['submitID' => 'submitID']);
    }

    /**
     * Gets query for [[Ass]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAss()
    {
        return $this->hasOne(Assignment::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[RegNo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegNo()
    {
        return $this->hasOne(Student::className(), ['reg_no' => 'reg_no']);
    }
}

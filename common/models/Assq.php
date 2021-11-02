<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assq".
 *
 * @property int $assq_ID
 * @property int|null $assID
 * @property int $qno
 * @property int $total_marks
 *
 * @property Assignment $ass
 * @property QMarks[] $qMarks
 */
class Assq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assID', 'qno', 'total_marks'], 'integer'],
            [['qno', 'total_marks'], 'required'],
            [['assID'], 'exist', 'skipOnError' => true, 'targetClass' => Assignment::className(), 'targetAttribute' => ['assID' => 'assID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'assq_ID' => 'Assq ID',
            'assID' => 'Ass ID',
            'qno' => 'Qno',
            'total_marks' => 'Total Marks',
        ];
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
     * Gets query for [[QMarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQMarks()
    {
        return $this->hasMany(QMarks::className(), ['assq_ID' => 'assq_ID']);
    }
}

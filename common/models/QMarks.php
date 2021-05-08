<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "q_marks".
 *
 * @property int $qmarkID
 * @property int|null $submitID
 * @property int|null $assq_ID
 * @property float|null $q_score
 * @property string|null $comment
 *
 * @property Assq $assq
 * @property Submit $submit
 */
class QMarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'q_marks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['submitID', 'assq_ID'], 'integer'],
            [['q_score'], 'number'],
            [['comment'], 'string', 'max' => 200],
            [['assq_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Assq::className(), 'targetAttribute' => ['assq_ID' => 'assq_ID']],
            [['submitID'], 'exist', 'skipOnError' => true, 'targetClass' => Submit::className(), 'targetAttribute' => ['submitID' => 'submitID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'qmarkID' => 'Qmark ID',
            'submitID' => 'Submit ID',
            'assq_ID' => 'Assq ID',
            'q_score' => 'Q Score',
            'comment' => 'Comment',
        ];
    }

    /**
     * Gets query for [[Assq]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssq()
    {
        return $this->hasOne(Assq::className(), ['assq_ID' => 'assq_ID']);
    }

    /**
     * Gets query for [[Submit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmit()
    {
        return $this->hasOne(Submit::className(), ['submitID' => 'submitID']);
    }
}

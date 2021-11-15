<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lectureroominfo".
 *
 * @property int $lectureroomID
 * @property int $lectureID
 * @property string $meetingID
 * @property string $mpw
 * @property string $attpw
 *
 * @property LiveLecture $lecture
 */
class Lectureroominfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lectureroominfo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lectureID', 'meetingID', 'mpw', 'attpw'], 'required'],
            [['lectureID'], 'integer'],
            [['meetingID'], 'string', 'max' => 10],
            [['mpw', 'attpw'], 'string', 'max' => 20],
            [['lectureID'], 'exist', 'skipOnError' => true, 'targetClass' => LiveLecture::className(), 'targetAttribute' => ['lectureID' => 'lectureID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lectureroomID' => 'Lectureroom ID',
            'lectureID' => 'Lecture ID',
            'meetingID' => 'Meeting ID',
            'mpw' => 'Mpw',
            'attpw' => 'Attpw',
        ];
    }

    /**
     * Gets query for [[Lecture]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLecture()
    {
        return $this->hasOne(LiveLecture::className(), ['lectureID' => 'lectureID']);
    }
}

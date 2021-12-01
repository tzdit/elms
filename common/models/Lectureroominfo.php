<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "lectureroominfo".
 *
 * @property int $lectureroomID
 * @property int $lectureID
 * @property string $meetingID
 * @property int $duration
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
    
    public function behaviors()
    {
        return [
            'auditEntryBehaviors' => [
                'class' => AuditEntryBehaviors::class
             ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lectureID', 'meetingID', 'duration', 'mpw', 'attpw'], 'required'],
            [['lectureID', 'duration'], 'integer'],
            [['meetingID'], 'string', 'max' => 255],
            [['mpw', 'attpw'], 'string', 'max' => 255],
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
            'duration' => 'Duration',
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

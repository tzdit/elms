<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "studentdisabilities".
 *
 * @property int $disabID
 * @property int|null $DEAFBLIND
 * @property int|null $MULTIIMPARED
 * @property int|null $ALBINO
 * @property int|null $VISUALLYIMPARED
 * @property int|null $PHYSICALLYIMPARED
 * @property int|null $HEARINGIMPARED
 * @property string $reg_no
 *
 * @property Student $regNo
 */
class Studentdisabilities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'studentdisabilities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DEAFBLIND', 'MULTIIMPARED', 'ALBINO', 'VISUALLYIMPARED', 'PHYSICALLYIMPARED', 'HEARINGIMPARED'], 'integer'],
            [['reg_no'], 'required'],
            [['reg_no'], 'string', 'max' => 20],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'disabID' => 'Disab ID',
            'DEAFBLIND' => 'Deafblind',
            'MULTIIMPARED' => 'Multiimpared',
            'ALBINO' => 'Albino',
            'VISUALLYIMPARED' => 'Visuallyimpared',
            'PHYSICALLYIMPARED' => 'Physicallyimpared',
            'HEARINGIMPARED' => 'Hearingimpared',
            'reg_no' => 'Reg No',
        ];
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

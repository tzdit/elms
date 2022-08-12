<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "backgroundinfo".
 *
 * @property int $bi_info
 * @property int|null $theory
 * @property int|null $prac
 * @property string $employstatus
 * @property string $reg_no
 *
 * @property Student $regNo
 */
class Backgroundinfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'backgroundinfo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['theory', 'prac'], 'integer'],
            [['employstatus', 'reg_no'], 'required'],
            [['employstatus'], 'string', 'max' => 15],
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
            'bi_info' => 'Bi Info',
            'theory' => 'Theory',
            'prac' => 'Prac',
            'employstatus' => 'Employstatus',
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

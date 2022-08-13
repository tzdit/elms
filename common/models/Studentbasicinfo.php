<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "studentbasicinfo".
 *
 * @property int $infoID
 * @property string|null $profil
 * @property string|null $birthdate
 * @property string $nida
 * @property string $region
 * @property string $district
 * @property string|null $ward
 * @property string $maritalstatus
 * @property string $reg_no
 * @property string|null $spouseaddress
 * @property string|null $spousephone
 *
 * @property Student $regNo
 */
class Studentbasicinfo extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'studentbasicinfo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthdate'], 'safe'],
            [['region','birthdate', 'district','ward','nida','maritalstatus', 'reg_no'], 'required'],
            [['profil', 'ward', 'maritalstatus', 'reg_no', 'spouseaddress'], 'string', 'max' => 20],
            [['nida', 'region', 'district'], 'string', 'max' => 25],
            [['file'], 'file', 'skipOnEmpty' =>true,'extensions'=>['jpg','png']],
            [['spousephone'], 'string', 'max' => 15],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'infoID' => 'Info ID',
            'profil' => 'Profil',
            'birthdate' => 'Birth Date',
            'nida' => 'NIDA',
            'region' => 'Region',
            'district' => 'District',
            'ward' => 'Ward',
            'maritalstatus' => 'Marital status',
            'reg_no' => 'Reg No',
            'spouseaddress' => 'Spouse address',
            'spousephone' => 'Spouse phone',
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

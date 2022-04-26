<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "receipts".
 *
 * @property int $receiptnumber
 * @property int $issuedto
 * @property int $issuedfor
 * @property int $issuer
 * @property string $type
 * @property string $issuedon
 * @property int $yearID
 */
class Receipts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receiptnumber', 'issuedto', 'issuedfor', 'issuer', 'type', 'issuedon', 'yearID'], 'required'],
            [['receiptnumber', 'issuedto', 'issuedfor', 'issuer', 'yearID'], 'integer'],
            [['issuedon'], 'safe'],
            [['type'], 'string', 'max' => 30],
            [['receiptnumber'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'receiptnumber' => 'Receiptnumber',
            'issuedto' => 'Issuedto',
            'issuedfor' => 'Issuedfor',
            'issuer' => 'Issuer',
            'type' => 'Type',
            'issuedon' => 'Issuedon',
            'yearID' => 'Year ID',
        ];
    }
}

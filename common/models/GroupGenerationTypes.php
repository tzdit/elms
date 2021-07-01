<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group_generation_types".
 *
 * @property int $typeID
 * @property string $generation_type
 *
 * @property Groups[] $groups
 */
class GroupGenerationTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_generation_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['generation_type'], 'required'],
            [['generation_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'typeID' => 'Type ID',
            'generation_type' => 'Generation Type',
        ];
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['generation_type' => 'typeID']);
    }
}

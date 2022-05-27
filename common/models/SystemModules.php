<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "system_modules".
 *
 * @property int $moduleID
 * @property string $moduleName
 * @property string|null $moduleDescription
 * @property string $status
 */
class SystemModules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_modules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['moduleName'], 'required'],
            [['moduleName'], 'string', 'max' => 30],
            [['moduleDescription'], 'string', 'max' => 150],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'moduleID' => 'Module ID',
            'moduleName' => 'Module Name',
            'moduleDescription' => 'Module Description',
            'status' => 'Status',
        ];
    }

    public function activate()
    {
        $this->status="active";

        return $this->save();
    }
    public function deactivate()
    {
        $this->status="not active";

        return $this->save();
    }
}

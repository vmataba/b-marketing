<?php

namespace app\models;

use app\assets\DataDefinition;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "app_currency".
 *
 * @property int $id
 * @property string $name
 * @property string $acronym
 * @property int $is_active
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 */
class Currency extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'app_currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'acronym', 'is_active'], 'required'],
            [['is_active', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['acronym'], 'string', 'max' => 54],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'acronym' => 'Acronym',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public static function getCurrencies() {
        $models = self::find()
                ->select(['id', 'name', 'acronym'])
                ->where(['is_active' => DataDefinition::BOOLEAN_TYPE_YES])
                ->all();
        return ArrayHelper::map($models, 'id', 'acronym');
    }

}

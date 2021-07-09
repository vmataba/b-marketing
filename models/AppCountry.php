<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "app_country".
 *
 * @property int $id
 * @property string $country_code
 * @property string $country_name
 */
class AppCountry extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'app_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['country_code', 'country_name'], 'required'],
            [['country_code'], 'string', 'max' => 10],
            [['country_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
        ];
    }

    public static function getEastAfricanCountries() {
        $countries = self::find()
            ->select(['id', 'country_name'])
            ->where('country_code IN ("TZ","KE","UG","BI")')
            ->orderBy(['country_name' => SORT_ASC])
            ->all();
        return ArrayHelper::map($countries, 'id', 'country_name');
    }

    public static function getCountries() {
        $countries = self::find()
            ->select(['id', 'country_name'])
            ->orderBy(['country_name' => SORT_ASC])
            ->all();
        return ArrayHelper::map($countries, "id", "country_name");
    }

    public static function getCountryCodes() {
        $countryCodes = [];
        $countries = AppCountry::find()
            ->select('country_code')
            ->asArray()
            ->all();
        foreach ($countries as $country) {
            $countryCodes[] = $country['country_code'];
        }
        return $countryCodes;
    }

}

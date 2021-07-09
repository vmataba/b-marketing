<?php

namespace app\models;

use DateTime;
use miserenkov\validators\PhoneValidator;

/**
 * This is the model class for table "app_user".
 *
 * @property int $id
 * @property int $app_user_type_id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property int $salutation
 * @property string $first_name
 * @property string $middle_name
 * @property string $surname
 * @property int $app_country_id
 * @property string $phone
 * @property string $email
 * @property string $photo
 * @property int $default_system_route_id
 * @property int $has_default_password
 * @property string $last_login
 * @property int $is_active
 * @property string $created_at
 * @property string $sex
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 */
class AppUser extends User {

    public $confirm_password;
    public $confirm_email;
    public $confirm_phone;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'app_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['app_user_type_id', 'username', 'password', 'auth_key', 'salutation', 'first_name', 'surname', 'app_country_id', 'phone', 'email', 'confirm_password', 'confirm_email', 'confirm_phone', 'birthdate'], 'required'],
            [['app_user_type_id', 'salutation', 'app_country_id', 'default_system_route_id', 'has_default_password', 'is_active', 'created_by', 'updated_by'], 'integer'],
            [['last_login', 'created_at', 'updated_at', 'sex'], 'safe'],
            [['username', 'auth_key', 'access_token', 'first_name', 'middle_name', 'surname', 'email'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 256],
            [['phone', 'confirm_phone'], PhoneValidator::class, 'countries' => AppCountry::getCountryCodes()],
            [['photo'], 'string', 'max' => 512],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email', 'confirm_email'], 'email'],
            [['phone'], 'unique'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
            ['confirm_email', 'compare', 'compareAttribute' => 'email'],
            ['confirm_phone', 'compare', 'compareAttribute' => 'phone'],
        ];
    }

    public static function computeAge($birthdate) {

        $date = new DateTime($birthdate);
        $now = new DateTime();
        $interval = $now->diff($date);
        return (float)$interval->y . "." . str_pad($interval->m, 2, '0', STR_PAD_LEFT);


    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'app_user_type_id' => 'App User Type ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'salutation' => 'Salutation',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'surname' => 'Surname',
            'app_country_id' => 'Country of Citizenship',
            'phone' => 'Phone',
            'email' => 'Email',
            'photo' => 'Photo',
            'default_system_route_id' => 'Default System Route ID',
            'has_default_password' => 'Has Default Password',
            'last_login' => 'Last Login',
            'birthdate' => 'Date of Birth (Age limit: 55years)',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}

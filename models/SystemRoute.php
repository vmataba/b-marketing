<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_system_route".
 *
 * @property int $id
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $pretty_name
 * @property int $is_active
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 */
class SystemRoute extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'app_system_route';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['controller', 'action', 'pretty_name', 'created_by'], 'required'],
            [['is_active', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['module', 'controller', 'action', 'pretty_name'], 'string', 'max' => 128],
            [['module', 'controller', 'action'], 'unique', 'targetAttribute' => ['module', 'controller', 'action']],
            [['pretty_name'], 'unique', 'message' => 'This name already exists']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'module' => 'Module',
            'controller' => 'Controller',
            'action' => 'Action',
            'pretty_name' => 'Pretty Name',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getRoute() {
        if (empty($this->module)) {
            return "$this->controller/$this->action";
        }
        return "$this->module/$this->controller/$this->action";
    }

    public function getCreatedBy() {
        return User::findOne($this->created_by);
    }

    public function getUpdatedBy() {
        return User::findOne($this->updated_by);
    }

    public function countUses() {
        return CanPerform::find()->where(['system_route_id' => $this->id])->count();
    }

    public function everUsed() {
        return $this->countUses() > 0;
    }

    public function canBeDeleted() {
        return !$this->everUsed();
    }

    public static function getCurrentRoute() {
        return \Yii::$app->controller->route;
    }

    public static function getCurrentModule() {
        $currentRoute = self::getCurrentRoute();
        $routeArray = explode("/", $currentRoute);
        if (sizeof($routeArray) < 3) {
            return null;
        }
        return $routeArray[0];
    }

    public static function getCurrentController() {
        $currentRoute = self::getCurrentRoute();
        $routeArray = explode("/", $currentRoute);
        if (sizeof($routeArray) >= 3) {
            return $routeArray[1];
        }
        return $routeArray[0];
    }

    public static function getCurrentAction() {
        $currentRoute = self::getCurrentRoute();
        $routeArray = explode("/", $currentRoute);
        if (sizeof($routeArray) >= 3) {
            return $routeArray[2];
        }
        return $routeArray[1];
    }

    public static function activeWhen($params = []) {
        if (empty($params)) {
            return false;
        }
        $shouldActivateMenuItem = true;

        if (isset($params['module'])) {
            $shouldActivateMenuItem &= $params['module'] === self::getCurrentModule();
        }
        if (!isset($params['controller'])) {
            return false;
        }
        $shouldActivateMenuItem &= $params['controller'] === self::getCurrentController();
        if (isset($params['actions'])) {
            $actionsCondition = false;
            for ($index = 0; $index < sizeof($params['actions']); $index++) {
                if ($params['actions'][$index] === self::getCurrentAction()) {
                    $actionsCondition = true;
                    break;
                }
            }
            $shouldActivateMenuItem &= $actionsCondition;
        }
        return $shouldActivateMenuItem;
    }

}

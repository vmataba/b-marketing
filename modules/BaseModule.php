<?php

namespace app\modules;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Yii;
use yii\base\Module;

/**
 * Description of BaseModule
 *
 * @author victor
 */
class BaseModule extends Module {

    /**
     * {@inheritdoc}
     */
    public function init() {
        parent::init();
        //$this->layout = 'main';
        $this->layout = "@app/views/layouts/main";
        foreach (Yii::$app->params['modules'] as $moduleId => $module) {
            if ($module['active']) {
                $module['active'] = false;
            }
        }
        \Yii::$app->params['modules'][$this->id]['active'] = true;
    }

    public static function hasActiveModule() {
        foreach (Yii::$app->params['modules'] as $moduleId => $module) {
            if ($module['active']) {
                return true;
            }
        }
        return false;
    }

    public static function getActiveModule() {
        foreach (Yii::$app->params['modules'] as $moduleId => $module) {
            if ($module['active']) {
                return $module;
            }
        }
    }

    public static function deactivateAll() {
        foreach (Yii::$app->params['modules'] as $moduleId => $module) {
            if ($module['active']) {
                $module['active'] = false;
            }
        }
    }
}

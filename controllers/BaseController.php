<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

/**
 * Description of BaseController
 *
 * @author Victor Mataba <vmataba0@gmail.com>
 */
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use app\models\User;
use yii\helpers\Url;
use app\modules\BaseModule;

class BaseController extends Controller {

    const EXPECTIONAL_ROUTES = [
        'site/logout',
        'site/login',
        'site/log-me-out',
        'payroll/payroll/test',
        'payroll/payroll/clean',
        'payroll/payroll/load-next-date',
        'recruitment/job/update-country',
        'recruitment/job-application/load-attachment'
    ];

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {

            if (Yii::$app->user->isGuest) {
                $this->redirect(['/site/login']);
                return false;
            }
            Yii::$app->session['sessionTimeout'] = Yii::$app->params['sessionTimeout'];
            date_default_timezone_set("Africa/Dar_es_Salaam");

            if (empty($this->module) || $this->module === null) {
                BaseModule::deactivateAll();
            }

            $currentUser = User::findOne(Yii::$app->user->id);

            /* In active user */
            if (!$currentUser->isActive() && $this->route !== 'user/inactive') {
                return $this->redirect(['user/inactive', 'id' => $currentUser->id]);
            }

            /* User with default password */
//            if ($currentUser->hasDefaultPassword() && $this->route !== 'user/update-password') {
//                return $this->redirect(['user/update-password', 'id' => $currentUser->id]);
//            }

            if (!$currentUser->canPerform($this->route) && !in_array($this->route, self::EXPECTIONAL_ROUTES)) {
                throw new ForbiddenHttpException("Access denied! Please contact your System Adminstrator.");
            }

            return true;
        }
        return false;
    }

    public function goHome() {
        $currentUser = User::findOne(Yii::$app->user->id);
        if ($currentUser !== null && $currentUser->hasDefaultPage()) {
            return $this->redirect(Url::to([$currentUser->getDefaultSystemRoute()->getRoute()]));
        }
        return parent::goHome();
    }

}

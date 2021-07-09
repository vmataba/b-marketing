<?php

namespace app\controllers;

use app\models\Employee;
use app\models\EmployeeContract;
use app\modules\payroll\models\ApprovalAction;
use yii\helpers\Json;
use yii\web\Controller;

class TesterController extends Controller{

    public function actionIndex(){
        return 'It works';
    }

    public function actionTest(){
        return Json::encode(ApprovalAction::getActionsByGroups());
    }


}
<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use kartik\tabs\TabsX;

$this->registerAssetBundle(yii\web\JqueryAsset::className(), View::POS_HEAD);
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\NotificationSearch $searchModel
 */
$this->title = 'Welcome ' . $fullname;
$this->params['breadcrumbs'][] = 'Welcome';

echo TabsX::widget([
    'items' => [
        [
            'label' => '<i class="glyphicon glyphicon-envelope"></i> NOTIFICATIONS',
            'content' => $this->render('_index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'modelUser' => $modelUser,
                'fullname' => $fullname,
            ]),
            'id' => 'notifications_tab_id',
        ],
        
        [
            'label' => '<i class="glyphicon glyphicon-list-alt"></i> GENERAL INSTRUCTIONS',
            'content' => $this->render('_general_instructions', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'modelUser' => $modelUser,
                'fullname' => $fullname,
            ]),
            'id' => 'notifications_tab_id',
        ],
    ],
    'position' => TabsX::POS_ABOVE,
    'bordered' => false,
    'encodeLabels' => false
]);





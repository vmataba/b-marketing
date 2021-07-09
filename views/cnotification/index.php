<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\CnotificationSearch $searchModel
 */

$this->title = 'Composed Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cnotification-index">
 

    <?php  
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'cnotification_id',
            //'title',
            'subject',
            [
              'attribute'=>'is_group',
              'value'=>function($model){
                if($model->is_group == 1){
                    return "<span class='label label-success'>YES</span>";
                } else {
                     return "<span class='label label-info'>NO</span>";
                }
              },
              'format'=>'raw',
            ],
            [
              'attribute'=>'is_system',
              'value'=>function($model){
                if($model->is_system == 1){
                    return "<span class='label label-success'>YES</span>";
                } else {
                     return "<span class='label label-info'>NO</span>";
                }
              },
              'format'=>'raw',
            ],
            //'notification:ntext',
            //['attribute' => 'date_created','format' => ['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']],

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Yii::$app->urlManager->createUrl(['cnotification/update', 'id' => $model->cnotification_id, 'edit' => 't']),
                            ['title' => Yii::t('yii', 'Edit'),]
                        );
                    },
                   
                    
                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]);  ?>

</div>

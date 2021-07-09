<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\Cnotification $model
 */

//$this->title = $model->cnotification_id;
//$this->params['breadcrumbs'][] = ['label' => 'Cnotifications', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cnotification-view">



    <?php
   
       $keys = '';
      if(trim($model->query)!= ''){
       $row = \app\models\Cnotification::checkQuery($model->query);
       if($row === false){
        $keys = "Query has no records";   
       } else {
          $row = array_flip($row); 
          $keys = implode(', ', $row);
       }
   }
    echo DetailView::widget([
        'model' => $model,
        'condensed' => false,
        'hover' => true,
        'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
        'panel' => [
            //'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
            'heading'=>  Html::a('[Back to List]', ['/cnotification/index']).'&nbsp;&nbsp;&nbsp;'.Html::a('[Edit]', ['/cnotification/update','id'=>$model->cnotification_id])
        ],
        'attributes' => [
            //'cnotification_id',
            'subject',
            //'title',
       
            [
              'attribute'=>'notification',
              'format'=>'raw',
            ],
            [
              'attribute'=>'is_group',
              'value'=>($model->is_group == 1)?"<span class='label label-success'>YES</span>":"<span class='label label-info'>NO</span>",
              'format'=>'raw',  
            ],
            'query',
            [
              'label'=>'Keys',
              'value'=>$keys,
            ],
            'date_created',
         
        ],
        'deleteOptions' => [
            'url' => ['delete', 'id' => $model->cnotification_id],
        ],
        'enableEditMode' => false,
    ]) ?>

</div>

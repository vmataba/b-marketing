<script>
    
    function sendEmails(sent_notification_id){
      
      var url = '<?= yii\helpers\Url::to(['/notifications/send-email'], true) ?>&sent_notification_id='+sent_notification_id;
     
      $("#send-email-dialog-id").dialog("open");
      $("#send-email-iframe-id").attr('src', url);
    }
    
</script>


<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\SentNotificationSearch $searchModel
 */

$this->title = 'Send Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sent-notification-index">
    <?php 
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            [
//              'label'=>'Title' ,
//               'value'=>function($model){
//                return app\models\Cnotification::findOne($model->cnotification_id)->title;
//               }
//            ],
            [
              'label'=>'Message Subject' ,
               'value'=>function($model){
                return app\models\Cnotification::findOne($model->cnotification_id)->subject;
               }
            ],
            //'description',
           [
             'label'=>'Messages',
             'value'=>function($model){
                return number_format(app\models\Notification::find()->where("sent_notification_id = {$model->sent_notification_id}")->count());
             },
             'hAlign'=>'right',
             'format'=>'raw',
           ],
                      [
             'label'=>'Read (System)',
             'value'=>function($model){
                return number_format(app\models\Notification::find()->where("sent_notification_id = {$model->sent_notification_id} and is_read = 1")->count());
             },
             'hAlign'=>'right',
             'format'=>'raw',
           ],
                     
           [
             'label'=>'Sent (Emails)',
             'value'=>function($model){
            $unsent = number_format(app\models\Notification::find()->where("sent_notification_id = {$model->sent_notification_id} and email_sent = 1")->count());
             return $unsent.' '.' [ '.Html::a('SEND EMAILS', 'javascript:sendEmails('.$model->sent_notification_id.')').' ]';
             },
             'hAlign'=>'right',
             'format'=>'raw',
           ],
            //'user_sent',
           [
             'label'=>'Date',
             'attribute'=>'date_sent',
           ],
            //['attribute' => 'date_sent','format' => ['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']], 

//            [
//                'class' => 'yii\grid\ActionColumn',
//                'buttons' => [
//                    'update' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
//                            Yii::$app->urlManager->createUrl(['sent-notification/view', 'id' => $model->sent_notification_id, 'edit' => 't']),
//                            ['title' => Yii::t('yii', 'Edit'),]
//                        );
//                    }
//                ],
//            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type' => 'default',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', '', ['class' => 'btn btn-success','onclick'=>"$('#sending-notification-dialog-id').dialog('open'); return false;"]),
           // 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]); 
    
                 \yii\jui\Dialog::begin([
    'clientOptions' => [
        'modal' => true,
        'autoOpen' => false,
        'height' => '350',
        'width' => '500'
    ],
    'options' => [
        'title' => 'Sending Notification',
        'id' => 'sending-notification-dialog-id'
    ]
        ]
);
 echo $this->render('_form',['model'=>$model]);
\yii\jui\Dialog::end();

             \yii\jui\Dialog::begin([
    'clientOptions' => [
        'modal' => true,
        'autoOpen' => false,
        'height' => '350',
        'width' => '500'
    ],
    'options' => [
        'title' => 'Sending Emails',
        'id' => 'send-email-dialog-id'
    ]
        ]
);
 echo '<iframe src="" width="100%" height="400px" style="border: 0" id="send-email-iframe-id"></iframe>';
\yii\jui\Dialog::end();  
?>
   

</div>

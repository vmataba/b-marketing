<script>
  function RefreshWindow(){
    /alert('How are you?');
//    var url = $('#send-notifications-frame-id').attr('src'); 
//    $('#send-notifications-frame-id').attr('src',url);
//
  }  
</script>

<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\tabs\TabsX;

$this->title = 'Manage Notifications';
$this->params['breadcrumbs'][] = $this->title;


echo TabsX::widget([
    'items' => [
        [
           'label'=>'Compose Messages',
           'content'=>'<iframe src="'.yii\helpers\Url::to(['/cnotification/index']).'" width="100%" height="400px" style="border: 0"></iframe>',
           'id'=>'1',
        ],
        
//        [
//           'label'=>'Activate Account',
//           'content'=>'<iframe src="'.yii\helpers\Url::to(['/institution/activate-account','id'=>1]).'" width="100%" height="400px" style="border: 0"></iframe>',
//           'id'=>'2',
//        ],
//        
//         [
//           'label'=>'Account Activated',
//           'content'=>'<iframe src="'.yii\helpers\Url::to(['/institution/account-activated','id'=>1]).'" width="100%" height="400px" style="border: 0"></iframe>',
//           'id'=>'3',
//        ],
//        
//         [
//           'label'=>'Payment Confirmed',
//           'content'=>'<iframe src="'.yii\helpers\Url::to(['/institution/payment-confirmed','id'=>1]).'" width="100%" height="400px" style="border: 0"></iframe>',
//           'id'=>'4',
//        ],
//        
//                 [
//           'label'=>'Referee Email(PG)',
//           'content'=>'<iframe src="'.yii\helpers\Url::to(['/institution/referee-email','id'=>1]).'" width="100%" height="400px" style="border: 0"></iframe>',
//           'id'=>'5',
//        ],
//        
        [
           'label'=>'Send Emails/Messages',
           'content'=>'<div onclick="RefreshWindow()"><iframe src="'.yii\helpers\Url::to(['/sent-notification/index/']).'" width="100%" height="400px" style="border: 0"  id="send-notifications-frame-id"></iframe></div>',
           'id'=>'6',
        ],
        
    ],
    'position' => TabsX::POS_ABOVE,
    'bordered' => true,
    'encodeLabels' => false
]);


?>
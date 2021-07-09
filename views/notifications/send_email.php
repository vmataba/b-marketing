<?php
$number = app\models\Notification::find()->where("sent_notification_id = {$sent_notification_id} and email_sent = 0 ")->count();
$modelSN = app\models\SentNotification::findOne($sent_notification_id);
$modelCNotification = \app\models\Cnotification::findOne($modelSN->cnotification_id);

if($action == 'send'){
    
     if (ob_get_level() == 0) ob_start();
           echo "Preparing..........<br>";
           ob_flush();
                flush();
           echo "Sending notification to System Administrators/Users..........<br>";
           ob_flush();
                flush();
    $message_notifier = 'Dear user, this is to inform you that the system has started sending <strong>'.number_format($number) .'</strong> emails, with a subject <em><strong>'.$modelCNotification->subject .'</strong></em> and title <em><strong>'. $modelCNotification->title .'</strong></em> <br> '
            . 'The system will notify you once it has finished sending all the emails. <br><br>'
            . 'Sincerely, <br> '
            . 'EAC BMS Budget Requisition and Accountability Module <br><br> '
            . '<em>Please note, this is an auto generated email, do not reply</em>';
    $notifier = explode(';',$modelSN->notifier);
    
    foreach ($notifier as $key => $value) {
        $value = trim($value);
        $send_status = app\models\Notification::sendEmail($value, 'Admission System Notification', $message_notifier);
        if($send_status == true){
        echo "Notification to {$value} succeeded..........<br>";
        } else {
           echo "Notification to {$value} failed..........<br>";  
        }
           ob_flush();
                flush();   
    }
    
    echo "<br>Sending to Users..........<br>";
           ob_flush();
                flush();
                
    $notifications = app\models\Notification::find()->where("sent_notification_id = {$sent_notification_id} and email_sent = 0 ")->all();
    $sent = 0;
    $failed = 0;
    $succeded = 0;
    foreach ($notifications as $notific) {
        ++$sent;
        $email_address = trim($notific->email_address);
        $send_status = app\models\Notification::sendEmail($email_address, $notific->subject, $notific->notification);
        if($send_status == true){
        echo "{$email_address} succeeded..........<br>";
        $notific->email_sent = 1;
        $notific->date_email_sent = date('Y-m-d H:i:s');
        $notific->save();
        ++$succeded;
        } else {
           echo "{$email_address} failed..........<br>"; 
           ++$failed;
        }
           ob_flush();
                flush();  
    }
    
    echo "Sending Report to System Administrators/Users..........<br>";
    ob_flush();
                flush();
           
           $message_notifier = 'Dear user, this is to inform you that the system has completed sending <strong>'.number_format($sent) .'</strong> emails, with a subject <em><strong>'.$modelCNotification->subject .'</strong></em> <br> '
            . 'Out of which '. number_format($succeded).' succeded and '. number_format($failed).' failed<br><br>'
            . 'Sincerely, <br> '
            . 'EAC BMS Budget Requisition and Accountability Module <br><br> '
            . '<em>Please note, this is an auto generated email, do not reply</em>';    
           foreach ($notifier as $key => $value) {
        $value = trim($value);
        $send_status = app\models\Notification::sendEmail($value, 'EAC BMS - Process Completed', $message_notifier);
        if($send_status == true){
        echo "Notification to {$value} succeeded..........<br>";
        } else {
           echo "Notification to {$value} failed..........<br>";  
        }
           ob_flush();
                flush();   
    }
     
    echo "Process completed, ". number_format($sent)." were sent, ". number_format($succeded)." succeeded, and ". number_format($failed)." failed";
    ob_flush();
                flush();   
    echo '<br>';
    echo yii\helpers\Html::a('Back', ['send-email','sent_notification_id'=>$sent_notification_id]);
    exit();
}
?>
<br><br>
You are about to send <strong><?= number_format($number) ?></strong> emails, with a subject <em><strong><?= $modelCNotification->subject ?></strong></em>. Click the button below to proceed

<br><br> 
<?php
 echo yii\helpers\Html::a('SEND EMAILS', ['send-email', 'sent_notification_id'=>$sent_notification_id, 'action'=>'send'], ['class'=>'btn btn-sm btn-success']);
?>
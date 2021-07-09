<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $notification_id
 * @property integer $user_id
 * @property string $subject
 * @property string $notification
 * @property string $date_created
 * @property integer $is_read
 * @property string $date_read
 */
class Notification extends \yii\db\ActiveRecord
{
    //public $sent_notification_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'subject', 'notification', 'date_created','sent_notification_id'], 'required'],
            [['user_id', 'is_read','sent_notification_id'], 'integer'],
            [['notification'], 'string'],
            [['date_created', 'date_read','date_email_sent','email_sent','email_address'], 'safe'],
            [['subject'], 'string', 'max' => 150],
        ];
    }

    
    public static function sendEmail($to, $subject, $email_body){
                    try{
                        Yii::$app->mail->compose()
                        ->setFrom(['noreply@lvfo.org' =>'LVFO HRM'])
                        ->setTo($to)
                        ->setSubject($subject)
                        ->setHtmlBody($email_body)
                        ->send();
                        return true;
                    }  catch (\Swift_TransportException $exep) {
                return false;
            }
    }
    
    public static function logNotification($user_id, $email_address, $subject, $notification){
        $modelNotif = new Notification();
        $modelNotif->user_id = $user_id;
        $modelNotif->email_address = $email_address;
        $modelNotif->subject = $subject;
        $modelNotif->notification = $notification;
        $modelNotif->date_created = date('Y-m-d H:i:s');
        $modelNotif->is_read = 0;
        $modelNotif->save(false);
    }
    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'notification_id' => 'Notification ID',
            'user_id' => 'User ID',
            'subject' => 'Subject',
            'notification' => 'Notification',
            'date_created' => 'Date Created',
            'is_read' => 'Is Read',
            'date_read' => 'Date Read',
        ];
    }
}

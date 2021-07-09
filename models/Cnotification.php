<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cnotification".
 *
 * @property integer $cnotification_id
 * @property string $subject
 * @property string $notification
 * @property string $date_created
 */
class Cnotification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cnotification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'notification', 'date_created','is_group'],'required'],
            [['notification'], 'string'],
            [['date_created','query','is_system'], 'safe'],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    
    public static function checkQuery($query){
       if(strpos($query, 'delete') !== false){
           return false;
       } 
       
       if(strpos($query, 'update') !== false){
           return false;
       } 
       
       if(strpos($query, 'drop') !== false){
           return false;
       }
       
       try {
         $row = Yii::$app->db->createCommand($query)->queryOne();
         return $row;
       } catch (yii\db\Exception $ex) {
          return false; 
       }
    }
    
    public static function sendNotification($requis_id, $req_type, $position_id, $message,$subject){
        $modelReq = NULL;
        switch ($req_type) {
            case 'TRVE':
                $modelReq = TravelRequisition::findOne($requis_id);
                break;
            default:
                die('Cannot send notification. Requisition type error');
                break;
        }
        
        
        $ModelPosition = Position::findOne($position_id);
        
        $ModelContract = EmployeeContract::find()->where("position_id = {$position_id} and is_active = 1")->one();
        if($ModelContract == NULL){
            die('Cannot send notification. Contract not found');
        }
        
        
        $ModelStaff = Staff::findOne($ModelContract->staff_id);
        if($ModelStaff == NULL){
            
            die('Cannot send notification. Staff record not found'); 
        }
        
        
        $fullname = $ModelStaff->firstname.' '.$ModelStaff->surname;
        $message = str_replace('{fullname}', $fullname, $message);
        $message = str_replace('{position}', $ModelPosition->abbreviation, $message);
        $message = str_replace('{rtitle}', $modelReq->travel_purpose, $message);
        //logging notification
        $modelNot = new Notification();
        $modelNot->user_id = $ModelStaff->user_id;
        $modelNot->subject = $subject;
        $modelNot->notification = $message;
        $modelNot->date_created = date('Y-m-d H:i:s');
        $modelNot->is_read = 0;
        $modelNot->email_sent = 0;
        $modelNot->save(false);
       
        
        
    }
    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cnotification_id' => 'Cnotification ID',
            'subject' => 'Subject',
            'notification' => 'Notification',
            'date_created' => 'Date Created',
            'is_group'=>'Group',
            'is_system'=>'System',
        ];
    }
}

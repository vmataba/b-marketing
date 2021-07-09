<?php

namespace app\controllers;

use Yii;
use app\models\SentNotification;
use app\models\SentNotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SentNotificationController implements the CRUD actions for SentNotification model.
 */
class SentNotificationController extends BaseController
{
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all SentNotification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'simple_layout';
        $searchModel = new SentNotificationSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        $model = new SentNotification;

         if($model->load(Yii::$app->request->post())) {
            $model->user_sent = Yii::$app->user->identity->user_id;
            $model->date_sent = date('Y-m-d H:i:s');
            if($model->save()){
                $this->SendNotification($model);
                return $this->redirect(['index']);
            } else {
                var_dump($model->getErrors());
                die;
            } 
          } 
        
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
        ]);
    }
    
    public function SendNotification($model){

       $modelCN = \app\models\Cnotification::findOne($model->cnotification_id);
      
       
       $message = strip_tags($modelCN->notification, '<p><br><b><strong><em><i><u><sup><sub><ol><ul><li><a>');
       $message = str_replace("'", "", $message);
       
       $rows = Yii::$app->db->createCommand($modelCN->query)->queryAll();
       
       foreach ($rows as $row) {
         $user_id = $row['user_id'];
         $message_tosend = $message;
         $subject = $modelCN->subject;
         foreach ($row as $key => $value) { 
           $message_tosend  = str_replace('{'.$key.'}', $value, $message_tosend);  
           $subject = str_replace('{'.$key.'}', $value, $subject);
         }
          $modelNotif = new \app\models\Notification();
          $modelNotif->sent_notification_id = $model->sent_notification_id;
          $modelNotif->user_id = $user_id;
          $modelNotif->subject = $subject;
          $modelNotif->email_address = $row['email_address'];
          $modelNotif->notification = $message_tosend;
          $modelNotif->date_created = date('Y-m-d H:i:s');
          if(!$modelNotif->save()){
              var_dump($modelNotif->getErrors());
              die;
          }
          
       }
       
    }

    /**
     * Displays a single SentNotification model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'simple_layout';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sent_notification_id]);
        } else {
            return $this->render('view', ['model' => $model]);
        }
    }

    /**
     * Creates a new SentNotification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'simple_layout';
        $model = new SentNotification;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sent_notification_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SentNotification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'simple_layout';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sent_notification_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SentNotification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SentNotification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SentNotification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SentNotification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

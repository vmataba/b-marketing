<?php

namespace app\controllers;

use Yii;
use app\models\Notification;
use app\models\NotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificationsController implements the CRUD actions for Notification model.
 */
class NotificationsController extends BaseController {
    
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionSendEmail($sent_notification_id, $action = NULL) {
        $this->layout = 'simple_layout';
        return $this->render('send_email', ['sent_notification_id' => $sent_notification_id, 'action' => $action]);
    }

    /**
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex() {
        $user_id = Yii::$app->user->identity->id;
        $modelUser = \app\models\User::findOne($user_id);

        $fullname = \app\models\Salutation::findOne($modelUser->salutation)->name . ". " . $modelUser->first_name . " " . $modelUser->surname;

        $searchModel = new NotificationSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());



        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'modelUser' => $modelUser,
                    'fullname' => $fullname,
        ]);
    }

    public function actionGetNotification($notification_id) {
        if (Yii::$app->user->isGuest) {
            return [''];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $user_id = Yii::$app->user->identity->id;


        $notModel = Notification::findOne($notification_id);
        $notModel->is_read = 1;
        $notModel->date_read = date('Y-m-d H:i:s');
        $notModel->save(false);

        return ['notification_id' => $notModel->notification_id, 'notification' => $notModel->notification, 'date_created' => $notModel->date_created, 'is_read' => $notModel->is_read, 'date_read' => $notModel->date_read];
    }

    /**
     * Displays a single Notification model.
     * @param integer $id
     * @return mixed
     */
//    public function actionNotifications(){
//      if(Yii::$app->user->isGuest){
//         return $this->redirect(['/site/login']);  
//      }
//       $user_id = Yii::$app->user->identity->id;
//       $modelUser = \app\models\ApplicantUser::findOne($user_id);
//       
//       if($modelUser->user_type_id !== 5){
//         return $this->redirect(['/site/login']);  
//       }
//      
//    }
//    public function actionView($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->notification_id]);
//        } else {
//            return $this->render('view', ['model' => $model]);
//        }
//    }

    /**
     * Creates a new Notification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new Notification;
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->notification_id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing Notification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->notification_id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

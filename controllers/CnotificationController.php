<?php

namespace app\controllers;

use Yii;
use app\models\Cnotification;
use app\models\CnotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CnotificationController implements the CRUD actions for Cnotification model.
 */
class CnotificationController extends BaseController
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
     * Lists all Cnotification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'simple_layout';
        $searchModel = new CnotificationSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    
    
    public function actionMain(){
      return $this->render('main');  
    }

    /**
     * Displays a single Cnotification model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'simple_layout';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cnotification_id]);
        } else {
            return $this->render('view', ['model' => $model]);
        }
    }

    
    
    /**
     * Creates a new Cnotification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'simple_layout';
        $model = new Cnotification;

        if ($model->load(Yii::$app->request->post())) {
            $model->date_created = date('Y-m-d H:i:s');
            if(trim($model->query) != ''){
            $checkQuery = Cnotification::checkQuery($model->query);
            
            if($checkQuery === false){
              $model->addError('query', 'Invalid query or no results found');  
            }
            if(is_array($checkQuery)){
              $checkQuery = array_flip($checkQuery);
              if(!in_array('user_id', $checkQuery)){
                 $model->addError('query', 'user_id must be one of the select results');  
              }
             
                 if(!in_array('email_address', $checkQuery)){
                 $model->addError('query', 'email_address must be one of the select results');  
              }
            }
           }
            if($model->validate(NULL, false)){
            if($model->save(false)){
            return $this->redirect(['view', 'id' => $model->cnotification_id]);
            }
            }
        } 
            return $this->render('create', [
                'model' => $model,
            ]);
        
    }

    /**
     * Updates an existing Cnotification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'simple_layout';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(trim($model->query) != ''){
            $checkQuery = Cnotification::checkQuery($model->query);
            if($checkQuery === false){
              $model->addError('query', 'Invalid query or no results found');  
            }
            if(is_array($checkQuery)){
              $checkQuery = array_flip($checkQuery);
              if(!in_array('user_id', $checkQuery)){
                 $model->addError('query', 'user_id must be one of the select results');  
              }
            
              if(!in_array('email_address', $checkQuery)){
                 $model->addError('query', 'email_address must be one of the select results');  
              }
            }
            }
            if($model->validate(NULL, false)){
            if($model->save(false)){
            return $this->redirect(['view', 'id' => $model->cnotification_id]);
            }
            }
        } 
            return $this->render('update', [
                'model' => $model,
            ]);
        
    }

    /**
     * Deletes an existing Cnotification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->is_system == 0){
          $model->delete();   
        } else {
         Yii::$app->session->setFlash('danger', 'Cannot delete system message');   
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cnotification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cnotification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cnotification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

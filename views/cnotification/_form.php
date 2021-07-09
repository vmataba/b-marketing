<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\Cnotification $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="cnotification-form">
    {fullname}=>Full Name,{position}=>Position, {rtitle}=> Requisition Title
    <?php 
    
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]); 
    
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            //'title' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Subject...', 'maxlength' => 100]],
            'subject' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Subject...', 'maxlength' => 255]],
            
             ]

    ]);
    
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
            'is_group' => ['type' => Form::INPUT_CHECKBOX, 'options' => ['placeholder' => 'Enter Subject...', 'maxlength' => 255]],
            'query' => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => 'Enter Subject...']],
            
             ]

    ]);
    
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
            
            'notification' => ['type' => Form::INPUT_WIDGET,
                'widgetClass' => \dosamigos\ckeditor\CKEditor::className(),
            ],
            
             ]

    ]);

    echo Html::a('Back',['index'],
        ['class' => 'btn btn-success']
    ).'&nbsp;&nbsp;&nbsp'.Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
    );
    ActiveForm::end(); ?>

</div>

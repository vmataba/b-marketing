<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Institution;
use app\modules\recruitment\models\Job;

$this->params['breadcrumbs'][] = ['label' => ''];

//app\models\Notification::sendEmail('matnatalis@gmail.com', 'Thanks', 'Thank you, I have succeeded to setup office 365 account . . ');
?>

<style>
    .job-vacancy-description{
        padding-left: 50px !important
    }
    .job-title{
        padding-left: 50px;
        margin-top: -35px
    }
</style>

<div class="custom-tabs-line tabs-line-bottom left-aligned">
    <ul class="nav" role="tablist">
        <li class="<?= $tab === null ? 'active' : '' ?>" id="tab-home"><a href="#home" role="tab" data-toggle="tab">Home</a></li>
        <li class="<?= $tab == 'login' ? 'active' : '' ?>" id="tab-login"><a href="#login" role="tab" data-toggle="tab">Login</a></li>
    </ul>
</div>
<div class="tab-content">
    <div id="home" class="tab-pane fade in <?= $tab === null ? 'active' : '' ?>">
        <?php if (Institution::hasInstance()): ?>

            <?= Institution::getInstance()->home_page ?>

        <?php else: ?>

            No contents to display...

        <?php endif; ?>
    </div>
    <div id="login" class="tab-pane fade in <?= $tab == 'login' ? 'active' : '' ?>">

        <div class="col-md-4">
            <?php
            $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => [
                            'class' => 'form-auth-small'
                        ]
            ]);
            ?>
            <div class="form-group">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Enter username...', 'value' => Yii::$app->session->get('username')]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Enter password...']) ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary form-control', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        if ($('.field-loginform-password').hasClass('has-error')) {
            $('#tab-home').removeClass('active');
            $('#jobs').removeClass('active');
            $('#tab-jobs').removeClass('active');
            $('#home').removeClass('active');

            $('#tab-login').addClass('active');
            $('#login').addClass('active');
        }
    });
</script>
<?php Yii::$app->session->set('username', null) ?>
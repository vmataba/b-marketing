<?php

use yii\helpers\Html;

$this->title = 'Job Details';
$this->params['breadcrumbs'][] = ['label' => 'New Jobs', 'url' => ['login', 'tab' => 'jobs']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .page-title{
        display: none !important
    }
</style>
<br>
<div class="panel">
    <div class="panel-body" style="padding-left: 50px">
        <span class="pull-right">
            <?= Html::a('Apply Now', ['register-job-applicant'], ['class' => 'btn btn-sm btn-round btn-info']) ?>
        </span>
        <br>
        <?= $model->job_details ?>
        <span class="pull-right">
            <?= Html::a('Apply Now', ['register-job-applicant'], ['class' => 'btn btn-sm btn-round btn-info']) ?>
        </span>
    </div>
</div>
<script>
    $(document).ready(() => {
        $('table').addClass('table');
        $('table').css('width', '100%');
        $('table').css('border', '0px');
    });
</script>
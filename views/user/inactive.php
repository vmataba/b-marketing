<?php

use yii\helpers\Url;

$this->title = 'Inactive User Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel" style="width: 100%; margin-left: auto; margin-right: auto">
    <div class="panel-heading">
        <img src="<?= $model->getPhoto() ?>" style="width: 50px; height: 50px" class="img img-circle"/>
        <h4 style="display: inline"><?= $model->getFullName() ?></h4>
    </div>
    <div class="panel-body">
        <p>
            Sorry your account has been <span class="text-danger">deactivated</span>, please contact your System Administrator!
        </p>
    </div>
</div>
<script>
    /*$(document).ready(() => {
     setTimeout(() => {
     window.location.href = `<?= Url::to(['/site/log-me-out']) ?>`;
     },5000);
     });*/
</script>
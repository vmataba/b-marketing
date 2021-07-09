<?php //$this->render("_temp_sidebar") ?>
<?php
/**
 * @var $this View
 * @var $user User
 **/

use app\models\User;
use yii\web\View;

$user = Yii::$app->user->identity;
?>
<style>
    .modules-list {
        margin-top: 15px;
        list-style: none;
    }
</style>

<?= $this->render('_sidebar_common') ?>
<nav>
    <ul class="nav">
        <?= $this->render("@app/views/layouts/common-links/_logout") ?>
    </ul>
</nav>
<?= $this->render("@app/views/layouts/scripts/_link_activator") ?>

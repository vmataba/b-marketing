<?php

use app\assets\tools\SideNav;
use app\models\SystemRoute;

$user = Yii::$app->user->identity;

$thisModule = 'recruitment'
?>

<?php SideNav::startMenuItem($user->canView("$thisModule/job-application/my-applications")) ?>
<?=

SideNav::createMenuItem([
    'module' => $thisModule,
    'controller' => 'job-application',
    'action' => 'my-applications',
    'label' => 'My Job Applications',
    'icon' => 'lnr lnr-rocket',
    'active' => SystemRoute::activeWhen([
        'controller' => 'job-application'
    ])
])
?>
<?php SideNav::endMenuItem() ?>

<?php SideNav::startMenuItem($user->canView("$thisModule/job-application/index")) ?>
<?=

SideNav::createMenuItem([
    'module' => $thisModule,
    'controller' => 'job-application',
    'action' => 'index',
    'label' => 'Job Applications',
    'icon' => 'lnr lnr-rocket',
    'active' => SystemRoute::activeWhen([
        'controller' => 'job-application'
    ])
])
?>
<?php SideNav::endMenuItem() ?>
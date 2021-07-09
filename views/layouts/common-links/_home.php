<?php

use app\assets\tools\SideNav;
use app\models\SystemRoute;

?>
<?php SideNav::startMenuItem($user->canView("site/index")) ?>
<?=

SideNav::createMenuItem([
    'controller' => 'site',
    'action' => 'index',
    'label' => 'Home',
    'icon' => 'lnr lnr-home',
    'active' => SystemRoute::activeWhen([
        'controller' => 'site',
        'actions' => [
            'index'
        ]
    ]) || SystemRoute::activeWhen([
        'controller' => 'notifications',
        'actions' => [
            'index'
        ]
    ])
])
?>
<?php SideNav::endMenuItem() ?>
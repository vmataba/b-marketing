<?php

/**
 * @var $user User
 **/

use app\assets\tools\SideNav;
use app\models\SystemRoute;
use app\models\User;


?>

<?php SideNav::startMenuItem($user->canView("user/my-profile")) ?>
<?=

SideNav::createMenuItem([
    'controller' => 'user',
    'action' => 'my-profile',
    'label' => 'My Profile',
    'icon' => 'lnr lnr-user',
    'active' => SystemRoute::activeWhen([
            'controller' => 'user',
            'actions' => [
                'my-profile',
                'update-password'
            ]
        ]) && !in_array(SystemRoute::getCurrentAction(), [
            'index'
        ])
])
?>
<?php SideNav::endMenuItem() ?>
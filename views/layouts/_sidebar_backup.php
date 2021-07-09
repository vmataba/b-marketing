<?php

use app\assets\tools\SideNav;
use app\models\Institution;

$user = \Yii::$app->session['user'];
?>

<nav>
    <ul class="nav" id="mainNav">
        <?=
        $this->render('@app/views/layouts/common-links/_home', [
            'user' => $user
        ])
        ?>

        <?=
        $this->render('@app/views/layouts/common-links/_my_profile', [
            'user' => $user
        ])
        ?>


        <?php SideNav::startMenuItem($user->canView("employee/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'employee',
            'action' => 'index',
            'label' => 'Employees',
            'icon' => 'lnr lnr-users'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("employee/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'cnotification',
            'action' => 'main',
            'label' => 'Notifications',
            'icon' => 'lnr lnr-users'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("user/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'user',
            'action' => 'index',
            'label' => 'System Users',
            'icon' => 'lnr lnr-users'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("report/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'report',
            'action' => 'index',
            'label' => 'Reports',
            'icon' => 'lnr lnr-rocket'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php
        SideNav::startMenuItemsGroup([
            'label' => 'References',
            'groupId' => 'referenceItems',
            'visible' => $user->canViewAny([
                'currency/index',
                'time-unit/index',
                'salutation/index',
                'position-category/index',
                'position-category/index',
                'identity-type/index',
                'employee-grade/index',
                'institution-type/index',
                'project/index'
            ]),
            'icon' => 'glyphicon glyphicon-link'
        ]);
        ?>

        <?php SideNav::startMenuItem($user->canView("currency/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'currency',
            'action' => 'index',
            'label' => 'Currencies'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


        <?php SideNav::startMenuItem($user->canView("time-unit/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'time-unit',
            'action' => 'index',
            'label' => 'Time Units'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


        <?php SideNav::startMenuItem($user->canView("salutation/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'salutation',
            'action' => 'index',
            'label' => 'Saluation'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


        <?php SideNav::startMenuItem($user->canView("position-category/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'position-category',
            'action' => 'index',
            'label' => 'Position Categories'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


        <?php SideNav::startMenuItem($user->canView("identity-type/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'identity-type',
            'action' => 'index',
            'label' => 'Identity Types'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


        <?php SideNav::startMenuItem($user->canView("employee-grade/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'employee-grade',
            'action' => 'index',
            'label' => 'Employee Grades'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("institution-type/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'institution-type',
            'action' => 'index',
            'label' => 'Institution Types'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("project/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'project',
            'action' => 'index',
            'label' => 'Projects'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::endMenuItemsGroup() ?>


        <?php
        SideNav::startMenuItemsGroup([
            'label' => 'Configurations',
            'groupId' => 'configurationItems',
            'visible' => $user->canViewAny([
                'institution/index',
                'institution-structure/index',
                'position/index',
                'period/index',
                'file-type/index'
            ]),
            'icon' => 'glyphicon glyphicon-wrench'
        ]);
        ?>

        <?php
        SideNav::startMenuItem($user->canViewAny([
                    "institution/index",
                    "institution/view"]
                )
        )
        ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'institution',
            'action' => !Institution::hasInstance() ? 'index' : 'view',
            'label' => 'Institution Setup'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("institution-structure/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'institution-structure',
            'action' => 'index',
            'label' => 'Institution Structures'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("position/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'position',
            'action' => 'index',
            'label' => 'Employee Positions'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("period/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'period',
            'action' => 'index',
            'label' => 'Periods'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("file-type/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'file-type',
            'action' => 'index',
            'label' => 'File Types'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>
        <?php SideNav::endMenuItemsGroup(); ?>


        <?php
        SideNav::startMenuItemsGroup([
            'label' => 'System Setup',
            'groupId' => 'systemSetupItems',
            'visible' => $user->canViewAny([
                'system-route/index',
                'user-group/index'
            ]),
            'icon' => 'glyphicon glyphicon-cog'
        ]);
        ?>

        <?php SideNav::startMenuItem($user->canView("system-route/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'system-route',
            'action' => 'index',
            'label' => 'System Routes'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>



        <?php SideNav::startMenuItem($user->canView("user-group/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'user-group',
            'action' => 'index',
            'label' => 'User Groups'
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::endMenuItemsGroup() ?>
    </ul>
</nav>
<?= $this->render('@app/views/layouts/scripts/_link_activator') ?>
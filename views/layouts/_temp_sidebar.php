<?php

use app\assets\tools\SideNav;
use app\models\SystemRoute;
use app\models\Institution;

$user = \Yii::$app->user->identity;
//$thisModule = Yii::$app->controller->module->id;
$thisModule = "recruitment";
?>

<nav>
    <ul class="nav" id="mainNav">
        <?=
        $this->render("@app/views/layouts/common-links/_home", [
            "user" => $user
        ])
        ?>

        <?php //SideNav::startMenuItem($user->canView("$thisModule/default/index")) ?>
        <?php SideNav::startMenuItem(false) ?>
        <?=
        SideNav::createMenuItem([
            "module" => $thisModule,
            "controller" => "default",
            "action" => "index",
            "label" => "Dashboard",
            "icon" => "glyphicon glyphicon-dashboard",
            'active' => SystemRoute::activeWhen([
                'module' => $thisModule,
                'controller' => 'default'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?=
        $this->render("@app/views/layouts/common-links/_my_profile", [
            "user" => $user
        ])
        ?>
        <?php SideNav::startMenuItem($user->canView("user/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'user',
            'action' => 'index',
            'label' => 'System Users',
            'icon' => 'lnr lnr-users',
            'active' => SystemRoute::activeWhen([
                'controller' => 'user'
            ]) && !SystemRoute::activeWhen([
                'controller' => 'user',
                'actions' => [
                    'my-profile',
                    'update-password'
                ]
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>
        <!--Temporary-->
        <?= $this->render("@app/views/layouts/_recruitment_sidebar") ?>
        <?php
        SideNav::startMenuItemsGroup([
            "label" => "Configurations",
            "groupId" => "configurationItems",
            "visible" => $user->canViewAny([
                "$thisModule/job/index",
                'institution/index',
                'institution-structure/index',
                'position/index'
            ]),
            "icon" => "glyphicon glyphicon-wrench"
        ]);
        ?>
        <!--End Temporary-->

        <?php SideNav::startMenuItem($user->canView("$thisModule/job/index")) ?>
        <?=
        SideNav::createMenuItem([
            "module" => $thisModule,
            "controller" => "job",
            "action" => "index",
            "label" => "Jobs",
            'active' => SystemRoute::activeWhen([
                'module' => $thisModule,
                'controller' => 'job'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


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
            'label' => 'Institution Setup',
            'active' => SystemRoute::activeWhen([
                'controller' => 'institution'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("institution-structure/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'institution-structure',
            'action' => 'index',
            'label' => 'Institution Structures',
            'active' => SystemRoute::activeWhen([
                'controller' => 'institution-structure'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("position/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'position',
            'action' => 'index',
            'label' => 'Employee Positions',
            'active' => SystemRoute::activeWhen([
                'controller' => 'position'
            ])
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
            'label' => 'System Routes',
            'active' => SystemRoute::activeWhen([
                'controller' => 'system-route'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>



        <?php SideNav::startMenuItem($user->canView("user-group/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'user-group',
            'action' => 'index',
            'label' => 'User Groups',
            'active' => SystemRoute::activeWhen([
                'controller' => 'user-group'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::endMenuItemsGroup() ?>
    </ul>
</nav>

<?= $this->render("@app/views/layouts/scripts/_link_activator") ?>
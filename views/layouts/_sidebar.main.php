<?php

use app\assets\tools\SideNav;
use app\models\Institution;
use app\models\SystemRoute;

$user = Yii::$app->user->identity;

$thisModule = 'recruitment'
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
            'icon' => 'lnr lnr-users',
            'active' => SystemRoute::activeWhen([
                'controller' => 'employee'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("cnotification/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'cnotification',
            'action' => 'main',
            'label' => 'Notifications',
            'icon' => 'glyphicon glyphicon-bell',
            'active' => SystemRoute::activeWhen([
                'controller' => 'cnotification'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

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

        <?php SideNav::startMenuItem($user->canView("report/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'report',
            'action' => 'index',
            'label' => 'Reports',
            'icon' => 'lnr lnr-rocket',
            'active' => SystemRoute::activeWhen([
                'controller' => 'report'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <!--This will later be placed in Recruitment Module-->
        <?= $this->render('_recruitment_sidebar') ?>

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
            'label' => 'Currencies',
            'active' => SystemRoute::activeWhen([
                'controller' => 'currency'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


        <?php SideNav::startMenuItem($user->canView("time-unit/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'time-unit',
            'action' => 'index',
            'label' => 'Time Units',
            'active' => SystemRoute::activeWhen([
                'controller' => 'time-unit'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


        <?php SideNav::startMenuItem($user->canView("salutation/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'salutation',
            'action' => 'index',
            'label' => 'Saluation',
            'active' => SystemRoute::activeWhen([
                'controller' => 'salutation'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


        <?php SideNav::startMenuItem($user->canView("position-category/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'position-category',
            'action' => 'index',
            'label' => 'Position Categories',
            'active' => SystemRoute::activeWhen([
                'controller' => 'position-category'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


        <?php SideNav::startMenuItem($user->canView("identity-type/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'identity-type',
            'action' => 'index',
            'label' => 'Identity Types',
            'active' => SystemRoute::activeWhen([
                'controller' => 'identity-type'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


        <?php SideNav::startMenuItem($user->canView("employee-grade/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'employee-grade',
            'action' => 'index',
            'label' => 'Employee Grades',
            'active' => SystemRoute::activeWhen([
                'controller' => 'employee-grade'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("institution-type/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'institution-type',
            'action' => 'index',
            'label' => 'Institution Types',
            'active' => SystemRoute::activeWhen([
                'controller' => 'institution-type'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("project/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'project',
            'action' => 'index',
            'label' => 'Projects',
            'active' => SystemRoute::activeWhen([
                'controller' => 'project'
            ])
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
                'file-type/index',
                "$thisModule/job/index"
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

        <?php SideNav::startMenuItem($user->canView("period/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'period',
            'action' => 'index',
            'label' => 'Periods',
            'active' => SystemRoute::activeWhen([
                'controller' => 'period'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>

        <?php SideNav::startMenuItem($user->canView("file-type/index")) ?>
        <?=
        SideNav::createMenuItem([
            'controller' => 'file-type',
            'action' => 'index',
            'label' => 'File Types',
            'active' => SystemRoute::activeWhen([
                'controller' => 'file-type'
            ])
        ])
        ?>
        <?php SideNav::endMenuItem() ?>


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
        <?= $this->render('@app/views/layouts/common-links/_logout') ?>
    </ul>
</nav>
<?= $this->render('@app/views/layouts/scripts/_link_activator') ?>
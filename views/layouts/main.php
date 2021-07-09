<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!-- ICONS -->

        <?= $this->render('@app/views/layouts/styles/_icons') ?>

        <script src='template/klorofil/assets/vendor/jquery/jquery.min.js'></script>      
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-fixed-top">
                <?= $this->render('_navbar') ?>
            </nav>
            <div id="sidebar-nav" class="sidebar">
                <div class="sidebar-scroll">
                    <?= $this->render('_sidebar') ?>
                </div>
            </div>
            <div class="main">
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3><?= $this->title ?></h3>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <?=
                                Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ])
                                ?>
                            </div>
                        </div>
                        <br>
                        <?= Alert::widget() ?>
                        <?= $content ?>   
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <footer>
                <?php //$this->render('_footer')   ?>
            </footer>
        </div>

        <script>
            $(document).ready(() => {
                const userAgent = window.navigator.userAgent.toLowerCase();
                if (!userAgent.includes('edge')) {
                    styleCheckBoxes();
                }
            });
        </script>

        <script>
            $('.breadcrumb').css('margin-bottom', '0px');
            $('.breadcrumb').css('margin-top', '10px');
            //$('.breadcrumb').css('background-color', '#FFFFFF');
            $('body').css('background-color', '#FFFFFF');
            $('.main').css('background-color', '#FFFFFF');
        </script>
        <?= $this->render('scripts/_session_timeout') ?>
    </body>
    <?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>

<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\tools\Tool;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <script src='template/klorofil/assets/vendor/jquery/jquery.min.js'></script>      
        <title><?= Html::encode($this->title) ?></title>
        <?= $this->render('@app/views/layouts/styles/_icons') ?>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div id="wrapper">
            <nav class="navbar navbar-default navbar-fixed-top">
                <?= $this->render('_guest_navbar') ?>
            </nav>
            <div id="sidebar-nav" class="sidebar">
                <div class="sidebar-scroll">
                    <?= $this->render('_guest_sidebar') ?>
                </div>
            </div>
            <div class="main">
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3 class="page-title"><?= $this->title ?></h3>
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
    </body>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

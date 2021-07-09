<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\tools\Tool;

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
        <?php $this->head() ?>
        <style>
            .search-box{
                margin-right: 15px;
                background: url("<?= Tool::getSearchIcon() ?>");
                background-size: 30px;
                background-repeat: no-repeat;
                padding-left: 31px
            }
            .icon-reset{
                margin-right: 15px;
                background: url("<?= Tool::getResetIcon() ?>");
                background-size: 30px;
                background-repeat: no-repeat;
            }
            .icon-ms-excel{
                margin-right: 1px;
                background: url("<?= Tool::getExcelIcon() ?>");
                background-size: 17px;
                background-repeat: no-repeat;
                padding-left: 31px
            }
            .icon-pdf{
                margin-right: 1px;
                background: url("<?= Tool::getPdfIcon() ?>");
                background-size: 17px;
                background-repeat: no-repeat;
                padding-left: 31px
            }
            .icon-png{
                margin-right: 1px;
                background: url("<?= Tool::getPngIcon() ?>");
                background-size: 17px;
                background-repeat: no-repeat;
                padding-left: 31px
            }
            .icon-key-pass{
                margin-right: 1px;
                background: url("<?= Tool::getKeyPassIcon() ?>");
                background-size: 20px;
                background-repeat: no-repeat;
                padding-left: 31px
            }
            .round-input{
                border-radius: 10px
            }
            @font-face {
                font-family: "manrope";
                src: url("fonts/manrope/manrope.ttf");
                font-weight: normal;
                -fs-pdf-font-embed: embed;
                -fs-pdf-font-encoding: Identity-H;
            }
            .page{
                margin-left: 2%;
                margin-right: 2%;
                margin-top: 20px !important;
            }
        </style>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <div class="page">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
        <script>

            $('body').css('background-color', '#FFFFFF');
            $('.wrap').css('background-color', '#FFFFFF');
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

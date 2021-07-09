<?php

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\SystemRoute;
?>
<script>

//    $(document).ready(() => {
//        checkInactivity();
//    });
//    function checkInactivity() {
//        //One minute left to be logged out
//        setTimeout(() => {
//            $('#modalSessionTimeout').modal('show');
//            let secondsLeft = 60;
//            setInterval(() => {
//                $('#secondsLeft').html(--secondsLeft);
//            }, 1000);
//        }, (parseInt(`<?= Yii::$app->session['sessionTimeout'] ?>`) - 1) * 60 * 1000);
//        //Logout
//        setTimeout(() => {
//            window.location.href = `<?= Url::to(['/site/log-me-out']) ?>`;
//        }, parseInt(`<?= Yii::$app->session['sessionTimeout'] ?>`) * 60 * 1000);
//    }
</script>

<!-- Modal -->
<div class="modal fade" id="modalSessionTimeout" tabindex="-1" role="dialog" aria-labelledby="modalSessionTimeoutTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?= Yii::$app->user->identity->getPhoto() ?>" style="width: 50px; height: 50px" class="img img-circle"/>
                <h5 style="display: inline; font-size: 1em; font-weight: bold">Session Timeout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    You will be logged out in <span id="secondsLeft" style="font-weight: bold"></span> seconds to come
                </p>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?= Html::a('Keep me active', [SystemRoute::getCurrentRoute()], ['class' => 'btn btn-success', 'style' => 'font-weight:bold']) ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?= Html::a('Logout', ['/site/log-me-out'], ['class' => 'btn btn-danger pull-right', 'style' => 'font-weight:bold']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

use app\models\Institution;
?>
<style>
    nav{
        margin-top: 15px;
        padding: 10px
    }
</style>
<nav>
    <ul class="nav" id="mainNav">
        <li>
            <?php if (Institution::hasInstance()): ?>
                <img src="<?= Institution::getInstance()->logo ?>" class="img center-block" style="width: <?= Institution::getInstance()->logo_width ?>; height: <?= Institution::getInstance()->logo_height ?>"/>
            <?php else: ?>
                <img src="<?= Institution::getDefaultLogo() ?>" class="img center-block" style="width: <?= Institution::DEFAULT_LOGO_WIDTH ?>; height: <?= Institution::DEFAULT_LOGO_HEIGHT ?>"/>
            <?php endif; ?>
        </li>
        <li class="text-center">
            <?php if (Institution::hasInstance()): ?>

                <?= Institution::getInstance()->contact_details ?>

            <?php else: ?>

                No contents to display...

            <?php endif; ?>
        </li>
    </ul>
</nav>
<?= $this->render('@app/views/layouts/scripts/_link_activator') ?>
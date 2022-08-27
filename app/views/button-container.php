<?php

use SSZ\Calculator\Calculator;
use SSZ\Calculator\View;
use SSZ\Calculator\models\Calculator\Button;

?>
<div class="js-calculator-buttons-container calculator-buttons-container">
    <?php foreach ( Calculator::getButtons() as $row ) : ?>
        <div class="row g-1 my-1">
            <?php

            /**
             * @var $btn Button
             */
            foreach ( $row as $btn ) : ?>
                <div class="col-3">
                    <?= View::partial( 'button', [
                        'button' => $btn
                    ] ) ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
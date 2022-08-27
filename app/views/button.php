<?php

use SSZ\Calculator\models\Calculator\Button;

/**
 * @var $button Button
 */

$btnVariant = 'btn-primary';
if ( $button->isOperation() ) {
    $btnVariant = 'btn-warning';
}
if ( $button->disable ) {
    $btnVariant = 'btn-secondary';
}

?>
<a href="#"
   data-action="<?= $button->action ?>"
   data-number="<?= $button->number ?>"
   class="js-calculator-button btn <?= $btnVariant ?> w-100">
    <?= $button->label ?>
</a>
<?php

use SSZ\Calculator\View;
use SSZ\Calculator\Calculator;

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="rounded bg-white shadow-lg m-5 p-3">
                <div id="calculator-screen" class="js-calculator-screen border rounded p-3 bg-light mb-3 text-end fs-3">0</div>
                <?= View::partial( 'button-container' ) ?>
            </div>
        </div>
    </div>
</div>
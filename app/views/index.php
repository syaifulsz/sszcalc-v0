<?php

use SSZ\Calculator\View;
use SSZ\Calculator\Calculator;

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="rounded bg-white shadow-lg m-5 p-3">
                <div id="calculator-screen" class="border rounded px-3 py-2 bg-light mb-3 text-end">
                    <div class="js-calculator-formula text-muted">0</div>
                    <div class="js-calculator-screen fs-3">0</div>
                </div>
                <?= View::partial( 'button-container' ) ?>
            </div>
        </div>
    </div>
</div>
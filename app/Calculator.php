<?php

namespace SSZ\Calculator;

use SSZ\Calculator\models\Calculator\Button;

/**
 * Class Calculator
 * @package SSZ\Calculator
 */
class Calculator
{
    /**
     * @return array
     */
    public static function getButtons(): array
    {
        $rows = [];
        foreach ( Config::getInstance()->getData()[ 'buttons' ] as $row => $btns ) {
            foreach ( $btns as $btn ) {
                $rows[ $row ][] = Button::initByAttributes( $btn );
            }
        }
        return $rows;
    }
}
<?php

namespace SSZ\Calculator\models\Calculator;

use SSZ\Calculator\models\ModelAbstract;

/**
 * Class Button
 * @package SSZ\Calculator\models\Calculator
 *
 * @property string label
 * @property string action
 * @property string number
 * @property bool disable
 */
class Button extends ModelAbstract
{
    public $attributes = [
        'label'     => '',
        'action'    => '',
        'number'    => '',
        'disable'   => false,
    ];

    /**
     * @return bool
     */
    public function isOperation(): bool
    {
        return $this->action !== 'enter-number';
    }

    /**
     * @return bool
     */
    public function isEnterNumber(): bool
    {
        return $this->action === 'enter-number';
    }
}
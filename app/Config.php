<?php

namespace SSZ\Calculator;

/**
 * Class Config
 * @package SSZ\Calculator
 */
class Config
{
    public $data = [];
    public $configDir;

    public static $instance;

    /**
     * @return static
     */
    public static function boot(): self
    {
        if ( !self::$instance ) {
            return self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        return self::$instance;
    }

	public function __construct()
	{
        $this->configDir = __DIR__ . '/configs';

        $this->data = [];
        $configFiles = glob( "{$this->configDir}/*.php" );
        foreach ( $configFiles as $cF ) {
            $info = pathinfo( $cF );
            $this->data[ $info[ 'filename' ] ] = require $cF;
        }
	}

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
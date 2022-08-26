<?php

namespace SSZ\Calculator;

/**
 * Class Asset
 * @package SSZ\Calculator
 */
class Asset
{
    public static $instance;

    /**
     * @return static
     */
    public static function boot( Config $config ): self
    {
        if ( !self::$instance ) {
            return self::$instance = new self( $config );
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

    /**
     * @var array
     */
    public $configData = [];

    /**
     * @param Config $config
     */
    public function __construct( Config $config )
    {
        $this->configData = $config->getData();
    }

    /**
     * @return string
     */
    public static function css(): string
    {
        $str = [];
        foreach ( self::getInstance()->configData[ 'assets' ][ 'css' ] as $file ) {
            $str[] = "<link rel=\"stylesheet\" href=\"{$file}\">";
        }
        return implode( '', $str );
    }

    /**
     * @return string
     */
    public static function js(): string
    {
        $str = [];
        foreach ( self::getInstance()->configData[ 'assets' ][ 'js' ] as $file ) {
            $str[] = "<script src=\"{$file}\" defer></script>";
        }
        return implode( '', $str );
    }
}
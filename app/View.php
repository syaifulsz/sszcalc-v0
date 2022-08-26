<?php

namespace SSZ\Calculator;

/**
 * Class View
 * @package SSZ\Calculator
 */
class View
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
    public $configData;
    public $viewsDir;
    public $layout;
    public $index;

    /**
     * @param Config $config
     */
    public function __construct( Config $config )
    {
        $this->configData = $config->getData();
        $this->viewsDir = __DIR__ . '/views';
        $this->layout = "{$this->viewsDir}/layout.php";
        $this->index = "{$this->viewsDir}/index.php";
    }

    public function render()
    {
        // render content
        extract( $this->configData, EXTR_SKIP );
        ob_start();
        require( $this->index );
        $content = ob_get_contents();
        ob_clean();

        // render layout
        extract( array_merge( $this->configData, [
            'content' => $content
        ] ), EXTR_SKIP );
        ob_start();
        require( $this->layout );
        $layout = ob_get_contents();
        ob_clean();
        
        echo $layout;
    }
}
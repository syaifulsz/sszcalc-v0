<?php

namespace SSZ\Calculator;

/**
 * Class App
 * @package SSZ\Calculator
 */
class App
{
	public $config;
	public $view;
	public $asset;

	public function __construct()
	{
		$this->config = Config::boot();
		$this->view = View::boot( $this->config );
		$this->asset = Asset::boot( $this->config );
	}

    public function run()
    {
        $this->view->render();
    }
}
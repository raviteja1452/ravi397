<?php

class Config{
	public $address;
	public $port;
	
	public function __construct(){
		$this->address = '0.0.0.0';
		$this->port = 25003;
	}
}
spl_autoload_register(function ($query) {
    include $query.'.php';
});

?>

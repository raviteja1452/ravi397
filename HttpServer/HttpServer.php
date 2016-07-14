<?php

require_once('Server.php');
abstract class HttpServer extends Server{
	abstract function get();
	abstract function post($output);
}

?>
<?php

abstract class Server{
	abstract function create();
	abstract function bind();
	abstract function listen();
	abstract function accept();
	abstract function parse($client);
}

?>
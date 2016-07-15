<?php

abstract class Server{
	abstract function createSocket();
	abstract function bindSocket();
	abstract function listenClient();
	abstract function acceptConnection();
	abstract function parseString($client);
}

?>
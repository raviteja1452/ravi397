<?php

require_once('Config.php');
require_once('HttpServer.php');
require_once('ServerException.php');

class BaseServer extends HttpServer{

	protected $address;
	protected $port;
	protected $sock;

	function __construct() {
		$config = new config();
		$this->address = $config->address;
		$this->port = $config->port;
	}

	function createSocket(){
		try{
				$this->sock = socket_create(AF_INET, SOCK_STREAM, 0);
				if($this->sock == NULL) throw new ServerException("Could not create socket");
			}catch(Exception $e){
					die("Error Message :".$e->getMessage()."\n");
			}
	}

	function bindSocket(){
			try{
				socket_bind($this->sock,$this->address,$this->port);
			}catch(Exception $e){
				die("Error Message ".$e->getMessage()."\n");
			}
	}

	function listenClient(){
			try{
				socket_listen($this->sock);
				echo "Started Server and waiting for Clients \n";
			}catch(Exception $e){
				die("Error Message ".$e->getMessage()."\n");
			}
	}
	function acceptConnection(){
		while(true)
		{
			$client = NULL;
			try 
			{
				$client = socket_accept($this->sock);
				if($client == NULL) die("Socket Accept not working");
				$this->forkChild($client);
			}catch(Exception $e){
				die("Error Message".$e->getMessage()."\n");
			}
		}
	}
	function forkChild($client){
		$pid = pcntl_fork();
		if($pid == 0)
		{
			$this->parseString($client);
			die("Child Dead Now\n");
		} else if($pid == -1){
			die("Could Not fork");
		} else {	
			echo "Forked a Client and Waiting for New Client\n";
		}	
	}
	function parseString($client){	
		try{
			$input = NULL;
			$input = socket_read($client,1024);
			$line = explode("\n", $input);
			$word = explode(" ",$line[0]);
			$saction = explode("?",$word[1]);
			$actions = explode("/",$saction[0]);
			$items['action'] = $actions[1];
			$params = explode('&',$saction[1]);
			foreach($params as $item){
				$id = explode('=',$item);
				$items['params'][$id[0]]=$id[1];
			}
			$result = $this->route($items);
			$this->post($result,$client);

		}catch(Exception $e){
				die("Error Message".$e->getMessage()."\n");
		}
	}
	function route($items){
		$result = NULL;
		try{
			if($items['action']){
				$query = ucfirst($items['action']);
				$query = $query."Server";
				if (class_exists($query)) 
				{
					$obj = new $query;
				}else{
					return NULL;
				}
				$result = $obj->execute($items);
			}
		}catch(Exception $e){
			die("Error Message".$e->getMessage()."\n");
		}
		return $result;
	}
	
	function post($output,$client){

		socket_write($client,$output,strlen($output));
		socket_close($client);
	}
	function runServer(){
		$this->createSocket();
		$this->bindSocket();
		$this->listenClient();
		$this->acceptConnection();
	}
	function get(){
	}
	function execute($str) {
	}
	function __destruct(){

	}
}

$run = new BaseServer();
$run->runServer();

?>
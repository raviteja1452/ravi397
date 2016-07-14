<?php

require_once('Config.php');
require_once('HttpServer.php');
require_once('ServerException.php');

class BinaryServer extends HttpServer{

	private $address;
	private $port;
	private $sock;

	function __construct() {
		$config = new config();
		$this->address = $config->address;
		$this->port = $config->port;
	}

	function create(){
		try{
				$this->sock = socket_create(AF_INET, SOCK_STREAM, 0);
				if($this->sock == NULL) throw new ServerException("Could not create socket");
				$this->bind();
			}catch(Exception $e){
					die("Error Message :".$e->getMessage()."\n");
			}
	}

	function bind(){
			try{
				socket_bind($this->sock,$this->address,$this->port);
				$this->listen();
			}catch(Exception $e){
				die("Error Message ".$e->getMessage()."\n");
			}
	}

	function listen(){
			try{
				socket_listen($this->sock);
				echo "Started Server and waiting for Clients \n";
				$this->get();
			}catch(Exception $e){
				die("Error Message ".$e->getMessage()."\n");
			}
	}
	function get(){
		$client  = $this->accept();
	}
	function post($arr){
		$client = $arr['client'];
		$output = $arr['output'];
		//echo "To Client :".$output."\n";
		socket_write($client,$output,strlen($output));
		socket_close($this->sock);
	}
	function fork($client){
		$pid = pcntl_fork();
		if($pid == 0)
		{
			$arr = $this->parse($client);
			$this ->post($arr);
			die("I am Dead Now\n");
		} else if($pid == -1){
			die("Could Not fork");
		} else {	
			echo "Forked a Client and Waiting for New Client\n";
		}	
	}
	function accept(){
		while(true)
		{
			$client = NULL;
			try 
			{
				$client = socket_accept($this->sock);
				$this->fork($client);
				if($client == NULL) die("Socket Accept not working");
			}catch(Exception $e){
				die("Error Message".$e->getMessage()."\n");
			}
		}
	}

	function parse($client){	
		try{
			$input = NULL;
			$output = NULL;
			$input = socket_read($client,1024);
			$line = explode("\n", $input);
			$word = explode(" ",$line[0]);
			$str = explode("=",$word[1]);
			echo $str[1];
			if (file_exists($str[1])) {
			    $file = fopen($str[1],'rb');
				$output = fread($file,filesize($str[1]));
				//echo fread($file,filesize($str[1]));
				fclose($file);
			} else {
			    $output = "FILE NOT FOUND";
			    echo "File not found";
			}
			
			$arr['client'] = $client;
			$arr['output'] = $output;
			return $arr;
		}catch(Exception $e){
			die("Error Message ".$e->getMessage()."\n");
		}
		socket_close($client);
	}
	function __destruct(){

	}
}

$serv = new BinaryServer();
$serv->create();

?>
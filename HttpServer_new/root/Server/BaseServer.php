<?php

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
				socket_listen($this->sock,10);
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
			if(isset($saction[1])){
				$params = explode('&',$saction[1]);
				foreach($params as $item){
					$id = explode('=',$item);
					if(isset($id[0]) and isset($id[1]))
					$items['params'][$id[0]]=$id[1];
				}
			}
			$result = $this->route($items);
			$this->post($result,$client);

		}catch(Exception $e){
				die("Error Message".$e->getMessage()."\n");
		}
	}
	function route($items){
		$result = NULL;
		$output = NULL;
		try{
			if($items['action']){
				if($items['action']!=="favicon.ico")
				{
					$query = ucfirst($items['action']);
					$template = $query."Handler";
					$query = $query."Server";
					$obj = new $query;
					$db = DB::__connect();
					$result = $obj->execute($items,$db);
					$output = $this->renderTemplate($template,$result);
				}
			}
		}catch(Exception $e){
			die("Error Message".$e->getMessage()."\n");
		}
		return $output;
	}

	function renderTemplate($query,$result){

		$var = 'Html/'.$query.'.php';
		$file = fopen($var,'r');
		$output = fread($file,filesize($var));
		if($result==false){
			echo "NOT ENTERED".PHP_EOL;
		}else if(is_object($result)){
			$concat = NULL;
			$i = 0;
			foreach($result as $row){
				$concat = $concat.'<tr>';
				foreach($row as $col){
					if($i == 0){
						$concat = $concat.'<td>'.$col.'</td>';
						$i = 1;
					}else{
						$i = 0;
					}
				}
				$concat = $concat.'</tr>';
			}
			$output = str_replace("{{var}}",$concat,$output);
		}
		else if($result !== NULL){
			foreach ($result as $id=>$value){
				$output = str_replace("{{".$id."}}",$value,$output);
			}
		}
		return $output;
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
	function execute($str,$db) {
	}
	function __destruct(){

	}
}

?>
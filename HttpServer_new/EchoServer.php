<?php

require_once('BaseServer.php');

class EchoServer extends BaseServer{
	
	function execute($str){	
		try{
			if($str['params']['string']){
				$var = $str['params']['string'];
				$output = $var;
				echo "From Client :".$var."\n";
			}else{
				$output = "String is Not Found";
			}
			return $output;
		}catch(Exception $e){
			die("Error Message ".$e->getMessage()."\n");
		}
	}
}

?>
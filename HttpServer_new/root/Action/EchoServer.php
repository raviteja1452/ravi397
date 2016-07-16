<?php

class EchoServer extends BaseServer{
	
	function execute($str,$db){	
		try{
			if($str['params']['string']){
				$var = $str['params']['string'];
				$output['var'] = $var;
				echo "From Client :".$var."\n";
			}else{
				$output['var'] = "String is Not Found";
			}
			return $output;
		}catch(Exception $e){
			die("Error Message ".$e->getMessage()."\n");
		}
	}
}

?>
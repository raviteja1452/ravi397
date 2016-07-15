<?php

class PingServer extends BaseServer{
	
	function execute($str){	
		try{
			$output = "HI";
			return $output;
		}catch(Exception $e){
			die("Error Message ".$e->getMessage()."\n");
		}
	}
}

?>
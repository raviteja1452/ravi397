<?php

class PingServer extends BaseServer{
	
	function execute($str,$db){	
		try{
			$output['var'] = "HI";
			return $output;
		}catch(Exception $e){
			die("Error Message ".$e->getMessage()."\n");
		}
	}
}

?>
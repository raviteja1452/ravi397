<?php

class DisplayServer extends BaseServer{

	function execute($str,$db){	
		try{
			$output = $db->query("select * from entry");
			return $output;
		}catch(Exception $e){
			die("Error Message ".$e->getMessage()."\n");
		}
	}
}

?>
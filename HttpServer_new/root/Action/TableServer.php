<?php

class TableServer extends BaseServer{

	function execute($str,$db){	
		try{
			if($str['params']['table']){
				$table = $str['params']['table'];
				$output['var'] = $db->query('select * from '.$table);
			}else{
				$output['var'] = "FILE NOT FOUND";
				echo "FILE NAME NOT FOUND";
			}
			return $output;
		}catch(Exception $e){
			die("Error Message ".$e->getMessage()."\n");
		}
	}
	
}

?>
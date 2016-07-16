<?php

class SearchServer extends BaseServer{

	function execute($str,$db){	
		try{
			$output= NULL;
			if(isset($str['params']['search'])){
				$name = $str['params']['search'];
				$query = 'select * from entry where name like "%'.$name.'%"';
				$output = $db->query($query);
			}
			return $output;
		}catch(Exception $e){
			die("Error Message ".$e->getMessage()."\n");
		}
	}
}

?>
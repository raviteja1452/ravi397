<?php

class EntryServer extends BaseServer{

	function execute($str,$db){	
		try{
			$name = NULL;
			$age = NULL;
			$email = NULL;
			$output = NULL;
			if(isset($str['params']['name']) and isset($str['params']['age']) and isset($str['params']['email'])){
				$name = $str['params']['name'];
				$age = (int)$str['params']['age'];
				$email = $str['params']['email'];
				if($name !== "" and $email !== ""){
					$query = 'insert into entry (name, age, email ) values ("'.$name.'",'.$age.',"'.$email.'")';
					$output = $db->query($query);
				}
			}
			return $output;
		}catch(Exception $e){
			die("Error Message ".$e->getMessage()."\n");
		}
	}
}

?>
<?php

class FileServer extends BaseServer{

	function execute($str){	
		try{
			if($str['params']['file']){
				$var = $str['params']['file'];
				if (file_exists($var)) {
				    $file = fopen($var,'r');
					$output = fread($file,filesize($var));
					fclose($file);
				} else {
				    $output = "FILE NOT FOUND";
				    echo "FILE NOT FOUND";
				}
			}else{
				$output = "FILE NOT FOUND";
				echo "FILE NAME NOT FOUND";
			}
			return $output;
		}catch(Exception $e){
			die("Error Message ".$e->getMessage()."\n");
		}
	}
}

?>
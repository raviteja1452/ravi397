<?php

class FileServer extends BaseServer{

	function execute($str,$db){	
		try{
			if($str['params']['file']){
				$var = $str['params']['file'];
				if (file_exists($var)) {
				    $file = fopen($var,'r');
					$output['var'] = fread($file,filesize($var));
					fclose($file);
				} else {
				    $output['var'] = "FILE NOT FOUND";
				    echo "FILE NOT FOUND";
				}
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
<?php

spl_autoload_register(function ($query) {
	$connection = $query.'.php';
	if(file_exists('Server/'.$connection)){
    	require_once('Server/'.$connection);
	}
    else if(file_exists('Action/'.$connection)){
    	require_once('Action/'.$connection);
    }
    else if(file_exists('God/'.$connection)){
    	require_once('God/'.$connection);
    }else{
    	echo "not found";
    }
});	

//Starting Server	
$app = new BaseServer();
$app->runserver();
?>
<?php

class DB{

	private static $obj = NULL;
	private $dbh;

	private function __construct(){
		$params = parse_ini_file("Config.ini",true);
		try{
			$this->dbh = new PDO('mysql:host='.$params['ip'].':'.$params['port'].';dbname='.$params['dbname'],$params['user'], $params['password']);
		}catch(Exception $e){
			die("Exception is :".$e);
		}
	}
	public static function __connect(){
		if(self::$obj === NULL){
			self::$obj = new DB();
		}
		return self::$obj;
	}
	public function query($query){
		$data = $this->dbh->query($query);
		return $data;
	}
}

?>
<?php
class DBPDOConstractorForPostgreSQLStruct{
	public $info = Array(
		"host" => "",
		"dbname" => "",
		"port" => "",
		"user" => "",
		"pass" => ""
	);
}

class DBPDOConstractorForMySQL{
	public $info = Array(
		"host" => "",
		"dbname" => "",
		"port" => ""
	);
}

class DBPDOConstractorForSQLite{
	public $info = Array(
		"db_name" => ""	//absolute Path for database
	);
}

class DBPDOConstractorForSQLite2{
	public $info = Array(
		"db_name" => ""	//absolute Path for database
	);
}
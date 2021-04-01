<?php
/* SET */
class DBSP_SetServerTokenStruct{
	public $info = Array(
		"token" => "",
		"startFrom" => "",
		"endAt" => ""
	);
}

class DBSP_SetUserStatusStruct{
	public $info = Array(
		"user_address" => "",
		"status" => ""
	);
}


/* GET */
class DBSP_GetUserIdStruct{
	public $info = Array(
		"user_id" => ""
	);
}

class DBSP_GetServerTokenStruct{
	public $info = Array(
		"token" => "",
		"startFrom" => "",
		"endAt" => ""
	);
}

class DBSP_GetUserStatusStruct{
	public $info = Array(
		"user_status" => ""
	);
}

/* ADD */
class DBSP_AddRegisteredUserStruct{
	public $info = Array(
		"user_address" => ""
	);
}
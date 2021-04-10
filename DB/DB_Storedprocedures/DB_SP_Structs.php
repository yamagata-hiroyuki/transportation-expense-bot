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
		"status" => 0
	);
}

class DBSP_SetTempRouteInfo_JorudanInfoStruct{
	public $info = Array(
		"user_address" => "",
		"route" => "",
		"route_date" => "",
		"price" => 0
		);
}

class DBSP_SetTempRouteInfo_DestinationStruct{
	public $info = Array(
		"user_address" => "",
		"destination" => ""
		);
}

class DBSP_SetTempRouteInfo_UserPriceStruct{
	public $info = Array(
		"user_address" => "",
		"user_price" => FALSE
		);
}

class DBSP_SetTempRouteInfo_RemarksStruct{
	public $info = Array(
		"user_address" => "",
		"remarks" => ""
		);
}

class DBSP_SetTempRouteInfo_RoundsStruct{
	public $info = Array(
		"user_address" => "",
		"rounds" => TRUE
		);
}

class DBSP_SetTempRouteInfo_ClearJorudanInfoStruct{
	public $info = Array(
		"user_address" => ""
	);
}

/* GET */
class DBSP_GetUserIdStruct{
	public $info = Array(
		"user_id" => 0
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
		"user_status" => 0
	);
}

class DBSP_GetTempRouteInfoStruct{
	public $info = Array(
		"route_date" => "",
		"destination" => "",
		"route" => "",
		"rounds" => TRUE,
		"price" => 0,
		"user_price" => FALSE,
		"remarks" => ""
	);
}

/* ADD */
class DBSP_AddRegisteredUserStruct{
	public $info = Array(
		"user_address" => ""
	);
}

class DBSP_AddRouteInfoStruct{
	public $info = Array(
		"user_address" => ""
		);
}

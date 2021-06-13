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
		"user_price" => 0
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

class DBSP_SetSelectedDeleteRouteInfoStruct{
	public $info = Array(
		"user_address" => "",
		"route_no" => ""
	);
}

class DBSP_SetRouteInfo_DocsIdStruct{
	public $info = Array(
		"user_address" => "",
		"route_no" => 0,
		"docs_id" => 0,
		"application_date" => ""
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

class DBSP_GetRouteInfosStruct{
	public $info = Array();	//DBSP_GetRouteInfoStructが配列となって格納されている
}

class DBSP_GetRouteInfoStruct{
		public $route_no		= "";
		public $route_date		= "";
		public $destination	= "";
		public $route			= "";
		public $rounds			= TRUE;
		public $price			= 0;
		public $user_price		= FALSE;
		public $remarks		= "";
		public $application	= FALSE;
		public $docs_id		= 0;
}

class DBSP_GetIsRouteInfoExistStruct{
	public $info = Array(
		"GetIsRouteInfoExist" => FALSE
	);
}

class DBSP_GetIsRouteInfoExistByRouteNoStruct{
	public $info = Array(
		"GetIsRouteInfoExistByRouteNo" => FALSE
	);
}

class DBSP_GetRouteInfoByRouteNoStruct{
	public $info = Array(
		"route_no" => 0,
		"route_date" => "",
		"destination" => "",
		"route" => "",
		"rounds" => TRUE,
		"price" => 0,
		"user_price" => FALSE,
		"remarks" => "",
		"application" => FALSE,
		"docs_id" => 0
	);
}

class DBSP_GetSelectedDeleteRouteInfoStruct{
	public $info = Array(
		"selected_delete_route_info" => 0,
	);
}

class DBSP_GetIsNotRequestedRouteInfoExistByApplicationStruct{
	public $info = Array(
		"GetIsNotRequestedRouteInfoExistByApplication" => FALSE
	);
}

class DBSP_GetNotRequestedRouteInfosByApplicationStruct{
	public $info = Array();	//DBSP_GetNotRequestedRouteInfoByApplicationStructが配列となって格納されている
}

class DBSP_GetNotRequestedRouteInfoByApplicationStruct{
	public $route_no		= "";
	public $route_date		= "";
	public $destination	= "";
	public $route			= "";
	public $rounds			= TRUE;
	public $price			= 0;
	public $user_price		= FALSE;
	public $remarks		= "";
	public $application	= FALSE;
	public $docs_id		= 0;
}

class DBSP_GetDocsMS_DocsIDsStruct{
	public $info = Array();	//DBSP_GetDocsMS_DocsIDStructが配列となって格納される
}

class DBSP_GetDocsMS_DocsIDStruct{
	public $docs_id;
}

class DBSP_GetTempRouteInfo_PriceStruct{
	public $info = Array(
		"price" => 0
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

/* DELETE */
class DBSP_DelRouteInfoByRouteNoStruct{
	public $info = Array(
		"user_address"	=> "",
		"route_no"		=> 0
	);
}
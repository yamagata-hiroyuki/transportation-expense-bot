<?php
	file_put_contents("php://stdout", "DEBUG Log Herro PHP 2row\n");
//	require_once 'LineWorks/LineWorksCfg.php';
//	require_once 'HTTP/HTTPSClientCommon.php';
//	require_once 'LineWorks/LineWorksHTTPSReqs.php';
//	require_once 'LineWorks/LineWorksHTTPSResies.php';
//	require_once 'JWT/JWTFuncs.php';
//	require_once 'DB/DB_test_sql.php';
//	require_once 'DB/DB_Storedprocedures/DB_SP_GetFunctions.php';
//	require_once 'DB/DB_Storedprocedures/DB_SP_AddFunctions.php';
//	require_once 'DB/DB_Storedprocedures/DB_SP_SetFunctions.php';
//
//	DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,">>>DBG hello php");
//	date_default_timezone_set(TIME_ZONE);
//	//require_once '';
//	//require_once '';
//	//require_once '';
//
//	/* ServerToken取得テスト */
//	{
//		if(S_TOKEN_TEST){
//			//LineWorks クライアントの作成
//			$client = new LineWorksReqs();
//
//			//JWT Token生成
//			$JWTToken = CreateJWT();
//			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"JWTToken = ".$JWTToken);
//
//			//Server Token 要求
//			$resp = new ServerTokenRes();
//
//			$resp->propaty = $client->ServerTokenReq($JWTToken);
//
//			//serverTokenをDBへ登録
//			$currentTime = new DateTime("now");
//			$endTime = new DateTime("now +".$resp->propaty["expires_in"]." seconds");//expires_inミリ秒アクセストークン有効
//			$reqInfo = new DBSP_SetServerTokenStruct();
//			$reqInfo->info["server_token"] = $resp->propaty["access_token"];
//			$reqInfo->info["startFrom"] = $currentTime->format("Y/m/d H:i:sO");
//			$reqInfo->info["endAt"] = $endTime->format("Y/m/d H:i:sO");
//
//			DB_SP_setServerToken($reqInfo);
//		}
//	}
//
//	/* 受信・応答テスト */
//	{
//		if(RCV_TEST){
//			$client = new LineWorksResies();
//			$client->RecvCallBackEvent();
//		}
//	}
//
//	/* メニュー表示テスト */
//	{
//		if(MENU_TEST){
//			//LineWorks クライアントの作成
//			$client = new LineWorksReqs();
//
//			//JWT Token生成
//			$JWTToken = CreateJWT();
//			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"JWTToken = ".$JWTToken);
//
//			//TODO Server Token 要求(DBから取得するように修正すること)
//			$serverToken = $client->ServerTokenReq($JWTToken);
//			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"serverToken = ".$serverToken);
//
//			//TODO メッセージを送付したいユーザーIDを取得
//			$accountId = "masashi-watanabe@upload-gp.co.jp";
//
//			$client->DispMainMenuReq($accountId,$serverToken);
//		}
//	}
//
//	/* DBテスト */
//	{
//		if(DB_TEST){
//			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,">>>DBG DB Test Start");
//			$userId = "masashi-watanabe@upload-gp.co.jp";
//			$status = Enum_CallBack_userState::USER_JUST_REGISTED;
//			$rsltArray = new DBSP_GetIsRouteInfoExistStruct();
//			//$rsltArray->info["user_address"] = "masashi-watanabe@upload-gp.co.jp";
//			DB_SP_getIsRouteInfoExist($userId,$rsltArray);
//			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"rsltArray = ",$rsltArray);
//			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,">>>DBG DB Test End");
//		}
//	}
//

<?php
	require_once 'LineWorks/LineWorksCfg.php';
	require_once 'HTTP/HTTPSClientCommon.php';
	require_once 'LineWorks/LineWorksHTTPSReqs.php';
	require_once 'LineWorks/LineWorksHTTPSRese.php';
	require_once 'JWT/JWTFuncs.php';
	require_once 'DB/DB_basic.php';
	require_once 'DB/DB_test_sql.php';

	DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"hello php");
	//require_once '';
	//require_once '';
	//require_once '';

	/* ServerToken取得テスト */
	{
		if(S_TOKEN_TEST){
			//LineWorks クライアントの作成
			$client = new LineWorksReqs();

			//JWT Token生成
			$JWTToken = CreateJWT();
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"JWTToken = ".$JWTToken);

			//Server Token 要求
			$serverToken = $client->ServerTokenReq($JWTToken);
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"serverToken = ".$serverToken);

			//TODO $serverTokenをDBへ登録

			//Bot List要求
			$client->SendBotListReq($serverToken);
		}
	}

	/* 受信・応答テスト */
	{
		if(RCV_TEST){
			$client = new LineWorksReses;
			$client->RecvCallBackEvent();
		}
	}

	/* メニュー表示テスト */
	{
		if(MENU_TEST){
			//LineWorks クライアントの作成
			$client = new LineWorksReqs();

			//JWT Token生成
			$JWTToken = CreateJWT();
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"JWTToken = ".$JWTToken);

			//TODO Server Token 要求(DBから取得するように修正すること)
			$serverToken = $client->ServerTokenReq($JWTToken);
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"serverToken = ".$serverToken);

			//TODO メッセージを送付したいユーザーIDを取得
			$accountId = "masashi-watanabe@upload-gp.co.jp";

			$client->DispMainMenuReq($accountId,$serverToken);
		}
	}

	/* DBテスト */
	{
		if(DB_TEST){
			$userId = "test_user";
			$result = registerUser($userId);
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"regist UserId = ".$userId);
		}
	}


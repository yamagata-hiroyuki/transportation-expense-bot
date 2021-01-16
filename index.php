<?php
	error_log("hello php(error_log)");
	require_once 'LineWorks/LineWorksCfg.php';
 	require_once 'HTTP/HTTPSClientCommon.php';
 	require_once 'LineWorks/LineWorksHTTPSReqs.php';
 	require_once 'LineWorks/LineWorksHTTPSRese.php';
 	require_once 'JWT/JWTFuncs.php';
	DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"hello php(DEBUG_LOG)");
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
        
         	//Bot List要求
         	$client->SendBotListReq($serverToken);
     	}
 	}
 	
 	/* 受信テスト */
 	{
 	    if(RCV_TEST){
 	        $client = new LineWorksReses;
 	        $client->RecvCallBackEvent();
 	     }
 	}

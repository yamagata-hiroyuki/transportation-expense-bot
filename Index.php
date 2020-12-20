<?php
echo "hallo php";
	require_once 'LineWorks/LineWorksCfg.php';
 	require_once 'HTTP/HTTPSClientCommon.php';
 	require_once 'LineWorks/LineWorksHTTPSReqs.php';
 	require_once 'JWT/JWTFuncs.php';
 	//require_once '';
 	//require_once '';
 	//require_once '';
 	
 	//LineWorks クライアントの作成
 	$client = new LineWorksReqs();
 	
 	//JWT Token生成
 	$JWTToken = CreateJWT();
 	DEBUG_LOG("JWTToken = ",$JWTToken);
 	
 	//Server Token 要求
 	$serverToken = $client->ServerTokenReq($JWTToken);
 	DEBUG_LOG("serverToken = ",$serverToken);

 	//Bot List要求
 	$client->SendBotListReq($serverToken);

?>
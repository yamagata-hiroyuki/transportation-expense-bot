<?php
echo "hallo php";
	require_once 'LineWorksCfg.php';
 	require_once 'HTTPSClientCommon.php';
 	require_once 'LineWorksHTTPSReqs.php';
 	//require_once '';
 	//require_once '';
 	//require_once '';
	
 	//クライアントの作成
 	$clientInstance = new LineWorksReqs();
 	$client = $clientInstance->BotListReq;
 	//プロパティの設定
 	$propatyInstance = new BotListReqStruct();
 	$propaty = $propatyInstance->propaty;
 	$client->SendBotListReq($propaty);

?>
<?php
	require_once 'LineWorksCfg.php';
	require_once 'HTTPSClientCommon.php';
	require_once 'LineWorksHTTPSReqs.php';
	//require_once '';
	//require_once '';
	//require_once '';
	
	$client = new LineWorksReqs();
	$propaty = new BotListReqStruct();
	$client->BotListReq($propaty);

?>
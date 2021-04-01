<?php
require_once "DB/DB_basic.php";
require_once "LineWorks/LineWorksHTTPSReqs.php";
require_once "LineWorks/LineWorksHTTPSRese.php";
require_once "DB/DB_Storedprocedures/DB_SP_Structs.php";

function DB_SP_getUserId(string $user_address ,DBSP_GetUserIdStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetUserId"(:user_address)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $user_address, PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			$output->info = $sth->fetch(PDO::FETCH_ASSOC);
		} else {
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec result faild.");
			return false;
		}
	}
	catch( PDOException $e){
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec error: ".$e->getMessage());
		return false;
	}
	return true;
}

function DB_SP_getServerToken(DBSP_GetServerTokenStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetServerToken"()';
	$sth = $dbConnection->prepare($sql);
	try {
		if( $sth->execute() ){
			$output->info = $sth->fetch(PDO::FETCH_ASSOC);
		} else {
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec result faild.");
			return false;
		}
	}
	catch (PDOException $e) {
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec error: ".$e->getMessage());
		return false;
	}

	$needReissueFlag = false;
	$currentTime = new DateTime("now");
	if( empty($output->info["endAt"]) ){
		//レコードがなければトークンを発行する
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Token is not saved in DB.Token will be issue.");
		$needReissueFlag = true;
	} else if( strtotime($currentTime->format("Y/m/d H:i:sO")) >= strtotime($output->info["endAt"]) ){
		//有効期限外ならトークンを再発行する
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,
			"[INFO]token is expired.Token will be reissue.(expire date = ".$output->info["endAt"]);
		$needReissueFlag = true;
	}

	if ( $needReissueFlag ){
		//トークンの発行
		//LineWorks クライアントの作成
		$client = new LineWorksReqs();

		//JWT Token生成
		$JWTToken = CreateJWT();
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"JWTToken = ".$JWTToken);

		//Server Token 要求
		$resp = new ServerTokenRes();
		$resp->propaty = $client->ServerTokenReq($JWTToken);

		//serverTokenをDBへ登録
		$currentTime = new DateTime("now");
		$endTime = new DateTime("now +".$resp->propaty["expires_in"]." seconds");//expires_inミリ秒アクセストークン有効
		$reqInfo = new DBSP_SetServerTokenStruct();
		$reqInfo->info["server_token"] = $resp->propaty["access_token"];
		$reqInfo->info["startFrom"] = $currentTime->format("Y/m/d H:i:sO");
		$reqInfo->info["endAt"] = $endTime->format("Y/m/d H:i:sO");

		$rslt = DB_SP_setServerToken($reqInfo);
		if( $rslt){ return false};
		//新しいトークン情報でアウトプットを上書きする
		$output->info["server_token"] = $resp->propaty["access_token"];
		$output->info["startFrom"] = $currentTime;
		$output->info["endAt"] = $endTime;
	}
	return true;
}

function DB_SP_getUserStatus(string $user_address ,DBSP_GetUserStatusStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetUserStatus"(:user_address)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $user_address, PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			$output->info = $sth->fetch(PDO::FETCH_ASSOC);
		} else {
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec result faild.");
			return false;
		}
	}
	catch( PDOException $e){
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec error: ".$e->getMessage());
		return false;
	}
	return true;
}


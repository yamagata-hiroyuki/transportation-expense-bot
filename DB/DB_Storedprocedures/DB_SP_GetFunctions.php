<?php
require_once "DB/DB_basic.php";
require_once "LineWorks/LineWorksHTTPSReqs.php";
require_once "LineWorks/LineWorksHTTPSResies.php";
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
	DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"debug ",$output->info);
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
		if( false == $rslt){ return false;};
		//新しいトークン情報でアウトプットを上書きする
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"resp = ",$resp);
		$output->info["token"] = $resp->propaty["access_token"];
		$output->info["startFrom"] = $currentTime;
		$output->info["endAt"] = $endTime;
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"output = ",$output);
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

function DB_SP_getTempRouteInfo(string $user_address ,DBSP_GetTempRouteInfoStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetTempRouteInfo"(:user_address)';
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

function DB_SP_getRouteInfo(string $user_address ,DBSP_GetRouteInfosStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetRouteInfo"(:user_address)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $user_address, PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			foreach($sth->fetchall(PDO::FETCH_ASSOC) as $row ){
				$routeInfo = new DBSP_GetRouteInfoStruct();
				$routeInfo->route_no	= $row["route_no"];
				$routeInfo->route_date	= $row["route_date"];
				$routeInfo->destination	= $row["destination"];
				$routeInfo->route		= $row["route"];
				$routeInfo->rounds		= $row["rounds"];
				$routeInfo->price		= $row["price"];
				$routeInfo->user_price	= $row["user_price"];
				$routeInfo->trans_exp	= $row["trans_exp"];
				$routeInfo->remarks		= $row["remarks"];
				array_push($output->info,$routeInfo);
			}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"A_Break routeInfo=",$routeInfo);
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

function DB_SP_getIsRouteInfoExist(string $user_address ,DBSP_GetIsRouteInfoExistStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetIsRouteInfoExist"(:user_address)';
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

function DB_SP_getIsRouteInfoExistByRouteNo(string $user_address , int $route_no, DBSP_GetIsRouteInfoExistByRouteNoStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetIsRouteInfoExistByRouteNo"(:user_address,:route_no)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $user_address, PDO::PARAM_STR);
	$sth->bindValue(':route_no', $route_no, PDO::PARAM_INT);
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

function DB_SP_getRouteInfoByRouteNo(string $user_address,int $route_no, DBSP_GetRouteInfoByRouteNoStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetRouteInfoByRouteNo"(:user_address,:route_no)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $user_address, PDO::PARAM_STR);
	$sth->bindValue(':route_no', $route_no, PDO::PARAM_INT);

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

function DB_SP_getSelectedDeleteRouteInfo(string $user_address, DBSP_GetSelectedDeleteRouteInfoStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetSelectedDeleteRouteInfo"(:user_address)';
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

function DB_SP_getNotRequestedRouteInfoByApplication(string $user_address ,DBSP_GetNotRequestedRouteInfosByApplicationStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetNotRequestedRouteInfoByApplication"(:user_address)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $user_address, PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			foreach($sth->fetchall(PDO::FETCH_ASSOC) as $row ){
				$routeInfo = new DBSP_GetNotRequestedRouteInfoByApplicationStruct();
				$routeInfo->route_no	= $row["route_no"];
				$routeInfo->route_date	= $row["route_date"];
				$routeInfo->destination	= $row["destination"];
				$routeInfo->route		= $row["route"];
				$routeInfo->rounds		= $row["rounds"];
				$routeInfo->price		= $row["price"];
				$routeInfo->user_price	= $row["user_price"];
				$routeInfo->trans_exp	= $row["trans_exp"];
				$routeInfo->remarks		= $row["remarks"];
				array_push($output->info,$routeInfo);
			}
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

function DB_SP_getIsNotRequestedRouteInfoExistByApplication(string $user_address , DBSP_GetIsNotRequestedRouteInfoExistByApplicationStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetIsNotRequestedRouteInfoExistByApplication"(:user_address)';
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

function DB_SP_GetDocsMS_DocsIDs(string $user_address , DBSP_GetDocsMS_DocsIDsStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetDocsMS_DocsIDs"(:user_address)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $user_address, PDO::PARAM_STR);
	try {
		if( $sth->execute() ){
			foreach($sth->fetchall(PDO::FETCH_ASSOC) as $row ){
				$docs_id = new DBSP_GetDocsMS_DocsIDStruct();
				$docs_id->docs_id = $row["docs_id"];
				array_push($output->info,$docs_id);
			}
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

function DB_SP_getTempRouteInfo_price(string $user_address ,DBSP_GetTempRouteInfo_PriceStruct &$output):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetTempRouteInfo"(:user_address)';
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

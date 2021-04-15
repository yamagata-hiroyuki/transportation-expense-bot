<?php
require_once "DB/DB_basic.php";
require_once "LineWorks/LineWorksHTTPSResiesJsonStructs.php";
require_once "DB/DB_Storedprocedures/DB_SP_Structs.php";

function DB_SP_setServerToken(DBSP_SetServerTokenStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetServerToken"(:token,:startFrom,:endAt)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':token', $setInfo->info["server_token"], PDO::PARAM_STR);
	$sth->bindValue(':startFrom', $setInfo->info["startFrom"], PDO::PARAM_STR);
	$sth->bindValue(':endAt', $setInfo->info["endAt"], PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			//DO Nothing
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

function DB_SP_setUserStatus(DBSP_SetUserStatusStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetUserStatus"(:user_address,:status)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $setInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':status', $setInfo->info["status"], PDO::PARAM_INT);

	try {
		if( $sth->execute() ){
			//DO Nothing
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

function DB_SP_setTempRouteInfo_JorudanInfo(DBSP_SetTempRouteInfo_JorudanInfoStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetTempRouteInfo_JorudanInfo"(:user_address,:route,:route_date,:price)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $setInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':route', $setInfo->info["route"], PDO::PARAM_STR);
	$sth->bindValue(':route_date', $setInfo->info["route_date"], PDO::PARAM_STR);
	$sth->bindValue(':price', $setInfo->info["price"], PDO::PARAM_INT);

	try {
		if( $sth->execute() ){
			//DO Nothing
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

function DB_SP_setTempRouteInfo_Destination(DBSP_SetTempRouteInfo_DestinationStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetTempRouteInfo_Destination"(:user_address,:destination)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $setInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':destination', $setInfo->info["destination"], PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			//DO Nothing
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

function DB_SP_setTempRouteInfo_Price(DBSP_SetTempRouteInfo_UserPriceStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetTempRouteInfo_Price"(:user_address,:price)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $setInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':price', $setInfo->info["price"], PDO::PARAM_BOOL);

	try {
		if( $sth->execute() ){
			//DO Nothing
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

function DB_SP_setTempRouteInfo_Remarks(DBSP_SetTempRouteInfo_RemarksStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetTempRouteInfo_Remarks"(:user_address,:remarks)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $setInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':remarks', $setInfo->info["remarks"], PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			//DO Nothing
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

function DB_SP_setTempRouteInfo_Rounds(DBSP_SetTempRouteInfo_RoundsStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetTempRouteInfo_Rounds"(:user_address,:rounds)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $setInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':rounds', $setInfo->info["rounds"], PDO::PARAM_BOOL);

	try {
		if( $sth->execute() ){
			//DO Nothing
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

function DB_SP_setTempRouteInfo_UserPrice(DBSP_SetTempRouteInfo_UserPriceStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetTempRouteInfo_UserPrice"(:user_address,:user_price)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $setInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':user_price', $setInfo->info["user_price"], PDO::PARAM_BOOL);

	try {
		if( $sth->execute() ){
			//DO Nothing
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

function DB_SP_setTempRouteInfo_CrearJorudanInfo(DBSP_SetTempRouteInfo_ClearJorudanInfoStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetTempRouteInfo_ClearJorudanInfo"(:user_address)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $setInfo->info["user_address"], PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			//DO Nothing
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

function DB_SP_setSelectedDeleteRouteInfo(DBSP_SetSelectedDeleteRouteInfoStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}
	DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"delInfo=",$setInfo);
	$sql = 'SELECT transportation_expense_bot."SetSelectedDeleteRouteInfo"(:user_address,:route_no)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $setInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':route_no', $setInfo->info["route_no"], PDO::PARAM_INT);

	try {
		if( $sth->execute() ){
			//DO Nothing
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

function DB_SP_setRouteInfo_DocsId(DBSP_SetRouteInfo_DocsIdStruct $setInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}
	$sql = 'SELECT transportation_expense_bot."SetRouteInfo_DocsId"(:user_address,:route_no,:docs_id,:application_date)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $setInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':route_no', $setInfo->info["route_no"], PDO::PARAM_INT);
	$sth->bindValue(':docs_id', $setInfo->info["docs_id"], PDO::PARAM_INT);
	$sth->bindValue(':application_date', $setInfo->info["application_date"], PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			//DO Nothing
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
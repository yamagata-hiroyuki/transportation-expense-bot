<?php
require_once "DB/DB_basic.php";
require_once "LineWorks/LineWorksHTTPSResesJsonStructs.php";
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
<?php
require_once "DB/DB_basic.php";
require_once "DB/DB_Storedprocedures/DB_SP_Structs.php";

function DB_SP_addRegisteredUser(DBSP_AddRegisteredUserStruct $addInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."AddRegisteredUser"(:user_address,:user_name)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $addInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':user_name', $addInfo->info["user_name"], PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			//DO Nothing
		}else{
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec result faild.");
			return false;
		}
	}
	catch (PDOException $e) {
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec error: ".$e->getMessage());
		return false;
	}
	return true;
}

function DB_SP_addRouteInfo(DBSP_AddRouteInfoStruct $addInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."AddRouteInfo"(:user_address)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $addInfo->info["user_address"], PDO::PARAM_STR);

	try {
		if( $sth->execute() ){
			//DO Nothing
		}else{
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec result faild.");
			return false;
		}
	}
	catch (PDOException $e) {
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec error: ".$e->getMessage());
		return false;
	}
	return true;
}
<?php
require_once "DB/DB_basic.php";
require_once "LineWorks/LineWorksHTTPSResiesJsonStructs.php";
require_once "DB/DB_Storedprocedures/DB_SP_Structs.php";

function DB_SP_delRouteInfoByRouteNo(DBSP_DelRouteInfoByRouteNoStruct $delInfo):bool{
	$dbConnection = null;
	if( !dbConnection::getConnection($dbConnection) ){
		return false;
	}

	DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"delInfo=",$delInfo);
	$sql = 'SELECT transportation_expense_bot."DelRouteInfoByRouteNo"(:user_address,:route_no)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $delInfo->info["user_address"], PDO::PARAM_STR);
	$sth->bindValue(':route_no', $delInfo->info["route_no"], PDO::PARAM_INT);

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

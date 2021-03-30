<?php
require_once "DB/DB_basic.php";
require_once "LineWorks/LineWorksHTTPSResesJsonStructs.php";

function DB_SP_setServerToken(string $token, $startFrom, $endAt):bool{
	$dbConnection = null;
	if(!dbConnection::getConnection($dbConnection)){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetServerToken"(:token,:startFrom,:endAt)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':token', $token, PDO::PARAM_STR);
	$sth->bindValue(':startFrom', $startFrom, PDO::PARAM_STR);
	$sth->bindValue(':endAt', $endAt, PDO::PARAM_STR);
	DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"startFrom=".$startFrom);
	DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"endAt=".$endAt);
	try {
		if($sth->execute()){
			//DO Nothing
		}else{
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec result faild.: ");
			return false;
		}
	}
	catch (PDOException $e) {
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec error: ".$e->getMessage());
		return false;
	}
	return true;
}



function DB_SP_setUserStatus(string $user_address, $status):bool{
	$dbConnection = null;
	if(!dbConnection::getConnection($dbConnection)){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."SetUserStatus"(:user_address,:status)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $user_address, PDO::PARAM_STR);
	$sth->bindValue(':status', $status, PDO::PARAM_INT);

	try {
		if($sth->execute()){
			//DO Nothing
		}else{
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec result faild.: ");
			return false;
		}
	}
	catch (PDOException $e) {
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec error: ".$e->getMessage());
		return false;
	}
	return true;
}
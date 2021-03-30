<?php
require_once "DB/DB_basic.php";

function DB_SP_addRegisteredUser(string $user_address):bool{
	$dbConnection = null;
	if(!dbConnection::getConnection($dbConnection)){
		return false;
	}

	$sql = 'SELECT transportation_expense_bot."AddRegisteredUser"(:user_address)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $user_address, PDO::PARAM_STR);

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
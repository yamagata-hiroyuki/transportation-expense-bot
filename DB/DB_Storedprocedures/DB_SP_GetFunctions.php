<?php
require_once "DB/DB_basic.php";

function DB_SP_getUserId(string $user_address, Array &$output):bool{
	$dbConnection = null;
	if(!dbConnection::getConnection($dbConnection)){
		return false;
	}

	$sql = 'SELECT * FROM transportation_expense_bot."GetUserId"(:user_address)';
	$sth = $dbConnection->prepare($sql);

	$sth->bindValue(':user_address', $user_address, PDO::PARAM_STR);

	try {
		if($sth->execute()){
			$output = $sth->fetch(PDO::FETCH_NUM);
			//TODO 本運用時は削除する（セキュリティ上ログに残すべきではない）
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[DEBUG]SQL output = ",$output);
		}else{
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]SQL exec result faild.: ");
			return false;
		}
	}
	catch (PDOException $e) {
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]]SQL exec error: ".$e->getMessage());
		return false;
	}
	return true;
}
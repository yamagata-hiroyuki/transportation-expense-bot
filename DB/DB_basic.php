<?php
require_once "Common/Lamdas.php";
require_once "DB/DBConfig.php";
require_once "DB/DB_Structs.php";

/*データベース接続クラス*/

class dbConnection{
	// インスタンス
	protected static $db;
	protected static $dbValidity;//$dbの有効性:true=有効
	// コンストラクタ
	private function __construct() {
		//PDOコンストラクター向け構文取得
		$dsn = self::getPDOConstractorString(DB_DSN);
		// 接続を確立
		try {
			self::$db = new PDO($dsn);
			// エラー時例外を投げるように設定
			self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			self::$dbValidity = true;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]DB conected.");
		}
		catch (PDOException $e) {
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]]Connection Error: ".$e->getMessage());
			self::$dbValidity = false;
		}
	}

	// シングルトン。存在しない場合のみインスタンス化
	public static function getConnection(&$connection):bool {
		if (!self::$db) {
			new dbConnection();
		}
		$connection = self::$db;
		return self::$dbValidity;
	}

	private function getPDOConstractorString(String $type):String{
		$str="";
		switch($type){
			case DB_DSN_AS_POSTGRE_SQL:
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Make for postgreSQL.");
				$dsn = new DBPDOConstractorForPostgreSQLStruct();
				if(DB_TEST_ON_LOCAL_ENV){
					$dsn->info = $GLOBALS["DB_INFO"];
				}else{
					// 環境変数からデータベースへの接続情報を取得し
					$url = parse_url(getenv('DATABASE_URL'));

					$dsn->info["host"] =  $url['host'];
					$dsn->info["dbname"] = substr($url['path'], 1);
					$dsn->info["user"] = $url['user'];
					$dsn->info["pass"] = $url['pass'];
					$dsn->info["port"] = DB_PORT;
				}
				$str = DB_DSN.":".
					"dbname=".$dsn->info["dbname"].
					";host=".$dsn->info["host"].
					";port=".$dsn->info["port"].
					";user=".$dsn->info["user"].
					";password=".$dsn->info["pass"];
				break;

			case DB_DSN_AS_MYSQL:
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Make for MySQL.");
				$dsn = new DBPDOConstractorForMySQL();
				if(DB_TEST_ON_LOCAL_ENV){
					$dsn->info = $GLOBALS["DB_INFO"];
				}else{
					//TODO Heroku上の環境変数より各パラメーターを設定
				}
				$str = DB_DSN.":".
					"dbname=".$dsn->info["dbname"].
					";host=".$dsn->info["host"].
					";port=".$dsn->info["port"];
				break;

			case DB_DSN_AS_SQLITE:
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Make for SQLite.");
				$dsn = new DBPDOConstractorForSQLite();
				if(DB_TEST_ON_LOCAL_ENV){
					$dsn->info = $GLOBALS["DB_INFO"];
				}else{
					//TODO Heroku上の環境変数より各パラメーターを設定
				}
				$str = DB_DSN.":".
					"dbname=".$dsn->info["dbname"];//絶対パス
				break;

			case DB_DSN_AS_SQLITE_2:
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Make for SQLite2.");
				$dsn = new DBPDOConstractorForSQLite2();
				if(DB_TEST_ON_LOCAL_ENV){
					$dsn->info = $GLOBALS["DB_INFO"];
				}else{
					//TODO Heroku上の環境変数より各パラメーターを設定
				}
				$str = DB_DSN.":".
					"dbname=".$dsn->info["dbname"];//絶対パス
				break;
			default:
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]DSN type is invalid.DB will not work.");
		}
		return $str;
	}
}

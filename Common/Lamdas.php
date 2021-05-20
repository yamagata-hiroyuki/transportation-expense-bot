<?php
	require_once 'CallbackAnalyser/MessageAnalyser/MessageAnalyser.php';

	define("DEBUG_LOG_OUT",true);//ログ出力のON/OFF
	define("S_TOKEN_TEST",false);//ServerToken取得テストを実行する場合はtrue
	define("RCV_TEST",true);//受信テストする場合はtrue
	define("RCV_TEST_DATA",false);//ローカルで受信テストする場合はtrueに設定.Herokuでテストする場合はfalse
	define("DB_TEST",false);//DBテストする場合はtrue
	define("DB_TEST_ON_LOCAL_ENV",false);//ローカル環境でDBを用いる場合はtrue
	define("LOG_OUTPUT_HEROKU",true);//Herokuでログ出力する場合はtrue,falseの時はローカルコンソールにログ出力
	define("MENU_TEST",false);//メインメニュー表示をテストする場合はTrue

	$RCV_DATA = Array(//ローカルで受信テストする場合はここを変更（受信データを設定できます）
 		"type" => "message",
		"source" => Array(
			"accountId" => "masashi-watanabe@upload-gp.co.jp",
			"roomId" => "",
		),
		"createdTime" => "1470902041851",
		"content" => Array(
			"type" => "text",
			  "text" => "some message input here"
			//"postback" => MA_MessagePostbackList::APPLY,
		)
	);

	$DB_INFO = Array(//ローカル環境でDBを用いる場合のDB情報
		"host" => "localhost",									//localhost固定
		"dbname" => "TransportationExpenseBotDBForLocalTest",	//バッチを用いて作成した場合はTransportationExpenseBotDBForLocalTest
		"port" => "5432",										//DBのポート番号
		"user" => "Upload",										//バッチを用いて作成した場合はUpload
		"pass" => "Upload"										//DB作成時のパスワード
	);

	$DEF = function($defName){return $defName;};

	function DEBUG_LOG(string $file ,string $func ,string $line ,string $str ,$ary = NULL){
		if( DEBUG_LOG_OUT ){
			if( $ary == NULL ){
				$printStr = $file."::".$func."()::".$line."::".$str."\n";
			}else{
				$printStr = $file."::".$func."()::".$line."::".$str."\n".print_r($ary,TRUE)."\n";
			}
			if(LOG_OUTPUT_HEROKU){
				file_put_contents("php://stdout", $printStr."\n");
			}else{
				echo $printStr;
			}
		}
	}

	//PHPでgetallheaders()が動かない時用の関数
	if ( !function_exists('getallheaders') ) {
		function getallheaders() {
			$headers = array();
			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"_SERVER=",$_SERVER);
			foreach ($_SERVER as $name => $value) {
				if( substr($name, 0, 5) == 'HTTP_'){
					$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
				}
			}
			return $headers;
		}
	}

	//$baseText中に存在する$chgFromTextを$chgToTextに置き換える(正規表現)
	function replaceText(string &$baseText, string $chgFromText, string $chgToText){
		$patern = "/".$chgFromText."/";
		$baseText = preg_replace($patern,$chgToText,$baseText);
	}

	//$baseTextを$delimiterで分割、配列にする
	function delimitText(string &$baseText, string $delimiter){
		$baseText = explode($delimiter,$baseText);
	}

	//ビットフラグオン
	function bitFlagOn(&$option, $bitFlagValue){
		$option |= $bitFlagValue;
	}

	//ビットフラグオフ
	function bitFlagOff(&$option, $bitFlagValue){
		$option &= ~$bitFlagValue;
	}

	//ビットフラグ反転（指定箇所）
	function bitFlagXOR(&$option, $bitFlagValue){
		$option ^= $bitFlagValue;
	}

	//ビットフラグ状態確認
	//return:true=(対象ビット=1);false=(対象ビット=0);
	function getBitFlagState($option, $bitFlagValue){
		if( $option & $bitFlagValue){ return true;};
		return false;
	}

	function right($str,$n){
		//文字コードUTF-8で、right関数。$strの右から$n文字取得
		return mb_substr($str,($n)*(-1),$n,"UTF-8");
	}

	function left($str,$n){
		//文字コードUTF-8で、left関数。$strの左から$n文字取得
		return mb_substr($str,0,$n,"UTF-8");
	}
<?php
    define("DEBUG_LOG_OUT",true);//ログ出力のON/OFF
    define("S_TOKEN_TEST",false);//ServerToken取得テストを実行する場合はtrue
    define("RCV_TEST",true);//受信テストする場合はtrue
    define("RCV_TEST_DATA",false);//ローカルで受信テストする場合はtrueに設定.Herokuでテストする場合はfalse
    
    $RCV_DATA = Array(//ローカルで受信テストする場合はここを変更（受信データを設定できます）
        "type" => "message",
        "source" => Array(
            "accountId" => "admin@example.com",
            "roomId" => "12345",
            
        ),
        "createdTime" => "1470902041851",
        "content" => Array(
            "type" => "text",
            "text" => "hellow",
            
        )
    );
    
    
    
    
    
	$DEF = function($defName){return $defName;};

	function DEBUG_LOG(string $file, string $func, string $line, string $str,$ary = NULL){
	    if(DEBUG_LOG_OUT){
	        if($ary == NULL){
	            echo $file."::".$func."()::".$line."::".$str."\n";
	        }else{
	            echo $file."::".$func."()::".$line."::".$str."\n";
	           print_r($ary);
	           echo "\n";
	        }
	    }
	}
	
	//PHPでgetallheaders()が動かない時用の関数
	if (!function_exists('getallheaders')) {
	    function getallheaders() {
	        $headers = array();
	        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"_SERVER=",$_SERVER);
	        foreach ($_SERVER as $name => $value) {
	            if (substr($name, 0, 5) == 'HTTP_') {
	                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
	            }
	        }
	        return $headers;
	    }
	}

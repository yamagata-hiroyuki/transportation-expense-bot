<?php
    define("DEBUG_LOG_OUT",true);//ログ出力のON/OFF
    define("S_TOKEN_TEST",false);//ServerToken取得テストを実行する場合はtrue
    define("RCV_TEST",true);//受信テストする場合はtrue
    define("RCV_TEST_DATA",false);//ローカルで受信テストする場合はtrueに設定.Herokuでテストする場合はfalse
    define("DB_TEST",false);//DBテストする場合はtrue
    define("LOG_OUTPUT_HEROKU",true);//Herokuでログ出力する場合はtrue,falseの時はローカルコンソールにログ出力
    define("MENU_TEST",false);//メインメニュー表示をテストする場合はTrue
    
    $RCV_DATA = Array(//ローカルで受信テストする場合はここを変更（受信データを設定できます）
        "type" => "message",
        "source" => Array(
            "accountId" => "admin@example.com",
            "roomId" => "12345",
            
        ),
        "createdTime" => "1470902041851",
        "content" => Array(
            "type" => "text",
            "text" => "住道→梅田 1/30(土) 11:18 - (11:44) 26分　乗換1回　220円 -------------------- 切符利用時の運賃です。 [ 1/30] 11:18発　住道 　ＪＲ東西線・学研都市線区間快速(西明石行) 　　9分 　　運賃：220円 11:27着　京橋 　▼3分 11:30発　京橋 　大阪環状線大阪方面関空快速≪日根野で切り離し注意≫(関西空港行) 　　7分 11:37着　大阪 　▼ (11:37)発　大阪 　徒歩 　　7分 (11:44)着　梅田 乗換案内 https://tiny.jorudan.co.jp/kvj8cN",
            //"text" => "住道→姫路 1/30(土) 18:12 - 19:50 1時間38分　乗換1回　1,980円 -------------------- 切符利用時の運賃です。 [ 1/30] 18:12発　住道 　ＪＲ東西線・学研都市線快速(篠山口行) 　　29分 　　運賃：1,980円 18:41着　尼崎 　▼10分 18:51発　尼崎　1番線 　ＪＲ神戸線新快速(播州赤穂行) 　　59分 19:50着　姫路 乗換案内 https://tiny.jorudan.co.jp/kvtjBE"
            //"text" => "住道→京橋 1/30(土) 18:16 - 21:53 3時間37分　乗換4回　15,108円 -------------------- ICカード利用時の運賃です。 [ 1/30] 18:16発　住道 　ＪＲ東西線・学研都市線(西明石行) 　　8分 　　運賃：9,130円 18:24着　放出 　▼4分 18:28発　放出 　おおさか東線(新大阪行) 　　16分 18:44着　新大阪 　▼25分 19:09発　新大阪　26番線 　のぞみ50号(N700系)(東京行) 　　2時間19分 　　指定席：5,810円 21:28着　品川 　▼10分 21:38発　品川　13番線 　横須賀線(成田行) 　　5分 21:43着　新橋 　▼7分 21:50発　新橋　2番線 　東京メトロ銀座線(浅草行) 　　3分 　　運賃：168円 21:53着　京橋 乗換案内 https://tiny.jorudan.co.jp/kvtvAh"
            "text" => "熊本→京橋 1/30(土) 6:01 - 12:32 6時間31分　乗換3回　27,798円 -------------------- ICカード利用時の運賃です。 [ 1/31] 6:01発　熊本　12番線 [当駅始発] 　さくら540号(N700系)(新大阪行) 　　49分 　　運賃：15,260円　指定席：12,370円 6:50着　博多 　▼25分 7:15発　博多　12番線 [当駅始発] 　のぞみ6号(N700系)(東京行) 　　4時間53分 　　指定席 12:08着　品川 　▼8分 12:16発　品川　13番線 　横須賀線(千葉行) 　　5分 12:21着　新橋 　▼8分 12:29発　新橋　2番線 　東京メトロ銀座線(浅草行) 　　3分 　　運賃：168円 12:32着　京橋 乗換案内 https://tiny.jorudan.co.jp/kw35cK"
        )
    );
    
    
    
    
    
	$DEF = function($defName){return $defName;};

	function DEBUG_LOG(string $file, string $func, string $line, string $str,$ary = NULL){
	    if(DEBUG_LOG_OUT){
	        if($ary == NULL){
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
	
	
	//$baseText中に存在する$chgFromTextを$chgToTextに置き換える(正規表現)
	function replaceText(string &$baseText, string $chgFromText, string $chgToText){
	    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"baseText=".$baseText);
	    $patern = "/".$chgFromText."/";
	    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"patern=".$patern);
	    $baseText = preg_replace($patern,$chgToText,$baseText);
	    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"replaced baseText=".$baseText);
	}
    
	//$baseTextを$delimiterで分割、配列にする
	function delimitText(string &$baseText, string $delimiter){
	    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"baseText=".$baseText);
	    $baseText = explode($delimiter,$baseText);
	    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"delimited baseText=",$baseText);
	}
<?php
require_once 'LineWorks/LineWorksCfg.php';
require_once 'Common/Lamdas.php';

//httpまたはhttpsでメッセージを送信する
//kind:"POST","GET","PUT","DELETE"のいずれか
//url:送信先URL
//param:JSON用にエンコードされる前のデータを指定
//return:成功時:応答JSON 失敗時 false
function SendRequest(string $reqKind, string $url, Array $header, Array $param){
    $ret = false;
//     $header = [
//         'Content-Type' => HTTP_H_CONTENT_TYPE,
//         'consumerKey' => CONSUMER_KEY,
//         'Authorization' => HTTP_H_AUTH
//     ];
//     DEBUG_LOG("def HTTP_H_CONTENT_TYPE = {$GLOBALS['DEF'](HTTP_H_CONTENT_TYPE)}\n");
//     DEBUG_LOG("def CONSUMER_KEY = {$GLOBALS['DEF'](CONSUMER_KEY)}\n");
//     DEBUG_LOG("def HTTP_H_AUTH = {$GLOBALS['DEF'](HTTP_H_AUTH)}\n");
    
    DEBUG_LOG(basename(__FILE__).":".__FUNCTION__."[".__LINE__."]"."reqKind = ".$reqKind);
    DEBUG_LOG(basename(__FILE__).":".__FUNCTION__."[".__LINE__."]"."url = ",$url);
    DEBUG_LOG(basename(__FILE__).":".__FUNCTION__."[".__LINE__."]"."header = ",$header);
    DEBUG_LOG(basename(__FILE__).":".__FUNCTION__."[".__LINE__."]"."param = ",$param);
    
    
    $jsonParam = $param;
//     $jsonParam = json_encode($param);
//     if($jsonParam == false){
//         //JSON形式へのエンコードに失敗
//         DEBUG_LOG(basename(__FILE__).":".__FUNCTION__."[".__LINE__."]"."Fail to encode to json type.");
//         return false;
//     }
    
    //cURL セッションを初期化
    $client = curl_init($url);
    
    //cURL 転送用オプションを設定
    curl_setopt($client,CURLOPT_HTTPHEADER, $header);//ヘッダー情報を設定
    curl_setopt($client,CURLOPT_POSTFIELDS, $jsonParam);//送信JSONデータを設定
    curl_setopt($client,CURLOPT_CUSTOMREQUEST, $reqKind);//要求タイプを設定
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    DEBUG_LOG("Done cUrl setopt()");
    
    //cURL セッションを実行
    $ret = curl_exec($client);
    DEBUG_LOG("");//curl_exec実行後応答が改行無しで表示されるため改行を追加
    DEBUG_LOG("Done cUrl curl_exec()\n");
    
    //エラーが発生したかを調べる
    if(curl_errno($client) === false )
    {
        DEBUG_LOG(basename(__FILE__).":".__FUNCTION__."[".__LINE__."]".curl_errno($client));
        $ret = false;
    }
    DEBUG_LOG("Done cUrl curl_errno()");
    
    //cURL セッションを閉じる
    curl_close($client);
    DEBUG_LOG("Done cUrl curl_close()");
    
    return $ret;
}

    
    
    
    
?>
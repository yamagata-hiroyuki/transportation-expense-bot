<?php
require_once 'LineWorks/LineWorksCfg.php';
require_once 'Common/Lamdas.php';

//httpまたはhttpsでメッセージを送信する
//kind:"POST","GET","PUT","DELETE"のいずれか
//url:送信先URL
//param:JSON用にエンコードされる前のデータを指定
//return:成功時:応答JSON 失敗時 false
function SendRequest(string $reqKind, string $url, Array $header, $param){
    $ret = false;
//     $header = [
//         'Content-Type' => HTTP_H_CONTENT_TYPE,
//         'consumerKey' => CONSUMER_KEY,
//         'Authorization' => HTTP_H_AUTH
//     ];
//     DEBUG_LOG("def HTTP_H_CONTENT_TYPE = {$GLOBALS['DEF'](HTTP_H_CONTENT_TYPE)}\n");
//     DEBUG_LOG("def CONSUMER_KEY = {$GLOBALS['DEF'](CONSUMER_KEY)}\n");
//     DEBUG_LOG("def HTTP_H_AUTH = {$GLOBALS['DEF'](HTTP_H_AUTH)}\n");
    
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqKind = ".$reqKind);
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"url = ".$url);
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"header = ",$header);
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"param = ",$param);
    
    
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
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Done cUrl setopt()");
//     //cURL送信情報表示
//     $ret = curl_getinfo($client);
//     DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"HTTP Req Info = ",$ret);
    
    //cURL セッションを実行
    $ret = curl_exec($client);
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Done cUrl curl_exec()\n");
    
    //エラーが発生したかを調べる
    if(curl_errno($client) === false )
    {
        //TODO 戻り値は文字列に直す必要あり
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,curl_errno($client));
        $ret = false;
    }
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Done cUrl curl_errno()");
    
    //cURL セッションを閉じる
    curl_close($client);
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Done cUrl curl_close()");
    
    return $ret;
}

    
    
    
    
?>
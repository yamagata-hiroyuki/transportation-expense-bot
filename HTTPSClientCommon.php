<?php
require_once 'LineWorksCfg.php';
require_once 'Lamdas.php';

//httpまたはhttpsでメッセージを送信する
//kind:"POST","GET","PUT","DELETE"のいずれか
//url:送信先URL
//param:JSON用にエンコードされる前のデータを指定
//return:boolean(成功時:true)
function SendRequest(string $reqKind ,string $url ,Array $param ){
    $ret = true;
    $header = [
        'Content-Type' => HTTP_H_CONTENT_TYPE,
        'consumerKey' => CONSUMER_KEY,
        'Authorization' => HTTP_H_AUTH
    ];
    DEBUG_LOG("def HTTP_H_CONTENT_TYPE = {$GLOBALS['DEF'](HTTP_H_CONTENT_TYPE)}\n");
    DEBUG_LOG("def CONSUMER_KEY = {$GLOBALS['DEF'](CONSUMER_KEY)}\n");
    DEBUG_LOG("def HTTP_H_AUTH = {$GLOBALS['DEF'](HTTP_H_AUTH)}\n");
    
    $jsonParam = json_encode($param);
    if($jsonParam == false){return false;}//JSON形式へのエンコードに失敗
    
//     $options = [
//         CURLOPT_HTTPHEADER => $header,          //ヘッダー情報を設定
//         CURLOPT_POSTFIELDS => $jsonParam,       //送信JSONデータを設定
//         CURLOPT_CUSTOMREQUEST => $reqKind       //要求タイプを設定
//     ];
    
    //cURL セッションを初期化
    $client = curl_init($url);
    
    //cURL 転送用オプションを設定
    curl_setopt($client,CURLOPT_HTTPHEADER, $header);
    curl_setopt($client,CURLOPT_POSTFIELDS, $jsonParam);
    curl_setopt($client,CURLOPT_CUSTOMREQUEST, $reqKind);
    DEBUG_LOG("Done cUrl setopt()\n");
    
    //cURL セッションを実行
    curl_exec($client);
    DEBUG_LOG("Done cUrl curl_exec()\n");
    
    //エラーが発生したかを調べる（0の時、エラーなし）
    if(curl_errno($client) != 0 )
    {
        $ret = false;
    }
    DEBUG_LOG("Done cUrl curl_errno()\n");
    
    //cURL セッションを閉じる
    curl_close($client);
    DEBUG_LOG("Done cUrl curl_close()\n");
    
    return $ret;
}

    
    
    
    
?>
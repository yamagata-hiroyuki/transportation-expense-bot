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
    
    $jsonParam = json_encode($param);
    if($jsonParam == false){return false;}//JSON形式へのエンコードに失敗
    
    $options = [
        CURLOPT_HTTPHEADER => $header,          //ヘッダー情報を設定
        CURLOPT_POSTFIELDS => $jsonParam,       //送信JSONデータを設定
        CURLOPT_CUSTOMREQUEST => $reqKind       //要求タイプを設定
    ];
    
    //cURL セッションを初期化
    $client = curl_init($url);
    
    //cURL 転送用オプションを設定
    curl_setopt($client, $options);
    
    //cURL セッションを実行
    curl_exec($client);
    
    //エラーが発生したかを調べる（0の時、エラーなし）
    if(curl_errno(client) != 0 ){$ret = false;};
    
    //cURL セッションを閉じる
    curl_close($client);
    
    return $ret;
}

    
    
    
    
?>
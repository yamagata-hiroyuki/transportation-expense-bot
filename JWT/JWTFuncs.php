<?php
use JWT\lib\JWT;

require_once 'JWT/JWTConfig.php';
require_once 'LineWorks/LineWorksCfg.php';
require_once 'Common/Lamdas.php';
require_once 'JWT/lib/JWT.php';
require_once 'JWT/JWTJsonStructs.php';

//秘密鍵の全内容を取得する
//return:string
$_private_key = file_get_contents(JWT_P_KEY_PATH,FILE_USE_INCLUDE_PATH) ;//秘密鍵全内容
function GetJWTPrivateKey(){
    global $_private_key;
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"privateKey = ".$_private_key);
    return $_private_key;
}

//JWTの生成を行う
//return:string?
// function CreateJWT(){
//     $currentTime = time();
//     $expireTime = $currentTime + JWT_EXP_TIME;
//     $ret = "";
    
//     {//Header作成
//         $header = [
//             'alg' => JWT_ALGORISM,
//             'typ' => JWT_TYPE
//         ];
//         //URLSafeな形で置換
//         $header = str_replace(array('+', '/', '='), array('-', '_', ''), $header);
//     }
    
//     {//body作成
//         $body = [
//             'iss' => JWT_SERVER_ID,
//             'iat' => $currentTime,
//             'exp' => $expireTime
//         ];
//         $body = str_replace(array('+', '/', '='), array('-', '_', ''), $body);
//     }
    
//     //headerとbodyを結合
//     $sha_hash = $header . "." . $body;
    
//     //電子認証（SHA256）
//     $rsa_key = GetJWTPrivateKey();
//     $encrypted = "";
//     openssl_sign($sha_hash, $encrypted, $rsa_key, OPENSSL_ALGO_SHA256);
//     $signature = base64_encode($encrypted);
//     $signature = str_replace(array('+', '/', '='), array('-', '_', ''), $signature);

    
//     //JWT生成
//     $ret = $header . "." . $body . "." . $signature;

//     return $ret;
// }

//JWTの生成を行う
//return:string（JSON形式）(暗号化されている)
function CreateJWT()
{
    $currentTime = time();
    $expireTime = $currentTime + JWT_EXP_TIME;
    
    $JWTStruct = new CreateJWTStruct();
    $JWTStruct->propaty["iss"] = JWT_SERVER_ID;
    $JWTStruct->propaty["iat"] = $currentTime;
    $JWTStruct->propaty["exp"] = $expireTime;
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"JWTStruct->protaty = ",$JWTStruct->propaty);
    
    // 秘密鍵の内容取得
    $privateKey = GetJWTPrivateKey();
    return JWT::encode($JWTStruct->propaty, $privateKey, JWT_ALGORISM);
}




?>
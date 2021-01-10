<?php
    require_once 'LineWorks/LineWorksCfg.php';
    require_once 'HTTP/HTTPSClientCommon.php';
    require_once 'LineWorks/LineWorksHTTPSReqsJsonStructs.php';
    require_once 'Common/Lamdas.php';
    require_once 'LineWorks/LineWorksHTTPSResesJsonStructs.php';
    
    define("CALLBACK_URL","https://{$GLOBALS['DEF'](APP_NAME)}.herokuapp.com/callback");						//CallBack URL(Lineworks �� heroku app)
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def CALLBACK_URL = {$GLOBALS['DEF'](CALLBACK_URL)}");
    
    //各関数用コンテンツ設定
    //BotList照会要求
    define("BOT_LIST_REQ_URL","https://apis.worksmobile.com/r/{$GLOBALS['DEF'](API_ID)}/message/v1/bot");
    define("CONT_BOT_LIST","{$GLOBALS['DEF'](HTTP_H_CONTENT_TYPE)}");
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def BOT_LIST_REQ_URL = {$GLOBALS['DEF'](BOT_LIST_REQ_URL)}");
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def CONT_BOT_LIST = {$GLOBALS['DEF'](CONT_BOT_LIST)}");
    
    //Server Token　要求
    define("SERVER_TOKEN_URL","https://auth.worksmobile.com/b/{$GLOBALS['DEF'](API_ID)}/server/token");
    define("CONT_SERVER_TOKEN","application/x-www-form-urlencoded; charset=UTF-8");
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def SERVER_TOKEN_URL = {$GLOBALS['DEF'](SERVER_TOKEN_URL)}");
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def CONT_SERVER_TOKEN = {$GLOBALS['DEF'](CONT_SERVER_TOKEN)}");
    
    class LineWorksReqs{
        function __construct()
        {
            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Done BotListReq __constractor()");
        }
        
        function __destruct()
        {
            
        }
        
        //BotList照会要求
        //Direction
        //REQ:BOT -> LineWorks
        //RES:LineWorks -> BOT
        function SendBotListReq(String $serverToken = "")
        {
            $reqStruct = new BotListReqStruct();
            $propaty = null;
            $header = null;
            $ret = new BotListResStruct();
            $result = "";
//             $reqHeaderArray = "";
            
            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"start SendBotListReq");
            //ヘッダー設定
            {
                $reqStruct->header["Content-Type"] = HTTP_H_CONTENT_TYPE;
                $reqStruct->header["charset"] = HTTP_H_CHARSET;
                $reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
                $reqStruct->header["Authorization"] = "Authorization: "."Bearer ${serverToken}";
//                 //連想配列を通常の配列にする(1階層分のみ)
//                 $reqHeaderArray = array_values($reqStruct->header);
//                 DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Header Array = ",$reqHeaderArray);
                $header = $reqStruct->header;
            }
            
            //プロパティー設定
            {
                //Do Nothing
                
                //プロパティーのJSONエンコード
                $propaty = json_encode($reqStruct->propaty);
            }
            
            //リクエストの送信
            $result = SendRequest("GET", BOT_LIST_REQ_URL, $header, $propaty);
            if($result != false){
                //応答が得られた場合
                //応答JSONを連想配列にデコード
                $ret = json_decode($result,true);
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
            }else{
                //リクエストが出来なかった場合
                //TODO 何かしらのエラー処理
            }
            
            return $ret;
        }
        
        //Server Token 要求
        //Direction
        //REQ:BOT -> LineWorks
        //RES:LineWorks -> BOT
        function ServerTokenReq(String $jwtToken = "")
        {
            $reqStruct = new ServerTokenReqStruct();
            $propaty = null;
            $header = null;
            $ret = new ServerTokenRes();
            $result = "";
            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"start ServerTokenReq");
            //ヘッダー設定
            {
                $reqStruct->header["Content-Type"] = CONT_SERVER_TOKEN;
                
                $header = $reqStruct->header;
            }
            //プロパティー設定
            {
                $reqStruct->propaty["grant_type"] = urlencode("urn:ietf:params:oauth:grant-type:jwt-bearer");
                $reqStruct->propaty["assertion"] = $jwtToken;
                
                //プロパティーのJSONエンコード
                //ヘッダーにてJSONタイプではないと宣言しているためJSONエンコードを無効化する
                //$propaty = json_encode($reqStruct->propaty);
                $propaty = $reqStruct->propaty;
            }
            
            $result = SendRequest("POST", SERVER_TOKEN_URL, $header, $propaty);
            if($result != false){
                //JSONを連想配列にデコード
                $ret = json_decode($result,true);
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
            }
            $ret = $ret["access_token"];
            
            return $ret;
        }
    }
    
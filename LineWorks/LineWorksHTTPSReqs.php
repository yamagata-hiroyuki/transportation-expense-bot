<?php
    require_once 'LineWorks/LineWorksCfg.php';
    require_once 'HTTP/HTTPSClientCommon.php';
    require_once 'LineWorks/LineWorksHTTPSReqsJsonStructs.php';
    require_once 'Common/Lamdas.php';
    require_once 'LineWorks/LineWorksHTTPSResesJsonStructs.php';
    
    define("CALLBACK_URL","https://{$GLOBALS['DEF'](APP_NAME)}.herokuapp.com/callback");						//CallBack URL(Lineworks �� heroku app)
    DEBUG_LOG("def CALLBACK_URL = {$GLOBALS['DEF'](CALLBACK_URL)}");
    
    //各関数用コンテンツ設定
    //BotList照会要求
    define("BOT_LIST_REQ_URL","https://apis.worksmobile.com/r/{$GLOBALS['DEF'](API_ID)}/message/v1/bot");
    define("CONT_BOT_LIST","{$GLOBALS['DEF'](HTTP_H_CONTENT_TYPE)}");
    DEBUG_LOG("def BOT_LIST_REQ_URL = {$GLOBALS['DEF'](BOT_LIST_REQ_URL)}");
    DEBUG_LOG("def CONT_BOT_LIST = {$GLOBALS['DEF'](CONT_BOT_LIST)}");
    
    //Server Token　要求
    define("SERVER_TOKEN_URL","https://auth.worksmobile.com/b/{$GLOBALS['DEF'](API_ID)}/server/token");
    define("CONT_SERVER_TOKEN","application/x-www-form-urlencoded; charset=UTF-8");
    DEBUG_LOG("def SERVER_TOKEN_URL = {$GLOBALS['DEF'](SERVER_TOKEN_URL)}");
    DEBUG_LOG("def CONT_SERVER_TOKEN = {$GLOBALS['DEF'](CONT_SERVER_TOKEN)}");
    
    class LineWorksReqs{
        function __construct()
        {
            DEBUG_LOG("Done BotListReq __constractor()");
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
            $ret = new BotListResStruct();
            $result = "";
            
            DEBUG_LOG("start SendBotListReq");
            //ヘッダー設定
            $reqStruct->header["Content-Type"] = HTTP_H_CONTENT_TYPE;
            $reqStruct->header["charset"] = HTTP_H_CHARSET;
            $reqStruct->header["consumerKey"] = CONSUMER_KEY;
            $reqStruct->header["Authorization"] = "Bearer ${serverToken}";
            
            //プロパティー設定
            //Do Nothing
            
            $result = SendRequest("GET", BOT_LIST_REQ_URL, $reqStruct->header, $reqStruct->propaty);
            if($result != false){
                //JSONを連想配列にデコード
                $ret = json_decode($result,true);
            }
            
            DEBUG_LOG(basename(__FILE__).__FUNCTION__.__LINE__."Res Json = ",$ret);
            return $ret;
        }
        
        //Server Token 要求
        //Direction
        //REQ:BOT -> LineWorks
        //RES:LineWorks -> BOT
        function ServerTokenReq(String $jwtToken = "")
        {
            $reqStruct = new ServerTokenReqStruct();
            $ret = new ServerTokenRes();
            $result = "";
            DEBUG_LOG("start ServerTokenReq");
            //ヘッダー設定
            $reqStruct->header["Content-Type"] = CONT_SERVER_TOKEN;
            
            //プロパティー設定
            $reqStruct->propaty["grant_type"] = urlencode("urn:ietf:params:oauth:grant-type:jwt-bearer");
            $reqStruct->propaty["assertion"] = $jwtToken;
            
            $result = SendRequest("POST", SERVER_TOKEN_URL, $reqStruct->header, $reqStruct->propaty);
            if($result != false){
                //JSONを連想配列にデコード
                $ret = json_decode($result,true);
                DEBUG_LOG(basename(__FILE__).__FUNCTION__.__LINE__."Res Json = ",$ret);
            }
            $ret = $ret["access_token"];
            
            return $ret;
        }
    }
?>
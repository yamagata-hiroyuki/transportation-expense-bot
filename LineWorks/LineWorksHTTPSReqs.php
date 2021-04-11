<?php
    require_once 'LineWorks/LineWorksCfg.php';
    require_once 'HTTP/HTTPSClientCommon.php';
    require_once 'LineWorks/LineWorksHTTPSReqsJsonStructs.php';
    require_once 'Common/Lamdas.php';
    require_once 'LineWorks/LineWorksHTTPSResiesJsonStructs.php';
    require_once 'CallbackAnalyser/MessageAnalyser/MessageAnalyser.php';

    define("CALLBACK_URL","https://{$GLOBALS['DEF'](APP_NAME)}.herokuapp.com/callback");						//CallBack URL(Lineworks �� heroku app)
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def CALLBACK_URL = {$GLOBALS['DEF'](CALLBACK_URL)}");

    //各関数用コンテンツ設定
    //BotList照会要求
    define("BOT_LIST_REQ_URL","https://apis.worksmobile.com/r/".API_ID."/message/v1/bot");
    define("CONT_BOT_LIST","{$GLOBALS['DEF'](HTTP_H_CONTENT_TYPE)}");
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def BOT_LIST_REQ_URL = {$GLOBALS['DEF'](BOT_LIST_REQ_URL)}");
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def CONT_BOT_LIST = {$GLOBALS['DEF'](CONT_BOT_LIST)}");

    //Server Token　要求
    define("SERVER_TOKEN_URL","https://auth.worksmobile.com/b/{$GLOBALS['DEF'](API_ID)}/server/token");
    define("CONT_SERVER_TOKEN","application/x-www-form-urlencoded; charset=UTF-8");
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def SERVER_TOKEN_URL = {$GLOBALS['DEF'](SERVER_TOKEN_URL)}");
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def CONT_SERVER_TOKEN = {$GLOBALS['DEF'](CONT_SERVER_TOKEN)}");

    //メインメニュー表示
    define("DISP_BUTTON_TEMP_URL","https://apis.worksmobile.com/r/".API_ID."/message/v1/bot/".BOT_NO."/message/push");
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def DISP_BUTTON_TEMP_URL = ".DISP_BUTTON_TEMP_URL);

    //メッセージ送信要求
    define("SEND_MESSAGE_URL","https://apis.worksmobile.com/r/".API_ID."/message/v1/bot/".BOT_NO."/message/push");
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"def SEND_MESSAGE_URL = ".SEND_MESSAGE_URL);

    class LineWorksReqs{
        function __construct()
        {
            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Done BotListReq __constractor()");
        }

        function __destruct()
        {

        }

        //Server Token 要求
        //Direction
        //REQ:BOT -> LineWorks
        //RES:LineWorks -> BOT
        function ServerTokenReq(String $jwtToken = ""):Array
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
                $ret->propaty = json_decode($result,true);
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret->propaty["access_token"]);
            }

            return $ret->propaty;
        }

        //メインメニュー表示
        //Direction
        //REQ:BOT -> LineWorks
        //RES:-
        function DispMainMenuReq(string $accountId = "",string $serverToken = "")
        {
            $reqStruct = new DispMainMenuReqStruct();
            $propaty = null;
            $header = null;
            $ret = false;

            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"start DispMainMenuReq");
            //ヘッダー設定
            {
                $reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
                $reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
                $reqStruct->header["Authorization"] = "Authorization: "."Bearer ${serverToken}";
                $header = $reqStruct->header;
            }

            //プロパティー設定
            {
                $reqStruct->propaty["accountId"] = $accountId;

                $tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
                $tmpMessage_ButtonTemplateStruct->propaty["contentText"] =
                "機能メニュー\n".
                "----------------------------------------\n".
                "登録済み経路一覧\n".
                "[1]01/16 TEST Train ST_A ～ ST_B 復 \820\n".
                "                              ----------\n".
                "                                    \820\n".
                "----------------------------------------\n";

                $tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
                $tmpAction_PostbackStructArray[0]->propaty["label"] = MA_MessageTextList::ONE_DELETE;
                $tmpAction_PostbackStructArray[0]->propaty["text"] = MA_MessageTextList::ONE_DELETE;
                $tmpAction_PostbackStructArray[0]->propaty["postback"] = MA_MessagePostbackList::ONE_DELETE;
                $tmpAction_PostbackStructArray[1]->propaty["label"] = MA_MessageTextList::PETITION;
                $tmpAction_PostbackStructArray[1]->propaty["text"] = MA_MessageTextList::PETITION;
                $tmpAction_PostbackStructArray[1]->propaty["postback"] = MA_MessagePostbackList::PETITION;
                $tmpAction_PostbackStructArray[2]->propaty["label"] = "キャンセル";
                $tmpAction_PostbackStructArray[2]->propaty["text"] = "キャンセル";
                $tmpAction_PostbackStructArray[2]->propaty["postback"] = MA_MessagePostbackList::CANCEL;
                //DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpAction_PostbackStructArray = ",$tmpAction_PostbackStructArray);
                //
                $tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
                                                                              $tmpAction_PostbackStructArray[1]->propaty,
                                                                              $tmpAction_PostbackStructArray[2]->propaty);
                //DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpMessage_ButtonTemplateStruct->propaty[\"actions\"] = ",$tmpMessage_ButtonTemplateStruct->propaty["actions"]);
                $reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
                //プロパティーのJSONエンコード
                $propaty = json_encode($reqStruct->propaty);
            }

            //リクエストの送信
            $result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
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

        //メッセージ送信
        //Direction
        //REQ:BOT -> LineWorks
        //RES:-
        function SendMessageReq(string $accountId = "",string $serverToken = "", string $msgText = ""):bool
        {
            $reqStruct = new SendMessageReqStruct();
            $propaty = null;
            $header = null;
            $ret = false;

            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"start DispMainMenuReq");
            //ヘッダー設定
            {
                $reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
                $reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
                $reqStruct->header["Authorization"] = "Authorization: "."Bearer ${serverToken}";
                $header = $reqStruct->header;
            }

            //プロパティー設定
            {
                $reqStruct->propaty["accountId"] = $accountId;

                $tmpMessage_TextStruct = new Message_TextStruct();

                $tmpMessage_TextStruct->propaty["text"] = $msgText;

                $reqStruct->propaty["content"] = $tmpMessage_TextStruct->propaty;

                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
                //プロパティーのJSONエンコード
                $propaty = json_encode($reqStruct->propaty);
            }

            //リクエストの送信
            $result = SendRequest("POST", SEND_MESSAGE_URL, $header, $propaty);
            if($result != false){
                //応答が得られた場合
                //応答JSONを連想配列にデコード
                $ret = json_decode($result,true);
                if( NULL == $ret ){$ret = false;}
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
            }else{
                //リクエストが出来なかった場合
                //TODO 何かしらのエラー処理
            }

            return $ret;
        }
    }

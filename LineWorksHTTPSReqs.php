<?php
    require_once 'LineWorksCfg.php';
    require_once 'HTTPSClientCommon.php';
    
    define("CALLBACK_URL","https://{$GLOBALS['DEF'](APP_NAME)}.herokuapp.com/callback");						//CallBack URL(Lineworks �� heroku app)

    DEBUG_LOG("def CALLBACK_URL = {$GLOBALS['DEF'](CALLBACK_URL)}\n");
    
    class LineWorksReqs{
        public $BotListReq;
        
        function __construct(){
            $this->BotListReq = new BotListReqStruct();
            
            DEBUG_LOG("Done BotListReq __constractor()\n");
            
        }
        
        function __destruct(){}
        
        
    }
    
    //トーク Bot リスト照会 要求
    define("BOT_LIST_REQ_URL","https://apis.worksmobile.com/r/{$GLOBALS['DEF'](API_ID)}/message/v1/bot");
    DEBUG_LOG("def BOT_LIST_REQ_URL = {$GLOBALS['DEF'](BOT_LIST_REQ_URL)}\n");
    class BotListReqStruct{
        public $propaty = Array();
        

        function SendBotListReq(Array $propaty){
            DEBUG_LOG("start SendBotListReq\n");
            SendRequest("GET", BOT_LIST_REQ_URL, $propaty);
        }
    }

?>
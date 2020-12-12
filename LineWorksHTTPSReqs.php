<?php
    require_once 'LineWorksCfg.php';
    require_once 'HTTPSClientCommon.php';
    
    define("CALLBACK_URL","https://{$GLOBALS['DEF'](APP_NAME)}.herokuapp.com/callback");						//CallBack URL(Lineworks �� heroku app)

    class LineWorksReqs{
        public $BotListReq;
        
        private function __construct(){
            $this->BotListReq = new BotListReqStruct();
            
            
            
        }
        
        private function __destruct(){}
        
        
    }
    
    //トーク Bot リスト照会 要求
    define("BOT_LIST_REQ_URL","https://apis.worksmobile.com/r/{$GLOBALS['DEF'](API_ID)}/message/v1/bot");
    class BotListReqStruct{
        public $propaty = Array();
        
    }
    function SendBotListReq(Array $propaty){
        SendRequest("GET", BOT_LIST_REQ_URL, $propaty);
    }


?>
<?php
require_once 'LineWorks/LineWorksHTTPSResesJsonStructs.php';
require_once 'LineWorks/LineWorksCfg.php';
require_once 'LineWorks/LineWorksHTTPSResesStateEvents.php';


class LineWorksReses{
    function __construct()
    {
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Done LineWorksReses __constractor()");
    }
    
    function __destruct()
    {
        
    }
    
    //コールバックイベント受信処理
    //Direction
    //REQ:LineWorks -> BOT(Server)
    //RES:BOT(Server) -> LineWorks
    //return:bool:true => 解析成功 false => 解析失敗
    function RecvCallBackEvent():bool
    {
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvCallBackEvent Func start");
        $ret = false;
        $retRecvData = new CallBackStruct();
        //改竄チェック
        $ret = $this->AnaryseCallBackData();
        if($ret == false)
        {
            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"CallBackData is not safety.");
            return $ret;
        }
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"CallBackData is safety.");
        
        //データ格納
        $ret = $this->RecvDataToArray($retRecvData);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"recvData =",(array)$retRecvData);
        //ユーザー名取得
        $tmpUser = $retRecvData->baseInfo["source"]["accountId"];
        //イベント取得
        $tmpEvent = stringToEnum($retRecvData->baseInfo["type"]);
        //TODO DBよりユーザーのステータスを取得
        $userState = Enum_CallBack_userState::MAIN_MENU;
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpUser=".$tmpUser." tmpEvent=".$tmpEvent." userState=".$userState);
        
        //ステータスより関数を呼び出し
        $tmpSEClass = new StateEvent();
        $callTargetFunc = $tmpSEClass->stateEventTable[$userState][$tmpEvent];
        $ret = $tmpSEClass->StateEventCaller($callTargetFunc,$retRecvData);
        return $ret;
    }
    
    //コールバックイベント受信データ 改竄チェック
    //return:bool:true => 改竄なし false => 改竄あり
    private function AnaryseCallBackData():bool
    {
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"AnaryseCallBackData Func start");
        $tmpHeader = new CallBackHeaderInfoStruct();
        
        $tmpHeader->header = getallheaders();
        $tmpBody = file_get_contents('php://input');
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpHeader->header = ",$tmpHeader->header);
        
        //API IDを秘密鍵として送られてきたbodyをHMAC-SHA256 アルゴリズムでエンコード
        $encode = hash_hmac('sha256', $tmpBody, API_ID, true);
        
        //HMAC-SHA256 アルゴリズムでエンコードした結果を BASE64 エンコード
        $signature = base64_encode($encode);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"signature is = ".$signature);
        
        //X-WORKS-Signature のヘッダー値と比較
        if($signature != $tmpHeader->header["X-WORKS-Signature"])
        {
            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"signature is not match!.");
            //内部テスト用にコメントアウト(実記ではONにすること)
            //return false;
        }
        return true;
    }
    
    //コールバックイベント受信データ 構造体へ格納するための関数を呼び出す
    //output:$retRecvData 受信したデータ（配列）
    //return:なし
    private function RecvDataToArray(CallBackStruct &$retRecvData)
    {
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvDataToArray Func start");
        $tmpHeader = new CallBackHeaderInfoStruct();
        $tmpBody = new CallBackBaseInfoStruct();
        $tmpHeader->header = getallheaders();
        $tmpBody->baseInfo = file_get_contents('php://input');
        
        //テスト用データ
        if(RCV_TEST_DATA){
            $tmpBody->baseInfo = $GLOBALS[RCV_DATA];
        }else{
            $tmpBody->baseInfo = json_decode($tmpBody->baseInfo,true);
        }
        
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpHeader->header = ",$tmpHeader->header);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpBody->baseInfo = ",$tmpBody->baseInfo);
        //typeを文字列からEnumへ変換
        $tmpType = stringToEnum($tmpBody->baseInfo["type"]);
        
        //受信データを解析
        switch ($tmpType)
        {
            case Enum_CallBack_Type::MESSAGE:
                //受信データを構造体へ格納
                $this->RecvDataToArrayMESSAGE($retRecvData);
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvData to Array Type = MESSAGE.");
                break;
                
            case Enum_CallBack_Type::JOIN:
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Not supported type type that is JOIN.");
                break;
                
            case Enum_CallBack_Type::LEAVE:
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Not supported type type that is LEAVE.");
                break;
                
            case Enum_CallBack_Type::JOINED:
                //受信データを構造体へ格納
                $this->RecvDataToArrayJOINED($retRecvData);
                break;
                
            case Enum_CallBack_Type::LEFT:
                //受信データを構造体へ格納
                $this->RecvDataToArrayLEFT($retRecvData);
                break;
                
            case Enum_CallBack_Type::POST_BACK:
                //受信データを構造体へ格納
                $this->RecvDataToArrayPOST_BACK($retRecvData);
                break;
            default:
                //有り得ない
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Unexpected type.tmpBody->baseInfo[\"type\"] = ".$tmpBody->baseInfo["type"]);
        }
        
    }
    
    //コールバックイベント受信データ 構造体へ格納(MESSAGE)
    //output:$retRecvData 受信したデータ（配列）
    //return:なし
    private function RecvDataToArrayMESSAGE(CallBackStruct &$retRecvData)
    {
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvDataToArrayMESSAGE Func start");
        //生データ取得
        $tmpSorceData = file_get_contents('php://input');
        
        //テスト用データ
        if(RCV_TEST_DATA){
            $tmpSorceData = $GLOBALS[RCV_DATA];
        }else{
            $tmpSorceData = json_decode($tmpSorceData,true);
        }
        
        //ヘッダー情報取得
        $tmpHeader = new CallBackHeaderInfoStruct();
        $tmpHeader->header = getallheaders();
        
        //基本情報取得
        $tmpBaseInfo = new CallBackBaseInfoStruct();
        $tmpBaseInfo->baseInfo["type"] = $tmpSorceData["type"];
        $tmpBaseInfo->baseInfo["source"]["accountId"] = $tmpSorceData["source"]["accountId"];
        $tmpBaseInfo->baseInfo["source"]["roomId"] = $tmpSorceData["source"]["roomId"];
        $tmpBaseInfo->baseInfo["createdTime"] = $tmpSorceData["createdTime"];
        
        //typeを文字列からEnumへ変換
        $tmpType = stringToEnum($tmpSorceData["content"]["type"]);
        
        //受信データを解析
        switch ($tmpType)
        {
            case Enum_CallBack_ContentType::TEXT:
                //ボディデータ取得
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvData content Type = TEXT.");
                $tmpBody = new CallBack_MessageStruct();
                $tmpBody->propaty["content"]["type"] = $tmpSorceData["content"]["type"];
                
                $tmpBodyContent = new CallBack_Message_TextStruct();
                $tmpBodyContent->propaty["text"] = $tmpSorceData["content"]["text"];
                $tmpBodyContent->propaty["postback"] = $tmpSorceData["content"]["postback"];
                
                $tmpBody->propaty["content"] = $tmpBody->propaty["content"] + $tmpBodyContent->propaty;
                break;
                
            case Enum_CallBack_ContentType::LOCATION:
                //ボディデータ取得
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvData content Type = LOCATION.");
                $tmpBody = new CallBack_MessageStruct();
                $tmpBody->propaty["content"]["type"] = $tmpSorceData["content"]["type"];
                
                $tmpBodyContent = new CallBack_Message_LocationStruct();
                $tmpBodyContent->propaty["address"] = $tmpSorceData["content"]["address"];
                $tmpBodyContent->propaty["latitude"] = $tmpSorceData["content"]["latitude"];
                $tmpBodyContent->propaty["longitude"] = $tmpSorceData["content"]["longitude"];
                
                $tmpBody->propaty["content"] = $tmpBody->propaty["content"] + $tmpBodyContent->propaty;
                break;
                
            case Enum_CallBack_ContentType::STICKER:
                //ボディデータ取得
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvData content Type = STICKER.");
                $tmpBody = new CallBack_MessageStruct();
                $tmpBody->propaty["content"]["type"] = $tmpSorceData["content"]["type"];
                
                $tmpBodyContent = new CallBack_Message_StickerStruct();
                $tmpBodyContent->propaty["packageId"] = $tmpSorceData["content"]["packageId"];
                $tmpBodyContent->propaty["stickerId"] = $tmpSorceData["content"]["stickerId"];
                
                $tmpBody->propaty["content"] = $tmpBody->propaty["content"] + $tmpBodyContent->propaty;
                break;
                
            case Enum_CallBack_ContentType::IMAGE:
                //ボディデータ取得
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvData content Type = IMAGE.");
                $tmpBody = new CallBack_MessageStruct();
                $tmpBody->propaty["content"]["type"] = $tmpSorceData["content"]["type"];
                
                $tmpBodyContent = new CallBack_Message_ImageStruct();
                $tmpBodyContent->propaty["resourceId"] = $tmpSorceData["content"]["resourceId"];
                
                $tmpBody->propaty["content"] = $tmpBody->propaty["content"] + $tmpBodyContent->propaty;
                break;
                
            case Enum_CallBack_ContentType::FILE:
                //ボディデータ取得
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvData content Type = FILE.");
                $tmpBody = new CallBack_MessageStruct();
                $tmpBody->propaty["content"]["type"] = $tmpSorceData["content"]["type"];
                
                $tmpBodyContent = new CallBack_Message_FileStruct();
                $tmpBodyContent->propaty["resourceId"] = $tmpSorceData["content"]["resourceId"];
                
                $tmpBody->propaty["content"] = $tmpBody->propaty["content"] + $tmpBodyContent->propaty;
                break;
                
            default:
                //有り得ない
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Unexpected type.tmpSorceData[\"content\"][\"type\"] = ".$tmpSorceData["content"]["type"]);
                $tmpBodyContent = new CallBack_Message_TextStruct();
        }
        
        //取得したデータを格納
        $retRecvData->header = (array)$tmpHeader->header;
        $retRecvData->baseInfo = (array)$tmpBaseInfo->baseInfo;
        $retRecvData->propaty = (array)$tmpBody->propaty;
        
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->header = ",$retRecvData->header);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->baseInfo = ",$retRecvData->baseInfo);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->propaty = ",$retRecvData->propaty);

    }
    
    //コールバックイベント受信データ 構造体へ格納(JOINED)
    //output:$retRecvData 受信したデータ（配列）
    //return:なし
    private function RecvDataToArrayJOINED(CallBackStruct &$retRecvData)
    {
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvDataToArrayJOINED Func start");
        //生データ取得
        $tmpSorceData = file_get_contents('php://input');
        
        //テスト用データ
        if(RCV_TEST_DATA){
            $tmpSorceData = $GLOBALS[RCV_DATA];
        }else{
            $tmpSorceData = json_decode($tmpSorceData,true);
        }
        
        //ヘッダー情報取得
        $tmpHeader = new CallBackHeaderInfoStruct();
        $tmpHeader->header = getallheaders();
        
        //基本情報取得
        $tmpBaseInfo = new CallBackBaseInfoStruct();
        $tmpBaseInfo->baseInfo["type"] = $tmpSorceData["type"];
        //$tmpBaseInfo->baseInfo["source"]["accountId"] = $tmpSorceData["source"]["accountId"];//※accountIdは存在しない
        $tmpBaseInfo->baseInfo["source"]["roomId"] = $tmpSorceData["source"]["roomId"];
        $tmpBaseInfo->baseInfo["createdTime"] = $tmpSorceData["createdTime"];
        
        //ボディデータ取得
        $tmpBody = new CallBack_JoinedStruct();
        
        $tmpBody->propaty["memberList"] = $tmpSorceData["memberList"];
        
        //取得したデータを格納
        $retRecvData->header = $tmpHeader;
        $retRecvData->baseInfo = $tmpBaseInfo;
        $retRecvData->propaty = $tmpBody;
        
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->header = ",$retRecvData->header);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->baseInfo = ",$retRecvData->baseInfo);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->propaty = ",$retRecvData->propaty);
    }
    
    //コールバックイベント受信データ 構造体へ格納(LEFT)
    //output:$retRecvData 受信したデータ（配列）
    //return:なし
    private function RecvDataToArrayLEFT(CallBackStruct &$retRecvData)
    {
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvDataToArrayLEFT Func start");
        //生データ取得
        $tmpSorceData = file_get_contents('php://input');
        
        //テスト用データ
        if(RCV_TEST_DATA){
            $tmpSorceData = $GLOBALS[RCV_DATA];
        }else{
            $tmpSorceData = json_decode($tmpSorceData,true);
        }
        
        //ヘッダー情報取得
        $tmpHeader = new CallBackHeaderInfoStruct();
        $tmpHeader->header = getallheaders();
        
        //基本情報取得
        $tmpBaseInfo = new CallBackBaseInfoStruct();
        $tmpBaseInfo->baseInfo["type"] = $tmpSorceData["type"];
        //$tmpBaseInfo->baseInfo["source"]["accountId"] = $tmpSorceData["source"]["accountId"];//※accountIdは存在しない
        $tmpBaseInfo->baseInfo["source"]["roomId"] = $tmpSorceData["source"]["roomId"];
        $tmpBaseInfo->baseInfo["createdTime"] = $tmpSorceData["createdTime"];
        
        //ボディデータ取得
        $tmpBody = new CallBack_LeftStruct();
        
        $tmpBody->propaty["memberList"] = $tmpSorceData["memberList"];
        
        //取得したデータを格納
        $retRecvData->header = $tmpHeader;
        $retRecvData->baseInfo = $tmpBaseInfo;
        $retRecvData->propaty = $tmpBody;
        
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->header = ",$retRecvData->header);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->baseInfo = ",$retRecvData->baseInfo);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->propaty = ",$retRecvData->propaty);
    }
    
    //コールバックイベント受信データ 構造体へ格納(POST_BACK)
    //output:$retRecvData 受信したデータ（配列）
    //return:なし
    private function RecvDataToArrayPOST_BACK(CallBackStruct &$retRecvData)
    {
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"RecvDataToArrayPOST_BACK Func start");
        //生データ取得
        $tmpSorceData = file_get_contents('php://input');
        
        //テスト用データ
        if(RCV_TEST_DATA){
            $tmpSorceData = $GLOBALS[RCV_DATA];
        }else{
            $tmpSorceData = json_decode($tmpSorceData,true);
        }
        
        //ヘッダー情報取得
        $tmpHeader = new CallBackHeaderInfoStruct();
        $tmpHeader->header = getallheaders();
        
        //基本情報取得
        $tmpBaseInfo = new CallBackBaseInfoStruct();
        $tmpBaseInfo->baseInfo["type"] = $tmpSorceData["type"];
        $tmpBaseInfo->baseInfo["source"]["accountId"] = $tmpSorceData["source"]["accountId"];
        $tmpBaseInfo->baseInfo["source"]["roomId"] = $tmpSorceData["source"]["roomId"];
        $tmpBaseInfo->baseInfo["createdTime"] = $tmpSorceData["createdTime"];
        
        //ボディデータ取得
        $tmpBody = new CallBack_PostbackStruct();
        
        $tmpBody->propaty["data"] = $tmpSorceData["data"];
        
        //取得したデータを格納
        $retRecvData->header = $tmpHeader;
        $retRecvData->baseInfo = $tmpBaseInfo;
        $retRecvData->propaty = $tmpBody;
        
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->header = ",$retRecvData->header);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->baseInfo = ",$retRecvData->baseInfo);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retRecvData->propaty = ",$retRecvData->propaty);
    }
    

}
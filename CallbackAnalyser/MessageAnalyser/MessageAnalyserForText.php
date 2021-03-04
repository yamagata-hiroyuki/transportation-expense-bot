<?php
require_once 'LineWorks/LineWorksHTTPSResesJsonStructs.php';
require_once 'Jorudan/Jorudan_Funcs.php';
require_once 'Jorudan/Jorudan_FuncsStruct.php';
require_once 'Common/Lamdas.php';

class MA_MessageKind{
    //共通
    const APPLY                 = 0x00000001;
    const CANCEL                = 0x00000002;
    const NUMBER                = 0x00000004;    //数字列
    //メニュー
    const MENU                  = 0x00000008;    //メニュー
    const ONE_DELETE            = 0x00000010;    //一件削除
    const PETITION              = 0x00000020;     //申請
    //交通経路データ登録
    const REQUEST_TO_USER       = 0x00000040;   //ユーザー請求
    const REQUEST_TO_IN_HOUSE   = 0x00000080;//自社請求
    const ONE_WAY               = 0x00000100;       //片道
    const ROUND_TRIP            = 0x00000200;        //往復
    //個別データ削除
    //nothing
    
    //ジョルダン乗換案内
    const JORUDAN               = 0x00000400;
}

class MA_MessageTextList{
    //共通
    const APPLY = "はい";
    const CANCEL = "いいえ";
    //メニュー
    const MENU = "メニュー";
    const ONE_DELETE = "一件削除";    //一件削除
    const PETITION = "申請";     //申請
    //交通経路データ登録
    const REQUEST_TO_USER = "ユーザー請求";   //ユーザー請求
    const REQUEST_TO_IN_HOUSE = "自社請求";//自社請求
    const ONE_WAY = "片道";       //片道
    const ROUND_TRIP = "往復";        //往復
    
}

class MA_MessagePostbackList{
    //共通
    const APPLY = "postback はい";
    const CANCEL = "postback いいえ";
    //メニュー
    const ONE_DELETE = "postback 一件削除";    //一件削除
    const PETITION = "postback 申請";     //申請
    //交通経路データ登録
    const REQUEST_TO_USER = "postback ユーザー請求";   //ユーザー請求
    const REQUEST_TO_IN_HOUSE = "postback 自社請求";//自社請求
    const ONE_WAY = "postback 片道";       //片道
    const ROUND_TRIP = "postback 往復";        //往復
    
}

trait MA_ForText{
    static public function getMessageKind(CallBackStruct $recvData){
        $retValue = 0x0;
        if(self::isAPPLY($recvData))bitFlagOn($retValue, MA_MessageKind::APPLY);
        if(self::isCANCEL($recvData))bitFlagOn($retValue, MA_MessageKind::CANCEL);
        if(self::isNUMBER($recvData))bitFlagOn($retValue, MA_MessageKind::NUMBER);
        if(self::isMENU($recvData))bitFlagOn($retValue, MA_MessageKind::MENU);
        if(self::isONE_DELETE($recvData))bitFlagOn($retValue, MA_MessageKind::ONE_DELETE);
        if(self::isPETITION($recvData))bitFlagOn($retValue, MA_MessageKind::PETITION);
        if(self::isREQUEST_TO_USER($recvData))bitFlagOn($retValue, MA_MessageKind::REQUEST_TO_USER);
        if(self::isREQUEST_TO_IN_HOUSE($recvData))bitFlagOn($retValue, MA_MessageKind::REQUEST_TO_IN_HOUSE);
        if(self::isONE_WAY($recvData))bitFlagOn($retValue, MA_MessageKind::ONE_WAY);
        if(self::isROUND_TRIP($recvData))bitFlagOn($retValue, MA_MessageKind::ROUND_TRIP);
        if(self::isJORUDAN($recvData))bitFlagOn($retValue, MA_MessageKind::JORUDAN);
        return $retValue;
    }
    
    static public function getJorudanInfo(Jorudan_Info &$output ,CallBackStruct $recvData):bool
    {
        $jorudanInstance = new Jorudan_Funcs();
        //受信データがジョルダン情報か判断
        $bitFlags = self::getMessageKind($recvData);
        if(!getBitFlagState($bitFlags, MA_MessageKind::JORUDAN))
        {
            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Not Jorudan Information.");
            return false;
        }
        
        //データを構造体に格納
        if(!$jorudanInstance->GetInfo($recvData->propaty["content"]["text"],$output)){
            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"failed to exchange raw data into struct.");
            return false;
        }
        return true;
    }
    
    static protected function getBodyData_Text($recvData):CallBack_MessageStruct
    {
        $tmpBody = new CallBack_MessageStruct();
        $tmpBody->propaty["content"]["type"] = $recvData["content"]["type"];
        
        $tmpBodyContent = new CallBack_Message_TextStruct();
        $tmpBodyContent->propaty["text"] = $recvData["content"]["text"];
        $tmpBodyContent->propaty["postback"] = $recvData["content"]["postback"];
        
        $tmpBody->propaty["content"] = $tmpBody->propaty["content"] + $tmpBodyContent->propaty;
        return $tmpBody;
    }
    
    static protected function isAPPLY(CallBackStruct $recvData):bool{
        if ($recvData->propaty["content"]["postback"] == MA_MessagePostbackList::APPLY) return true;
        return false;
    }
    
    static protected function isCANCEL(CallBackStruct $recvData):bool{
        if ($recvData->propaty["content"]["postback"] == MA_MessagePostbackList::CANCEL) return true;
        return false;
    }
    
    static protected function isNUMBER(CallBackStruct $recvData):bool{
        if( ctype_digit($recvData->propaty["content"]["text"]) )return true;
        return false;
    }
    
    static protected function isMENU(CallBackStruct $recvData):bool{
        if ($recvData->propaty["content"]["postback"] == MA_MessageTextList::MENU) return true;
        return false;
    }
    
    static protected function isONE_DELETE(CallBackStruct $recvData):bool{
        if ($recvData->propaty["content"]["postback"] == MA_MessagePostbackList::ONE_DELETE) return true;
        return false;
    }
    
    static protected function isPETITION(CallBackStruct $recvData):bool{
        if ($recvData->propaty["content"]["postback"] == MA_MessagePostbackList::PETITION) return true;
        return false;
    }
    
    static protected function isREQUEST_TO_USER(CallBackStruct $recvData):bool{
        if ($recvData->propaty["content"]["postback"] == MA_MessagePostbackList::REQUEST_TO_USER) return true;
        return false;
    }
    
    static protected function isREQUEST_TO_IN_HOUSE(CallBackStruct $recvData):bool{
        if ($recvData->propaty["content"]["postback"] == MA_MessagePostbackList::REQUEST_TO_IN_HOUSE) return true;
        return false;
    }
    
    static protected function isONE_WAY(CallBackStruct $recvData):bool{
        if ($recvData->propaty["content"]["postback"] == MA_MessagePostbackList::ONE_WAY) return true;
        return false;
    }
    
    static protected function isROUND_TRIP(CallBackStruct $recvData):bool{
        if ($recvData->propaty["content"]["postback"] == MA_MessagePostbackList::ROUND_TRIP) return true;
        return false;
    }
    
    static protected function isJORUDAN(CallBackStruct $recvData):bool{
        $jorudanInstance = new Jorudan_Funcs();
        if($jorudanInstance->IsJorudanInfo($recvData->propaty["content"]["text"]))return true;
        return false;
    }
}
<?php
require_once 'LineWorks/LineWorksHTTPSResesJsonStructs.php';

class JoinedAnalyser{
    //ボディデータを取得する
    //input:file_get_contents('php://input')のデータ
    //return:ボディデータ（CallBack_JoinedStruct）
    public static function JA_GetBodyData($recvData):CallBack_JoinedStruct
    {
        $tmpBody = new CallBack_JoinedStruct();
        
        $tmpBody->propaty["memberList"] = $recvData["memberList"];
        return $tmpBody;
    }
}
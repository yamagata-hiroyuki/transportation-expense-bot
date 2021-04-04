<?php
require_once 'LineWorks/LineWorksHTTPSResiesJsonStructs.php';

class LeftAnalyser{
    //ボディデータを取得する
    //input:file_get_contents('php://input')のデータ
    //return:ボディデータ（CallBack_LeftStruct）
    public static function LA_GetBodyData($recvData):CallBack_LeftStruct
    {
        $tmpBody = new CallBack_LeftStruct();
        
        $tmpBody->propaty["memberList"] = $recvData["memberList"];
        return $tmpBody;
    }
}
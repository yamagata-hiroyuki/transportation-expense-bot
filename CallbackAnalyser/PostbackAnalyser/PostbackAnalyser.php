<?php
require_once 'LineWorks/LineWorksHTTPSResesJsonStructs.php';

class PostbackAnalyser{
    //ボディデータを取得する
    //input:file_get_contents('php://input')のデータ
    //return:ボディデータ（CallBack_PostbackStruct）
    public static function PA_GetBodyData($recvData):CallBack_PostbackStruct
    {
        $tmpBody = new CallBack_PostbackStruct();
        
        $tmpBody->propaty["data"] = $tmpSorceData["data"];
        return $tmpBody;
    }
}
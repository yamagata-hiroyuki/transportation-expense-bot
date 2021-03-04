<?php
require_once 'LineWorks/LineWorksHTTPSResesJsonStructs.php';

trait MA_ForLocation{
    //ボディデータを取得する
    //input:file_get_contents('php://input')のデータ
    //return:ボディデータ（CallBack_MessageStruct）
    static protected function getBodyData_Location($recvData):CallBack_MessageStruct
    {
        $tmpBody = new CallBack_MessageStruct();
        $tmpBody->propaty["content"]["type"] = $recvData["content"]["type"];
        
        $tmpBodyContent = new CallBack_Message_LocationStruct();
        $tmpBodyContent->propaty["address"] = $recvData["content"]["address"];
        $tmpBodyContent->propaty["latitude"] = $recvData["content"]["latitude"];
        $tmpBodyContent->propaty["longitude"] = $recvData["content"]["longitude"];
        
        $tmpBody->propaty["content"] = $tmpBody->propaty["content"] + $tmpBodyContent->propaty;
        return $tmpBody;
    }
}
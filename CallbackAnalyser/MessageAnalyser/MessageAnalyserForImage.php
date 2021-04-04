<?php
require_once 'LineWorks/LineWorksHTTPSResiesJsonStructs.php';

trait MA_ForImage{
    //ボディデータを取得する
    //input:file_get_contents('php://input')のデータ
    //return:ボディデータ（CallBack_MessageStruct）
    static protected function getBodyData_Image($recvData):CallBack_MessageStruct
    {
        $tmpBody = new CallBack_MessageStruct();
        $tmpBody->propaty["content"]["type"] = $recvData["content"]["type"];
        
        $tmpBodyContent = new CallBack_Message_ImageStruct();
        $tmpBodyContent->propaty["resourceId"] = $recvData["content"]["resourceId"];
        
        $tmpBody->propaty["content"] = $tmpBody->propaty["content"] + $tmpBodyContent->propaty;
        return $tmpBody;
    }
}
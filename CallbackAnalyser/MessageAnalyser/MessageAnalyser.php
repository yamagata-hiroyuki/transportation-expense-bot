<?php
require_once 'CallbackAnalyser/MessageAnalyser/MessageAnalyserForText.php';
require_once 'CallbackAnalyser/MessageAnalyser/MessageAnalyserForLocation.php';
require_once 'CallbackAnalyser/MessageAnalyser/MessageAnalyserForSticker.php';
require_once 'CallbackAnalyser/MessageAnalyser/MessageAnalyserForImage.php';
require_once 'CallbackAnalyser/MessageAnalyser/MessageAnalyserForFile.php';
require_once 'LineWorks/LineWorksHTTPSResiesJsonStructs.php';

class MessageAnalyser{
    //多重継承(trait)
    use MA_ForText, MA_ForFile, MA_ForImage, MA_ForSticker, MA_ForLocation;

    //ボディデータを取得する
    //input:file_get_contents('php://input')のデータ
    //return:ボディデータ（CallBack_MessageStruct）
    static public function MA_GetBodyData($recvData):CallBack_MessageStruct
    {
        //typeを文字列からEnumへ変換
        $tmpType = stringToEnum($recvData["content"]["type"]);
        $tmpBody = new CallBack_MessageStruct();
        //受信データを解析
        switch ($tmpType)
        {
            case Enum_CallBack_ContentType::TEXT:
                //ボディデータ取得
                $tmpBody = self::getBodyData_Text($recvData);
                break;
            case Enum_CallBack_ContentType::LOCATION:
                //ボディデータ取得
                $tmpBody = self::getBodyData_Location($recvData);
                break;

            case Enum_CallBack_ContentType::STICKER:
                //ボディデータ取得
                $tmpBody = self::getBodyData_Sticker($recvData);
                break;

            case Enum_CallBack_ContentType::IMAGE:
                //ボディデータ取得
                $tmpBody = self::getBodyData_Image($recvData);
                break;

            case Enum_CallBack_ContentType::FILE:
                //ボディデータ取得
                $tmpBody = self::getBodyData_File($recvData);
                break;

            default:
                //有り得ない
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Unexpected type.recvData[\"content\"][\"type\"] = ".$recvData["content"]["type"]);
        }
        return $tmpBody;
    }
}
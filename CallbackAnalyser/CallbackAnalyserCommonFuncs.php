<?php
require_once 'LineWorks/LineWorksHTTPSResiesJsonStructs.php';

//ヘッダー情報を取得する
//input:file_get_contents('php://input')のデータ
//return:ヘッダー情報
function MA_GetHeaderInfo($sorceData):CallBackHeaderInfoStruct
{
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"MA_GetHeaderInfo Func start");
    
    //ヘッダー情報取得
    $tmpHeader = new CallBackHeaderInfoStruct();
    $tmpHeader->header = getallheaders();
    
    return $tmpHeader;
}

//基本情報を取得する
//input:file_get_contents('php://input')のデータ
//return:基本情報
function MA_GetBaseInfo($sorceData):CallBackBaseInfoStruct
{
    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"MA_GetBaseInfo Func start");
    
    //基本情報取得
    $tmpBaseInfo = new CallBackBaseInfoStruct();
    $tmpBaseInfo->baseInfo["type"] = $sorceData["type"];
    $tmpBaseInfo->baseInfo["source"]["accountId"] = $sorceData["source"]["accountId"];
    $tmpBaseInfo->baseInfo["source"]["roomId"] = $sorceData["source"]["roomId"];
    $tmpBaseInfo->baseInfo["createdTime"] = $sorceData["createdTime"];
    
    return $tmpBaseInfo;
}
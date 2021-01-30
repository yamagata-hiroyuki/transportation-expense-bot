<?php
require_once 'Jorudan/Jorudan_FuncsStruct.php';
require_once 'Common/Lamdas.php';


class Jorudan_Funcs{
    function __construct()
    {
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Done Jorudan_Funcs __constractor()");
    }
    
    function __destruct()
    {
        
    }
    
    //ジョルダン情報判断
    //渡されたテキストがジョルダン乗り換え案内の情報化を判断
    //$text：生ジョルダン情報
    //return:bool:true => ジョルダン乗り換え案内情報 false => その他
    function IsJorudanInfo(string $text):bool
   {
        $ret = false;
        if(mb_strpos($text,"tiny.jorudan",0,"UTF-8")){
            $ret = true;
        }else{
            $ret = false;
        }
        
        return $ret;
    }
    
    //生ジョルダン情報 構造体化
    //ジョルダン乗り換え案内情報を構造体にした物を返す
    //$text：生ジョルダン情報
    //$jorudanInfo：構造体化された上ルダン乗り換え案内情報
    //return:bool:true =>成功
    function GetInfo(string $text, Jorudan_Info &$jorudanInfo):bool
    {
        $ret = false;
        replaceText($text, "( |　)+", ";");
        delimitText($text, ";");
        
        //出発駅取得
        $jorudanInfo->sectionFrom = $this->getSectionFrom($text);
        
        //到着駅取得
        $jorudanInfo->sectionTo = $this->getSectionTo($text);
        
        //乗降日時を取得
        $jorudanInfo->date = $this->getDate($text);
        
        //乗換回数を取得
        $jorudanInfo->transferNum = $this->getTransferNum($text);
        
        //合計金額を取得
        $jorudanInfo->amountPrice = $this->getAmountPrice($text);
        
        //乗降詳細を取得
        $jorudanInfo->details = $this->getDetailsInfo($text);
        
        
        $ret = true;
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"jorudanInfo=",$jorudanInfo);
        return $ret;
    }
    
    //出発駅を取得
    private function getSectionFrom(Array $text):string
    {
        $tmpArray = explode("→",$text[0]);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"SectionFrom=".$tmpArray[0]);
        return $tmpArray[0];
    }
    //到着駅を取得
    private function getSectionTo(Array $text):string
    {
        $tmpArray = explode("→",$text[0]);
        $maxNum = sizeof($tmpArray) - 1;
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"SectionTo=".$tmpArray[$maxNum]);
        return $tmpArray[$maxNum];
    }
    //乗降日時を取得
    private function getDate(Array $text):string
    {
        $retStr = $text[1]." ".$text[2];
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"date=".$retStr);
        return $retStr;
    }
    //乗換回数を取得
    private function getTransferNum(Array $text):int
    {
        $retNum = preg_replace('/[^0-9]/', '', $text[6]);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"transferNum=".$retNum);
        return $retNum;
    }
    //合計金額を取得
    private function getAmountPrice(Array $text):int
    {
        $retNum = preg_replace('/[^0-9]/', '', $text[7]);
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"amountPrice=".$retNum);
        return $retNum;
    }
    //乗降詳細を取得
    //戻り値：Jorudan_Info_Details
    private function getDetailsInfo(Array $text):array
    {
        $retDetailsArray = array();
        $targetNums = array();
        
        $count = 0;
        foreach( $text as $tmpStr)
        {
            DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpStr=".$tmpStr);
            //$ret = preg_match("/[^0-9:]+発/",$tmpStr);
            //DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"ret=".$ret);
            if(1 == preg_match("/[0-9:]+発/",$tmpStr) ){
            //HH:MM発にマッチした
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"count=".$count);
                array_push($targetNums,$count);
            }
            $count++;

        }
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"targetNums=",$targetNums);
        
        foreach($targetNums as $i)
        {
            $retDetails = new Jorudan_Info_Details();
            
            $retDetails->timeFrom = preg_replace('/[^0-9:]/','',$text[$i]);$i++;
            $retDetails->sectionFrom = $text[$i];$i++;
            if(false !== mb_strpos($text[$i],"番線" ))$i++;
            $retDetails->trainName = preg_replace('/≪.+≫/','',$text[$i]);$i++;
            $i++;
            if(false !== mb_strpos($text[$i],"運賃" ) or false !== mb_strpos($text[$i],"指定席") ){
                $retDetails->Price = preg_replace('/[^0-9]/', '', $text[$i]);
                $i++;
            }else{
                $retDetails->Price = 0;
            }
            $retDetails->timeTo = preg_replace('/[^0-9:]/','',$text[$i]);;$i++;
            $retDetails->sectionTo = $text[$i];
            
//             $retDetails->sectionTo = $text[$i - 1];
//             $retDetails->timeTo = preg_replace('/[^0-9:]/','',$text[$i - 2]);
//             if(false !== mb_strpos($text[$i - 3],"運賃" ) or false !== mb_strpos($text[$i - 3],"指定席") ){
//                 $retDetails->Price = preg_replace('/[^0-9]/', '', $text[$i - 3]);
//             }else{
//                 $retDetails->Price = 0;
//                 $i++;
//             }
//             $retDetails->trainName = preg_replace('/≪.+≫/','',$text[$i - 5]);
//             if(false !== mb_strpos($text[$i - 6],"番線" ))$i--;
//             $retDetails->sectionFrom = $text[$i - 6];
//             $retDetails->timeFrom = preg_replace('/[^0-9:]/','',$text[$i - 7]);
            array_push($retDetailsArray,$retDetails);
        }
        DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"retDetailsArray=",$retDetailsArray);
        return $retDetailsArray;
    }
    
    
    
    
    
}
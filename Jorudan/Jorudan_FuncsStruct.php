<?php
    /* Enum定義 */


    /* ジョルダン情報 */
    class Jorudan_Info{
        public $sectionFrom = "";  //出発駅
        public $sectionTo = "";    //最終到着駅
        public $date = "";         //乗降日(M/D(曜日) hh:mm)
        public $transferNum = 0;  //乗換回数
        public $amountPrice = 0;   //合計金額
        public $details = Array();//乗降詳細。$transfer_Numの数だけ配列が用意される。
                                    //詳細情報はJorudan_Info_Details参照
    }
    
    /* ジョルダン情報 */
    class Jorudan_Info_Details{
        public $sectionFrom = "";   //出発駅
        public $sectionTo = "";     //到着駅
        public $timeFrom = "";      //出発時間(hh:mm)
        public $timeTo = "";        //到着時間(hh:mm)
        public $trainName = "";     //乗降車両名
        public $Price = 0;          //金額
    }
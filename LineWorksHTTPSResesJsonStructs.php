<?php
    //Bot list req
    
    class ResJsonStructs{
        public $BotListRes;
        
        private function __construct(){
            $this->BotListRes = new BotListResStruct();
            
            
            
        }
        
        private function __destruct(){}
    
    
    }
    
    //トーク Bot リスト照会 応答
    class BotListResStruct{
        public $propaty = Array(
            "bots" =>                                   //トーク Bot リスト
            Array(
                "botNo"                 => 0,           //トーク Bot 番号
                "name"                  => "Unknown",   //Bot 名
                "i18nNames" =>                          //多言語名のリスト
                Array(
                    "language"          => "Unknown",   //言語コード
                    "name"              => "Unknown"    //各言語のトーク Bot 名
                    ),
                "photoUrl"              => "Unknown",   //トーク Bot プロフィール画像の URL
                "i18nPhotoUrls" =>                      //各言語でのプロフィール画像リスト (URL)
                Array(
                    "language"          => "Unknown",   //言語コード
                    "photoUrl"          => "Unknown"    //画像の URL
                    )
                )
            );
    }













?>
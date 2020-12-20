<?php
    //Bot list req
    
    class ResJsonStructs{
        private function __construct(){
        }
        
        private function __destruct(){
        }
    }
    
    //トーク Bot リスト照会 応答
    class BotListResStruct
    {
        public $propaty = Array(
            "bots" =>                            //トーク Bot リスト
            Array(
                "botNo"                 => 0,    //トーク Bot 番号
                "name"                  => "",   //Bot 名
                "i18nNames" =>                   //多言語名のリスト
                Array(
                    "language"          => "",   //言語コード
                    "name"              => ""    //各言語のトーク Bot 名
                    ),
                "photoUrl"              => "",   //トーク Bot プロフィール画像の URL
                "i18nPhotoUrls" =>               //各言語でのプロフィール画像リスト (URL)
                Array(
                    "language"          => "",   //言語コード
                    "photoUrl"          => ""    //画像の URL
                    )
                )
            );
    }
    
    class ServerTokenRes
    {
        public $propaty = Array(
            "access_token" => "",               //Server Token
            "token_type" => "",                 //Bearer
            "expires_in" => ""                  //Server Token の有効期限(秒)
            );
    }













?>
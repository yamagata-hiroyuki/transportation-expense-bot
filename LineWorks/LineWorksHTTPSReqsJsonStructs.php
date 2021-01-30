<?php
    //トーク Bot リスト照会 要求
    class BotListReqStruct{
        public $propaty = Array();
        public $header = Array(
            "Content-Type" => "",
            "charset" => "",
            "consumerKey" => "",
            "Authorization" => ""
        );
    }

    //サーバートークン要求
    class ServerTokenReqStruct{
        public $propaty = Array(
            "grant_type" => "",
            "assertion" => ""
        );
        public $header = Array(
            "Content-Type" => ""
        );
    }

    //メインメニュー表示要求
    class DispMainMenuReqStruct{
        public $propaty = Array(
            "accountId" => "",           //メンバーアカウント
            "content" => Array()          //メッセージの内容.Message_ButtonTemplateStructを参照
        );
        public $header = Array(
            "Content-Type" => "",
            "charset" => "",
            "consumerKey" => "",
            "Authorization" => ""
        );
    }

    //メッセージ送信要求
    class SendMessageReqStruct{
        public $propaty = Array(
            "accountId" => "",           //メンバーアカウント
            "content" => Array()          //メッセージの内容.Message_TextStructを参照
        );
        public $header = Array(
            "Content-Type" => "",
            "charset" => "",
            "consumerKey" => "",
            "Authorization" => ""
        );
    }
    /* Bot メッセージ送信関連 構造体 */
        /* Button temolate */
        class Message_ButtonTemplateStruct{
            public $propaty = Array(
                "type" => "button_template", //button_template固定
                "contentText" => "",         //表示する内容
                "actions" => Array()        //ボタンの設定（ボタン名や動作を定義）Action_PostbackStructを参照
                //https://developers.worksmobile.com/jp/document/100500804?lang=ja 参照
                );
        }
        
        /* text */
        class Message_TextStruct{
            public $propaty = Array(
                "type" => "text", //button_template固定
                "text" => "",     //メッセージの内容.最大2000文字
            );
        }
        
        /* ActionObject関連 構造体 */
        class Action_MessageStruct{
            public $propaty = Array(
                "type" => "message",        //message固定
                "label" => "",              //項目のラベル.最大20文字
                "text" => "",               //項目を押した時に送信されるテキスト.最大 300 文字
                "postback" => ""            //message.postback プロパティに返される文字列.最大 1000 文字
                );
        }




<?php

    /* Enum定義 */
    {
        class Enum_CallBack_Type{
            const MESSAGE = 0;
            const JOIN = 1;
            const LEAVE = 2;
            const JOINED = 3;
            const LEFT = 4;
            const POST_BACK = 5;
        }
        
        class Enum_CallBack_ContentType{
            const TEXT = 0;
            const LOCATION = 1;
            const STICKER = 2;
            const IMAGE = 3;
            const FILE = 4;
        }
        
        class Enum_CallBack_userState{
            /*ユーザー未登録*/
            const USER_NOT_REGISTED = 0;    //ユーザー未登録状態
            /* メインメニュー */
            const MAIN_MENU = 1;            //メインメニュー選択状態待機
            /* データ登録機能 */
            const REGIST_INPUT_DIST = 2;    //行き先入力待機
            const REGIST_INPUT_DEMAND = 3;  //請求先選択待機
            const REGIST_INPUT_ROUND = 4;   //往復・片道選択待機
            const REGIST_INPUT_REMARK = 5;  //備考入力待機
            const REGIST_INPUT_CONF = 6;    //入力確認選択待機
            
            
        }
    }



    //コールバック受信
    class CallBackStruct{
        public $baseInfo = Array();        //CallBackBaseInfoStruct参照
        public $propaty = Array();         //CallBack_XXXXStruct参照
        public $header = Array();          //ヘッダー情報
    }
    
    /* CallBackイベント */
    {
        class CallBack_MessageStruct{           //メンバーが送信したメッセージが含まれた Callback イベント
            public $propaty = Array(
                "content" => Array("type" => "")//コンテンツのタイプ
            );
            //ヘッダー情報はCallBackStructにて設定済みのため不要
        }
        
        class CallBack_JoinStruct{              //トークルームに Bot が招待された際に生じる Callback イベント
            public $propaty = Array();         //なし
        }
        
        class CallBack_LeaveStruct{             //トークルームから Bot が退室した際に生じる Callback イベント
            public $propaty = Array();         //なし
        }
        
        class CallBack_JoinedStruct{            //Bot が属するトークルームに新たにメンバーが招待された際に生じる Callback イベント
            public $propaty = Array(
                "memberList" => Array()         //招待されたメンバーリスト
            );
        }
        
        class CallBack_LeftStruct{              //Bot が属するトークルームに新たにメンバーが退室した際に生じる Callback イベント
            public $propaty = Array(
                "memberList" => Array()         //トークルームから退室したメンバーリスト
                );
        }
        
        class CallBack_PostbackStruct{          //Action Object(ボタン等)の postback action に対する応答のイベント
            public $propaty = Array(
                "data" => ""                     //postback データ
            );
        }
    }
    
    /* 各コールバックイベント参照構造体 */
    {
        //コールバック受信 ヘッダー情報
        class CallBackHeaderInfoStruct{
            public $header = Array(
                "Content-Type" => "",
                "charset" => "",
                "X-WORKS-Signature" => "",
                "X-WORKS-BotNo" => ""
            );
        }
        
        //コールバック受信 基本情報
        class CallBackBaseInfoStruct{
            public $baseInfo = Array(
                "type" => "",                   //コールバックのイベントタイプ
                "source" => Array(
                    "accountId" => "",          //送信元ユーザーアカウント
                    "roomId" => "",             //送信したトークルームID
                ),
                "createdTime" => 0              //メッセージが作成された日時。Unix timeで表示 (単位 : msec)
            );
        }
        
        //コールバック受信（Message->Text）構造体
        class CallBack_Message_TextStruct{     //メンバーが送信したテキストが含まれるオブジェクト
            public $propaty = Array(
                "text" => "",                   //メッセージ本文
                "postback" => ""                //postback メッセージ (ボタンなどのテンプレート利用時)
            );
            //ヘッダー情報はCallBackStructにて設定済みのため不要
        }
        
        //コールバック受信（Message->Location）構造体
        class CallBack_Message_LocationStruct{ //メンバーが送信した位置情報が含まれたオブジェクト
            public $propaty = Array(
                "address" => "",                //メンバーが送信した位置情報(住所)
                "latitude" => 0,                //メンバーが送信した位置情報(緯度)
                "longitude" => 0                //メンバーが送信した位置情報(経度)
            );
            //ヘッダー情報はCallBackStructにて設定済みのため不要
        }
        
        //コールバック受信（Message->Sticker）構造体
        class CallBack_Message_StickerStruct{  //メンバーが送信したスタンプ情報が含まれたオブジェクト
            public $propaty = Array(
                "packageId" => "",              //パッケージ ID
                "stickerId" => ""               //スタンプ ID
            );
            //ヘッダー情報はCallBackStructにて設定済みのため不要
        }
        
        //コールバック受信（Message->Image）構造体
        class CallBack_Message_ImageStruct{     //メンバーが送信した画像データが含まれたオブジェクト
            public $propaty = Array(
                "resourceId" => "",              //リソース ID
            );
            //ヘッダー情報はCallBackStructにて設定済みのため不要
        }
        
        //コールバック受信（Message->File）構造体
        class CallBack_Message_FileStruct{     //メンバーが送信したファイルが含まれたオブジェクト
            public $propaty = Array(
                "resourceId" => ""              //リソース ID
            );
            //ヘッダー情報はCallBackStructにて設定済みのため不要
        }
    }
    
    
    /* 各種応答構造体  (LineWorks -> Bot(Server)) */
    {
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
    }

    /* 各種応答構造体  (Server -> LineWorks(Bot)) */
    {

    }

    /* Enum　拡張機能 */
    function stringToEnum(string $str){
        switch ($str){
            case "message":
                return Enum_CallBack_Type::MESSAGE;
            case "join":
                return Enum_CallBack_Type::JOIN;
            case "leave":
                return Enum_CallBack_Type::LEAVE;
            case "joined":
                return Enum_CallBack_Type::JOINED;
            case "left":
                return Enum_CallBack_Type::LEFT;
            case "postback":
                return Enum_CallBack_Type::POST_BACK;
            case "text":
                return Enum_CallBack_ContentType::TEXT;
            case "location":
                return Enum_CallBack_ContentType::LOCATION;
            case "sticker":
                return Enum_CallBack_ContentType::STICKER;
            case "image":
                return Enum_CallBack_ContentType::IMAGE;
            case "file":
                return Enum_CallBack_ContentType::FILE;
            default:
                return -1;
        }
    }





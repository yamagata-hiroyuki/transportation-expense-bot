<?php
require_once 'Common/Lamdas.php';
require_once 'LineWorks/LineWorksHTTPSResesJsonStructs.php';
require_once 'LineWorks/LineWorksCfg.php';
require_once 'LineWorks/LineWorksHTTPSReqs.php';
require_once 'Jorudan/Jorudan_Funcs.php';
require_once 'CallbackAnalyser/MessageAnalyser/MessageAnalyser.php';
require_once 'DB/DB_Storedprocedures/DB_SP_SetFunctions.php';
require_once 'DB/DB_Storedprocedures/DB_SP_GetFunctions.php';
require_once 'DB/DB_Storedprocedures/DB_SP_AddFunctions.php';

/* 関数テーブル */
class StateEvent{
    public function StateEventCaller(string $funcStr,$recvData):bool{
        return $this->$funcStr($recvData);
    }

    /* Enum_CallBack_userState *//* Enum_CallBack_Type */
    public $stateEventTable = Array(
        /* USER_JUST_REGISTED */
        Enum_CallBack_userState::USER_JUST_REGISTED => Array(
            Enum_CallBack_Type::MESSAGE => 'RecvEvent_S00E00',
            Enum_CallBack_Type::JOIN => 'RecvEvent_SXXE01',
            Enum_CallBack_Type::LEAVE => 'RecvEvent_SXXE02',
            Enum_CallBack_Type::JOINED => 'RecvEvent_S00E03',
            Enum_CallBack_Type::LEFT => 'RecvEvent_S00E04',
            Enum_CallBack_Type::POST_BACK => 'RecvEvent_S00E05'
        ),
        /* MAIN_MENU */
        Enum_CallBack_userState::MAIN_MENU => Array(
            Enum_CallBack_Type::MESSAGE => 'RecvEvent_S01E00',
            Enum_CallBack_Type::JOIN => 'RecvEvent_SXXE01',
            Enum_CallBack_Type::LEAVE => 'RecvEvent_SXXE02',
            Enum_CallBack_Type::JOINED => 'RecvEvent_SXXE03',
            Enum_CallBack_Type::LEFT => 'RecvEvent_SXXE04',
            Enum_CallBack_Type::POST_BACK => 'RecvEvent_S01E05'
        ),

        /* REGIST_INPUT_DIST */
        Enum_CallBack_userState::REGIST_INPUT_DIST => Array(
            Enum_CallBack_Type::MESSAGE => 'RecvEvent_S02E00',
            Enum_CallBack_Type::JOIN => 'RecvEvent_SXXE01',
            Enum_CallBack_Type::LEAVE => 'RecvEvent_SXXE02',
            Enum_CallBack_Type::JOINED => 'RecvEvent_SXXE03',
            Enum_CallBack_Type::LEFT => 'RecvEvent_SXXE04',
            Enum_CallBack_Type::POST_BACK => 'RecvEvent_S02E05'
        ),

        /* REGIST_INPUT_DEMAND */
        Enum_CallBack_userState::REGIST_INPUT_DEMAND => Array(
            Enum_CallBack_Type::MESSAGE => 'RecvEvent_S03E00',
            Enum_CallBack_Type::JOIN => 'RecvEvent_SXXE01',
            Enum_CallBack_Type::LEAVE => 'RecvEvent_SXXE02',
            Enum_CallBack_Type::JOINED => 'RecvEvent_SXXE03',
            Enum_CallBack_Type::LEFT => 'RecvEvent_SXXE04',
            Enum_CallBack_Type::POST_BACK => 'RecvEvent_S03E05'
        ),

        /* REGIST_INPUT_ROUND */
        Enum_CallBack_userState::REGIST_INPUT_ROUND => Array(
            Enum_CallBack_Type::MESSAGE => 'RecvEvent_S04E00',
            Enum_CallBack_Type::JOIN => 'RecvEvent_SXXE01',
            Enum_CallBack_Type::LEAVE => 'RecvEvent_SXXE02',
            Enum_CallBack_Type::JOINED => 'RecvEvent_SXXE03',
            Enum_CallBack_Type::LEFT => 'RecvEvent_SXXE04',
            Enum_CallBack_Type::POST_BACK => 'RecvEvent_S04E05'
        ),

        /* REGIST_INPUT_REMARK */
        Enum_CallBack_userState::REGIST_INPUT_REMARK => Array(
            Enum_CallBack_Type::MESSAGE => 'RecvEvent_S05E00',
            Enum_CallBack_Type::JOIN => 'RecvEvent_SXXE01',
            Enum_CallBack_Type::LEAVE => 'RecvEvent_SXXE02',
            Enum_CallBack_Type::JOINED => 'RecvEvent_SXXE03',
            Enum_CallBack_Type::LEFT => 'RecvEvent_SXXE04',
            Enum_CallBack_Type::POST_BACK => 'RecvEvent_S05E05'
        ),

        /* REGIST_INPUT_CONF */
        Enum_CallBack_userState::REGIST_INPUT_CONF => Array(
            Enum_CallBack_Type::MESSAGE => 'RecvEvent_S06E00',
            Enum_CallBack_Type::JOIN => 'RecvEvent_SXXE01',
            Enum_CallBack_Type::LEAVE => 'RecvEvent_SXXE02',
            Enum_CallBack_Type::JOINED => 'RecvEvent_SXXE03',
            Enum_CallBack_Type::LEFT => 'RecvEvent_SXXE04',
            Enum_CallBack_Type::POST_BACK => 'RecvEvent_S06E05'
        )

    );

    private $stateEventContentTypeTable = Array(
        /* USER_JUST_REGISTED */
        Enum_CallBack_userState::USER_JUST_REGISTED => Array(
            Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S00E00',
            Enum_CallBack_ContentType::LOCATION => 'RecvEventContent_SXXE01',
            Enum_CallBack_ContentType::STICKER => 'RecvEventContent_SXXE02',
            Enum_CallBack_ContentType::IMAGE => 'RecvEventContent_SXXE03',
            Enum_CallBack_ContentType::FILE => 'RecvEventContent_SXXE04'
        ),
        /* MAIN_MENU */
        Enum_CallBack_userState::MAIN_MENU => Array(
            Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S01E00',
            Enum_CallBack_ContentType::LOCATION => 'RecvEventContent_SXXE01',
            Enum_CallBack_ContentType::STICKER => 'RecvEventContent_SXXE02',
            Enum_CallBack_ContentType::IMAGE => 'RecvEventContent_SXXE03',
            Enum_CallBack_ContentType::FILE => 'RecvEventContent_SXXE04'
        ),

        /* REGIST_INPUT_DIST */
        Enum_CallBack_userState::REGIST_INPUT_DIST => Array(
            Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S02E00',
            Enum_CallBack_ContentType::LOCATION => 'RecvEventContent_SXXE01',
            Enum_CallBack_ContentType::STICKER => 'RecvEventContent_SXXE02',
            Enum_CallBack_ContentType::IMAGE => 'RecvEventContent_SXXE03',
            Enum_CallBack_ContentType::FILE => 'RecvEventContent_SXXE04'
        ),

        /* REGIST_INPUT_DEMAND */
        Enum_CallBack_userState::REGIST_INPUT_DEMAND => Array(
            Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S03E00',
            Enum_CallBack_ContentType::LOCATION => 'RecvEventContent_SXXE01',
            Enum_CallBack_ContentType::STICKER => 'RecvEventContent_SXXE02',
            Enum_CallBack_ContentType::IMAGE => 'RecvEventContent_SXXE03',
            Enum_CallBack_ContentType::FILE => 'RecvEventContent_SXXE04'
        ),

        /* REGIST_INPUT_ROUND */
        Enum_CallBack_userState::REGIST_INPUT_ROUND => Array(
            Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S04E00',
            Enum_CallBack_ContentType::LOCATION => 'RecvEventContent_SXXE01',
            Enum_CallBack_ContentType::STICKER => 'RecvEventContent_SXXE02',
            Enum_CallBack_ContentType::IMAGE => 'RecvEventContent_SXXE03',
            Enum_CallBack_ContentType::FILE => 'RecvEventContent_SXXE04'
        ),

        /* REGIST_INPUT_REMARK */
        Enum_CallBack_userState::REGIST_INPUT_REMARK => Array(
            Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S05E00',
            Enum_CallBack_ContentType::LOCATION => 'RecvEventContent_SXXE01',
            Enum_CallBack_ContentType::STICKER => 'RecvEventContent_SXXE02',
            Enum_CallBack_ContentType::IMAGE => 'RecvEventContent_SXXE03',
            Enum_CallBack_ContentType::FILE => 'RecvEventContent_SXXE04'
        ),

        /* REGIST_INPUT_CONF */
        Enum_CallBack_userState::REGIST_INPUT_CONF => Array(
            Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S06E00',
            Enum_CallBack_ContentType::LOCATION => 'RecvEventContent_SXXE01',
            Enum_CallBack_ContentType::STICKER => 'RecvEventContent_SXXE02',
            Enum_CallBack_ContentType::IMAGE => 'RecvEventContent_SXXE03',
            Enum_CallBack_ContentType::FILE => 'RecvEventContent_SXXE04'
        )

    );

    /* $stateEventTable 用関数群 */
        /* USER_JUST_REGISTED Funcs */
            private function RecvEvent_S00E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Invalid state event called(RecvEvent_S00E00()).");
                return true;
            }

            private function RecvEvent_SXXE01($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Not supported state event called(RecvEvent_SXXE01()).");
                return true;
            }

            private function RecvEvent_SXXE02($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Not supported state event called(RecvEvent_SXXE02()).");
                return true;
            }

            private function RecvEvent_S00E03($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S00E03()).");
                //ユーザーアドレスを取得
                $accountId = $recvData->baseInfo["source"]["accountId"];

                //DBへユーザーを新規登録
                IF(DB_SP_addRegisteredUser($accountId)){
                	DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[Info]User registered.");
                	return true;
                }else{
                	DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[WARN]User not registered.");
                	return false;
                }
            }

            private function RecvEvent_S00E04($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Invalid state event called(RecvEvent_S00E04()).");
                return true;
            }

            private function RecvEvent_S00E05($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Invalid state event called(RecvEvent_S00E05()).");
                return true;
            }

        /* MAIN_MENU Funcs */
            private function RecvEvent_S01E00(CallBackStruct $recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called.");
                //コンテントのタイプごとに呼び出す関数を決定
                $contentType = stringToEnum($recvData->propaty["content"]["type"]);
                $targetFunc = $this->stateEventContentTypeTable[Enum_CallBack_userState::MAIN_MENU][$contentType];
                if($targetFunc == null){
                    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,
                        "Unexpected table Func Referred.\nPlease create and set func in stateEventContentTypeTable.");
                    return true;
                }
                return $this->$targetFunc($recvData);
            }

            private function RecvEvent_SXXE03($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Invalid state event called(RecvEvent_SXXE03()).");
                return true;
            }

            private function RecvEvent_SXXE04($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Istate event called(RecvEvent_SXXE04()).");
                //TODO DBからユーザーを削除

                return true;
            }

            private function RecvEvent_S01E05($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(ecvEvent_S01E05()).");
                return true;
            }

        /* REGIST_INPUT_DIST Funcs */
            private function RecvEvent_S02E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S02E00()).");
                return true;
            }

            private function RecvEvent_S02E05($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S02E05()).");
                return true;
            }

        /* REGIST_INPUT_DEMAND Funcs */
            private function RecvEvent_S03E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S03E00()).");
                return true;
            }

            private function RecvEvent_S03E05($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S03E05()).");
                return true;
            }

        /* REGIST_INPUT_ROUND Funcs */
            private function RecvEvent_S04E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S04E00()).");
                return true;
            }

            private function RecvEvent_S04E05($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S04E05()).");
                return true;
            }

        /* REGIST_INPUT_REMARK Funcs */
            private function RecvEvent_S05E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S05E00()).");
                return true;
            }

            private function RecvEvent_S05E05($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S05E05()).");
                return true;
            }

        /* REGIST_INPUT_CONF Funcs */
            private function RecvEvent_S06E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S06E00()).");
                return true;
            }

            private function RecvEvent_S06E05($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S06E05()).");
                return true;
            }

    /* $stateEventContentTypeTable 用関数群 */
        /* USER_NOT_REGISTED Funcs */
            private function RecvEventContent_S00E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEvent_S00E00()).");
                return true;
            }

            private function RecvEventContent_SXXE01($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Not supported state event called(RecvEventContent_SXXE01()).");
                return true;
            }

            private function RecvEventContent_SXXE02($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Not supported state event called(RecvEventContent_SXXE02()).");
                return true;
            }

            private function RecvEventContent_SXXE03($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Not supported called(RecvEventContent_SXXE03()).");
                return true;
            }

            private function RecvEventContent_SXXE04($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Not supported state event called(RecvEventContent_SXXE04()).");
                return true;
            }

        /* MAIN_MENU Funcs */
            private function RecvEventContent_S01E00(CallBackStruct $recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEventContent_S01E00()).");
                //LineWorks クライアントの作成
                $client = new LineWorksReqs();
                //TODO Server Token 要求(DBから取得するように修正すること)
                {
                    //JWT Token生成
                    $JWTToken = CreateJWT();
                    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"JWTToken = ".$JWTToken);


                    $serverToken = $client->ServerTokenReq($JWTToken);
                    DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"serverToken = ".$serverToken);
                }

                //メッセージを送付したいユーザーIDを取得
                $accountId = $recvData->baseInfo["source"]["accountId"];
                //ジョルダン乗り換え案内より情報取得（テスト用：DB整備後は適切なステータスイベントへ移動）
                do{
                    $jorudanInfo = new Jorudan_Info();

                    //ジョルダン情報取得
                    if(false == MessageAnalyser::getJorudanInfo($jorudanInfo, $recvData))break;
                    //以下テスト用
                    $tmpArray = print_r($jorudanInfo,true);
                    $client->SendMessageReq($accountId,$serverToken,$tmpArray);

                    //TODO DBへ一時データ保存

                    //TODO 状態更新

                }while(false);

                return true;
            }

        /* REGIST_INPUT_DIST Funcs */
            private function RecvEventContent_S02E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEventContent_S02E00()).");
                return true;
            }

        /* REGIST_INPUT_DEMAND Funcs */
            private function RecvEventContent_S03E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEventContent_S03E00()).");
                return true;
            }

        /* REGIST_INPUT_ROUND Funcs */
            private function RecvEventContent_S04E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEventContent_S04E00()).");
                return true;
            }

        /* REGIST_INPUT_REMARK Funcs */
            private function RecvEventContent_S05E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEventContent_S05E00()).");
                return true;
            }

        /* REGIST_INPUT_CONF Funcs */
            private function RecvEventContent_S06E00($recvData):bool{
                DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"state event called(RecvEventContent_S06E00()).");
                return true;
            }


}





















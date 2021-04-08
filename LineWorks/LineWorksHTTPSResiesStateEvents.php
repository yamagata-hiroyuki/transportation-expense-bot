<?php
require_once 'Common/Lamdas.php';
require_once 'LineWorks/LineWorksHTTPSResiesJsonStructs.php';
require_once 'LineWorks/LineWorksCfg.php';
require_once 'LineWorks/LineWorksHTTPSReqs.php';
require_once 'Jorudan/Jorudan_Funcs.php';
require_once 'CallbackAnalyser/MessageAnalyser/MessageAnalyser.php';
require_once 'DB/DB_Storedprocedures/DB_SP_SetFunctions.php';
require_once 'DB/DB_Storedprocedures/DB_SP_GetFunctions.php';
require_once 'DB/DB_Storedprocedures/DB_SP_AddFunctions.php';

/* 関数テーブル */
/* イベントテーブル定義 */
class StateEvent{
	public function StateEventCaller(string $funcStr,$recvData):bool{
		$ret = false;
		try {
			$ret = $this->$funcStr($recvData);
		}
		catch (Exception $e) {
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Error: ".$e->getMessage());
			$ret = false;
		}
		return $ret;
	}

	/* Enum_CallBack_userState *//* Enum_CallBack_Type */
	public $stateEventTable = Array(
		/* USER_JUST_REGISTED */
		Enum_CallBack_userState::USER_JUST_REGISTED => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
		),
		/* MAIN_MENU */
		Enum_CallBack_userState::MAIN_MENU => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
		),

		/* REGIST_INPUT_DIST */
		Enum_CallBack_userState::REGIST_INPUT_DIST => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
		),

		/* REGIST_INPUT_DEMAND */
		Enum_CallBack_userState::REGIST_INPUT_DEMAND => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
		),

		/* REGIST_INPUT_ROUND */
		Enum_CallBack_userState::REGIST_INPUT_ROUND => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
		),

		/* REGIST_INPUT_REMARK */
		Enum_CallBack_userState::REGIST_INPUT_REMARK => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
		),

		/* REGIST_INPUT_CONF */
		Enum_CallBack_userState::REGIST_INPUT_CONF => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
		),

		/* SELECT_MENU */
		Enum_CallBack_userState::SELECT_MENU => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
		),

		/* DELETE_SELECT_ID */
		Enum_CallBack_userState::DELETE_SELECT_ID => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
			),

		/* DELETE_CONF */
		Enum_CallBack_userState::DELETE_CONF => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
		),

		/* PETITION_CONF */
		Enum_CallBack_userState::PETITION_CONF => Array(
			Enum_CallBack_Type::MESSAGE => 'RecvEvent_SECallContentTypeTable',
			Enum_CallBack_Type::JOIN => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEAVE => 'RecvEvent_Nope',
			Enum_CallBack_Type::JOINED => 'RecvEvent_Nope',
			Enum_CallBack_Type::LEFT => 'RecvEvent_Nope',
			Enum_CallBack_Type::POST_BACK => 'RecvEvent_Nope'
		)
	);

	/* サブイベントテーブル定義 */
	private $stateEventContentTypeTable = Array(
		/* USER_JUST_REGISTED */
		Enum_CallBack_userState::USER_JUST_REGISTED => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S00E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		),
		/* MAIN_MENU */
		Enum_CallBack_userState::MAIN_MENU => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S01E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		),

		/* REGIST_INPUT_DIST */
		Enum_CallBack_userState::REGIST_INPUT_DIST => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S02E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		),

		/* REGIST_INPUT_DEMAND */
		Enum_CallBack_userState::REGIST_INPUT_DEMAND => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S03E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		),

		/* REGIST_INPUT_ROUND */
		Enum_CallBack_userState::REGIST_INPUT_ROUND => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S04E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		),

		/* REGIST_INPUT_REMARK */
		Enum_CallBack_userState::REGIST_INPUT_REMARK => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S05E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		),

		/* REGIST_INPUT_CONF */
		Enum_CallBack_userState::REGIST_INPUT_CONF => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S06E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		),

		/* SELECT_MENU */
		Enum_CallBack_userState::SELECT_MENU => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S07E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		),

		/* DELETE_SELECT_ID */
		Enum_CallBack_userState::DELETE_SELECT_ID => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S08E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		),

		/* DELETE_CONF */
		Enum_CallBack_userState::DELETE_CONF => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S09E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		),

		/* PETITION_CONF */
		Enum_CallBack_userState::PETITION_CONF => Array(
			Enum_CallBack_ContentType::TEXT => 'RecvEventContent_S10E00',
			Enum_CallBack_ContentType::LOCATION => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::STICKER => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::IMAGE => 'RecvEvent_Nope',
			Enum_CallBack_ContentType::FILE => 'RecvEvent_Nope'
		)
	);

	/* $stateEventTable 用関数群 */
		/* USER_JUST_REGISTED Funcs */
		/* MAIN_MENU Funcs */
		/* REGIST_INPUT_DIST Funcs */
		/* REGIST_INPUT_DEMAND Funcs */
		/* REGIST_INPUT_ROUND Funcs */
		/* REGIST_INPUT_REMARK Funcs */
		/* REGIST_INPUT_CONF Funcs */
			private function RecvEvent_SECallContentTypeTable($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEvent_SECallContentTypeTable()).");
				//コンテントのタイプを取得
				$contentType = stringToEnum($recvData->propaty["content"]["type"]);
				//ユーザーステータスを取得
				$userName = $recvData->baseInfo["source"]["accountId"];
				$userStatus = new DBSP_GetUserStatusStruct();
				$ret = DB_SP_getUserStatus($userName, $userStatus);
				if( false == $ret ){
					//取得失敗
					DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed to get user status.user_address=".$userName);
					return false;
				}

				//コンテントタイプ+ユーザーステータスから実行するサブイベントを決定
				$targetFunc = $this->stateEventContentTypeTable[$userStatus->info["user_status"]][$contentType];
				if($targetFunc == null){
					DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,
						"[WARN]Unexpected table Func Referred.\nPlease create and set func in stateEventContentTypeTable.");
					return true;
				}
				return $this->$targetFunc($recvData);
			}

			private function RecvEvent_Nope($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEvent_Nope()).");
				//ユーザーステータスを取得
				$userName = $recvData->baseInfo["source"]["accountId"];
				$userStatus = new DBSP_GetUserStatusStruct();
				$ret = DB_SP_getUserStatus($userName, $userStatus);
				if( false == $ret ){
					//取得失敗
					DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[WARN]Failed to get user status.");
				}
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]userStatus=".$userStatus);
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]recvData=",$recvData);
				return true;
			}

	/* $stateEventContentTypeTable 用関数群 */
		/* USER_JUST_REGISTED Funcs */
			private function RecvEventContent_S00E00($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S00E00()).");
				//ユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					//状態更新
					$userStatusInfo = new DBSP_SetUserStatusStruct();
					$userStatusInfo->info["user_address"] = $accountId;
					$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
					DB_SP_setUserStatus($userStatusInfo);
				}while(false);
				return true;
			}

		/* MAIN_MENU Funcs */
			private function RecvEventContent_S01E00(CallBackStruct $recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S01E00()).");
				//LineWorks クライアントの作成
				$client = new LineWorksReqs();
				//Server Token 取得
				$serverTokenInfo = new DBSP_GetServerTokenStruct();
				DB_SP_getServerToken($serverTokenInfo);

				//メッセージを送付したいユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					$messasgeKind = MessageAnalyser::getMessageKind($recvData);
					switch ($messasgeKind){
						case MA_MessageKind::JORUDAN:
							//ジョルダン情報取得
							$jorudanInfo = new Jorudan_Info();
							if(false == MessageAnalyser::getJorudanInfo($jorudanInfo, $recvData)){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Invalid Input.");
								//ユーザーへ通知（パース失敗）
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"予期せぬエラーが発生しました。開発者へ連絡してください。");
								break;
							}
							//以下テスト用
							$tmpArray = print_r($jorudanInfo,true);
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"デバッグ情報\n".$tmpArray);

							//DBへ一時データ保存
							$tempRouteInfo = new DBSP_SetTempRouteInfo_JorudanInfoStruct();
							$tempRouteInfo->info["user_address"] = $accountId;
							$tempRouteInfo->info["route"] = $jorudanInfo->details[0]->sectionFrom."～".$jorudanInfo->details[$jorudanInfo->transferNum ]->sectionTo;
							replaceText($jorudanInfo->date,"\(.*","");
							$tempRouteInfo->info["route_date"] = date("Y")."/".$jorudanInfo->date;
							$tempRouteInfo->info["price"] = $jorudanInfo->amountPrice;
							if( false == DB_SP_setTempRouteInfo_JorudanInfo($tempRouteInfo) ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed to save JorudanInfo into DB..");
								//ユーザーへ通知
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"予期せぬエラーが発生しました。開発者へ連絡してください。");
								break;
							}

							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::REGIST_INPUT_DIST;
							DB_SP_setUserStatus($userStatusInfo);
							break;
						case MA_MessageKind::SELECT_MENU:
							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::SELECT_MENU;
							DB_SP_setUserStatus($userStatusInfo);
							break;
						default:
							DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Invalid Input.");
							//ユーザーへ通知（入力は無効である）
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
								"無効な入力です。\n".
								"「メニュー」を送信するか、ジョルダン案内情報の内容をコピペしてください。");
							break;
					}
				}while(false);

				return true;
			}

		/* REGIST_INPUT_DIST Funcs */
			private function RecvEventContent_S02E00($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S02E00()).");
				//LineWorks クライアントの作成
				$client = new LineWorksReqs();
				//Server Token 取得
				$serverTokenInfo = new DBSP_GetServerTokenStruct();
				DB_SP_getServerToken($serverTokenInfo);

				//メッセージを送付したいユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					//文字数チェック
					$tmplen = mb_strlen($recvData->propaty["content"]["text"]);
					if(DIST_STR_MIN > $tmplen || DIST_STR_MAX < $tmplen){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Invalid Input.");
						//ユーザーへ通知（入力は無効である）
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
							"無効な入力です。\n".
							"目的地は".DIST_STR_MIN."～".DIST_STR_MAX."文字以内となるよう再度入力してください。");
						break;
					}
					//TODO 以下テスト用 本運用時は削除すること
					$tmpArray = $recvData->propaty["content"]["text"];
					$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"デバッグ情報\n".
						"入力された目的地は".$tmpArray);

					//DBへ一時データ保存
					$tempRouteInfo = new DBSP_SetTempRouteInfo_DestinationStruct();
					$tempRouteInfo->info["user_address"] = $accountId;
					$tempRouteInfo->info["destination"] = $recvData->propaty["content"]["text"];
					DB_SP_setTempRouteInfo_Destination($tempRouteInfo);

					//状態更新
					$userStatusInfo = new DBSP_SetUserStatusStruct();
					$userStatusInfo->info["user_address"] = $accountId;
					$userStatusInfo->info["status"] = Enum_CallBack_userState::REGIST_INPUT_DEMAND;
					DB_SP_setUserStatus($userStatusInfo);
				}while(false);
				return true;
			}

		/* REGIST_INPUT_DEMAND Funcs */
			private function RecvEventContent_S03E00($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S03E00()).");
				//LineWorks クライアントの作成
				$client = new LineWorksReqs();
				//Server Token 取得
				$serverTokenInfo = new DBSP_GetServerTokenStruct();
				DB_SP_getServerToken($serverTokenInfo);

				//メッセージを送付したいユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					//ボタンによる応答かチェック
					$bitFlags = MessageAnalyser::getPostbackKind($recvData);
					if(  !(getBitFlagState($bitFlags, MA_PostbackKind::REQUEST_TO_IN_HOUSE)
							|| getBitFlagState($bitFlags, MA_PostbackKind::REQUEST_TO_USER)
						   ) )
					{
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Invalid Input.");
						//ユーザーへ通知（入力は無効である）
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
							"無効な入力です。\n".
							"ボタンで選択するようにしてください。");
						break;
					}

					//TODO 以下テスト用 本運用時は削除すること
					$tmpArray = $recvData->propaty["content"]["postback"];
					$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"デバッグ情報\n".
						"入力された請求先は".$tmpArray);

					//DBへ一時データ保存
					$tempRouteInfo = new DBSP_SetTempRouteInfo_UserPriceStruct();
					$tempRouteInfo->info["user_address"] = $accountId;
					if(MA_MessagePostbackList::REQUEST_TO_USER == $recvData->propaty["content"]["postback"]){
						$tempRouteInfo->info["user_price"] = TRUE;
					}else{
						$tempRouteInfo->info["user_price"] = FALSE;
					}
					DB_SP_setTempRouteInfo_UserPrice($tempRouteInfo);

					//状態更新
					$userStatusInfo = new DBSP_SetUserStatusStruct();
					$userStatusInfo->info["user_address"] = $accountId;
					$userStatusInfo->info["status"] = Enum_CallBack_userState::REGIST_INPUT_ROUND;
					DB_SP_setUserStatus($userStatusInfo);
				}while(false);
				return true;
			}

		/* REGIST_INPUT_ROUND Funcs */
			private function RecvEventContent_S04E00($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S04E00()).");
				//LineWorks クライアントの作成
				$client = new LineWorksReqs();
				//Server Token 取得
				$serverTokenInfo = new DBSP_GetServerTokenStruct();
				DB_SP_getServerToken($serverTokenInfo);

				//メッセージを送付したいユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					//ボタンによる応答かチェック
					$bitFlags = MessageAnalyser::getPostbackKind($recvData);
					if(  !(getBitFlagState($bitFlags, MA_PostbackKind::ONE_WAY)
						|| getBitFlagState($bitFlags, MA_PostbackKind::ROUND_TRIP)
						) )
					{
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Invalid Input.");
						//ユーザーへ通知（入力は無効である）
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
							"無効な入力です。\n".
							"ボタンで選択するようにしてください。");
						break;
					}

					//TODO 以下テスト用 本運用時は削除すること
					$tmpArray = $recvData->propaty["content"]["postback"];
					$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"デバッグ情報\n".
						"入力された経路は".$tmpArray);

					//DBへ一時データ保存
					$tempRouteInfo = new DBSP_SetTempRouteInfo_RoundsStruct();
					$tempRouteInfo->info["user_address"] = $accountId;
					if(MA_MessagePostbackList::ROUND_TRIP == $recvData->propaty["content"]["postback"]){
						$tempRouteInfo->info["rounds"] = TRUE;
					}else{
						$tempRouteInfo->info["rounds"] = FALSE;
					}
					DB_SP_setTempRouteInfo_Rounds($tempRouteInfo);

					//状態更新
					$userStatusInfo = new DBSP_SetUserStatusStruct();
					$userStatusInfo->info["user_address"] = $accountId;
					$userStatusInfo->info["status"] = Enum_CallBack_userState::REGIST_INPUT_REMARK;
					DB_SP_setUserStatus($userStatusInfo);
				}while(false);
				return true;
			}

		/* REGIST_INPUT_REMARK Funcs */
			private function RecvEventContent_S05E00($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S05E00()).");
				//LineWorks クライアントの作成
				$client = new LineWorksReqs();
				//Server Token 取得
				$serverTokenInfo = new DBSP_GetServerTokenStruct();
				DB_SP_getServerToken($serverTokenInfo);

				//メッセージを送付したいユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					//文字数チェック
					$tmplen = mb_strlen($recvData->propaty["content"]["text"]);
					if(REMARK_STR_MIN > $tmplen || REMARK_STR_MAX < $tmplen){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[WARN]Invalid Input.");
						//ユーザーへ通知（入力は無効である）
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
							"無効な入力です。\n".
							"備考は".REMARK_STR_MIN."～".REMARK_STR_MAX."文字以内となるよう再度入力してください。");
						break;
					}
					//TODO 以下テスト用 本運用時は削除すること
					$tmpArray = $recvData->propaty["content"]["text"];
					$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"デバッグ情報\n".
						"入力された備考は".$tmpArray);

					//DBへ一時データ保存
					$tempRouteInfo = new DBSP_SetTempRouteInfo_RemarksStruct();
					$tempRouteInfo->info["user_address"] = $accountId;
					$tempRouteInfo->info["remarks"] = $recvData->propaty["content"]["text"];
					DB_SP_setTempRouteInfo_Remarks($tempRouteInfo);

					//状態更新
					$userStatusInfo = new DBSP_SetUserStatusStruct();
					$userStatusInfo->info["user_address"] = $accountId;
					$userStatusInfo->info["status"] = Enum_CallBack_userState::REGIST_INPUT_CONF;
					DB_SP_setUserStatus($userStatusInfo);
				}while(false);
				return true;
			}

		/* REGIST_INPUT_CONF Funcs */
			private function RecvEventContent_S06E00($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S06E00()).");
				//LineWorks クライアントの作成
				$client = new LineWorksReqs();
				//Server Token 取得
				$serverTokenInfo = new DBSP_GetServerTokenStruct();
				DB_SP_getServerToken($serverTokenInfo);

				//メッセージを送付したいユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					//ボタンによる応答かチェック
					$bitFlags = MessageAnalyser::getPostbackKind($recvData);
					if(  !(getBitFlagState($bitFlags, MA_PostbackKind::APPLY)
						|| getBitFlagState($bitFlags, MA_PostbackKind::CANCEL)
						) )
					{
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Invalid Input.");
						//ユーザーへ通知（入力は無効である）
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
							"無効な入力です。\n".
							"ボタンで選択するようにしてください。");
						break;
					}

					//TODO 以下テスト用 本運用時は削除すること
					$tmpArray = $recvData->propaty["content"]["postback"];
					$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"デバッグ情報\n".
						"入力された選択は".$tmpArray);

					if(MA_MessagePostbackList::APPLY == $recvData->propaty["content"]["postback"]){
						//一時データを正式なデータとしてDBへ保存
						$tempRouteInfo = new DBSP_AddRouteInfoStruct();
						$tempRouteInfo->info["user_address"] = $accountId;
						if( false == DB_SP_addRouteInfo($tempRouteInfo) ){
							DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed add RouteInfo.");
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
								"予期せぬエラーが発生しました。開発者へ連絡してください。");
							break;
						}
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"登録しました。");
					}else{
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"登録をキャンセルしました。");
					}

					//状態更新
					$userStatusInfo = new DBSP_SetUserStatusStruct();
					$userStatusInfo->info["user_address"] = $accountId;
					$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
					DB_SP_setUserStatus($userStatusInfo);
				}while(false);
				return true;
			}

		/* SELECT_MENU Funcs */
			private function RecvEventContent_S07E00($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S07E00()).");
				//LineWorks クライアントの作成
				$client = new LineWorksReqs();
				//Server Token 取得
				$serverTokenInfo = new DBSP_GetServerTokenStruct();
				DB_SP_getServerToken($serverTokenInfo);

				//メッセージを送付したいユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					$postbackKind = MessageAnalyser::getPostbackKind($recvData);
					switch ($postbackKind){
						case MA_PostbackKind::ONE_DELETE:
							//TODO データの有無を確認

							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::DELETE_SELECT_ID;
							DB_SP_setUserStatus($userStatusInfo);
							break;
						case MA_PostbackKind::PETITION:
							//TODO データの有無を確認

							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::PETITION_CONF;
							DB_SP_setUserStatus($userStatusInfo);
							break;
						case MA_PostbackKind::CANCEL:
							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
							DB_SP_setUserStatus($userStatusInfo);
						default:
							DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Invalid Input.");
							//ユーザーへ通知（入力は無効である）
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
								"無効な入力です。\n".
								"ボタンのいずれかを選択してください。");
							break;
					}
				}while(false);

				return true;
			}


		/* DELETE_SELECT_ID Funcs */
			private function RecvEventContent_S08E00($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S08E00()).");
				//LineWorks クライアントの作成
				$client = new LineWorksReqs();
				//Server Token 取得
				$serverTokenInfo = new DBSP_GetServerTokenStruct();
				DB_SP_getServerToken($serverTokenInfo);

				//メッセージを送付したいユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					$messageKind = MessageAnalyser::getMessageKind($recvData);
					switch ($messageKind){
						case MA_MessageKind::NUMBER:
							//TODO 対象IDのデータの削除対象フラグを設定(データ自体が存在するかも確認すること)

							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::DELETE_CONF;
							DB_SP_setUserStatus($userStatusInfo);
							break;
						default:
							DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Invalid Input.");
							//ユーザーへ通知（入力は無効である）
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
								"無効な入力です。\n".
								"一件削除の処理を終了します。");

							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
							DB_SP_setUserStatus($userStatusInfo);
							break;
					}
				}while(false);

				return true;
			}


		/* DELETE_CONF Funcs */
			private function RecvEventContent_S09E00($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S09E00()).");
				//LineWorks クライアントの作成
				$client = new LineWorksReqs();
				//Server Token 取得
				$serverTokenInfo = new DBSP_GetServerTokenStruct();
				DB_SP_getServerToken($serverTokenInfo);

				//メッセージを送付したいユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					$postbackKind = MessageAnalyser::getPostbackKind($recvData);
					switch ($postbackKind){
						case MA_PostbackKind::APPLY:
							//TODO 対象IDのデータの削除を行う

							//ユーザーへ通知
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
							"指定されたデータを削除しました。");

							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
							DB_SP_setUserStatus($userStatusInfo);
							break;
						case MA_PostbackKind::CANCEL:
							//ユーザーへ通知
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
							"処理を取り消しました。");

							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
							DB_SP_setUserStatus($userStatusInfo);
							break;
						default:
							DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Invalid Input.");
							//ユーザーへ通知（入力は無効である）
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
								"無効な入力です。\n".
								"ボタンの何れかを選択してください。");
							break;
					}
				}while(false);

				return true;
			}


		/* PETITION_CONF Funcs */
			private function RecvEventContent_S10E00($recvData):bool{
				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]state event called(RecvEventContent_S10E00()).");
				//LineWorks クライアントの作成
				$client = new LineWorksReqs();
				//Server Token 取得
				$serverTokenInfo = new DBSP_GetServerTokenStruct();
				DB_SP_getServerToken($serverTokenInfo);

				//メッセージを送付したいユーザーアカウントを取得
				$accountId = $recvData->baseInfo["source"]["accountId"];
				do{
					$postbackKind = MessageAnalyser::getPostbackKind($recvData);
					switch ($postbackKind){
						case MA_PostbackKind::APPLY:
							//TODO データ全てを申請する（未申請のもののみ）

							//ユーザーへ通知
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
							"申請を完了しました");

							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
							DB_SP_setUserStatus($userStatusInfo);
							break;
						case MA_PostbackKind::CANCEL:
							//ユーザーへ通知（入力は無効である）
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
							"処理を取り消しました。");

							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
							DB_SP_setUserStatus($userStatusInfo);
							break;
						default:
							DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Invalid Input.");
							//ユーザーへ通知（入力は無効である）
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
								"無効な入力です。\n".
								"ボタンの何れかを選択してください。");
							break;
					}
				}while(false);

				return true;
			}
}





















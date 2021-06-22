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
require_once 'DB/DB_Storedprocedures/DB_SP_DelFunctions.php';

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
							$tmpArray = "デバッグ情報\n".$tmpArray;
							if(strlen("デバッグ情報\n"."入力された経路は".$tmpArray) > MESSAGE_MAX_LEN_SERVER_TO_USER){
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"メッセージとして送信できる最大文字数".
									MESSAGE_MAX_LEN_SERVER_TO_USER."文字を超えたため、デバッグ情報の出力を省略します。");
							}else{
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],$tmpArray);
							}

							//DBへ一時データ保存
							$tempRouteInfo = new DBSP_SetTempRouteInfo_JorudanInfoStruct();
							$tempRouteInfo->info["user_address"] = $accountId;
							//$tempRouteInfo->info["route"] = $jorudanInfo->details[0]->sectionFrom."～".$jorudanInfo->details[$jorudanInfo->transferNum ]->sectionTo;
							$tempRouteInfo->info["route"] = $jorudanInfo->sectionFrom."～".$jorudanInfo->sectionTo;
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
					//キャンセルの場合MAIN_MENUへ戻る
					if(MA_MessageTextList::CANCEL_KANA == $recvData->propaty["content"]["text"]){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Cancel sequence.");
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"処理を中断しました");

						//状態更新
						$userStatusInfo = new DBSP_SetUserStatusStruct();
						$userStatusInfo->info["user_address"] = $accountId;
						$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
						DB_SP_setUserStatus($userStatusInfo);
						break;
					}

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
					//キャンセルの場合MAIN_MENUへ戻る
					if(MA_MessageTextList::CANCEL_KANA == $recvData->propaty["content"]["text"]){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Cancel sequence.");
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"処理を中断しました");

						//状態更新
						$userStatusInfo = new DBSP_SetUserStatusStruct();
						$userStatusInfo->info["user_address"] = $accountId;
						$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
						DB_SP_setUserStatus($userStatusInfo);
						break;
					}

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
					$tempPrice = new DBSP_GetTempRouteInfo_PriceStruct();
					if(false == DB_SP_getTempRouteInfo_price($accountId ,$tempPrice) ){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Faild to get amount price from temp route info.");
						//ユーザーへ通知（DBからpriceの取得失敗）
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
							"予期せぬエラーが発生しました。開発者へ連絡してください。");
						break;
					}

					$tempRouteInfo = new DBSP_SetTempRouteInfo_UserPriceStruct();
					$tempRouteInfo->info["user_address"] = $accountId;
					if(MA_MessagePostbackList::REQUEST_TO_USER == $recvData->propaty["content"]["postback"]){
						$tempRouteInfo->info["user_price"] = $tempPrice->info["price"];
					}else{
						$tempRouteInfo->info["user_price"] = 0;
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
					//キャンセルの場合MAIN_MENUへ戻る
					if(MA_MessageTextList::CANCEL_KANA == $recvData->propaty["content"]["text"]){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Cancel sequence.");
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"処理を中断しました");

						//状態更新
						$userStatusInfo = new DBSP_SetUserStatusStruct();
						$userStatusInfo->info["user_address"] = $accountId;
						$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
						DB_SP_setUserStatus($userStatusInfo);
						break;
					}

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
					//キャンセルの場合MAIN_MENUへ戻る
					if(MA_MessageTextList::CANCEL_KANA == $recvData->propaty["content"]["text"]){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Cancel sequence.");
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"処理を中断しました");

						//状態更新
						$userStatusInfo = new DBSP_SetUserStatusStruct();
						$userStatusInfo->info["user_address"] = $accountId;
						$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
						DB_SP_setUserStatus($userStatusInfo);
						break;
					}

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
					//キャンセルの場合MAIN_MENUへ戻る
					if(MA_MessageTextList::CANCEL_KANA == $recvData->propaty["content"]["text"]){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Cancel sequence.");
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"処理を中断しました");

						//状態更新
						$userStatusInfo = new DBSP_SetUserStatusStruct();
						$userStatusInfo->info["user_address"] = $accountId;
						$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
						DB_SP_setUserStatus($userStatusInfo);
						break;
					}

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
						//一時データをクリア
						$tempRouteInfo = new DBSP_SetTempRouteInfo_ClearJorudanInfoStruct();
						$tempRouteInfo->info["user_address"] = $accountId;
						if( false == DB_SP_setTempRouteInfo_CrearJorudanInfo($tempRouteInfo) ){
							DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed clear tempRouteInfo.");
							$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
								"予期せぬエラーが発生しました。開発者へ連絡してください。");
							break;
						}
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
							//データの有無を確認
							$existInfo = new DBSP_GetIsRouteInfoExistStruct();
							if( false == DB_SP_getIsRouteInfoExist($accountId, $existInfo) ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed is RouteInfo exist.");
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"予期せぬエラーが発生しました。開発者へ連絡してください。");
								break;
							}
							if( false == $existInfo->info["GetIsRouteInfoExist"] ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]RouteInfo is exist.");
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"削除可能なIDが存在しません。\n使用する機能を再度選択してください。");
								break;
							}

							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							$userStatusInfo->info["status"] = Enum_CallBack_userState::DELETE_SELECT_ID;
							DB_SP_setUserStatus($userStatusInfo);
							break;
						case MA_PostbackKind::PETITION:
							// データの有無を確認
							$existInfo = new DBSP_GetIsNotRequestedRouteInfoExistByApplicationStruct();
							if( false == DB_SP_getIsNotRequestedRouteInfoExistByApplication($accountId, $existInfo) ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed is RouteInfo exist.");
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"予期せぬエラーが発生しました。開発者へ連絡してください。");
								break;
							}
							if( false == $existInfo->info["GetIsNotRequestedRouteInfoExistByApplication"] ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]RouteInfo is not exist.");
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"申請可能なIDが存在しません。\n使用する機能を再度選択してください。");
								break;
							}
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
							break;
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
					//キャンセルの場合MAIN_MENUへ戻る
					if(MA_MessageTextList::CANCEL_KANA == $recvData->propaty["content"]["text"]){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Cancel sequence.");
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"処理を中断しました");

						//状態更新
						$userStatusInfo = new DBSP_SetUserStatusStruct();
						$userStatusInfo->info["user_address"] = $accountId;
						$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
						DB_SP_setUserStatus($userStatusInfo);
						break;
					}

					$messageKind = MessageAnalyser::getMessageKind($recvData);
					switch ($messageKind){
						case MA_MessageKind::NUMBER:
							$abordFlag = false;
							//データ自体が存在するか確認
							$route_no = $recvData->propaty["content"]["text"];
							$existInfo = new DBSP_GetIsRouteInfoExistByRouteNoStruct();
							if( false == DB_SP_getIsRouteInfoExistByRouteNo($accountId, $route_no, $existInfo) ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed is RouteInfo exist by route no.");
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"予期せぬエラーが発生しました。開発者へ連絡してください。");
								break;
							}
							if( false == $existInfo->info["GetIsRouteInfoExistByRouteNo"] ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]RouteInfo is not exist by route no.");
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"Noが存在しません\n処理を中断します");
									$abordFlag = true;
								//break;
							}else{
								$setInfo = new DBSP_SetSelectedDeleteRouteInfoStruct();
								$setInfo->info["user_address"] = $accountId;
								$setInfo->info["route_no"] = $route_no;
								if ( false == DB_SP_setSelectedDeleteRouteInfo($setInfo) ){
									DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed is RouteInfo exist by route no.");
									$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
										"予期せぬエラーが発生しました。開発者へ連絡してください。");
									break;
								}



							}


							//状態更新
							$userStatusInfo = new DBSP_SetUserStatusStruct();
							$userStatusInfo->info["user_address"] = $accountId;
							if ( true == $abordFlag ){
								$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
							}else{
								$userStatusInfo->info["status"] = Enum_CallBack_userState::DELETE_CONF;
							}
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
					//キャンセルの場合MAIN_MENUへ戻る
					if(MA_MessageTextList::CANCEL_KANA == $recvData->propaty["content"]["text"]){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Cancel sequence.");
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"処理を中断しました");

						//状態更新
						$userStatusInfo = new DBSP_SetUserStatusStruct();
						$userStatusInfo->info["user_address"] = $accountId;
						$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
						DB_SP_setUserStatus($userStatusInfo);
						break;
					}

					$postbackKind = MessageAnalyser::getPostbackKind($recvData);
					switch ($postbackKind){
						case MA_PostbackKind::APPLY:
							//対象IDのデータの削除を行う
							$selectedNo = new DBSP_GetSelectedDeleteRouteInfoStruct();
							if( false == DB_SP_getSelectedDeleteRouteInfo($accountId,$selectedNo) ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed to get selected delete RouteInfo.");
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"予期せぬエラーが発生しました。開発者へ連絡してください。");
								break;
							}
							$delInfo = new DBSP_DelRouteInfoByRouteNoStruct();
							$delInfo->info["user_address"]	= $accountId;
							$delInfo->info["route_no"]	= $selectedNo->info["selected_delete_route_info"];
							if( false == DB_SP_delRouteInfoByRouteNo($delInfo) ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed delete RouteInfo by route no.");
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"予期せぬエラーが発生しました。開発者へ連絡してください。");
								break;
							}
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
					//キャンセルの場合MAIN_MENUへ戻る
					if(MA_MessageTextList::CANCEL_KANA == $recvData->propaty["content"]["text"]){
						DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]Cancel sequence.");
						$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],"処理を中断しました");

						//状態更新
						$userStatusInfo = new DBSP_SetUserStatusStruct();
						$userStatusInfo->info["user_address"] = $accountId;
						$userStatusInfo->info["status"] = Enum_CallBack_userState::MAIN_MENU;
						DB_SP_setUserStatus($userStatusInfo);
						break;
					}

					$postbackKind = MessageAnalyser::getPostbackKind($recvData);
					switch ($postbackKind){
						case MA_PostbackKind::APPLY:
							//データ全てを申請する（未申請のもののみ）
							$routeInfos = new DBSP_GetNotRequestedRouteInfosByApplicationStruct;
							if( false == DB_SP_getNotRequestedRouteInfoByApplication($accountId, $routeInfos) ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed to get not requested RouteInfo.");
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"予期せぬエラーが発生しました。開発者へ連絡してください。");
								break;
							}
							//清算書番号の左側４桁(年月)と右４桁（連番）を取得する
							$docs_Ym = 0;
							$docs_Num = 0;
							if ( false == self::getSettableDocsId($accountId,$docs_Ym,$docs_Num) ){
								DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed to get docs_id");
								$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
									"予期せぬエラーが発生しました。開発者へ連絡してください。");
								break;
							}

							$errorFlag = false;
							DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"debug routInfos=",$routeInfos);
							foreach ($routeInfos->info as $routeInfo){
								$setInfo = new DBSP_SetRouteInfo_DocsIdStruct();
								$setInfo->info["user_address"] = $accountId;
								$setInfo->info["route_no"] = $routeInfo->route_no;
								$applicationDate = new DateTime("now");
								$setInfo->info["application_date"] = $applicationDate->format("Y/m/d");
								$setInfo->info["docs_id"] = sprintf("%04d%04d",$docs_Ym,$docs_Num);
								if( false == DB_SP_setRouteInfo_DocsId($setInfo) ){
									DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Failed to applicate not requested RouteInfo.RouteInfo=".$setInfo);
									$client->SendMessageReq($accountId,$serverTokenInfo->info["token"],
										"予期せぬエラーが発生しました。開発者へ連絡してください。");
									$errorFlag = true;
									break;
								}
								$docs_Num = $docs_Num + 1;
							}
							if(true == $errorFlag){break;}

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

			private function getSettableDocsId(string $user_address, int &$docs_Ym, int &$docs_Num):bool{

				$currentDate = new datetime("now");
				$currentDateNum = (int)$currentDate->format("ym");

				$docs_Ym = $currentDateNum;
				$docs_Num = 1;

				$docs_ids = new DBSP_GetDocsMS_DocsIDsStruct();
				if( false == DB_SP_GetDocsMS_DocsIDs($user_address, $docs_ids)){
					return false;
				}

				DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"debug docs_ids=",$docs_ids);
				foreach( $docs_ids->info as $docs_id ){
					DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"debug docs_id=",$docs_id);
					$tmpDocsIdStr = sprintf("%08d",$docs_id->docs_id);
					$cmpNum = (int)left($tmpDocsIdStr,4);
					if( $currentDateNum == $cmpNum ){
						$tmpNum = right($tmpDocsIdStr, 4);
						if ( $tmpNum >=  $docs_Num ){
							$docs_Num = $tmpNum + 1;
						}
					}
				}
				return true;
			}
}

<?php
require_once 'LineWorks/LineWorksHTTPSReqs.php';
require_once 'LineWorks/LineWorksHTTPSResiesJsonStructs.php';

class StateChangeMessage{
	public function StateChangeMessageCaller(string $funcStr,$recvData):bool{
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

	/* BeforeState = Enum_CallBack_userState *//* AfterState = Enum_CallBack_userState */
	public $stateChangeMessageTable = Array(
		/* USER_JUST_REGISTED */
		Enum_CallBack_userState::USER_JUST_REGISTED => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		),
		/* MAIN_MENU */
		Enum_CallBack_userState::MAIN_MENU => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_B1A2',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_B1A7',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		),
		/* REGIST_INPUT_DIST */
		Enum_CallBack_userState::REGIST_INPUT_DIST => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_B2A3',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		),
		/* REGIST_INPUT_DEMAND */
		Enum_CallBack_userState::REGIST_INPUT_DEMAND => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_B3A4',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		),
		/* REGIST_INPUT_ROUND */
		Enum_CallBack_userState::REGIST_INPUT_ROUND => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_B4A5',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		),
		/* REGIST_INPUT_REMARK */
		Enum_CallBack_userState::REGIST_INPUT_REMARK => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_B5A6',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		),
		/* REGIST_INPUT_CONF */
		Enum_CallBack_userState::REGIST_INPUT_CONF => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		),
		/* SELECT_MENU */
		Enum_CallBack_userState::SELECT_MENU => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_B7A8',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		),
		/* DELETE_SELECT_ID */
		Enum_CallBack_userState::DELETE_SELECT_ID => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_B8A9',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		),
		/* DELETE_CONF */
		Enum_CallBack_userState::DELETE_CONF => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		),
		/* PETITION_CONF */
		Enum_CallBack_userState::PETITION_CONF => Array(
			Enum_CallBack_userState::USER_JUST_REGISTED		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::MAIN_MENU				=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DIST		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_DEMAND	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_ROUND		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_REMARK	=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::REGIST_INPUT_CONF		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_Nope'
		)
	);
	private function ChangeMessage_Nope(CallBackStruct $recvData):bool{
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]stateChangeMessageTable func called.");
		return true;
	}

	private function ChangeMessage_B1A2(CallBackStruct $recvData):bool{
		$ret = false;
		//ユーザーアドレスを取得
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks クライアントの作成
		$client = new LineWorksReqs();
		//Server Token 取得
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);
		$ret = $client->SendMessageReq($userAddress,$serverTokenInfo->info["token"],
				"行先を入力してください");
		return $ret;
	}

	private function ChangeMessage_B1A7(CallBackStruct $recvData):bool{
		//ユーザーアドレスを取得
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks クライアントの作成
		$client = new LineWorksReqs();
		//Server Token 取得
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//ヘッダー設定
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//プロパティー設定
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			$tmpStr = "機能メニュー\n".
				"----------------------------------------\n";
			//DBからRouteInfoを取得
			$routeInfos = new DBSP_GetRouteInfosStruct();
			DB_SP_getRouteInfo($userAddress,$routeInfos);
			$amountPrice = 0;
			foreach( $routeInfos->info as $index => $value ){
				if( 0 == $index ){
					$tmpStr = $tmpStr."登録済み経路一覧\n";
				}
				$route_no		= $value->route_no;
				$date = new DateTime($value->route_date);
				$route_date = $date->format("m/d");
				$destination	= $value->destination;
				$route			= $value->route;
				$rounds			= "";
				if( true == $value->rounds ){ $rounds = "復"; }
				$price			= $value->price;
				$user_price = "";
				if( true == $value->user_price ){ $user_price = "仮"; }
				$routeInfo = sprintf("[%3d]%5s %22s\n     %-18s %1s%1s \n                             ￥%5d\n",
										$route_no,
										$route_date,
										$destination,
										$route,
										$user_price,
										$rounds,
										$price
									);

				$tmpStr = $tmpStr.$routeInfo;
				$amountPrice = $amountPrice + $price;
			}

			if( 0 < $amountPrice ){
				$amountPriceStr = sprintf("%s\n%s￥%5s\n","                              ----------","                             ",$amountPrice);
				$tmpStr = $tmpStr.$amountPriceStr;
			}
			$tmpStr = $tmpStr."----------------------------------------\n";

			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = $tmpStr;
			$tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
			$tmpAction_PostbackStructArray[0]->propaty["label"] = MA_MessageTextList::ONE_DELETE;
			$tmpAction_PostbackStructArray[0]->propaty["text"] = MA_MessageTextList::ONE_DELETE;
			$tmpAction_PostbackStructArray[0]->propaty["postback"] = MA_MessagePostbackList::ONE_DELETE;
			$tmpAction_PostbackStructArray[1]->propaty["label"] = MA_MessageTextList::PETITION;
			$tmpAction_PostbackStructArray[1]->propaty["text"] = MA_MessageTextList::PETITION;
			$tmpAction_PostbackStructArray[1]->propaty["postback"] = MA_MessagePostbackList::PETITION;
			$tmpAction_PostbackStructArray[2]->propaty["label"] = "キャンセル";
			$tmpAction_PostbackStructArray[2]->propaty["text"] = "キャンセル";
			$tmpAction_PostbackStructArray[2]->propaty["postback"] = MA_MessagePostbackList::CANCEL;
			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpAction_PostbackStructArray = ",$tmpAction_PostbackStructArray);
			//
			$tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
				$tmpAction_PostbackStructArray[1]->propaty,
				$tmpAction_PostbackStructArray[2]->propaty);
			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpMessage_ButtonTemplateStruct->propaty[\"actions\"] = ",$tmpMessage_ButtonTemplateStruct->propaty["actions"]);
			$reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
			//プロパティーのJSONエンコード
			$propaty = json_encode($reqStruct->propaty);
		}

		//リクエストの送信
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//応答が得られた場合
			//応答JSONを連想配列にデコード
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//リクエストが出来なかった場合
			//TODO 何かしらのエラー処理
		}

		return $ret;
	}

	private function ChangeMessage_B2A3(CallBackStruct $recvData):bool{
		//ユーザーアドレスを取得
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks クライアントの作成
		$client = new LineWorksReqs();
		//Server Token 取得
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//ヘッダー設定
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//プロパティー設定
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = "ユーザー請求で登録しますか？";
			$tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
			$tmpAction_PostbackStructArray[0]->propaty["label"] = MA_MessageTextList::REQUEST_TO_USER;
			$tmpAction_PostbackStructArray[0]->propaty["text"] = MA_MessageTextList::REQUEST_TO_USER;
			$tmpAction_PostbackStructArray[0]->propaty["postback"] = MA_MessagePostbackList::REQUEST_TO_USER;
			$tmpAction_PostbackStructArray[1]->propaty["label"] = MA_MessageTextList::REQUEST_TO_IN_HOUSE;
			$tmpAction_PostbackStructArray[1]->propaty["text"] = MA_MessageTextList::REQUEST_TO_IN_HOUSE;
			$tmpAction_PostbackStructArray[1]->propaty["postback"] = MA_MessagePostbackList::REQUEST_TO_IN_HOUSE;
			$tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
																		$tmpAction_PostbackStructArray[1]->propaty);
			$reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
			//プロパティーのJSONエンコード
			$propaty = json_encode($reqStruct->propaty);
		}

		//リクエストの送信
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//応答が得られた場合
			//応答JSONを連想配列にデコード
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//リクエストが出来なかった場合
			//TODO 何かしらのエラー処理
		}

		return $ret;
	}

	private function ChangeMessage_B3A4(CallBackStruct $recvData):bool{
		//ユーザーアドレスを取得
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks クライアントの作成
		$client = new LineWorksReqs();
		//Server Token 取得
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//ヘッダー設定
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//プロパティー設定
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = "往復経路で登録しますか？";
			$tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
			$tmpAction_PostbackStructArray[0]->propaty["label"] = MA_MessageTextList::ROUND_TRIP;
			$tmpAction_PostbackStructArray[0]->propaty["text"] = MA_MessageTextList::ROUND_TRIP;
			$tmpAction_PostbackStructArray[0]->propaty["postback"] = MA_MessagePostbackList::ROUND_TRIP;
			$tmpAction_PostbackStructArray[1]->propaty["label"] = MA_MessageTextList::ONE_WAY;
			$tmpAction_PostbackStructArray[1]->propaty["text"] = MA_MessageTextList::ONE_WAY;
			$tmpAction_PostbackStructArray[1]->propaty["postback"] = MA_MessagePostbackList::ONE_WAY;
			$tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
				$tmpAction_PostbackStructArray[1]->propaty);
			$reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
			//プロパティーのJSONエンコード
			$propaty = json_encode($reqStruct->propaty);
		}

		//リクエストの送信
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//応答が得られた場合
			//応答JSONを連想配列にデコード
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//リクエストが出来なかった場合
			//TODO 何かしらのエラー処理
		}

		return $ret;
	}

	private function ChangeMessage_B4A5(CallBackStruct $recvData):bool{
		$ret = false;
		//ユーザーアドレスを取得
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks クライアントの作成
		$client = new LineWorksReqs();
		//Server Token 取得
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);
		$ret = $client->SendMessageReq($userAddress,$serverTokenInfo->info["token"],
			"備考があれば入力してください");
		return $ret;
	}

	private function ChangeMessage_B5A6(CallBackStruct $recvData):bool{
		//ユーザーアドレスを取得
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks クライアントの作成
		$client = new LineWorksReqs();
		//Server Token 取得
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//ヘッダー設定
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//プロパティー設定
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			//DBからTEMP_ROUTE_INFOを取得
			$tempRouteInfo = new DBSP_GetTempRouteInfoStruct();
			DB_SP_getTempRouteInfo($userAddress, $tempRouteInfo);

			$date = new DateTime($tempRouteInfo->info["route_date"]);
			$route_date = $date->format("m/d");
			$destination = $tempRouteInfo->info["destination"];
			$route = $tempRouteInfo->info["route"];
			if(  true == $tempRouteInfo->info["rounds"] ){
				$rounds = "あり";
			}else{
				$rounds = "なし";
			}
			$price = $tempRouteInfo->info["price"];
			if( true == $tempRouteInfo->info["user_price"] ){
				$user_price = $price;
			}else{
				$user_price = 0;
			}
			$remarks = $tempRouteInfo->info["remarks"];
			$tmpStr = sprintf("乗車日%20s\n行先%22s\n経路%22s\n往復の有無%16s\n合計運賃%18s円\nユーザー請求額%12s円\n備考%22s\n",
								$route_date,
								$destination,
								$route,
								$rounds,
								$price,
								$user_price,
								$remarks
							);
			$tmpStr = $tmpStr."----------------------------------------\n"."以上の内容を登録しますか？";

			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = $tmpStr;
			$tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
			$tmpAction_PostbackStructArray[0]->propaty["label"] = MA_MessageTextList::APPLY;
			$tmpAction_PostbackStructArray[0]->propaty["text"] = MA_MessageTextList::APPLY;
			$tmpAction_PostbackStructArray[0]->propaty["postback"] = MA_MessagePostbackList::APPLY;
			$tmpAction_PostbackStructArray[1]->propaty["label"] = MA_MessageTextList::CANCEL;
			$tmpAction_PostbackStructArray[1]->propaty["text"] = MA_MessageTextList::CANCEL;
			$tmpAction_PostbackStructArray[1]->propaty["postback"] = MA_MessagePostbackList::CANCEL;
			$tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
				$tmpAction_PostbackStructArray[1]->propaty);
			$reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
			//プロパティーのJSONエンコード
			$propaty = json_encode($reqStruct->propaty);
		}

		//リクエストの送信
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//応答が得られた場合
			//応答JSONを連想配列にデコード
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//リクエストが出来なかった場合
			//TODO 何かしらのエラー処理
		}

		return $ret;
	}

	private function ChangeMessage_B7A8(CallBackStruct $recvData):bool{
		$ret = false;
		//ユーザーアドレスを取得
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks クライアントの作成
		$client = new LineWorksReqs();
		//Server Token 取得
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);
		$ret = $client->SendMessageReq($userAddress,$serverTokenInfo->info["token"],
			"削除する経路データの番号を入力してください");
		return $ret;
	}

	private function ChangeMessage_B8A9(CallBackStruct $recvData):bool{
		//ユーザーアドレスを取得
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks クライアントの作成
		$client = new LineWorksReqs();
		//Server Token 取得
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//ヘッダー設定
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//プロパティー設定
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			//DBからROUTE_INFOを取得
			$RouteInfo = new DBSP_GetRouteInfoByRouteNoStruct();
			DB_SP_getRouteInfoByRouteNo($userAddress, $recvData->propaty["content"]["text"], $RouteInfo);

			$date = new DateTime($RouteInfo->info["route_date"]);
			$route_date = $date->format("m/d");
			$destination = $RouteInfo->info["destination"];
			$route = $RouteInfo->info["route"];
			if(  true == $RouteInfo->info["rounds"] ){
				$rounds = "あり";
			}else{
				$rounds = "なし";
			}
			$price = $RouteInfo->info["price"];
			if( true == $RouteInfo->info["user_price"] ){
				$user_price = $price;
			}else{
				$user_price = 0;
			}
			$remarks = $RouteInfo->info["remarks"];
			$tmpStr = sprintf("乗車日%20s\n行先%22s\n経路%22s\n往復の有無%16s\n合計運賃%18s円\nユーザー請求額%12s円\n備考%22s\n",
				$route_date,
				$destination,
				$route,
				$rounds,
				$price,
				$user_price,
				$remarks
				);
			$tmpStr = $tmpStr."----------------------------------------\n"."以上のデータを削除しますか？";

			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = $tmpStr;
			$tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
			$tmpAction_PostbackStructArray[0]->propaty["label"] = MA_MessageTextList::APPLY;
			$tmpAction_PostbackStructArray[0]->propaty["text"] = MA_MessageTextList::APPLY;
			$tmpAction_PostbackStructArray[0]->propaty["postback"] = MA_MessagePostbackList::APPLY;
			$tmpAction_PostbackStructArray[1]->propaty["label"] = MA_MessageTextList::CANCEL;
			$tmpAction_PostbackStructArray[1]->propaty["text"] = MA_MessageTextList::CANCEL;
			$tmpAction_PostbackStructArray[1]->propaty["postback"] = MA_MessagePostbackList::CANCEL;
			$tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
				$tmpAction_PostbackStructArray[1]->propaty);
			$reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
			//プロパティーのJSONエンコード
			$propaty = json_encode($reqStruct->propaty);
		}

		//リクエストの送信
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//応答が得られた場合
			//応答JSONを連想配列にデコード
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//リクエストが出来なかった場合
			//TODO 何かしらのエラー処理
		}

		return $ret;
	}
}
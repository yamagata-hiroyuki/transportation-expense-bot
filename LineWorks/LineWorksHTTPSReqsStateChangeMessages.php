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
			Enum_CallBack_userState::SELECT_MENU			=> 'ChangeMessage_B7A7',
			Enum_CallBack_userState::DELETE_SELECT_ID		=> 'ChangeMessage_B7A8',
			Enum_CallBack_userState::DELETE_CONF			=> 'ChangeMessage_Nope',
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_B7A10'
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
			Enum_CallBack_userState::PETITION_CONF			=> 'ChangeMessage_B10A10'
		)
	);
	private function ChangeMessage_Nope(CallBackStruct $recvData):bool{
		DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]stateChangeMessageTable func called.");
		return true;
	}

	private function ChangeMessage_B1A2(CallBackStruct $recvData):bool{
		$ret = false;
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);
		$ret = $client->SendMessageReq($userAddress,$serverTokenInfo->info["token"],
				"?????????????????????????????????");
		return $ret;
	}

	private function ChangeMessage_B1A7(CallBackStruct $recvData):bool{
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//??????????????????
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//????????????????????????
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			$tmpStr = "??????????????????\n".
				"----------------------------------------\n";
			//DB??????RouteInfo?????????
			$routeInfos = new DBSP_GetRouteInfosStruct();
			DB_SP_getRouteInfo($userAddress,$routeInfos);
			$infoCount = count($routeInfos->info);
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]infoCount = ".$infoCount);
			$amountPrice = 0;
			foreach( $routeInfos->info as $index => $value ){
				if($index >= MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME){
					//????????????????????????ROUT_INFO???????????????????????????????????????
					break;
				}

				if( 0 == $index ){
					$tmpStr .= "????????????????????????\n";
				}
				$route_no		= $value->route_no;
				$date = new DateTime($value->route_date);
				$route_date = $date->format("m/d");
				$destination	= $value->destination;
				$route			= $value->route;
				$rounds			= "";
				if( true == $value->rounds ){
					$rounds = "???";
					$price			= 2 * ($value->price + $value->trans_exp);
					$user_price = "";
					$roundsInfo = "(??????)";
				}else{
					$rounds = "???";
					$price			= 1 * ($value->price + $value->trans_exp);
					$user_price = "";
					$roundsInfo = "(??????)";
				}

				if( 0 < $value->user_price ){ $user_price = "???"; }
				$routeInfo = sprintf("[%3d]%5s %22s\n     %-18s %1s%1s \n                         ???%5d%s\n",
										$route_no,
										$route_date,
										$destination,
										$route,
										$rounds,
										$user_price,
										$price,
										$roundsInfo
									);

				$tmpStr .= $routeInfo;
			}
			//?????????????????????
			foreach( $routeInfos->info as $index => $value ){
				if( true == $value->rounds ){
					$amountPrice += 2 * $value->price;
					//$amountPrice += 2 * $value->user_price;
					$amountPrice += 2 * $value->trans_exp;
				}
				else{
					$amountPrice += 1 * $value->price;
					//$amountPrice += 1 * $value->user_price;
					$amountPrice += 1 * $value->trans_exp;
				}
			}
			if( 0 < $amountPrice ){
				$amountPriceStr = sprintf("%s\n%s???%5s\n","                              ----------","                             ",$amountPrice);
				$tmpStr .= $amountPriceStr;
			}
			$tmpStr .= "----------------------------------------\n";

			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = $tmpStr;
			$tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
			$tmpAction_PostbackStructArray[0]->propaty["label"] = MA_MessageTextList::ONE_DELETE;
			$tmpAction_PostbackStructArray[0]->propaty["text"] = MA_MessageTextList::ONE_DELETE;
			$tmpAction_PostbackStructArray[0]->propaty["postback"] = MA_MessagePostbackList::ONE_DELETE;
			$tmpAction_PostbackStructArray[1]->propaty["label"] = MA_MessageTextList::PETITION;
			$tmpAction_PostbackStructArray[1]->propaty["text"] = MA_MessageTextList::PETITION;
			$tmpAction_PostbackStructArray[1]->propaty["postback"] = MA_MessagePostbackList::PETITION;
			$tmpAction_PostbackStructArray[2]->propaty["label"] = "???????????????";
			$tmpAction_PostbackStructArray[2]->propaty["text"] = "???????????????";
			$tmpAction_PostbackStructArray[2]->propaty["postback"] = MA_MessagePostbackList::CANCEL;
			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpAction_PostbackStructArray = ",$tmpAction_PostbackStructArray);
			$tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
				$tmpAction_PostbackStructArray[1]->propaty,
				$tmpAction_PostbackStructArray[2]->propaty);

			//????????????????????????ROUT_INFO??????????????????????????????????????????????????????
			if( $infoCount > MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME){
				$nextNumnber = 1;//??????????????????0????????????
				array_push($tmpAction_PostbackStructArray,new Action_MessageStruct());
				$tmpAction_PostbackStructArray[3]->propaty["label"] = MA_MessageTextList::NEXT;
				$tmpAction_PostbackStructArray[3]->propaty["text"] = MA_MessageTextList::NEXT;
				$tmpAction_PostbackStructArray[3]->propaty["postback"] = MA_MessagePostbackList::NEXT.$nextNumnber;
				array_push($tmpMessage_ButtonTemplateStruct->propaty["actions"],$tmpAction_PostbackStructArray[3]->propaty);
			}

			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpMessage_ButtonTemplateStruct->propaty[\"actions\"] = ",$tmpMessage_ButtonTemplateStruct->propaty["actions"]);
			$reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
			//?????????????????????JSON???????????????
			$propaty = json_encode($reqStruct->propaty);
		}

		//????????????????????????
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//???????????????????????????
			//??????JSON??????????????????????????????
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//??????????????????????????????????????????
			//TODO ??????????????????????????????
		}

		return $ret;
	}

	private function ChangeMessage_B2A3(CallBackStruct $recvData):bool{
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//??????????????????
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//????????????????????????
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = "???????????????????????????????????????";
			$tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
			$tmpAction_PostbackStructArray[0]->propaty["label"] = MA_MessageTextList::REQUEST_TO_USER;
			$tmpAction_PostbackStructArray[0]->propaty["text"] = MA_MessageTextList::REQUEST_TO_USER;
			$tmpAction_PostbackStructArray[0]->propaty["postback"] = MA_MessagePostbackList::REQUEST_TO_USER;
			$tmpAction_PostbackStructArray[1]->propaty["label"] = MA_MessageTextList::REQUEST_TO_IN_HOUSE;
			$tmpAction_PostbackStructArray[1]->propaty["text"] = MA_MessageTextList::REQUEST_TO_IN_HOUSE;
			$tmpAction_PostbackStructArray[1]->propaty["postback"] = MA_MessagePostbackList::REQUEST_TO_IN_HOUSE;
			$tmpAction_PostbackStructArray[2]->propaty["label"] = MA_MessageTextList::REQUEST_AS_TRANS_EXP;
			$tmpAction_PostbackStructArray[2]->propaty["text"] = MA_MessageTextList::REQUEST_AS_TRANS_EXP;
			$tmpAction_PostbackStructArray[2]->propaty["postback"] = MA_MessagePostbackList::REQUEST_AS_TRANS_EXP;
			$tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
																		$tmpAction_PostbackStructArray[1]->propaty,
																		$tmpAction_PostbackStructArray[2]->propaty);
			$reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
			//?????????????????????JSON???????????????
			$propaty = json_encode($reqStruct->propaty);
		}

		//????????????????????????
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//???????????????????????????
			//??????JSON??????????????????????????????
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//??????????????????????????????????????????
			//TODO ??????????????????????????????
		}

		return $ret;
	}

	private function ChangeMessage_B3A4(CallBackStruct $recvData):bool{
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//??????????????????
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//????????????????????????
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = "????????????????????????????????????????????????";
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
			//?????????????????????JSON???????????????
			$propaty = json_encode($reqStruct->propaty);
		}

		//????????????????????????
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//???????????????????????????
			//??????JSON??????????????????????????????
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//??????????????????????????????????????????
			//TODO ??????????????????????????????
		}

		return $ret;
	}

	private function ChangeMessage_B4A5(CallBackStruct $recvData):bool{
		$ret = false;
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);
		$ret = $client->SendMessageReq($userAddress,$serverTokenInfo->info["token"],
			"??????????????????????????????????????????");
		return $ret;
	}

	private function ChangeMessage_B5A6(CallBackStruct $recvData):bool{
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//??????????????????
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//????????????????????????
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			//DB??????TEMP_ROUTE_INFO?????????
			$tempRouteInfo = new DBSP_GetTempRouteInfoStruct();
			DB_SP_getTempRouteInfo($userAddress, $tempRouteInfo);

			$date = new DateTime($tempRouteInfo->info["route_date"]);
			$route_date = $date->format("m/d");
			$destination = $tempRouteInfo->info["destination"];
			$route = $tempRouteInfo->info["route"];
			if(  true == $tempRouteInfo->info["rounds"] ){
				$rounds = "??????";
				$roundsInfo = "(??????)";

				$price = 2 * ($tempRouteInfo->info["price"] + $tempRouteInfo->info["trans_exp"]);
				$user_price = 2 * $tempRouteInfo->info["user_price"];
			}else{
				$rounds = "??????";
				$roundsInfo = "(??????)";
				$price = 1 * ($tempRouteInfo->info["price"] + $tempRouteInfo->info["trans_exp"]);
				$user_price = 1 * $tempRouteInfo->info["user_price"];
			}
			$remarks = $tempRouteInfo->info["remarks"];
			$tmpStr = sprintf("?????????%20s\n??????%22s\n??????%22s\n???????????????%16s\n????????????%18s???%s\n?????????????????????%12s???%s\n??????%22s\n",
								$route_date,
								$destination,
								$route,
								$rounds,
								$price,
								$roundsInfo,
								$user_price,
								$roundsInfo,
								$remarks
							);
			$tmpStr = $tmpStr."----------------------------------------\n"."???????????????????????????????????????";

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
			//?????????????????????JSON???????????????
			$propaty = json_encode($reqStruct->propaty);
		}

		//????????????????????????
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//???????????????????????????
			//??????JSON??????????????????????????????
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//??????????????????????????????????????????
			//TODO ??????????????????????????????
		}

		return $ret;
	}

	private function ChangeMessage_B7A7(CallBackStruct $recvData):bool{
		$postbackKind = MessageAnalyser::getPostbackKind($recvData);
		if(! ( $postbackKind == MA_PostbackKind::NEXT
			|| $postbackKind == MA_PostbackKind::PREVIOUS
		)){
			// ????????????????????????
			return true;
		}


		//???/????????????????????????
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//??????????????????
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//????????????????????????
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			$tmpStr = "??????????????????\n".
				"----------------------------------------\n";
			//DB??????RouteInfo?????????
			$routeInfos = new DBSP_GetRouteInfosStruct();
			DB_SP_getRouteInfo($userAddress,$routeInfos);
			$infoCount = count($routeInfos->info);
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]infoCount = ".$infoCount);
			$amountPrice = 0;

			//?????????????????????
			$postbackNumber = (int)preg_replace("/\D+/","",$recvData->propaty["content"]["postback"]);
			$nextNumber = $postbackNumber + 1;
			$previousNumber = $postbackNumber - 1;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]postbackNumber = ".$postbackNumber);

			//???/????????????????????????????????????
			$flgNext = ($nextNumber >= ceil( $infoCount / MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME) ) ? false : true;
			$flgPrevious = ($previousNumber < 0) ? false : true;

			//??????????????????????????????
			if (  $postbackNumber > ($infoCount / MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME)
				|| $postbackNumber < 0
				){
					DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Out of range.postbackNumber = ".$postbackNumber
						.".total page count = ".$infoCount / MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME.".");
					return false;
			}



			foreach( $routeInfos->info as $index => $value ){
				if($index < MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME * ($postbackNumber)){
					//?????????????????????
					continue;
				}

				if($index >= MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME * ($postbackNumber + 1)){
					//????????????????????????ROUT_INFO???????????????????????????????????????
					break;
				}

				if( 0 == $index ){
					$tmpStr .= "????????????????????????\n";
				}
				$route_no		= $value->route_no;
				$date = new DateTime($value->route_date);
				$route_date = $date->format("m/d");
				$destination	= $value->destination;
				$route			= $value->route;
				$rounds			= "";
				if( true == $value->rounds ){
					$rounds = "???";
					$price			= 2 * ($value->price + $value->trans_exp);
					$user_price = "";
					$roundsInfo = "(??????)";
				}else{
					$rounds = "???";
					$price			= 1 * ($value->price + $value->trans_exp);
					$user_price = "";
					$roundsInfo = "(??????)";
				}
				if( 0 < $value->user_price ){ $user_price = "???"; }
				$routeInfo = sprintf("[%3d]%5s %22s\n     %-18s %1s%1s \n                         ???%5d%s\n",
					$route_no,
					$route_date,
					$destination,
					$route,
					$rounds,
					$user_price,
					$price,
					$roundsInfo
					);

				$tmpStr .= $routeInfo;
			}
			//?????????????????????
			foreach( $routeInfos->info as $index => $value ){
				if( true == $value->rounds ){
					$amountPrice += 2 * $value->price;
					//$amountPrice += 2 * $value->user_price;
					$amountPrice += 2 * $value->transe_exp;
				}else{
					$amountPrice += 1 * $value->price;
					//$amountPrice += 1 * $value->user_price;
					$amountPrice += 1 * $value->transe_exp;
				}
			}
			if( 0 < $amountPrice ){
				$amountPriceStr = sprintf("%s\n%s???%5s\n","                              ----------","                             ",$amountPrice);
				$tmpStr .= $amountPriceStr;
			}
			$tmpStr .= "----------------------------------------\n";

			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = $tmpStr;
			$tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
			$arrayNumber = 0;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["label"] = MA_MessageTextList::ONE_DELETE;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["text"] = MA_MessageTextList::ONE_DELETE;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["postback"] = MA_MessagePostbackList::ONE_DELETE;
			$arrayNumber += 1;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["label"] = MA_MessageTextList::PETITION;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["text"] = MA_MessageTextList::PETITION;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["postback"] = MA_MessagePostbackList::PETITION;
			$arrayNumber += 1;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["label"] = "???????????????";
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["text"] = "???????????????";
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["postback"] = MA_MessagePostbackList::CANCEL;
			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpAction_PostbackStructArray = ",$tmpAction_PostbackStructArray);
			$tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
				$tmpAction_PostbackStructArray[1]->propaty,
				$tmpAction_PostbackStructArray[2]->propaty);

			//??????????????????????????????
			if( $flgNext === true){
				array_push($tmpAction_PostbackStructArray,new Action_MessageStruct());
				$arrayNumber += 1;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["label"] = MA_MessageTextList::NEXT;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["text"] = MA_MessageTextList::NEXT;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["postback"] = MA_MessagePostbackList::NEXT.$nextNumber;
				array_push($tmpMessage_ButtonTemplateStruct->propaty["actions"],$tmpAction_PostbackStructArray[$arrayNumber]->propaty);
			}

			//??????????????????????????????
			if( $flgPrevious === true){
				array_push($tmpAction_PostbackStructArray,new Action_MessageStruct());
				$arrayNumber += 1;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["label"] = MA_MessageTextList::PREVIOUS;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["text"] = MA_MessageTextList::PREVIOUS;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["postback"] = MA_MessagePostbackList::PREVIOUS.$previousNumber;
				array_push($tmpMessage_ButtonTemplateStruct->propaty["actions"],$tmpAction_PostbackStructArray[$arrayNumber]->propaty);
			}

			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpMessage_ButtonTemplateStruct->propaty[\"actions\"] = ",$tmpMessage_ButtonTemplateStruct->propaty["actions"]);
			$reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
			//?????????????????????JSON???????????????
			$propaty = json_encode($reqStruct->propaty);
		}

		//????????????????????????
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//???????????????????????????
			//??????JSON??????????????????????????????
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//??????????????????????????????????????????
			//TODO ??????????????????????????????
		}

		return $ret;
	}

	private function ChangeMessage_B7A8(CallBackStruct $recvData):bool{
		$ret = false;
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);
		$ret = $client->SendMessageReq($userAddress,$serverTokenInfo->info["token"],
			"???????????????????????????????????????????????????????????????");
		return $ret;
	}

	private function ChangeMessage_B8A9(CallBackStruct $recvData):bool{
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//??????????????????
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//????????????????????????
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			//DB??????ROUTE_INFO?????????
			$RouteInfo = new DBSP_GetRouteInfoByRouteNoStruct();
			DB_SP_getRouteInfoByRouteNo($userAddress, $recvData->propaty["content"]["text"], $RouteInfo);

			$date = new DateTime($RouteInfo->info["route_date"]);
			$route_date = $date->format("m/d");
			$destination = $RouteInfo->info["destination"];
			$route = $RouteInfo->info["route"];
			if(  true == $RouteInfo->info["rounds"] ){
				$rounds = "??????";
				$roundsInfo = "(??????)";
				$price = 2 * ($RouteInfo->info["price"] + $RouteInfo->info["trans_exp"]);
				$user_price = 2 * $RouteInfo->info["user_price"];
			}else{
				$rounds = "??????";
				$roundsInfo = "(??????)";
				$price = 1 * ($RouteInfo->info["price"] + $RouteInfo->info["trans_exp"]);
				$user_price = 1 * $RouteInfo->info["user_price"];
			}
			$remarks = $RouteInfo->info["remarks"];
			$tmpStr = sprintf("?????????%20s\n??????%22s\n??????%22s\n???????????????%16s\n????????????%18s???%s\n?????????????????????%12s???%s\n??????%22s\n",
				$route_date,
				$destination,
				$route,
				$rounds,
				$price,
				$$roundsInfo,
				$user_price,
				$$roundsInfo,
				$remarks
				);
			$tmpStr = $tmpStr."----------------------------------------\n"."??????????????????????????????????????????";

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
			//?????????????????????JSON???????????????
			$propaty = json_encode($reqStruct->propaty);
		}

		//????????????????????????
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//???????????????????????????
			//??????JSON??????????????????????????????
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//??????????????????????????????????????????
			//TODO ??????????????????????????????
		}

		return $ret;
	}

	private function ChangeMessage_B7A10(CallBackStruct $recvData):bool{
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//??????????????????
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//????????????????????????
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			$tmpStr = "??????????????????\n".
				"----------------------------------------\n";
			//DB??????RouteInfo?????????
			$routeInfos = new DBSP_GetNotRequestedRouteInfosByApplicationStruct();
			DB_SP_getNotRequestedRouteInfoByApplication($userAddress,$routeInfos);
			$infoCount = count($routeInfos->info);
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]infoCount = ".$infoCount);
			$amountPrice = 0;
			foreach( $routeInfos->info as $index => $value ){
				if($index >= MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME){
					//????????????????????????ROUT_INFO???????????????????????????????????????
					break;
				}

				$date = new DateTime($value->route_date);
				$route_date = $date->format("m/d");
				$destination	= $value->destination;
				$route			= $value->route;
				$rounds			= "";
				if( true == $value->rounds ){
					$rounds = "???";
					$price			= 2 * ($value->price + $value->trans_exp);
					$user_price = "";
					$roundsInfo = "(??????)";
				}else{
					$rounds = "???";
					$price			= 1 * ($value->price + $value->trans_exp);
					$user_price = "";
					$roundsInfo = "(??????)";
				}

				if( 0 < $value->user_price ){ $user_price = "???"; }
				$routeInfo = sprintf("%5s %22s\n     %-18s %1s%1s \n                         ???%5d%s\n",
					//$route_no,
					$route_date,
					$destination,
					$route,
					$user_price,
					$rounds,
					$price,
					$roundsInfo
					);

				$tmpStr = $tmpStr.$routeInfo;
			}

			//?????????????????????
			foreach( $routeInfos->info as $index => $value ){
				if( true == $value->rounds ){
					$amountPrice += 2 * $value->price;
					//$amountPrice += 2 * $value->user_price;
					$amountPrice += 2 * $value->trans_exp;
				}else{
					$amountPrice += 1 * $value->price;
					//$amountPrice += 1 * $value->user_price;
					$amountPrice += 1 * $value->trans_exp;
				}

			}

			if( 0 < $amountPrice ){
				$amountPriceStr = sprintf("%s\n%s???%5s\n","                              ----------","                             ",$amountPrice);
				$tmpStr = $tmpStr.$amountPriceStr;
			}
			$tmpStr = $tmpStr."----------------------------------------\n";
			$tmpStr = $tmpStr."???????????????????????????????????????";

			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = $tmpStr;
			$tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
			$tmpAction_PostbackStructArray[0]->propaty["label"] = MA_MessageTextList::APPLY;
			$tmpAction_PostbackStructArray[0]->propaty["text"] = MA_MessageTextList::APPLY;
			$tmpAction_PostbackStructArray[0]->propaty["postback"] = MA_MessagePostbackList::APPLY;
			$tmpAction_PostbackStructArray[1]->propaty["label"] = MA_MessageTextList::CANCEL;
			$tmpAction_PostbackStructArray[1]->propaty["text"] = MA_MessageTextList::CANCEL;
			$tmpAction_PostbackStructArray[1]->propaty["postback"] = MA_MessagePostbackList::CANCEL;

			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpAction_PostbackStructArray = ",$tmpAction_PostbackStructArray);
			//
			$tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
				$tmpAction_PostbackStructArray[1]->propaty);
			//????????????????????????ROUT_INFO??????????????????????????????????????????????????????
			if( $infoCount > MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME){
				$nextNumnber = 1;//??????????????????0????????????
				array_push($tmpAction_PostbackStructArray,new Action_MessageStruct());
				$tmpAction_PostbackStructArray[3]->propaty["label"] = MA_MessageTextList::NEXT;
				$tmpAction_PostbackStructArray[3]->propaty["text"] = MA_MessageTextList::NEXT;
				$tmpAction_PostbackStructArray[3]->propaty["postback"] = MA_MessagePostbackList::NEXT.$nextNumnber;
				array_push($tmpMessage_ButtonTemplateStruct->propaty["actions"],$tmpAction_PostbackStructArray[3]->propaty);
			}
			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpMessage_ButtonTemplateStruct->propaty[\"actions\"] = ",$tmpMessage_ButtonTemplateStruct->propaty["actions"]);
			$reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
			//?????????????????????JSON???????????????
			$propaty = json_encode($reqStruct->propaty);
		}

		//????????????????????????
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//???????????????????????????
			//??????JSON??????????????????????????????
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//??????????????????????????????????????????
			//TODO ??????????????????????????????
		}

		return $ret;
	}

	private function ChangeMessage_B10A10(CallBackStruct $recvData):bool{
		$postbackKind = MessageAnalyser::getPostbackKind($recvData);
		if(! ( $postbackKind == MA_PostbackKind::NEXT
			|| $postbackKind == MA_PostbackKind::PREVIOUS
			)){
				// ????????????????????????
				return true;
		}


		//???/????????????????????????
		//?????????????????????????????????
		$userAddress = $recvData->baseInfo["source"]["accountId"];
		//LineWorks ???????????????????????????
		$client = new LineWorksReqs();
		//Server Token ??????
		$serverTokenInfo = new DBSP_GetServerTokenStruct();
		DB_SP_getServerToken($serverTokenInfo);


		$reqStruct = new DispMainMenuReqStruct();
		$propaty = null;
		$header = null;
		$ret = false;

		//??????????????????
		{
			$reqStruct->header["Content-Type"] = "Content-Type: ".HTTP_H_CONTENT_TYPE;
			$reqStruct->header["consumerKey"] = "consumerKey: ".CONSUMER_KEY;
			$reqStruct->header["Authorization"] = "Authorization: "."Bearer ".$serverTokenInfo->info["token"];
			$header = $reqStruct->header;
		}

		//????????????????????????
		{
			$reqStruct->propaty["accountId"] = $userAddress;

			$tmpMessage_ButtonTemplateStruct = new Message_ButtonTemplateStruct();
			$tmpStr = "??????????????????\n".
				"----------------------------------------\n";
			//DB??????RouteInfo?????????
			$routeInfos = new DBSP_GetNotRequestedRouteInfosByApplicationStruct();
			DB_SP_getNotRequestedRouteInfoByApplication($userAddress,$routeInfos);
			$infoCount = count($routeInfos->info);
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]infoCount = ".$infoCount);

			//?????????????????????
			$postbackNumber = (int)preg_replace("/\D+/","",$recvData->propaty["content"]["postback"]);
			$nextNumber = $postbackNumber + 1;
			$previousNumber = $postbackNumber - 1;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[INFO]postbackNumber = ".$postbackNumber);

			//???/????????????????????????????????????
			$flgNext = ($nextNumber >= ceil( $infoCount / MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME) ) ? false : true;
			$flgPrevious = ($previousNumber < 0) ? false : true;

			//??????????????????????????????
			if (  $postbackNumber > ($infoCount / MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME)
				|| $postbackNumber < 0
				){
					DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"[ERROR]Out of range.postbackNumber = ".$postbackNumber
						.".total page count = ".$infoCount / MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME.".");
					return false;
			}



			$amountPrice = 0;
			foreach( $routeInfos->info as $index => $value ){
				if($index < MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME * ($postbackNumber)){
					//?????????????????????
					continue;
				}

				if($index >= MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME * ($postbackNumber + 1)){
					//????????????????????????ROUT_INFO???????????????????????????????????????
					break;
				}

				$date = new DateTime($value->route_date);
				$route_date = $date->format("m/d");
				$destination	= $value->destination;
				$route			= $value->route;
				$rounds			= "";
				if( true == $value->rounds ){
					$rounds = "???";
					$price			= 2 * ($value->price + $value->trans_exp);
					$user_price = "";
					$roundsInfo = "(??????)";
				}else{
					$rounds = "???";
					$price			= 1 * ($value->price + $value->trans_exp);
					$user_price = "";
					$roundsInfo = "(??????)";
				}
				if( 0 < $value->user_price ){ $user_price = "???"; }
				$routeInfo = sprintf("%5s %22s\n     %-18s %1s%1s \n                         ???%5d%s\n",
					//$route_no,
					$route_date,
					$destination,
					$route,
					$user_price,
					$rounds,
					$price,
					$roundsInfo
					);

				$tmpStr = $tmpStr.$routeInfo;
			}

			//?????????????????????
			foreach( $routeInfos->info as $index => $value ){
				if( true == $value->rounds ){
					$amountPrice += 2 * $value->price;
					//$amountPrice += 2 * $value->user_price;
					$amountPrice += 2 * $value->trans_exp;
				}else{
					$amountPrice += 1 * $value->price;
					//$amountPrice += 1 * $value->user_price;
					$amountPrice += 1 * $value->trans_exp;
				}
			}

			if( 0 < $amountPrice ){
				$amountPriceStr = sprintf("%s\n%s???%5s\n","                              ----------","                             ",$amountPrice);
				$tmpStr = $tmpStr.$amountPriceStr;
			}
			$tmpStr = $tmpStr."----------------------------------------\n";
			$tmpStr = $tmpStr."???????????????????????????????????????";

			$tmpMessage_ButtonTemplateStruct->propaty["contentText"] = $tmpStr;
			$tmpAction_PostbackStructArray = Array(new Action_MessageStruct(),new Action_MessageStruct(),new Action_MessageStruct());
			$arrayNumber = 0;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["label"] = MA_MessageTextList::APPLY;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["text"] = MA_MessageTextList::APPLY;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["postback"] = MA_MessagePostbackList::APPLY;
			$arrayNumber += 1;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["label"] = MA_MessageTextList::CANCEL;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["text"] = MA_MessageTextList::CANCEL;
			$tmpAction_PostbackStructArray[$arrayNumber]->propaty["postback"] = MA_MessagePostbackList::CANCEL;

			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpAction_PostbackStructArray = ",$tmpAction_PostbackStructArray);
			//
			$tmpMessage_ButtonTemplateStruct->propaty["actions"] = Array($tmpAction_PostbackStructArray[0]->propaty,
				$tmpAction_PostbackStructArray[1]->propaty);
			//??????????????????????????????
			if( $flgNext === true){
				array_push($tmpAction_PostbackStructArray,new Action_MessageStruct());
				$arrayNumber += 1;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["label"] = MA_MessageTextList::NEXT;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["text"] = MA_MessageTextList::NEXT;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["postback"] = MA_MessagePostbackList::NEXT.$nextNumber;
				array_push($tmpMessage_ButtonTemplateStruct->propaty["actions"],$tmpAction_PostbackStructArray[$arrayNumber]->propaty);
			}

			//??????????????????????????????
			if( $flgPrevious === true){
				array_push($tmpAction_PostbackStructArray,new Action_MessageStruct());
				$arrayNumber += 1;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["label"] = MA_MessageTextList::PREVIOUS;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["text"] = MA_MessageTextList::PREVIOUS;
				$tmpAction_PostbackStructArray[$arrayNumber]->propaty["postback"] = MA_MessagePostbackList::PREVIOUS.$previousNumber;
				array_push($tmpMessage_ButtonTemplateStruct->propaty["actions"],$tmpAction_PostbackStructArray[$arrayNumber]->propaty);
			}

			//DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"tmpMessage_ButtonTemplateStruct->propaty[\"actions\"] = ",$tmpMessage_ButtonTemplateStruct->propaty["actions"]);
			$reqStruct->propaty["content"] = $tmpMessage_ButtonTemplateStruct->propaty;
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"reqStruct->propaty = ",$reqStruct->propaty);
			//?????????????????????JSON???????????????
			$propaty = json_encode($reqStruct->propaty);
		}

		//????????????????????????
		$result = SendRequest("POST", DISP_BUTTON_TEMP_URL, $header, $propaty);
		if($result != false){
			//???????????????????????????
			//??????JSON??????????????????????????????
			$ret = json_decode($result,true);
			if( $ret == NULL ){ $ret = false;}
			DEBUG_LOG(basename(__FILE__),__FUNCTION__,__LINE__,"Res Json = ",$ret);
		}else{
			//??????????????????????????????????????????
			//TODO ??????????????????????????????
		}

		return $ret;
	}
}
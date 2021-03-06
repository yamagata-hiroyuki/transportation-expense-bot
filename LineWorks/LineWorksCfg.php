<?php
	require_once 'Common/Lamdas.php';

	//User modify params  --start--
	define("APP_NAME","transportation-expense-bot");								//heroku application name
	define("API_ID","jp1bOeyTtDNts");												//API ID
	define("BOT_NO","1933144");														//BotNo

	//コンシュマーキー：{}内いずれかを有効化すること（デフォルト：サーバーコンシュマーキー
	define("SERVICE_CONSUMER_KEY","");												//サーバーコンシュマーの権限で認証
	define("SERVER_CONSUMER_KEY","ibQN8RztVtJBRKyDt1GA");							//サーバーコンシュマーの権限で認証
	define("SERVER_TOKEN","16e3e15038c24ad58c20f196e7d1745b");						//サーバートークン
	{
		//define("CONSUMER_KEY","{$GLOBALS['DEF'](SERVICE_CONSUMER_KEY)}");			//サービスコンシュマーの権限で認証
		define("CONSUMER_KEY","{$GLOBALS['DEF'](SERVER_CONSUMER_KEY)}");				//サーバーコンシュマーの権限で認証
	}


	//HTTP ヘッダー情報
	define("HTTP_H_CHARSET","UTF-8");												//ヘッダー情報:文字コード
	define("HTTP_H_CONTENT_TYPE","application/json; charset=".HTTP_H_CHARSET);		//ヘッダー情報:コンテンツタイプ
	define("HTTP_H_AUTH","Bearer {$GLOBALS['DEF'](SERVER_TOKEN)}");					//ヘッダー情報:サーバートークン
	define("HTTP_H_CONSUMER_KEY","{$GLOBALS['DEF'](CONSUMER_KEY)}");				//ヘッダー情報:コンシュマーキー

	//以下使うか不明
	define("SERVER_LIST_ID",SERVER_TOKEN);					//Server List ID

	//タイムゾーン
	define("TIME_ZONE","Asia/Tokyo");

	//制限系
	define("DIST_STR_MIN",1);														//最小入力文字数(目的地)
	define("DIST_STR_MAX",22);														//最大入力文字数(目的地)
	define("REMARK_STR_MIN",0);														//最小入力文字数(備考)
	define("REMARK_STR_MAX",18);													//最大入力文字数(備考)

	define("MESSAGE_MAX_LEN_SERVER_TO_USER",2000);									//最大文字数(メッセージ)(Sever→user)
	define("MESSAGE_MAX_COUNT_ROUTE_INFO_DISP_ON_MENU_AT_ONE_TIME",8);				//機能メニューで一度に表示できる経路の最大数

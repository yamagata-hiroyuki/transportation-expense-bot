<?php
    require_once 'Lamdas.php';

    //User modify params  --start--
    define("APP_NAME","chat-bot-upload-test");      //heroku application name
	define("API_ID","jp1bOeyTtDNts");				//API ID
	define("BOT_NO","1686949");						//BotNo
	
	//コンシュマーキー：{}内いずれかを有効化すること（デフォルト：サーバーコンシュマーキー
	define("SERVICE_CONSUMER_KEY","");                     //サーバーコンシュマーの権限で認証
	define("SERVER_CONSUMER_KEY","1s2i9GNFmIujbAyaQO9Z");  //サーバーコンシュマーの権限で認証
	define("SERVER_TOKEN","56907308ab094d119da932afd7c5dd56");//サーバートークン
	{
	    //define("CONSUMER_KEY","{$GLOBALS['DEF'](SERVICE_CONSUMER_KEY)}");//サービスコンシュマーの権限で認証
	   define("CONSUMER_KEY","{$GLOBALS['DEF'](SERVER_CONSUMER_KEY)}");//サーバーコンシュマーの権限で認証
	}

	
	//HTTP ヘッダー情報
	define("HTTP_H_CONTENT_TYPE","application/json;charset=UTF-8");                             //ヘッダー情報:コンテンツタイプ
	define("HTTP_H_AUTH","Bearer {$GLOBALS['DEF'](SERVER_TOKEN)}");                            //ヘッダー情報:サーバートークン
	define("HTTP_H_CONSUMER_KEY","{$GLOBALS['DEF'](CONSUMER_KEY)}");                           //ヘッダー情報:コンシュマーキー
	
	//以下使うか不明
	define("SERVER_LIST_ID","56907308ab094d119da932afd7c5dd56");					//Server List ID

?>
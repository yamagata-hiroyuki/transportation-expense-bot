<?php
require_once 'LineWorks/LineWorksCfg.php';
define("JWT_P_KEY_PATH","./private.key");                               //秘密鍵へのパス

define("JWT_ALGORISM","RS256");                                         //JWT生成時使用アルゴリズム
define("JWT_TYPE","JWT");                                               //JWT生成時タイプ
define("JWT_EXP_TIME",60 * 60 );                                        //生成JWT有効期限：現在時刻からの有効期限（MAX = 3600 秒）

define("JWT_SERVER_ID","{$GLOBALS['DEF'](SERVER_LIST_ID)}")            //LineBot サーバーID



?>
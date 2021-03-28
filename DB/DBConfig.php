<?php
{
    define("DB_DSN_AS_POSTGRE_SQL","pgsql");
    define("DB_DSN_AS_MYSQL","mysql");
    define("DB_DSN_AS_SQLITE","sqlite");
    define("DB_DSN_AS_SQLITE_2","sqlite2");
}
define("DB_DSN",DB_DSN_AS_POSTGRE_SQL);//DBのDSNタイプ。上記の何れかを指定

{
	define("DB_PORT_AS_POSTGRE_SQL",5432);
	define("DB_PORT_AS_MYSQL",3306);
}
define("DB_PORT",DB_PORT_AS_POSTGRE_SQL);//DBのPORT。上記の何れかを指定
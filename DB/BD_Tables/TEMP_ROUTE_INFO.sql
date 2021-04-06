CREATE SCHEMA IF NOT EXISTS transportation_expense_bot;				-- スキーマ存在確認
DROP TABLE IF EXISTS transportation_expense_bot."TEMP_ROUTE_INFO";	-- DB存在確認
CREATE TABLE transportation_expense_bot."TEMP_ROUTE_INFO" (
	"USER_ID" INT NOT NULL
	,"ROUTE_DATE"	DATE
	,"DESTINATION"	VARCHAR
	,"ROUTE"		VARCHAR
	,"ROUNDS"		INT
	,"PRICE"		INT
	,"USER_PRICE"	INT
	,"REMARKS"		VARCHAR
	,PRIMARY KEY ("USER_ID")
);

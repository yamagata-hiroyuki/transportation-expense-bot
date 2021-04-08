CREATE SCHEMA IF NOT EXISTS transportation_expense_bot;				-- スキーマ存在確認
DROP TABLE IF EXISTS transportation_expense_bot."ROUTE_INFO";	-- DB存在確認
CREATE TABLE transportation_expense_bot."ROUTE_INFO" (
	"USER_ID"		INT NOT NULL
	,"ROUTE_NO"		INT NOT NULL
	,"ROUTE_DATE"	DATE
	,"DESTINATION"	VARCHAR
	,"ROUTE"		VARCHAR
	,"ROUNDS"		BOOL
	,"PRICE"		INT
	,"USER_PRICE"	BOOL
	,"REMARKS"		VARCHAR
	,"APPLICATION"	BOOL
	,PRIMARY KEY ("USER_ID","ROUTE_NO")
);

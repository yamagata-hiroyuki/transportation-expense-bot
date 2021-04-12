CREATE SCHEMA IF NOT EXISTS transportation_expense_bot;				-- スキーマ存在確認
DROP TABLE IF EXISTS transportation_expense_bot."SELECTED_DELETE_ROUTE_INFO";	-- DB存在確認
CREATE TABLE transportation_expense_bot."SELECTED_DELETE_ROUTE_INFO" (
	"USER_ID" 				INT NOT NULL
	,"SELECTED_ROUTE_NO"	INT
	,PRIMARY KEY ("USER_ID")
);

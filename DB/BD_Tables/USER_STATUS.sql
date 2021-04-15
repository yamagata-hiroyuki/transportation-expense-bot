CREATE SCHEMA IF NOT EXISTS transportation_expense_bot;				-- スキーマ存在確認
DROP TABLE IF EXISTS transportation_expense_bot."USER_STATUS";		-- DB存在確認
CREATE TABLE transportation_expense_bot."USER_STATUS" (
	"USER_ID" INT NOT NULL
	,"STATUS" INT NOT NULL
	,PRIMARY KEY ("USER_ID")
);
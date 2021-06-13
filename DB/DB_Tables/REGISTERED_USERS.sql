CREATE SCHEMA IF NOT EXISTS transportation_expense_bot;					-- スキーマ存在確認
DROP TABLE IF EXISTS transportation_expense_bot."REGISTERED_USERS";		-- DB存在確認
CREATE TABLE transportation_expense_bot."REGISTERED_USERS" (
	"USER_ADDRESS" VARCHAR(100) NOT NULL
	,"USER_ID" INT NOT NULL
	,PRIMARY KEY ("USER_ADDRESS")
);

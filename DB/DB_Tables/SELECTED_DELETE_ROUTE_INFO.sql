CREATE SCHEMA IF NOT EXISTS transportation_expense_bot;				-- �X�L�[�}���݊m�F
DROP TABLE IF EXISTS transportation_expense_bot."SELECTED_DELETE_ROUTE_INFO";	-- DB���݊m�F
CREATE TABLE transportation_expense_bot."SELECTED_DELETE_ROUTE_INFO" (
	"USER_ID" 				INT NOT NULL
	,"SELECTED_ROUTE_NO"	INT
	,PRIMARY KEY ("USER_ID")
);

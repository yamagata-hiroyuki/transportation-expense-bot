CREATE SCHEMA IF NOT EXISTS transportation_expense_bot;					-- �X�L�[�}���݊m�F
DROP TABLE IF EXISTS transportation_expense_bot."DOCS_MS";	-- DB���݊m�F
CREATE TABLE transportation_expense_bot."DOCS_MS" (
	"USER_ID" INT NOT NULL
	,"DOCS_ID" INT
	,"APPLICATION_DATE" TIMESTAMP(6) WITH TIME ZONE
	,"EXPENSE_ISSUE_DATE" TIMESTAMP(6) WITH TIME ZONE
	,"EXPENSE_ADMIN_ISSUE_DATE" TIMESTAMP(6) WITH TIME ZONE
	,PRIMARY KEY ("USER_ID","DOCS_ID")
);
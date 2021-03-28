CREATE SCHEMA IF NOT EXISTS transportation_expense_bot;                            --スキーマ存在確認
DROP TABLE IF EXISTS transportation_expense_bot."USER_STATUS";                 --DB存在確認
CREATE TABLE transportation_expense_bot."USER_STATUS" (                        --DB作成
  "USER_ID" INT PRIMARY KEY NOT NULL,
  "STATUS" CHAR NOT NULL
);
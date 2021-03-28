CREATE SCHEMA IF NOT EXISTS transportation_expense_bot;                            --スキーマ存在確認
DROP TABLE IF EXISTS transportation_expense_bot.SERVER_TOKEN_INFO;                 --DB存在確認
CREATE TABLE transportation_expense_bot.SERVER_TOKEN_INFO (                        --DB作成
  ID CHAR PRIMARY KEY NOT NULL DEFAULT 1,
  TOKEN VARCHAR(1000) NOT NULL,
  START_FROM TIMESTAMP WITH TIME ZONE,
  END_AT TIMESTAMP WITH TIME ZONE NOT NULL
);

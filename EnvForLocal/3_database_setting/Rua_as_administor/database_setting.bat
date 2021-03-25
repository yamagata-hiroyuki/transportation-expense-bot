@echo off
setlocal enabledelayedexpansion
echo "[Info]Start DB Settings"

rem user settings start
set currentDirectory=%~dp0
set postgreSQLUsePort=5432
set DBOwner=Upload
set DBName=TransportationExpenseBotDBForLocalTest
rem user settings end

cd /d %currentDirectory%

rem Open port 5432
FOR /F "tokens=5 delims= " %%P IN ('netstat -ano ^| findstr ":%postgreSQLUsePort%"') DO (
	TaskKill.exe /F /PID %%P
	GOTO F1_Break
)
:F1_Break
rem stop DB
pg_ctl stop

rem init DB
initdb -U postgres -A password -E utf8 -W

rem startup DB
pg_ctl start

rem echo status
pg_ctl status

rem create User
echo "新規作成するユーザーのパスワードを入力すること!(新ユーザー:%DBOwner%)"
echo "「パスワード:」が「もう一度入力してください:」の後に表示された場合、"
echo "スーパーユーザーのパスワードを入力すること"
createuser -U postgres -P %DBOwner%

rem create DB

echo "新ユーザーをオーナーとするDBの作成開始"
echo "「パスワード:」が表示された場合はスーパーユーザーのパスワードを入力すること"
createdb -E UTF8 -O %DBOwner% -U postgres %DBName% -W

pause
exit
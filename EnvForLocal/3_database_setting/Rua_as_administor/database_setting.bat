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
echo "�V�K�쐬���郆�[�U�[�̃p�X���[�h����͂��邱��!(�V���[�U�[:%DBOwner%)"
echo "�u�p�X���[�h:�v���u������x���͂��Ă�������:�v�̌�ɕ\�����ꂽ�ꍇ�A"
echo "�X�[�p�[���[�U�[�̃p�X���[�h����͂��邱��"
createuser -U postgres -P %DBOwner%

rem create DB

echo "�V���[�U�[���I�[�i�[�Ƃ���DB�̍쐬�J�n"
echo "�u�p�X���[�h:�v���\�����ꂽ�ꍇ�̓X�[�p�[���[�U�[�̃p�X���[�h����͂��邱��"
createdb -E UTF8 -O %DBOwner% -U postgres %DBName% -W

pause
exit
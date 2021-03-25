@echo off
setlocal enabledelayedexpansion
color f1

:: ======================================================= ::
:: Copyright (C) 2014 tag. All rights reserved.
:: http://karat5i.blogspot.jp/
:: ======================================================= ::

:: variables
:: -------------------------------------------------------
:: target
set TARGET=%SYSTEMROOT%\System32\drivers\etc\hosts
:: -------------------------------------------------------
:: strings
set STRINGS="# label =>" "127.0.0.1 localhost" "# <= label"
:: -------------------------------------------------------

:: begin
echo =======================================================
echo please run as admin if you edit a system file!
echo.
echo [a]dd/[d]elete the following string(s) to/from the target file.
echo.
echo target: %TARGET%
echo.
echo string(s):
echo + - - - - - - - - - - - - - - - - - - - - - - - - - - +
for %%a in (%STRINGS%) do (
echo %%~a
)
echo + - - - - - - - - - - - - - - - - - - - - - - - - - - +

:: select action
set ACT=a
rem set ACT=n
rem set /p ACT=">"
if "%ACT%"=="a" (
goto AddStrings
) else if "%ACT%"=="d" (
goto DelStrings
) else (
set ERRORLEVEL=-1
goto End
)

:: add the strings to the target
:AddStrings
for %%a in (%STRINGS%) do (
echo %%~a>_tmp.txt
cmd /c "type _tmp.txt 1>>%TARGET%" 2>NUL
:: if the target can't be edited
if !ERRORLEVEL!==1 ( goto End )
)
goto End

:: delete the strings from the target
:DelStrings
for %%a in (%STRINGS%) do (
findstr /v /c:%%a %TARGET% 1>_tmp.txt
cmd /c "type _tmp.txt 1>%TARGET%" 2>NUL
:: if the target can't be edited
if !ERRORLEVEL!==1 ( goto End )
)
goto End

:: end
:End
if !ERRORLEVEL!==0 (
echo success.
) else if !ERRORLEVEL!==1 (
echo failure...
) else if !ERRORLEVEL!==-1 (
echo aborted.
)
:: remove _tmp.txt
if exist "_tmp.txt" (
del /q _tmp.txt 1>NUL 2>&1
)
echo =======================================================
endlocal
rem pause 1>NUL
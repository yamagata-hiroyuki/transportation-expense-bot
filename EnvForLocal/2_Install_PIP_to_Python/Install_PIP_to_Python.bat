@echo off
setlocal enabledelayedexpansion
echo "[Info]Start Install_PIP_to_Python proc"
rem user settings start
set RunPowerShellFile=Install_PIP.ps1
rem user settings end

set currentDirectory=%~dp0
cd %currentDirectory%

echo "[Info]Running..."
powershell -NoProfile -ExecutionPolicy Unrestricted .\%RunPowerShellFile%

pause
exit
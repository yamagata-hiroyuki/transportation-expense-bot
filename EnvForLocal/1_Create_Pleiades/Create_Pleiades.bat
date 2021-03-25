@echo off
setlocal enabledelayedexpansion


rem user settings start
set currentDirectory=%~dp0
set UnZipAppPath32Bit="C:\Program Files (x86)\7-Zip\7z.exe"
set UnZipAppPath64Bit="C:\Program Files\7-Zip\7z.exe"
set UnZipFile1=pleiades-2021-03-ultimate-win-64bit-jre_20210321.zip
set UnZipFile2=postgresql-13.2-1-windows-x64-binaries.zip
rem user settings end

cd /d %currentDirectory%
echo "[Info]Start Install 7-Zip"
7z1900-x64.exe /S

echo "[Info]Start create Pleiades"
rem Application exist check
echo "[Info]Check un zip application (32bit)"
IF NOT EXIST %UnZipAppPath32Bit% (
	echo "[Warn]Un zip application (32bit) not found"
	echo "[Info]Check un zip application (64bit)"
	IF NOT EXIST %UnZipAppPath64Bit% (
		echo "[Warn]Un zip application (64bit) not found"
		echo "[Error]Un zip application not found.stop bat."
		goto BAT_END
	) else (
		set UnZipAppPath=%UnZipAppPath64Bit%
	)
) ELSE (
	set UnZipAppPath=%UnZipAppPath32Bit%
)

echo "[Info]Un zipping file"

%UnZipAppPath% x -y -o../ %UnZipFile1%
%UnZipAppPath% x -y -o../ %UnZipFile2%

mkdir %currentDirectory%..\pgsql\data
mkdir %currentDirectory%..\pgsql\log

call :addGeneralValues


echo "Reboot required.Reboot will run if you press enter."
pause
shutdown.exe /r /t 0
:BAT_END
pause
exit

rem--------------------------------------------------------------------
:addGeneralValues
	setlocal enabledelayedexpansion
	set currentDirectory=%~dp0
del log.txt
	echo "[Info]Checking PATH value...(for SQL Path value)."
	echo "Default PATH = %PATH%" >> log.txt
	call :myFindStr "%PATH%" "%currentDirectory%..\pgsql\bin"
	IF %ERRORLEVEL% lss 1 powershell -NoProfile -ExecutionPolicy Unrestricted .\addGenarals.ps1 PATH '%PATH%' '%currentDirectory%..\pgsql\bin'

	echo "[Info]Checking PGDATA value...(for SQL Path value(data))."
	echo "Default PGDATA = %PGDATA%" >> log.txt
	call :myFindStr "%PGDATA%" "%currentDirectory%..\pgsql\data"
	IF %ERRORLEVEL% lss 1 powershell -NoProfile -ExecutionPolicy Unrestricted .\addGenarals.ps1 PGDATA '%PGDATA%' '%currentDirectory%..\pgsql\data'
exit /b
rem Path=C:\ProgramData\Oracle\Java\javapath;C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\Program Files (x86)\ATI Technologies\ATI.ACE\Core-Static;C:\Windows\system32\config\systemprofile\.dnx\bin;C:\Program Files\Microsoft DNX\Dnvm\;C:\Program Files\Microsoft SQL Server\130\Tools\Binn\;C:\Program Files\Microsoft SQL Server\120\Tools\Binn\;C:\Program Files\Git\cmd;C:\Program Files (x86)\Windows Kits\10\Windows PerformanceToolkit\;C:\flutter\bin;C:\PROGRA~1\JPKI;G:\programs\GitHub\bin;C:\ProgramData\Oracle\Java\javapath;C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\Program Files (x86)\ATI Technologies\ATI.ACE\Core-Static;C:\Windows\system32\config\systemprofile\.dnx\bin;C:\Program Files\Microsoft DNX\Dnvm\;C:\Program Files\MicrosoftSQL Server\130\Tools\Binn\;C:\Program Files\Microsoft SQL Server\120\Tools\Binn\;C:\Program Files\Git\cmd;C:\Program Files (x86)\Windows Kits\10\Windows Performance Toolkit\;C:\flutter\bin;C:\PROGRA~1\JPKI;G:\programs\GitHub\bin;C:\Users\WMC\AppData\Local\Programs\Python\Python38-32\Scripts\;C:\Users\WMC\AppData\Local\Programs\Python\Python38-32\;C:\Cadence\SPB_16.6\openaccess\bin\win32\opt;C:\Cadence\SPB_16.6\tools\capture;C:\Cadence\SPB_16.6\tools\pspice;C:\Cadence\SPB_16.6\tools\specctra\bin;C:\Cadence\SPB_16.6\tools\fet\bin;C:\Cadence\SPB_16.6\tools\libutil\bin;C:\Cadence\SPB_16.6\tools\bin;C:\Cadence\SPB_16.6\tools\pcb\bin;C:\OrCAD\OrCAD_10.5\tools\pcb\bin;C:\OrCAD\OrCAD_10.5\tools\fet\bin;C:\OrCAD\OrCAD_10.5\tools\specctra\bin;C:\OrCAD\OrCAD_10.5\tools\bin;C:\OrCAD\OrCAD_10.5\tools\PSpice\Library;C:\OrCAD\OrCAD_10.5\tools\Capture;G:\Microsoft VS Code\bin;G:\programs\Fiddler;G:\programs\heroku\bin;C:\Program Files\heroku\bin
rem--------------------------------------------------------------------
:myFindStr
	setlocal enabledelayedexpansion
	set findStr=%2
	set srcStr=%1
	set rsltFlag=0

	echo %srcStr% | find %findStr% > NUL
	IF ERRORLEVEL 1 (
		echo "[info]%findStr% is not exist."
		set rsltFlag=0
	) ELSE (
		echo "[info]%findStr% is already exist."
		set rsltFlag=1
	)
exit /b %rsltFlag%

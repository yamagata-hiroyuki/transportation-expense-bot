"[Info]PowerShell script start."
#User settings start
#現在のスクリプトからのみ読み書き可能
$script:currentDir = (Convert-Path .)
$script:copyFile = "$currentDir\get-pip.py"
$script:putPath = "$currentDir\..\pleiades\python\3"
#User setting end

cd $currentDir
cp $copyFile $putPath
cd ..\pleiades\python\3
.\python.exe .\get-pip.py
@echo off
setlocal enabledelayedexpansion
set Counter=1
for /f %%x in (arguments_for_script.txt) do (
  set "Line_!Counter!=%%x"
  set /a Counter+=1
)

echo user> ftp_script.txt
echo %Line_1%>> ftp_script.txt
echo %Line_2%>> ftp_script.txt
echo cd /public_html>> ftp_script.txt

REM Turn off interactive mode for mput
echo prompt n>> ftp_script.txt
echo mput ../../source_files/*>> ftp_script.txt
echo ls>> ftp_script.txt
echo quit>> ftp_script.txt

ftp -n -s:ftp_script.txt %Line_3%

pause

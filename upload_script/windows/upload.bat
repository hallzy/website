@echo off

REM Get each line from the arguments file to use
setlocal enabledelayedexpansion
set Counter=1
for /f %%x in (arguments_for_script.txt) do (
  set "Line_!Counter!=%%x"
  set /a Counter+=1
)

REM Generated the ftp_script.txt file. This is executed by the ftp command later
echo user> ftp_script.txt
echo %Line_1%>> ftp_script.txt
echo %Line_2%>> ftp_script.txt
echo cd /public_html>> ftp_script.txt
REM Turn off interactive mode for mput
echo prompt n>> ftp_script.txt
echo mput ../../source_files/*>> ftp_script.txt
echo ls>> ftp_script.txt
echo quit>> ftp_script.txt

REM Run the ftp_script with the ftp command on the host defined by the third
REM line of the arguments file.
ftp -n -s:ftp_script.txt %Line_3%

pause

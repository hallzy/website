@echo off

REM Get each line from the arguments file to use
setlocal enabledelayedexpansion
set Counter=1
for /f %%x in (arguments_for_script.txt) do (
  set "Line_!Counter!=%%x"
  set /a Counter+=1
)

set username=%Line_1%
set passwd=%Line_2%
set host=%Line_3%

REM Ask for Password if one is not given in the file
if %Counter% LEQ 3 (
  set /p passwd="FTP Password: "
  if not defined passwd goto :eof
  set host=%Line_2%
)


echo binary> ftp_script.txt
echo user>> ftp_script.txt
echo %username%>> ftp_script.txt
echo %passwd%>> ftp_script.txt
echo cd /public_html>> ftp_script.txt
REM Turn off interactive mode for mput
echo prompt n>> ftp_script.txt
echo mput ../../source_files/*>> ftp_script.txt
echo ls>> ftp_script.txt
echo quit>> ftp_script.txt

REM Run the ftp_script with the ftp command on the host defined by the third
REM line of the arguments file.
ftp -n -s:ftp_script.txt %host%

pause

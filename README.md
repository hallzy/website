# Website

This repository contains the source files used for my website
[stmhall.ca](http://www.stmhall.ca).

It also includes a script that automatically copies my source files to the
webserver.

In the repo is a file called "arguments_for_script_template". The name of this
file should match the "FILE_NAME_FOR_ARGS" variable in the script, and the
"ARGS_FILE" variable should match the actual path of the args file that you are
going to use.

Inside of the arguments file should be your server username, the login password
for the server, and the hostname of the server on each of their own lines in
that order (see template).

The password is optional. If you leave the password line blank for the linux
bash script, ftp will ask you for a password. For the Windows Batch script it
does not work this way, so the script allows you to just enter two lines of
information, and if you do it assumes the first line is the username, and the
second is the host, then the script will prompt you for the password (which will
be visible as you type it).

#### Windows

The same applies for windows. The arguments file just needs to be created and
populated. Then run the upload.bat script.

### My Resume

My resume is built using LaTeX. I have more details about how it was created on
my [dotfiles](http://github.com/hallzy/dotfiles) page.

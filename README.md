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

This script will also install a program called ncftp which is what it uses to
transfer files via ftp.

### My Resume

My resume is built using LaTeX. I have more details about how it was created on
my [dotfiles](http://github.com/hallzy/dotfiles) page.

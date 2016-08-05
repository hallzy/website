#
# =============================================================================
#
#   This Source Code Form is subject to the terms of the Mozilla Public
#   License, v. 2.0. If a copy of the MPL was not distributed with this file,
#   You can obtain one at http://mozilla.org/MPL/2.0/.
#
#   Copyright (c) 2015, MPL Steven Hall Hallzy.18@gmail.com
#
# =============================================================================
#

#!/bin/bash

#Name of the file that contains the necessary information.
FILE_NAME_FOR_ARGS=arguments_for_script
#This is the path to the file with the arguments
ARGS_FILE=~/Documents/git-repos/remote-github/website/upload_script/$FILE_NAME_FOR_ARGS
#This is the folder that contains the website source files
SOURCE_FILES=~/Documents/git-repos/remote-github/website/source_files

# If the arguments file exists then read the file and get the arguments, and
# insert them into the ncftpput command
if [ -e "$ARGS_FILE" ]; then
  # This is a file with three arguments that will be filled into the script below.
  readarray ARGUMENTS < $ARGS_FILE

  #Username
  USER_ARG=${ARGUMENTS[0]}
  #server password
  PASS_ARG=${ARGUMENTS[1]}
  #server hostname
  HOST_ARG=${ARGUMENTS[2]}

  command -v ncftp >/dev/null 2>&1 || {
    echo "ncftp is not installed and is required to execute this script. You"
    echo "can install it with \"sudo apt-get install ncftp\"."
    exit 1
  }


  echo "Now Copying files to webserver..."
  echo "================================="
  ncftpput -u $USER_ARG -p $PASS_ARG $HOST_ARG /public_html $SOURCE_FILES/*
else
  echo "Error, file $ARGS_FILE does not exist"
  exit 1;
fi

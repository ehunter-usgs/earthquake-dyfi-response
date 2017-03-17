dyfi-responses
==============

The DYFI responses subsytem. This manages the transfer of
DYFI user entries from the web interface to the DYFI backend
servers through the hazdev acquisition servers.

Location
--------

To be run on the HazDev acquisitions servers.

Components
----------

This program (found in the htdocs directory of this repo)
is run by the DYFI Questionnaire once the
user submits the form. It takes the form data and saves it as a unique
entry file (raw text format). It also displays the closing
message for the user.

It then makes a copy of the entry file for each of the backend servers. The entry files will be stored in a separate directory (one for each backend server) 
until the backend server periodically transfers the files to the backend
system. 


INSTALLATION AND CONFIGURATION
------------------------------

This subsytem should be installed in each "target" or response server for the DYFI Questionnaire. Setup requires the following locations:

- An 'apps' directory, [apps]/earthquake-dyfi-response. Executables go here. 
- A 'data' directory, [data]/earthquake-dyfi-response. Incoming entry files, replication directories, and logs go here. Ensure that it has sufficient file space.

1. On your local repository, run 'grunt dist' then rsync the 'dist' directory into the response server's app directory:
    - [apps]/earthquake-dyfi-response

2. Ensure the DYFI Questionnaire form points to the correct executable: 
    - [apps]/earthquake-dyfi-response/.build/src/htdocs/responses.php

3. cd to the repository root and run src/lib/pre-install to configure (this will create the target directories). It will ask for the following settings:
    - MOUNT PATH: URL for the response.php
    - SERVER SHORTNAME: Name of the server this is installed in
    - WRITE DIR: Data directory. For testing, you can use [THIS_REPOSITORY]/test/ata/. For installation, you probably want [data]/earthquake-dyfi-response
    - BACKEND SERVERS: Comma-delimited list of DYFI servers that will be accessing this data. The incoming entries will be copied to a separate directories each named 'incoming.[SERVER]'.
    - TEST RESPONSE URL: Used for local testing only.

5. On the DYFI backend servers, point the retrieval script to start receiving data from here: 
    - [fullservername]:[data]/earthquake-dyfi-response/incoming.[server]/

TODO
----
- Set up Docker/NPM/Travis??


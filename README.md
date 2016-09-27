# coc-utils

The purpose of this repository is to create a set of scripts written in PHP, Perl or Python to retrieve information from the API site of Clash Of Clans
For the time being you can only find some sample scripts written in PHP to work on SQlite tables.
I have specifically chosen to work with SQLite to be able to use low costs devices line Raspberry Pi that have low power consumption.

Requirements to work with the scripts
-------------------------------------
- PHP with Curl and SQLite3 support
- Bash
- https://github.com/1n9i9c7om/ClashOfClans-API-PHP

General information
========
Copy the PHP scripts from ClashOfClans-API-PHP into a folder clashapi.
Rename all PHP files with small letters otherwise my PHP scripts will not work when using Linux. Or you can also rename the folder clashapi_copy to clashapi.
Now, go to the developers site from Clash Of Clans and generate a Key. Add the Key to api.class.php. 
You should be able to start using the scripts.

History
=======
* 2016-09-06 - Created this small repository
* 2016-09-27 - SQLite orangenl.sqlite contains all Dutch Orange clans

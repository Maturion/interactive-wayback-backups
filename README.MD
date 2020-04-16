# Interactive Wayback Backups
## About
This script allows for easy self-hosting of interactive PHP websites downloaded via the [Wayback Machine Downloader](https://github.com/hartator/wayback-machine-downloader). 

Wayback Machine Downloader simply downloads files from the Wayback Machine, without discriminating between static HTML and interactive PHP files. If GET parameters are used in an URL , you'll end up having thousands of files that will bear names such as "viewforum.php?f=7&amp" that will fail to be properly executed on a regular server.


If this script detects a filename containing GET parameters, it will move the respective file to a subfolder in .phparchive/. Only one PHP file per filename will be kept in its original location. Thus directory structures will be more similiar to the original ones.

## Usage
Simply paste both files in a directory and execute waybackinteractive.sh. It will act on all PHP files containing GET parameters and remove itself after all work is done. The script doesn't run recursively yet.

This script was hastly written, so don't complain about the code.

## Long term goals:
* Support any kind of server-side scripting language, not just PHP
* Run recursively

#!bin/bash/

#this script is for deployment for our db, gonna try my hand at some bash
Version=1;
echo "$Version"
Version = $((Version+1))
echo $Version
echo "deploying to qa";
#needto talk w nick about master-slave db's
rsync -avzh testserver@ip:/sql/
echo "sent to qa, refresh  browser to see changes";
echo "files sent to qa" > sql.txt

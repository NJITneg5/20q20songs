#!bin/bash/

#this script is for deployment, gonna try my hand at some bash
Version=1;
echo "$Version"
Version = $((Version+1))
echo $Version
echo "deploying to qa";
#ssh to nate test server for deployment  requires keyless ssh
rsync -avzh testserver@ip:/var/www/html /var/www/html
sudo systemctl service apache2 restart
let 
echo "sent to qa, refresh  browser to see changes";
echo "files sent to qa" > myfile.txt

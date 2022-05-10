#!/bin/bash

host=$1
declare -i flag=1
declare -i check=1
function pingcheck
{
	ping=`ping -c 1 $host | grep bytes | wc -l`
	if [ "$ping" -gt 1 ];then
		check=1
	else
		check=0	
	fi
}

while [ $flag == 1 ]
do
	pingcheck
	echo "main system still running"
	if [ $check == 0 ];then
<<<<<<< HEAD
		scp ../webServer/partials/testRabbitMQ.ini it490@172.24.205.67:/home/it490/git/20q20songs/webServer/partials
                scp ../webServer/partials/nickLoggingRabbitMQ.ini it490@172.24.205.67:/home/it490/git/20q20songs/webServer/partials
		sudo scp ../webServer/partials/testRabbitMQ.ini it490@172.24.36.101:/var/www/172.24.36.101/20q20songs/webServer/pratials
		sudo scp ../webServer/partials/nateLoggingRabbitMQ.ini it490@172.24.36.101:/var/www/172.24.36.101/20q20songs/webServer/pratials
		scp ../webServer/partials/testRabbitMQ.ini anthony@172.24.187.221:/home/anthony/Desktop/20q20songs-working/webServer/partials
		scp ../webServer/partials/anthonyLoggingRabbitMQ.ini anthony@172.24.187.221:/home/anthony/Desktop/20q20songs-working/webServer/partials	
		flag=0
		
	else
		sleep 30
		continue
	fi
	
done

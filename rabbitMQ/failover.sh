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
		./testRabbitMQServer.php
		flag=0
		
	else
		sleep 30
		continue
	fi
	
done

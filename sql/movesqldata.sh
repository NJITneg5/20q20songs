#!/bin/bash

mysqldump -u root -p --all-databases > data.sql
scp data.sql it490@172.24.205.67:/home/it490/git/20q20songs/sql

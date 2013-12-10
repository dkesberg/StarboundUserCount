#!/bin/sh

PATHDATA=/var/www/starbound/app/storage/data

lsof -i TCP:21025|grep ESTABLISHED|wc -l > $PATHDATA/usercount.txt

# alternative
# netstat -a | grep :21025 | grep ESTABLISHED | wc -l > /var/www/starbound/app/storage/data/usercount.txt

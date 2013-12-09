#!/bin/sh

lsof -i TCP:21025|grep ESTABLISHED|wc -l > /var/www/starbound/app/storage/statistics/usercount.txt

# alternative
# netstat -a | grep :21025 | grep ESTABLISHED | wc -l > /var/www/starbound/app/storage/statistics/usercount.txt

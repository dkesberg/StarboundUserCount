StarboundUserCount
==================

Displays a png of active users on a starbound server

Example
-------

![Server Status](https://raw.github.com/dkesberg/StarboundUserCount/master/app/storage/backgrounds/demo.png)

Requirements
------------

* PHP5.4+
* Composer

Installation
------------

### PHP

Clone github directory

```
git clone https://github.com/dkesberg/StarboundUserCount.git
```

change into project directory and run composer

```
cd StarboundUserCount
composer install
```

### Cron

Create a cronjob to check network connections and update usercount.txt. 
Change filepath to match your system.

```
*/5 * * * * lsof -i TCP:21025|grep ESTABLISHED|wc -l > /var/www/starbound/app/storage/statistics/usercount.txt
```

Copyright Notice
----------------
Please visit http://playstarbound.com/ :)

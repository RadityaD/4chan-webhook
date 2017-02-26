#winpty docker run -it --rm -v //Users/4chan-wsg-webhook://usr/amyapp -w //usr/src/myapp php:7.0-cli php Webhook-post.php
docker run --name webserver -d -p 80:80 -v //Users/4chan-wsg-webhook://var/www/html/ --link mysqlserver:mysqldb ralobh/php-apache

FROM php:7.3.11-apache
RUN apt-get update -y
RUN apt-get upgrade -y
RUN apt-get install -y \
        unzip \
        curl \
        git
COPY src/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY src/index.php /var/www/html/index.php
EXPOSE 80

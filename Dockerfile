FROM php:7.3.11-apache
RUN apt-get update -y
RUN apt-get upgrade -y
COPY deploy/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY current/ /var/www/html/mfj360pro/
EXPOSE 80

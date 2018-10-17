####### WARNING #########
##### PRODUCTION DOCKERFILE NEEDS UPDATE, BUT BECAUSE WE ARE CONSTANTLY CHANGING DEV FOR NOW PROD IN NOT MAINTAINED #########
####################

# based on official php with apache image
FROM php:7.2.10-apache

# install python tools & ortools & other deps
RUN apt-get update && apt-get install -y build-essential libssl-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Apache config file
COPY ./dockerConfigs/apache.conf /etc/apache2/sites-available/000-default.conf

# Get composer from official image
COPY --from=composer:1.6.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Run entry script
#CMD ["sh", "/var/www/html/scripts/shell/dev-init.sh"]
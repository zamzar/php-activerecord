ARG PHP_VERSION=7.4

FROM php:$PHP_VERSION-cli

# Get latest packages
RUN apt-get -qqy update

## Install memcached extensions for PHP
RUN apt-get update && apt-get install -y libmemcached-dev libssl-dev zlib1g-dev \
	&& pecl install memcached-3.2.0 \
	&& docker-php-ext-enable memcached

# Install PDO extension for PHP
RUN docker-php-ext-install pdo

# Install MySQL extensions for PHP
RUN docker-php-ext-install pdo_mysql

# Install Postgres extensions for PHP
RUN apt-get -y install libpq-dev libzip-dev libicu-dev \
        && docker-php-ext-install pdo_pgsql pgsql

# Install composer
WORKDIR /tmp
RUN apt-get -qqy install wget unzip \
        && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
        && php -r "if (hash_file('SHA384', 'composer-setup.php') === exec('wget -q -O - https://composer.github.io/installer.sig')) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); exit(1); } echo PHP_EOL;" \
        && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
        && php -r "unlink('composer-setup.php');"

# Install composer dependencies
RUN mkdir /code
ADD . /code
WORKDIR /code
RUN composer install

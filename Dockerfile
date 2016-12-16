FROM php:7.0

# Get latest packages
RUN apt-get -y update

# Install memcached extensions for PHP
RUN buildDeps=" \
                git \
                libmemcached-dev \
                zlib1g-dev \
        " \
        && doNotUninstall=" \
                libmemcached11 \
                libmemcachedutil2 \
        " \
        && apt-get install -y $buildDeps --no-install-recommends \
        \
        && docker-php-source extract \
        && git clone --branch php7 https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached/ \
        && docker-php-ext-install memcached \
        \
        && docker-php-source delete \
        && apt-mark manual $doNotUninstall \
        && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false $buildDeps

# Install PDO extension for PHP
RUN docker-php-ext-install pdo

# Install MySQL extensions for PHP
RUN docker-php-ext-install pdo_mysql

# Install Postgres extensions for PHP
RUN apt-get -y install libpq-dev libzip-dev libicu-dev \
        && docker-php-ext-install pdo_pgsql pgsql

# Install wait-for-it script
RUN apt-get -y install wget \
        && wget -q -O /usr/local/bin/wait-for-it.sh https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh \
        && chmod 755 /usr/local/bin/wait-for-it.sh

# Install composer
WORKDIR /tmp
RUN apt-get -y install unzip \
        && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
        && php -r "if (hash_file('SHA384', 'composer-setup.php') === exec('wget -q -O - https://composer.github.io/installer.sig')) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); exit(1); } echo PHP_EOL;" \
        && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
        && php -r "unlink('composer-setup.php');"

# Install composer dependencies
# NB: add only composer files from the source tree at this point, as docker
# appears to rebuild the image automatically if an added file changes
RUN mkdir /code
ADD composer.* /code/
WORKDIR /code
RUN composer install

# Add full source tree to container, so that we can run tests.
# NB: doing this last avoids rerunning earlier steps each time we run tests
ADD . /code

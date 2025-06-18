FROM php:8.3 as php

RUN apt-get update -y
RUN apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libcurl4-gnutls-dev 

RUN docker-php-ext-install pdo pdo_mysql exif pcntl bcmath gd curl    

RUN pecl install redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis


WORKDIR /var/www

COPY . .    
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-progress --no-interaction
RUN cp .env.example .env

# Create startup script
RUN echo '#!/bin/bash\n \
    sleep 15\n\
    \
    echo "creating database"\n \
    mysql -h database -u root -p L05yvFmq2bgv0AJh -e "CREATE DATABASE IF NOT EXISTS location_manager;"\n\
    \
    echo "running php artisan key:generate"\n\
    php artisan key:generate\n\
    \
    echo "running migration and seeds"\n\
    php artisan migrate --seed --force\n\
    \
    echo "runnig optimize:clear"\n\
    php artisan optimize:clear\n\
    \
    echo "running php artisan serve --host=0.0.0.0 --port=8000"\n\
    php artisan serve --host=0.0.0.0 --port=8000' > /start.sh \
    && chmod +x /start.sh
CMD ["/start.sh"]




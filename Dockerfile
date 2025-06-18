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

WORKDIR /var/www

COPY . .    
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create startup script
RUN echo '#!/bin/bash\n \
    echo "copying .env file"\n \
    cp .env.example .env\n\
    \
    echo "composer install"\n \
    composer install --no-progress --no-interaction\n\
    \
    echo "creating database"\n \
    mysql -h database -u root -p ${DB_PASSWORD} -e "CREATE DATABASE IF NOT EXISTS ${DB_DATABASE};"\n\
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




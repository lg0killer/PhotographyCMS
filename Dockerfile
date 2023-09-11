FROM node:20 as nodebuilder
WORKDIR /home/node/app
COPY PhotographyCMS/ .
RUN apt-get update\
  && apt-get install -y php \
  && curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer
RUN apt-get install -y php-xml php-mysql php-curl php-common
RUN composer global require laravel/installer
RUN composer require laravel/pint
RUN composer install
RUN npm install
RUN npm run build


FROM php:8.1-fpm-alpine as final

RUN docker-php-ext-install pdo pdo_mysql sockets
RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache npm

WORKDIR /app

COPY --from=nodebuilder /home/node/app .

RUN mv .env.test .env
CMD ["php","artisan","serve","--host=0.0.0.0"]

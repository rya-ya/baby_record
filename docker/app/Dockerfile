FROM php:8.2-apache

WORKDIR /var/www/html

# PHP で必要なライブラリをインストール
RUN apt-get update \
    && apt-get install -y \
        libonig-dev \
        libzip-dev \
        unzip \
        mariadb-client \
        curl \
        ca-certificates \
    && docker-php-ext-install mbstring zip bcmath pdo_mysql mysqli \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Node.js / npm をインストール
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# mod_rewrite モジュールを使えるようにする
RUN a2enmod rewrite

# Composer のインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# PHP設定
COPY ./docker/app/php.ini /usr/local/etc/php/php.ini
COPY ./docker/app/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Apache設定
COPY ./docker/app/000-default.conf /etc/apache2/sites-available/000-default.conf

# Laravelの権限設定用スクリプト
COPY ./docker/app/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]

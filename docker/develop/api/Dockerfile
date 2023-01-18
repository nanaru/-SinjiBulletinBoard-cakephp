FROM php:8.1-apache

# Composer のバージョン と ハッシュ値
ARG composer_ver=2.3.10
ARG composer_hash=d808272f284fa8e0f8b470703e1438ac8f362030bbc9d12e29530277d767aff0

# Composer の保存先
ARG composer_path=/usr/local/bin/composer

RUN apt-get update \
  # Composer インストール
  && php -r "copy('https://getcomposer.org/download/$composer_ver/composer.phar', '$composer_path');" \
  && chmod 755 $composer_path \
  && php -r "if (hash_file('sha256', '$composer_path') !== '$composer_hash') { \
  echo '!!! Failed to install Composer !!!'; \
  unlink('$composer_path'); \
  } \
  echo PHP_EOL;" \
  && apt-get install -y vim \
  && apt-get install -y unzip \
  && apt-get install -y libicu-dev \
  && docker-php-ext-install intl \
  && docker-php-ext-install pdo_mysql \
  && a2enmod rewrite

RUN pecl install xdebug && \
  docker-php-ext-enable xdebug
WORKDIR /var/www/html
COPY ./html /var/www/html
COPY ./docker/develop/api/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./docker/develop/api/php.ini /usr/local/etc/php/

RUN composer install
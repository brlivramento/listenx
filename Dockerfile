FROM php:7.4-apache

RUN sed -i \
      -e '/debian-security/d' \
      -e '/security.debian.org/d' \
      -e '/bullseye-updates/d' \
      -e 's|deb.debian.org/debian|archive.debian.org/debian|g' \
      /etc/apt/sources.list \
    && apt-get update -o Acquire::Check-Valid-Until=false \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libicu-dev \
        libonig-dev \
        libzip-dev \
    && docker-php-ext-install \
        bcmath \
        intl \
        mbstring \
        pdo_mysql \
        zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/entrypoint.sh /usr/local/bin/project-entrypoint

RUN chmod +x /usr/local/bin/project-entrypoint

ENTRYPOINT ["/usr/local/bin/project-entrypoint"]
CMD ["apache2-foreground"]
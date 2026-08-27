FROM php:8.3-apache

# Serve the site from frontend/; server/ stays a sibling, OUTSIDE the web root
# (that's where enquiry.php loads ../../server/vendor + ../../server/.env from).
ENV APACHE_DOCUMENT_ROOT=/var/www/html/frontend
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
      /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf \
 && a2enmod rewrite headers

# Composer + extensions the AWS SDK / zip handling need.
RUN apt-get update && apt-get install -y --no-install-recommends git unzip libzip-dev \
 && docker-php-ext-install zip \
 && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install the server-side deps (AWS SES SDK etc.) into server/vendor,
# which lives outside the web root.
RUN composer install -d server --no-dev --no-interaction --prefer-dist --optimize-autoloader \
 && chown -R www-data:www-data /var/www/html

FROM php:7.4.1-apache
WORKDIR /var/www/

COPY ./VirtualHost/poupemais.com.conf /etc/apache2/sites-available/

RUN apt-get update\
    && apt-get upgrade -y\
    && apt-get autoremove -y\
    && apt-get autoclean\
    && apt-get install -y git
RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN usermod --non-unique --uid 1000 www-data \
  && groupmod --non-unique --gid 1000 www-data \
  && chown -R www-data:www-data /var/www

RUN mkdir -p /var/www/html/poupemais.com  
RUN chown -R www-data:www-data /var/www/html/poupemais.com
RUN chmod -R 755 /var/www/html

RUN a2enmod rewrite
RUN a2dissite 000-default.conf
RUN a2ensite poupemais.com.conf
RUN service apache2 restart

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"
# RUN composer update
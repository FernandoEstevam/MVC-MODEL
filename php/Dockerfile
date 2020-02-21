FROM php:7.4.1-apache
WORKDIR /var/www/

COPY ./VirtualHost/poupemais.com.conf /etc/apache2/sites-available/

RUN apt-get update\
    && apt-get upgrade -y\
    && apt-get autoremove -y\
    && apt-get autoclean\
    && apt-get install -y git
RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN mkdir -p /var/www/html/poupemais.com  
RUN chown -R www-data /var/www/html/poupemais.com
RUN chmod -R 755 /var/www/html

RUN a2enmod rewrite
RUN a2dissite 000-default.conf
RUN a2ensite poupemais.com.conf
RUN service apache2 restart

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'c5b9b6d368201a9db6f74e2611495f369991b72d9c8cbd3ffbc63edff210eb73d46ffbfce88669ad33695ef77dc76976') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN php -r "unlink('composer-setup.php');"
RUN mv composer /usr/local/bin/
# RUN cd /var/www/html/poupemais.com && composer update
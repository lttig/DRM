FROM php:7.2-apache
COPY www/scripts /var/www/scripts
RUN chown -R www-data:www-data /var/www/scripts
RUN rm -r /var/www/html
COPY www/html /var/www/html
RUN chown -R www-data:www-data /var/www/html/temp
RUN chown -R www-data:www-data /var/www/html/encrypted_videos
COPY Bento4 /usr/local/Bento4
COPY config/php.ini /usr/local/etc/php/php.ini
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/
RUN apt-get update && apt-get install -y python3
RUN apt-get install -y vim

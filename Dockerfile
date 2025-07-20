FROM php:8.2-apache

# Avoid hostname warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Enable rewrite
RUN a2enmod rewrite

# Ensure Apache listens correctly
RUN echo "Listen 0.0.0.0:80" >> /etc/apache2/ports.conf

# Copy project
COPY index.php /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

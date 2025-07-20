# Use official PHP image with Apache
FROM php:8.2-apache

# Enable mod_rewrite if needed
RUN a2enmod rewrite

# Install cURL (optional, usually preinstalled)
RUN apt-get update && apt-get install -y curl

# Copy your PHP file into the container
COPY index.php /var/www/html/index.php

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

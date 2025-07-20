# Use official PHP + Apache base image
FROM php:8.2-apache

# Enable Apache mod_rewrite (required for many PHP frameworks)
RUN a2enmod rewrite

# Install cURL (already included, but for completeness)
RUN apt-get update && apt-get install -y libcurl4-openssl-dev curl

# Copy PHP files into Apache web root
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

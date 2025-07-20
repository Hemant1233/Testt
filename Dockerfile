# Use official PHP image with Apache
FROM php:8.1-apache

# Enable Apache mod_rewrite (optional, but useful)
RUN a2enmod rewrite

# Copy PHP files into the container's web root
COPY . /var/www/html/

# Set permissions (optional, but prevents permission errors)
RUN chown -R www-data:www-data /var/www/html

# Expose default HTTP port
EXPOSE 80

# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    git \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip mysqli




# Copy project files
COPY . /var/www/html/persons

# Enable the use of .htaccess files
 RUN a2enmod rewrite

# Enable Apache modules
RUN a2dismod mpm_event && \
    a2enmod mpm_prefork && \
    a2enmod rewrite


# Set up MySQL
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql

# Expose port 9090
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]

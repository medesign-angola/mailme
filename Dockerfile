# Use an official PHP runtime as a parent image
FROM php:8.1.10-apache

# Set the working directory in the container
WORKDIR /home/md-mailme-app

# Copy your PHP application code into the container
COPY . .

# Install PHP extensions and other dependencies
RUN apt-get update && \
    apt-get install -y libpng-dev && \
    docker-php-ext-install pdo pdo_mysql gd

RUN php --version
RUN php -S localhost:8001

# Expose the port Apache listens on
EXPOSE 8001

# Start Apache when the container runs
CMD ["apache2-foreground"]
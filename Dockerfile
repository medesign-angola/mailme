# Use an official PHP runtime as a parent image
FROM php:8.1.10-apache as build

# Set the working directory in the container
WORKDIR /app

COPY . /app

# Copy your PHP application code into the container
FROM nginx:latest
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=build /app /usr/share/nginx/html/mailme

# Install PHP extensions and other dependencies
RUN apt-get update && \
    apt-get install -y libpng-dev && \
    docker-php-ext-install pdo pdo_mysql gd

# Expose the port Apache listens on
EXPOSE 80

# Start Apache when the container runs
CMD ["apache2-foreground"]
FROM php:8.1-cli

# Install mysqli
RUN docker-php-ext-install mysqli

WORKDIR /app

COPY . .

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]

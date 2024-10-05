FROM php:8.3-cli

# Update apt e instalar bibliotecas de dependências
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libxml2-dev

# Instalar extensões do PHP
RUN docker-php-ext-install zip xml pdo pdo_sqlite fileinfo intl pdo_pgsql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /app

# Copiar o código da aplicação para o container
COPY . .

COPY ./entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

# Expor a porta e iniciar o servidor
EXPOSE 8001
ENTRYPOINT ["/entrypoint.sh"]

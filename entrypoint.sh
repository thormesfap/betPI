#!/bin/bash

#Rodar o composer
echo 'Rodando Composer'
composer install

# Função para verificar a conexão com o banco de dados
function check_db() {
  # php artisan migrate para checar se o banco está ok
  echo 'Tesde DB'
  php artisan db:show
  if [ $? -eq 0 ]; then
    return 0
  else
    return 1
  fi
}

# Loop até a conexão com o banco de dados ser estabelecida
while ! check_db; do
  echo "Waiting for database..."
  sleep 10
done

# Executar as migrações
php artisan migrate

# Cria o secredo do jwt
php artisan jwt:secret

#configurando tempo de cronjob


#Iniciando cronservice
service cron start

# Iniciar o servidor
php artisan serve --host=0.0.0.0 --port=8080

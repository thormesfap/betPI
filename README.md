# BomBomBet - Backend

## Instalação via Docker

Execute os comandos abaixo para subir um container com a aplicação:

Windows
```shell
docker-compose up -d --build
```

Linux
```shell
sudo docker compose up -d --build
``` 
Após criação da imagem e execução do container, abra o navegador no link http://localhost:8001 para abrir a aplicação

***

## Instalação na máquina local
É necessário possuir php (pelo menos versão 8.2) e as extensões `fileinfo`, `mbstring`, `zip`, `pdo_sqlite` ativadas no sistema,
bem como composer instalado

Execute o seguinte comando após a clonagem:
```shell
composer install
```

Para criar o banco de dados e as tabelas execute o comando:
```shell
php artisan migrate
```

Para subir o servidor, execute o comando:
```shell
php artisan serve
```
O servidor deve subir na máquina local, na porta 8000 (http://localhost:8000).

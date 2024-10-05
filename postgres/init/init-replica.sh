#!/bin/bash
set -e

# Variáveis de configuração
PRIMARY_HOST="postgres-primary"
PRIMARY_PORT="5432"
REPLICA_USER="postgres"
REPLICA_PASSWORD="postgres"

# Aguarde o primário estar disponível
until psql -h $PRIMARY_HOST -U $REPLICA_USER -p $PRIMARY_PORT -c '\q'; do
  >&2 echo "Servidor primário não está pronto, aguardando..."
  sleep 5
done

# Apaga os dados existentes no diretório de dados do PostgreSQL
rm -rf /var/lib/postgresql/data/*

# Executa o pg_basebackup para copiar os dados do primário
pg_basebackup -h $PRIMARY_HOST -D /var/lib/postgresql/data -U $REPLICA_USER -vP -W --wal-method=stream

# Cria arquivo standby.signal
touch /var/lib/postgresql/data/standby.signal

# Adicionar configurações de replicação ao postgresql.conf
echo "primary_conninfo = 'host=$PRIMARY_HOST port=$PRIMARY_PORT user=$REPLICA_USER password=$REPLICA_PASSWORD'" >> /var/lib/postgresql/data/postgresql.conf
echo "primary_slot_name = 'replica_slot'" >> /var/lib/postgresql/data/postgresql.conf

# Corrige permissões do diretório de dados
chown -R postgres:postgres /var/lib/postgresql/data
chmod 700 /var/lib/postgresql/data

# Reinciar o servidor depois do backup
pg_ctl -D /var/lib/postgresql/data start

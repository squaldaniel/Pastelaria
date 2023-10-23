# 👩‍🍳 Pastelaria Dona Massa 👨‍🍳

A pastelaria Dona Massa é especialista em Pastel com diversos sabores
e diversos outros tipos de comida no pastel. Sinta-se a vontade para conhecer nosso cardápio.

> **Nota:** Esta aplicação é um teste de conhecimentos para vaga de desenvolvedor. Testando o conhecimento da linguagem PHP, framework Lumen
Padrões de desenvolvimento, até mesmo Dockerização de aplicações.
Use-a como base para sua API com Lumen Framework.

## Para testar a aplicação

Para que possa testar esta aplicação, clone o repositório em seu computador, tenha a versão do PHP > 8.0, uma Base de dados compativel com Lûmen, como MariaDB ou Mysql
Em um terminal do Powershell (Windows) ou no Seu terminal linux execute o comando :

docker compose -f "docker-compose.yml" up -d --build

Apos os containers estiverem startados, acesse seu terminal docker e execute
os seguintes comandos na order:
para instalar dependências:

 docker exec coopetest-www-1 sh -c "composer install"
para executar as migrações do banco de dados:

 docker exec coopetest-www-1 sh -c "php artisan migrate"
para semear o banco com informações iniciais:

```shell
docker exec coopetest-www-1 sh -c "php artisan db:seed"
```
 
# Projeto Biblia

Aplicação web de cadastro e consulta de dados de uma Biblia através de endpoints de CRUD de Idiomas, Versões, Testamentos, Livros e Versículos além do cadastro de usuários para autenticação.

## Sobre o projeto

### Objetivo
Este projeto foi criado com o intuito de praticar a criação de APIs Rest utilizando PHP e Laravel e consumi-las em uma aplicação front-end em VueJs.

## Funcionalidades
### - Endpoints de cadastros -
* O cadastro de usuários é feito através do método POST na rota pública.
```
POST  /register
```
```
name : String
email : String
password : String
password_confirmation : String
nameToken : String
```
* A autenticação é feita pela rota, que retornará o token a ser utilizado na autenticação das APIs.
```
POST  /login
```
```
email : String
password : String
```
* Os CRUDs de idiomas, versões, testamentos, livros e versiculos são protegidos por autenticação via token.
```
GET | POST | PUT | DELETE  /api/idioma
GET | POST | PUT | DELETE  /api/versao
GET | POST | PUT | DELETE  /api/testamento
GET | POST | PUT | DELETE  /api/livro
GET | POST | PUT | DELETE  /api/versiculo
```

## Configurando o projeto
* Configure a conexão com o banco no arquivo de configuração .env conforme exemplo:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblia
DB_USERNAME=root
DB_PASSWORD=root
```
* Para criar as tabelas do banco execute as migrations:
```
php artisan migrate
```
* Caso desejar, é possivel alimentar as tabelas com os seeders implementados
```
php artisan db:seed IdiomaSeeder
php artisan db:seed VersoesSeeder
php artisan db:seed TestamentosSeeder
php artisan db:seed LivrosSeeder
```
## Tecnologias utilizadas

* PHP 8.0.2 
* Laravel 9.19
* VueJs 3.2.45
* Banco MySQL;

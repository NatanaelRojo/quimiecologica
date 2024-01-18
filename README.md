# Manual de instalación de quimiecologica

* Entorno: Desarrollo
* Gestor de base de datos: Postgresql
* Usaremos $ para describir los comandos que se ejecutaran con un usuario regular.

## Versiones requeridas:

    -Versión de PHP requerida: 8.1
    -Versión de NodeJS requerida: v20.11.0
    -Versión de NPM requerida: v10.2.4

## Instalar los siguientes paquetes del sistema operativo:

    php = 8.1.x
    php-xml
    php-gd
    php-mbstring
    php-tokenizer
    php-zip
    php-cli
    php-curl
    php-pgsql
    postgresql
    curl
    zip
    unzip
    intl
    bcmath

## Instalar las dependencias de php del proyecto:

    $ composer install

## Instalar las dependencias de nodejs del proyecto:

    $ npm install

## Creamos el archivo de configuración .env a partir de un fichero de ejemplo que nos provee el proyecto:

    $ cp .env.example .env

## Generar un identificador único para la aplicación:

    $ php artisan key:generate

## Crear una base de datos y configurar las credenciales de acceso a la base de datos de PostgreSQL en el archivo .env:

    DB_CONNECTION=pgsql
    DB_HOST=localhost
    DB_PORT=5432
    DB_DATABASE=nombre_base_de_datos
    DB_USERNAME=usuario_base_de_datos
    DB_PASSWORD=contrasena_base_de_datos

## Limpiar configuración y cachearla:

    $ php artisan optimize:clear

## Ejecutar las migraciones de la base de datos:

    $ php artisan migrate

## Crear un usuario administrador en la base de datos:

    $ php artisan make:filament-user

## Probar la aplicación, se usarán 2 consolas a la vez:

En una consola ejecutar:

    $ npm run dev

Esto levantará el servidor local de Vite

En otra consola ejecutar:

    $ php artisan serve

Este comando levanta un servidor en la dirección ip 127.0.0.1 o localhost y en
el puerto 8000, para verificarlo puedes acceder a el enlace http://127.0.0.1:8000/

## Autenticarse con el usuario creado con filament

Navegar a: http://127.0.0.1:8000/admin/login

# Manual de instalación de quimiecologica

* Entorno: Desarrollo
* Gestor de base de datos: Postgresql
* Usaremos $ para describir los comandos que se ejecutaran con un usuario regular.

## Versiones requeridas:

    -Versión de PHP requerida: 8.1 a 8.3
    -Versión de NodeJS requerida: v20.11.0
    -Versión de NPM requerida: v10.2.4

## Instalar las dependencias de php del proyecto:

    $ composer install

## Instalar las dependencias de nodejs del proyecto:

    $ npm install

## Creamos el archivo de configuración .env a partir de un fichero de ejemplo que nos provee el proyecto:

    $ cp .env.example .env

## Generar un identificador único para la aplicación:

    $ php artisan key:generate

## Compilar los archivos javascript y css de la aplicación:

    $ npm run dev

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

## Probar la aplicación:

    $ php artisan serve

Este comando levanta un servidor en la dirección ip 127.0.0.1 o localhost y en
el puerto 8000, para verificarlo puedes acceder a el enlace http://127.0.0.1:8000/

Para evitar inconvenientes o errores de origines cruzados de peticiones en la
aplicación al registrar datos, se debe configurar en el archivo .env la url
correcta de la aplicación en la variable APP_URL, bien sea http://127.0.0.1 o
http://localhost según se necesite.

De igual forma se puede levantar el servidor con una dirección IP y un puerto
diferente, esta dirección IP también se debe configurar en la variable APP_URL
del archivo .env:

    $ php artisan serve --host=192.168.0.100 --port=8000

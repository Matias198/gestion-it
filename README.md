<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Para iniciar el proyecto se debe tener en cuenta:

### Modificar el .env con los siguientes valores:

- DB_CONNECTION=pgsql
- DB_HOST=127.0.0.1
- DB_PORT=5432
- DB_DATABASE=diseñoweb
- DB_USERNAME=admin
- DB_PASSWORD=admin
> Nota: se pueden cambiar estos parametros segun sus credenciales

### Node.js, PHP y Composer instalado en el sistema:
- npm install
- composer install

> **Nota:** verificar que en el archivo php.ini se encuentren descomentados los siguientes parametros:
> **extension=pdo_pgsql**
> **extension=pgsql**

### Utilizar el siguiente comando en la consola:
- php artisan migrate
> **Nota:** la base de datos debe estar creada con anterioridad.


### Ejecutar las instrucciones para generar los roles, permisos y usuarios

- php artisan db:seed --class=PermisosTableSeeder
- php artisan db:seed --class=SuperusuarioSeeder
> Nota: estos comandos crean los roles y permisos, junto al superusuario 


#### Ejecutar los siguientes comandos:
- npm run dev
- php artisan serve

### Dirigirse a la ruta 

localhost:8000/auth/login 

### Los datos del super usuario son

- correo: super@usuario
- clave: 12345678
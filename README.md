<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Para iniciar el proyecto se debe tener en cuenta:
### Una base de datos postgres que cumpla los siguientes paramtros del .env:

- DB_CONNECTION=pgsql
- DB_HOST=127.0.0.1
- DB_PORT=5432
- DB_DATABASE=diseñoweb
- DB_USERNAME=admin
- DB_PASSWORD=admin

### Ejecutar la siguiente query en la base de datos:

<code>INSERT INTO roles (id, name, permisos, created_at, updated_at)
VALUES (1, 'Super Usuario', '["ADMINISTRAR_USUARIOS", "ADMINISTRAR_ROLES", "ADMINISTRAR_EQUIPOS", "ADMINISTRAR_SOLICITUDES", "GESTIONAR_SOLICITUDES", "SOLICITAR_EQUIPOS"]'::json, current_date, current_date);</code>

<code> INTO users (id, name, email, password, role_id, created_at, updated_at) VALUES (1, 'Administrador', 'clave@12345678', '$2a$06$tVkuNV2RpD0eXZqWTLha9eVFzcXehdWbHpUVwPBeuHe8jnsmXUm.S', 1, '2023-06-19 01:21:00', '2023-06-19 01:58:38');</code>

### Node.js, PHP y Composer instalado en el sistema:
#### Ejecutar los siguientes comandos:
- npm run dev
- php artisan serve

### Dirigirse a la ruta 

localhost:8000/auth/login 

### Los datos del super usuario son

- correo: super@usuario
- clave: 12345678
<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

# slodigt-backend

**API backend central del ecosistema Slodigt.** Desarrollado en Laravel 12+, incluye:
- Autenticación de usuarios
- Gestión de roles (cliente, negocio, repartidor, agente)
- Sistema de pagos y recargas
- Migraciones y controladores estructurados
- Soporte para conexión con apps móviles y frontend en React

---

## 📦 Requisitos

- PHP 8.2+
- Composer 2+
- MySQL o MariaDB
- Node.js (opcional, solo si usas frontend dentro del mismo repo)
- Laravel 12+

---

## 🚀 Instalación

```bash
# 1. Clona el proyecto
git clone https://github.com/oscar-jp/slodigt-backend.git
cd slodigt-backend

# 2. Instala dependencias
composer install

# 3. Copia y configura variables de entorno
cp .env.example .env
php artisan key:generate

# 4. Crea la base de datos y ejecuta migraciones
php artisan migrate

# 5. (Opcional) Poblar con datos iniciales
php artisan db:seed

# 6. Inicia el servidor local
php artisan serve

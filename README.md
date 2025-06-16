<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

# slodigt-backend

**API backend central del ecosistema Slodigt**, una plataforma que conecta negocios locales con clientes mediante tiendas en línea y restaurantes virtuales.  
Está desarrollado en **Laravel 12+** y preparado para integrarse con apps móviles y frontend en React.  
El sistema permite monetizar mediante **comisiones por ventas, recargas y servicios premium para negocios**.

Incluye:
- Autenticación de usuarios y roles diferenciados
- Gestión de clientes, negocios, repartidores y agentes
- Sistema de pagos internos con recargas, transferencias y tarjetas
- Migraciones y controladores estructurados por dominio
- Conexión con apps móviles (Expo) y frontend React (portal)

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

📘 [Documentación técnica del backend](./overview.md)
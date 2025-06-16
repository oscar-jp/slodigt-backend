# Slodigt Backend - Documentación General

## 📌 Descripción del Proyecto

Este backend centralizado impulsa el ecosistema Slodigt, una plataforma multirol que gestiona usuarios, negocios, repartidores, agentes y un sistema de pagos con recargas y tarjetas. Está desarrollado en **Laravel 12+**, preparado para conectarse con múltiples frontends (apps móviles y React).

Slodigt está diseñado como un **marketplace central** que permite a negocios locales ofrecer productos y servicios a través de tiendas en línea o restaurantes virtuales. La plataforma monetiza mediante comisiones por venta y servicios premium para negocios.

---

## 🧰 Tecnologías Utilizadas

* **Framework**: Laravel 12+
* **Lenguaje**: PHP 8.2+
* **Base de datos**: MySQL / MariaDB
* **API Token Auth**: Laravel Sanctum
* **Frontend vinculado**: React (portal), apps móviles (Expo)
* **Entorno**: Docker + WSL2
* **Repositorio**: [GitHub - oscar-jp/slodigt-backend](https://github.com/oscar-jp/slodigt-backend)

---

## 🧩 Funcionalidades Esperadas

* Registro y autenticación de usuarios
* Roles diferenciados: cliente, negocio, repartidor, agente
* Tabla de cuentas con saldo por usuario o negocio
* Transferencias internas con verificación de PIN
* Activación y canjeo de tarjetas por QR + PIN
* Registro de recargas externas con comprobante (imagen, banco, ref.)
* Controladores REST organizados por módulo
* Gestión de catálogos de productos por negocio
* Creación de pedidos por parte de clientes
* Gestión manual de pedidos por parte de negocios
* Asignación y seguimiento de entregas a repartidores

---

## 🗃️ Estructura de Carpetas Relevante

```
slodigt-backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/ (registro, login, verificación)
│   │   │   ├── UserController.php
│   │   │   └── AuthController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   │   └── User.php (extendido con múltiples campos)
│   └── Providers/
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   ├── api.php
│   └── auth.php
├── public/, resources/, config/, storage/, tests/
```

---

## 🔐 Roles y Permisos

| Rol        | Permisos Básicos                                            |
| ---------- | ----------------------------------------------------------- |
| Cliente    | Consultar saldo, recibir recargas, hacer pedidos            |
| Negocio    | Activar tarjetas, transferir saldo, gestionar pedidos       |
| Repartidor | Aceptar entregas, ver historial y ganancias                 |
| Agente     | Aprobar recargas bancarias, dar soporte, gestionar usuarios |

---

## 🧪 Reglas para Codex u Otras IAs

1. **NO** modificar controladores existentes sin razón estructural válida.
2. **NO** cambiar el sistema de roles ni el uso de Sanctum.
3. **SÍ** puede proponer refactor si mejora la organización por dominio.
4. **SÍ** puede crear nuevas rutas o controladores si están documentados.
5. **NO** modificar migraciones ya en producción sin una alternativa segura.
6. **SÍ** puede auditar seguridad, middleware y sugerir mejoras en autenticación.
7. **SÍ** puede agregar pruebas automatizadas en `/tests/`.

---

## ✅ Pendientes Prioritarios

* Terminar módulo de recargas bancarias y verificación de imagen
* Terminar activación de tarjetas por QR
* Crear controlador completo de transferencias internas
* Agregar pruebas unitarias para cada rol
* Conectar backend a apps móviles (Expo) y frontend React (portal)
* Estructurar catálogo de productos por negocio
* Flujo completo de pedidos desde cliente hasta entrega

---

## 📦 Instalación Rápida

```bash
# Clonar y preparar
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed (opcional)
php artisan serve
```

---

## 📄 Licencia

Este proyecto está bajo licencia MIT y es parte del ecosistema privado de Slodigt.

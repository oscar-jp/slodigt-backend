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

## 🏗️ Módulos Implementados

### Gestión de Negocios
Manejo de altas de negocios, aprobación y roles internos. Utiliza los modelos
`Business`, `BusinessUserRole` y `BusinessReview`.

### Catálogo de Productos
Estructura de productos, variantes y categorías por negocio (tablas ya
disponibles). Pendiente integrar `ProductController` para CRUD completo.

### Pedidos y Entregas
Flujo de órdenes con su historial y seguimiento de repartidores mediante los
modelos `Order`, `Delivery` y `DeliveryTrack`.

### Cuentas y Transacciones
Módulo de recargas y transferencias internas. Incluye `Account`, `Recharge`,
`Transfer` y `Transaction`. Rutas disponibles:
`POST /recharges`, `POST /transfers`.

### Chats de Soporte
Canales de comunicación para resolver incidencias de pedidos o recargas.
Controlador: `SupportChatController` (`/support/chats` y `/support/chats/{chat}/messages`).

### Notificaciones
Registro de avisos al usuario por pedidos, recargas u otros eventos.
Controlador: `NotificationController` (`GET /notifications`).

---

## 🗃️ Estructura de Carpetas Relevante

```
slodigt-backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── UserController.php
│   │   │   ├── RechargeController.php
│   │   │   ├── TransferController.php
│   │   │   ├── SupportChatController.php
│   │   │   └── NotificationController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Account.php
│   │   ├── Business.php
│   │   ├── BusinessUserRole.php
│   │   ├── BusinessReview.php
│   │   ├── Order.php
│   │   ├── Delivery.php
│   │   ├── DeliveryTrack.php
│   │   ├── Recharge.php
│   │   ├── Transfer.php
│   │   ├── Transaction.php
│   │   ├── SupportChat.php
│   │   ├── SupportChatMessage.php
│   │   └── Notification.php
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

* Finalizar verificación de imagen en recargas bancarias
* Completar activación de tarjetas vía QR
* Implementar `BusinessController` y `ProductController`
* Desarrollar flujo completo de pedidos y entregas
* Añadir pruebas unitarias por rol
* Integrar API con apps móviles Expo y portal React

---
## 🧪 Entorno de validación visual
Para pruebas funcionales rápidas, se incluye un frontend básico con Blade para validar procesos como login, recargas, y pedidos. Este entorno no está destinado a producción.


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

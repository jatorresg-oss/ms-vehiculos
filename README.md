# ms-vehiculos · Vehículos

Microservicio de gestión de vehículos del sistema **LogiTrans Express** (control de rutas y transporte de carga).

## Stack

- PHP 8+
- Slim Framework 4
- Eloquent ORM (`illuminate/database`)
- MySQL / MariaDB
- Composer

## Estructura

```
ms-vehiculos/
├─ app/
│  ├─ Controllers/          Lógica de negocio
│  ├─ Models/               Modelos Eloquent
│  ├─ Presentation/
│  │  ├─ Repositories/      Adaptadores HTTP (request → response)
│  │  └─ Routers/           Definición de endpoints
│  ├─ Middlewares/
│  │  └─ cors.php
│  └─ global/
│     └─ database_config.php
├─ public/index.php         Punto de entrada
├─ db/                      Scripts de la base de datos
├─ endpoints.http           Pruebas manuales de la API
├─ .env.example
├─ composer.json
└─ README.md
```

## Puesta en marcha

```bash
composer install
copy .env.example .env          # Linux/macOS: cp .env.example .env
C:\xampp\php\php.exe -S 127.0.0.1:8003 -t public
```

> `vendor/`, `.env` y `composer.lock` **no** se versionan (requisito del examen).

## Endpoints

| Método | Ruta | Descripción |
|---|---|---|
| GET | `/health` | Estado del microservicio |
| GET | `/vehiculos` | Listado inicial (verificación de BD) |

## Base de datos

Base asignada: `logitrans_vehiculos`.

## Estado del proyecto

- **Día 1:** esqueleto del microservicio, CORS, conexión a la base de datos y
  endpoint de salud.
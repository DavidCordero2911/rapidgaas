# RapidGaas

**Sistema de Gestión y Seguimiento en Tiempo Real para Talleres de Motos**

Proyecto Intermodular de Desarrollo de Aplicaciones Web (PIDAWE) · 2.º DAW · Curso 2025/26

Autor: **David Cordero Carrasco**

---

## Descripción

RapidGaas es una aplicación web que digitaliza la gestión integral de un taller de motos: citas, vehículos, órdenes de reparación y comunicación con el cliente. Sustituye la gestión tradicional en papel/Excel por un sistema con **roles diferenciados**, **seguimiento en tiempo real** para el cliente, **notificaciones automáticas por email**, un **asistente virtual con inteligencia artificial** y herramientas de valor añadido como el **cálculo de ruta** al taller y la **previsión meteorológica**.

## Funcionalidades principales

- **Gestión de roles** (Administrador, Secretario, Mecánico, Cliente) con permisos diferenciados.
- **Panel interno** (AdminLTE): gestión de clientes, vehículos, citas y órdenes de trabajo.
- **Panel del mecánico**: actualización de estados de reparación, observaciones técnicas, registro de revisiones y subida de fotos.
- **Panel del cliente** (Bootstrap): seguimiento en tiempo real del estado de su moto con barra de progreso e historial.
- **Notificaciones automáticas por email** (Mailjet/SMTP) ante cambios de estado.
- **Chat de atención al cliente** con asistente de IA (Groq · `llama-3.3-70b-versatile`) y escalado a administrador.
- **Cálculo de ruta al taller** (Google Maps) y **previsión meteorológica** (OpenWeatherMap).
- **Análisis de datos** con un script en Python (pandas/matplotlib) para informes de productividad del taller.

## Stack tecnológico

| Área | Tecnología |
|------|-----------|
| Backend | Laravel 13.5 (PHP 8.5) |
| Autenticación | Laravel Breeze |
| Roles y permisos | Spatie Laravel-Permission |
| Base de datos | MySQL |
| Panel interno | AdminLTE |
| Panel cliente | Bootstrap 5.3 + CSS personalizado |
| Correo | Mailjet (SMTP) |
| Asistente IA | API de Groq (llama-3.3-70b-versatile) |
| Servicios externos | Google Maps API, OpenWeatherMap API |
| Entorno de desarrollo | XAMPP (Apache + MySQL) |
| Análisis de datos | Python (pandas, matplotlib, pymysql) |
| Control de versiones | Git + GitHub |

## Estructura del repositorio

```
rapidgaas/
├── app/                    # Lógica de la aplicación (modelos, controladores, middleware)
├── database/
│   ├── migrations/         # Definición de la estructura de la base de datos
│   └── seeders/            # Roles, permisos y usuario administrador inicial
├── resources/
│   ├── views/               # Vistas Blade (paneles AdminLTE y panel cliente)
│   └── views/emails/         # Plantillas de notificaciones por email
├── routes/                  # Definición de rutas web
├── public/                  # Punto de entrada y assets públicos
├── analisis-phyton/          # Script de análisis de datos (pandas/matplotlib)
│   └── informe_rapidgaas.py
├── docs/                     # Memoria técnica y diagramas del proyecto
├── .env.example              # Plantilla de variables de entorno
└── README.md
```

## Instalación y puesta en marcha (entorno local)

### Requisitos previos

- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL)
- [Composer](https://getcomposer.org/)
- [Node.js y NPM](https://nodejs.org/)
- [Python 3](https://www.python.org/) (opcional, para el script de análisis de datos)

### Pasos

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/<tu-usuario>/rapidgaas.git
   cd rapidgaas
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   npm install
   ```

3. **Configurar el entorno**

   Copia el archivo de ejemplo y renómbralo:
   ```bash
   cp .env.example .env
   ```

   Edita `.env` con tus credenciales de base de datos y las claves de API necesarias:
   ```
   DB_DATABASE=rapidgaas
   DB_USERNAME=root
   DB_PASSWORD=

   MAIL_MAILER=smtp
   MAIL_HOST=in-v3.mailjet.com
   MAIL_USERNAME=tu_api_key_mailjet
   MAIL_PASSWORD=tu_secret_key_mailjet

   GROQ_API_KEY=tu_api_key_groq
   GOOGLE_MAPS_API_KEY=tu_api_key_google_maps
   OPENWEATHER_API_KEY=tu_api_key_openweather
   ```

4. **Generar la clave de la aplicación**
   ```bash
   php artisan key:generate
   ```

5. **Arrancar Apache y MySQL** desde el panel de XAMPP.

6. **Crear la base de datos**

   Crea una base de datos vacía llamada `rapidgaas` desde phpMyAdmin.

7. **Ejecutar las migraciones y seeders**
   ```bash
   php artisan migrate --seed
   ```

   Esto crea todas las tablas, los roles (Administrador, Secretario, Mecánico, Cliente) y un usuario administrador inicial.

8. **Compilar los assets**
   ```bash
   npm run dev
   ```

9. **Arrancar el servidor**
   ```bash
   php artisan serve
   ```

   Accede a la aplicación en `http://localhost:8000`.

## Análisis de datos con Python

El script `analisis-phyton/informe_rapidgaas.py` se conecta a la base de datos `rapidgaas` y genera un informe de productividad del taller.

```bash
cd analisis-phyton
pip install pandas pymysql matplotlib openpyxl
python informe_rapidgaas.py
```

Genera:
- `ordenes_por_estado.png` — número de órdenes agrupadas por estado.
- `tiempo_medio_por_mecanico.png` — tiempo medio de reparación por mecánico.
- `informe_ordenes.xlsx` — informe detallado en Excel.

## Roles del sistema

| Rol | Funciones principales |
|-----|------------------------|
| **Administrador** | Gestión de usuarios y roles, supervisión de todas las órdenes, gestión del chat, cierre/entrega de órdenes. |
| **Mecánico** | Actualización del estado de las reparaciones, observaciones técnicas, registro de revisiones y subida de fotos. |
| **Cliente** | Seguimiento del estado de su moto, historial de actualizaciones, cálculo de ruta, previsión meteorológica y chat de atención. |

## Despliegue en producción (previsto)

La arquitectura de producción contempla la migración a contenedores **Docker** (PHP + Nginx + MySQL) sobre un **VPS** con Linux, dominio propio y certificado SSL/TLS de Let's Encrypt. El detalle completo de esta arquitectura, así como el plan de despliegue, se documenta en la memoria técnica del proyecto (`docs/`).

## Documentación

La memoria técnica completa del proyecto, con el análisis del sector, requisitos, diagramas UML, modelo Entidad-Relación, planificación, gestión de riesgos y seguimiento del proyecto, se encuentra en la carpeta [`docs/`](./docs).

## Licencia

Este proyecto se desarrolla con fines educativos como parte del ciclo formativo de Desarrollo de Aplicaciones Web (DAW). Las dependencias utilizadas (Laravel, Breeze, Spatie Laravel-Permission, AdminLTE, Bootstrap) se distribuyen bajo licencia MIT.

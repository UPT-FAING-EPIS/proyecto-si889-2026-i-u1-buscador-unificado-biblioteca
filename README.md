# 💻 Proyecto Sistema de Buscador Unificado de Recursos para Bibliotecas Físicas y Virtuales (NexusLib)

**NexusLib** es una plataforma de búsqueda avanzada diseñada para centralizar la consulta de recursos bibliográficos, integrando catálogos de inventario físico y repositorios virtuales en una interfaz única y eficiente. Su arquitectura permite gestionar colecciones locales mientras ofrece acceso a vastas fuentes de información digital bajo un entorno unificado.

---

### 🌐 Enlace de Despliegue
Puedes acceder al sistema desplegado a través del siguiente enlace:
👉 **[http://nexuslib.ddns.net](http://nexuslib.ddns.net)**

---

## 👨‍💻 Integrantes:

- Hurtado Ortiz, Leandro (2015052384)
- Flores Navarro, Eduardo Gino (2023076793)
- Cortez Mamani, Julio Samuel (2023077283)

---

## 🎯 Curso: Patrones de Software
## 🏫 Universidad Privada de Tacna
## 🗓️ Ciclo 2026-I

---

## 📋 Requisitos Previos

Para ejecutar el proyecto localmente, se requiere:
*   **XAMPP:** Con los módulos de **Apache** y **MySQL** iniciados.
*   **PHP:** Versión 8.2.12 recomendada.
*   **Composer:** Necesario para validar o reparar las dependencias del sistema.
*   **Gestor de BD:** HeidiSQL o phpMyAdmin para cargar el esquema.

## 🚀 Procedimiento de Despliegue Local

Aunque el paquete ya incluye la configuración base, sigue estos pasos para un despliegue seguro:

1.  **Ubicación:** 
    Copia la carpeta `nexuslib` dentro del directorio de publicación de XAMPP: `C:/xampp/htdocs/`.
2.  **Base de Datos:**
    Ejecuta el script SQL ubicado en `nexuslib/database/schema.sql` para crear la base de datos con las tablas necesarias.
3.  **Gestión de Dependencias (Importante):**
    Si al ejecutar el sistema recibes errores de carga de archivos (ej. `autoload_real.php`), abre una terminal en la carpeta del proyecto y ejecuta:
    ```bash
    composer install
    ```
    *Esto reconstruirá la carpeta `vendor/` garantizando la integridad de todas las librerías*.
4.  **Acceso al Sistema:**
    Abre tu navegador y entra a la siguiente dirección:
    `http://localhost/nexuslib/public/`

## ⚙️ Parámetros de Configuración (.env)

El proyecto utiliza un archivo **`.env`** en la carpeta raíz para gestionar credenciales de forma segura. Si tus credenciales de MySQL varían, edítalas allí:
```env
DB_HOST=localhost
DB_NAME=bd_nexus
DB_USER=root
DB_PASS=

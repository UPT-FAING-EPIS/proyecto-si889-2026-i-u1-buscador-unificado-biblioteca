# NexusLib - Buscador Unificado de Recursos Bibliográficos

NexusLib es una plataforma web híbrida de microservicios diseñada para resolver la fragmentación de la información académica en la Universidad Privada de Tacna. El sistema unifica de manera ágil y concurrente las consultas del catálogo físico de la universidad con repositorios digitales externos (Alpha Cloud y E-Libro), ofreciendo un espacio personal para estudiantes y un panel administrativo integrado.

---

## 🌐 Enlace de Despliegue Cloud

La plataforma se encuentra completamente publicada, operativa y disponible para su evaluación. Puedes acceder a la aplicación web en vivo directamente a través del siguiente enlace:

👉 **[http://nexuslib-upt.canadacentral.cloudapp.azure.com/nexuslib/](http://nexuslib-upt.canadacentral.cloudapp.azure.com/nexuslib/)**

---

## 🚀 Características Principales

El sistema implementa **9 Requerimientos Funcionales** estratégicos estructurados bajo patrones de diseño de software (*Facade, Adapter y Strategy*):

* **Búsqueda Unificada (RF-01):** Consulta simultánea distribuida entre el inventario local MySQL y las APIs externas.


* **Visualización Detallada (RF-02):** Ficha técnica unificada con metadatos estructurados y portadas.


* **Disponibilidad en Sala (RF-03):** Localización física en tiempo real (Piso y Estante) con control de existencias.


* **Filtrado Avanzado (RF-04):** Segmentación por Origen, Disponibilidad, Temas y Criterios de búsqueda.


* **Acceso Digital (RF-05):** Enlaces directos a visores externos o descargas autorizadas.


* **Gestión Administrativa (RF-06):** Panel protegido para el control de inventario local, usuarios y auditoría en modo lectura.


* **Seguridad y Autenticación (RF-07):** Registro y Login seguro mediante hashing de credenciales y tokens de sesión.


* **Módulo de Favoritos (RF-08):** Guardado persistente de referencias dentro del espacio personal del estudiante.


* **Módulo de Reservas (RF-09):** Separación preventiva de textos físicos en estantería con generación de códigos únicos de recojo.



---

## 📋 Requisitos del Sistema (Prerrequisitos)

Para ejecutar y compilar el proyecto en un entorno de desarrollo local, se requiere contar con las siguientes herramientas instaladas y configuradas:

* **XAMPP:** Con los módulos de **Apache** y **MySQL** completamente activos desde el Panel de Control.
* **PHP:** Versión **8.2.12** recomendada (con soporte para Programación Orientada a Objetos y extensiones `pdo_mysql`, `curl`, `json` habilitadas).


* **Gestor de Base de Datos:** Herramientas visuales como **HeidiSQL** o **phpMyAdmin** para administrar y cargar los esquemas relacionales.
* **Navegador Web:** Compatible con estándares ECMAScript 6 (ES6) para el renderizado correcto del frontend dinámico.



---

## ⚙️ Parámetros de Configuración de Base de Datos

A diferencia de configuraciones globales mediante archivos `.env`, la conexión con el motor relacional de NexusLib se gestiona directamente en las clases de configuración de los microservicios que interactúan con datos locales.

Deberás configurar los parámetros de conexión editando obligatoriamente los siguientes **3 archivos** dentro del repositorio:

1. `nexuslib/inventory-service/app/Config/Database.php`
2. `nexuslib/user-library-service/app/Config/Database.php`
3. `nexuslib/auth-service/app/Config/Database.php`

En cada uno de los archivos mencionados, localiza y modifica las siguientes variables con las credenciales correspondientes a tu servidor MySQL local:

```php
$host = '127.0.0.1';
$dbname = 'bd_nexus';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

```

---

## 🛠️ Procedimiento de Instalación Paso a Paso

Sigue estas instrucciones cronológicas para desplegar el proyecto localmente:

### 1. Clonar el Repositorio

Abre tu terminal y clona el código fuente del proyecto en tu directorio local de trabajo:

```bash
git clone https://github.com/UPT-FAING-EPIS/proyecto-si889-2026-i-ul-buscador-unificado-biblioteca.git
cd proyecto-si889-2026-i-ul-buscador-unificado-biblioteca

```

### 2. Configurar e Importar la Base de Datos Local

1. Inicia los módulos **Apache** y **MySQL** en el panel de XAMPP.
2. Abre tu gestor de base de datos de preferencia (**HeidiSQL** o **phpMyAdmin**).
3. Abre y ejecuta completamente el script base **`schema.sql`** ubicado en la carpeta `nexuslib/database` para inicializar de forma relacional las tablas del sistema (`accounts`, `inventory`, `reserved_books`, `saved_books`).

### 3. Inicializar el Servidor de Desarrollo Local

Para levantar la plataforma de manera inmediata, puedes utilizar el servidor de desarrollo nativo de PHP corriendo sobre cada módulo. Abre una terminal en la carpeta correspondiente al frontend y ejecuta:

```bash
php -S localhost:8000 -t public/

```

Una vez activo, abre tu navegador web e ingresa a la dirección: **`http://localhost:8000`**

---

## 📂 Estructura General del Proyecto

A continuación, se detalla un extracto general de la organización modular del repositorio bajo un esquema de arquitectura limpia y microservicios.

> 💡 **Nota para edición:** Reemplaza este bloque simplificado pegando tu árbol de directorios (*tree*) completo aquí:

```text
nexuslib/
├── frontend/               # Interfaz visual principal y capas de presentación (Boundaries)
│   ├── public/             # Archivos públicos de acceso (CSS, JS, imágenes, index.php)
│   ├── Views/              # Estructura de vistas (Admin, Layouts, Home, Search, Auth)
│   └── composer.json
├── gateway-service/        # Orquestador y Gateway API principal del sistema
├── alpha-service/          # Microservicio / Adaptador para la plataforma Alpha Cloud
├── elibro-service/         # Microservicio / Adaptador para la plataforma e-Libro
├── inventory-service/      # Gestión del inventario físico local de la UPT (MySQL)
├── auth-service/           # Control de autenticación, usuarios y seguridad
└── user-library-service/   # Persistencia y lógica de libros guardados y reservas

```

---

## 🛡️ Análisis Estático y Despliegue Seguro (DevSecOps)

Para dar cumplimiento con las normativas de desarrollo seguro y asegurar la calidad del código fuente frente a bugs o vulnerabilidades de inyección, el repositorio tiene integrados flujos de trabajo (*Pipelines*) mediante **GitHub Actions**.

Las herramientas automatizadas configuradas en el pipeline de Integración Continua (CI) son:

* **SonarQube:** Utilizado para el análisis estático de código, medición de deuda técnica, cobertura y detección de *code smells*.
* **Snyk / Semgrep:** Herramientas de seguridad encargadas de escanear las dependencias y el código en busca de vulnerabilidades conocidas (OWASP Top 10) antes de autorizar cualquier despliegue en producción.



Para ejecutar de manera local una revisión rápida de sintaxis y estándares antes de realizar un *Push* al repositorio, puedes utilizar los comandos de análisis estático correspondientes a tu entorno de pruebas configurado.

**![C:\\Users\\EPIS\\Documents\\upt.png][image1]**

**UNIVERSIDAD PRIVADA DE TACNA**

**FACULTAD DE INGENIERIA**

**Escuela Profesional de Ingeniería de Sistemas**

 **Sistema NexusLib**

Curso: Patrones de Software

Docente: Ing. Patrick Cuadros Quiroga

Integrantes:

**Hurtado Ortiz, Leandro			(2015052384)**  
***Flores Navarro, Eduardo Gino		(2023076793)***  
***Cortez Mamani, Julio Samuel		(2023077283)***

**Tacna – Perú**  
***2026***

| CONTROL DE VERSIONES |  |  |  |  |  |
| :---: | :---: | :---: | :---: | :---: | ----- |
| Versión | Hecha por | Revisada por | Aprobada por | Fecha | Motivo |
| 1.0 | MPV | ELV | ARV | 10/10/2020 | Versión Original |

# 

# 

# 

# 

# 

# 

# 

# 

# 

# 

# 

# **Sistema NexusLib**

# **Versión *1.0***

| CONTROL DE VERSIONES |  |  |  |  |  |
| :---: | :---: | :---: | :---: | :---: | ----- |
| Versión | Hecha por | Revisada por | Aprobada por | Fecha | Motivo |
| 1.0 | MPV | ELV | ARV | 10/10/2020 | Versión Original |

**INDICE GENERAL**

**[1\. Introducción	4](#1.-introducción)**

[**1.1 Propósito	4**](#1.1-propósito)

[**1.2 Alcance	4**](#1.2-alcance)

[**1.3 Definiciones, Siglas y Abreviaturas	5**](#1.3-definiciones,-siglas-y-abreviaturas)

[**1.4 Referencias	6**](#1.4-referencias)

[**1.5 Visión General	6**](#1.5-visión-general)

[**2\. Posicionamiento	7**](#2.-posicionamiento)

[**2.1 Oportunidad de negocio	7**](#2.1-oportunidad-de-negocio)

[**2.2 Definición del problema	7**](#2.2-definición-del-problema)

[**3\. Descripción de los interesados y usuarios	7**](#3.-descripción-de-los-interesados-y-usuarios)

[**3.1 Resumen de los interesados	7**](#3.1-resumen-de-los-interesados)

[**3.2 Resumen de los usuarios	7**](#3.2-resumen-de-los-usuarios)

[**3.3 Entorno de usuario	7**](#3.3-entorno-de-usuario)

[**3.4 Perfiles de los interesados	7**](#3.4-perfiles-de-los-interesados)

[**3.5 Perfiles de los Usuarios	7**](#3.5-perfiles-de-los-usuarios)

[**3.6 Necesidades de los interesados y usuarios	7**](#3.6-necesidades-de-los-interesados-y-usuarios)

[**4\. Vista General del Producto	7**](#4.-vista-general-del-producto)

[**4.1 Perspectiva del producto	7**](#4.1-perspectiva-del-producto)

[**4.2 Resumen de capacidades	7**](#4.2-resumen-de-capacidades)

[**4.3 Suposiciones y dependencias	7**](#4.3-suposiciones-y-dependencias)

[**4.4 Costos y precios	7**](#4.4-costos-y-precios)

[**4.5 Licenciamiento e instalación	7**](#4.5-licenciamiento-e-instalación)

[**5\. Características del producto	7**](#5.-características-del-producto)

[**6\. Restricciones	7**](#6.-restricciones)

[**7\. Rangos de calidad	7**](#7.-rangos-de-calidad)

[**8\. Precedencia y Prioridad	7**](#8.-precedencia-y-prioridad)

[**9\. Otros requerimientos del producto	8**](#9.-otros-requerimientos-del-producto)

[b) Estandares legales	8](#b\)-estandares-legales)

[c) Estandares de comunicación	8](#c\)-estándares-de-comunicación)

[d) Estandaraes de cumplimiento de la plataforma	8](#d\)-estándares-de-cumplimiento-de-la-plataforma)

[e) Estandaraes de calidad y seguridad	8](#e\)-estándares-de-calidad-y-seguridad)

[**CONCLUSIONES	8**](#conclusiones)

[**RECOMENDACIONES	8**](#recomendaciones)

[**BIBLIOGRAFIA	8**](#bibliografia)

[**WEBGRAFIA	8**](#webgrafia)

# **1\.	Introducción** {#1.-introducción}

# **1.1	Propósito** {#1.1-propósito}

El propósito de este proyecto es desarrollar una plataforma centralizada que unifique el acceso a colecciones bibliográficas físicas y recursos digitales dispersos. El sistema busca eliminar la fragmentación de la información, permitiendo que cualquier usuario, independientemente de su ubicación, pueda localizar, consultar la disponibilidad y acceder a materiales de lectura o investigación desde un único punto de entrada, optimizando así los tiempos de búsqueda y mejorando la visibilidad de los activos de la biblioteca.	

# **1.2	Alcance** {#1.2-alcance}

	El sistema NexusLib actuará como un integrador inteligente de recursos.

* **Funcionalidades Incluidas:**  
  * Búsqueda simultánea en inventarios locales (libros físicos, revistas, archivos) y repositorios remotos (e-books, artículos científicos, bases de datos en la nube).  
  * Sincronización de estados de disponibilidad en tiempo real para recursos físicos.  
  * Personalización de los criterios de búsqueda según las necesidades del usuario (búsquedas por relevancia, categorías o coincidencias exactas).  
  * Sistema de alertas y suscripción para recursos actualmente no disponibles.  
* **Funcionalidades Excluidas:**  
  * Gestión de procesos administrativos internos (nóminas, contratación de personal).  
  * Venta de libros o pasarelas de pago para multas.  
  * Digitalización física de documentos (escaneo de libros).

# **1.3	Definiciones, Siglas y Abreviaturas** {#1.3-definiciones,-siglas-y-abreviaturas}

# 

| Término / Sigla | Definición |
| :---- | :---- |
| Recurso Unificado | Objeto de información que agrupa datos tanto de origen físico como digital bajo un formato común. |
| Sistema Legacy | Sistema informático antiguo (generalmente para inventario físico) que todavía sigue en uso y debe integrarse. |
| API | Interfaz de programación que permite al buscador conectar con bases de datos externas de libros virtuales. |
| Metadata | Información estructurada que describe las características de un libro o recurso (autor, año, ISBN). |
| Disponibilidad Reactiva | Capacidad del sistema de informar automáticamente al usuario cuando un recurso cambia su estado a "disponible". |

# 	

# **1.4	Referencias** {#1.4-referencias}

**Estándares de Codificación:** Siguiendo las guías de la industria (PEP 8 para Python o Google Java Style) para asegurar legibilidad.

**Principios de Calidad:** Basado en las 10 Buenas Prácticas de Programación (Referencia: Infografía de ByteByteGo).

**Documentación Técnica:** Manuales de integración de APIs de terceros (Open Library, Google Books API, etc.).

	

# **1.5	Visión General** {#1.5-visión-general}

Este documento detalla el camino desde la identificación de la problemática de búsqueda fragmentada hasta la propuesta de una arquitectura de software robusta. Se abordará primero el análisis de la problemática actual, seguido por el diseño de la solución donde se aplicarán estrategias de software para manejar la diversidad de fuentes de datos. El informe culmina con la metodología de desarrollo y las pruebas que aseguran que el buscador sea rápido, seguro y fácil de mantener.

 	

# **2\.	Posicionamiento**	 {#2.-posicionamiento}

# **2.1	Oportunidad de negocio** {#2.1-oportunidad-de-negocio}

La transformación digital ha cambiado el hábito de consumo de información, pero las bibliotecas físicas siguen siendo pilares de conocimiento y espacios de estudio esenciales. La oportunidad de negocio de **NexusLib** reside en la modernización de la experiencia híbrida.

* **Optimización de Recursos:** Muchas organizaciones (municipios, centros de investigación, corporaciones) pagan suscripciones digitales costosas que los usuarios no usan porque no saben que existen, al estar ocultas en portales distintos al catálogo físico.  
* **Centralización Operativa:** Al unificar la búsqueda, se reduce el gasto en mantenimiento de múltiples interfaces de usuario y se centraliza la analítica de datos (saber qué temas son los más buscados, ya sea en papel o en digital).  
* **Diferenciación de Servicio:** Una biblioteca que ofrece una búsqueda fluida y alertas de disponibilidad en tiempo real aumenta su tasa de retención de usuarios y se posiciona como una entidad a la vanguardia tecnológica.

	

# **2.2	Definición del problema** {#2.2-definición-del-problema}

| Elemento | Descripción |
| :---- | :---- |
| **El problema de...** | La dispersión de la información y la falta de integración entre inventarios físicos y repositorios digitales. |
| **Afecta a...** | Usuarios finales (estudiantes, investigadores, lectores) y administradores de bibliotecas. |
| **El impacto asociado es...** | Pérdida de tiempo en búsquedas infructuosas, subutilización de recursos digitales pagados y frustración por la falta de información sobre la disponibilidad inmediata de ejemplares físicos. |
| **Una solución exitosa sería...** | Un buscador único "agnóstico a la fuente", que presente resultados normalizados y permita filtrar por tipo de recurso, relevancia o disponibilidad en una sola consulta. |

	

# **3\.	Descripción de los interesados y usuarios**	 {#3.-descripción-de-los-interesados-y-usuarios}

# **3.1	Resumen de los interesados** {#3.1-resumen-de-los-interesados}

Los interesados (*stakeholders*) son aquellas personas o entidades que tienen un interés directo en el éxito del proyecto, ya sea porque lo financian, lo administran o proveen la información.

| Interesado | Descripción | Responsabilidad / Interés |
| :---- | :---- | :---- |
| **Administración de la Biblioteca** | Directivos o dueños del centro de documentación. | Interesados en la rentabilidad de las suscripciones digitales y la eficiencia del servicio. |
| **Departamento de TI** | Personal técnico encargado de los servidores y redes. | Interesados en que la integración con los sistemas *legacy* no afecte la estabilidad de la red. |
| **Proveedores de Contenido Digital** | Entidades externas (Ej. Elsevier, Springer, Google Books). | Proveen las APIs y el contenido virtual que el sistema debe consumir. |
| **Personal Bibliotecario** | Empleados que gestionan el inventario físico. | Interesados en que el estado de los libros (prestado/disponible) se refleje correctamente en el buscador. |

	

# **3.2	Resumen de los usuarios** {#3.2-resumen-de-los-usuarios}

Los usuarios son quienes interactúan directamente con la aplicación para satisfacer una necesidad de información.

| Usuario | Perfil | Necesidad Principal |
| :---- | :---- | :---- |
| **Investigador / Especialista** | Usuario avanzado con necesidades de información técnica. | Requiere filtros complejos, metadatos detallados y acceso a journals específicos. |
| **Lector General / Estudiante** | Usuario que busca material de apoyo o recreativo. | Busca rapidez, facilidad de uso y saber si el libro está físicamente en el estante. |
| **Usuario Remoto** | Persona que consulta el catálogo desde fuera de las instalaciones. | Prioriza el acceso a recursos digitales (E-books, PDF) de visualización inmediata. |

	

# **3.3	Entorno de usuario** {#3.3-entorno-de-usuario}

El sistema debe operar en un entorno híbrido y flexible para adaptarse a las distintas situaciones de consulta:

* Plataforma Web: El entorno principal será una aplicación web responsiva, accesible desde navegadores modernos tanto en computadoras de escritorio como en dispositivos móviles.  
* Módulos de Consulta en Sitio (Kioscos): Pantallas táctiles dentro de la biblioteca física dedicadas exclusivamente a la búsqueda rápida y localización de estanterías.  
* Integración de Red: El sistema debe coexistir en un entorno donde se requiere conectividad constante a Internet para las fuentes virtuales y acceso a la red local (Intranet) para consultar la base de datos de libros físicos.  
* Disponibilidad: Se espera un entorno de alta disponibilidad ($24/7$ para recursos digitales), aunque la actualización de inventario físico pueda depender de los horarios de atención de la biblioteca.

# 	

# **3.4	Perfiles de los interesados** {#3.4-perfiles-de-los-interesados}

A diferencia de los usuarios, los interesados suelen evaluar el sistema bajo métricas de éxito institucional, técnico o financiero.

| Interesado | Educación / Conocimiento | Motivaciones Principales | Criterios de Éxito |
| :---- | :---- | :---- | :---- |
| **Director de Biblioteca** | Gestión administrativa, Bibliotecología. | Maximizar el uso de los recursos contratados y reducir quejas. | Reportes de uso claros y aumento en la consulta de e-books. |
| **Líder Técnico (TI)** | Ingeniería de Software, Seguridad Informática. | Estabilidad del sistema y facilidad de mantenimiento. | Código limpio, **robusto** y que no sature los servidores *legacy*. |
| **Proveedores Externos** | Desarrollo Web, APIs REST/GraphQL. | Cumplimiento de contratos de servicio (SLA) y seguridad de datos. | Consultas eficientes a sus APIs sin exceder los límites de tráfico. |

# **3.5	Perfiles de los Usuarios** {#3.5-perfiles-de-los-usuarios}

Aquí definimos el "Target" del buscador para diseñar una experiencia de usuario (UX) coherente.

| Usuario | Nivel Técnico | Frecuencia de Uso | Interés en el Sistema |
| :---- | :---- | :---- | :---- |
| **Estudiante Pregrado** | Medio (Nativo Digital). | Alta (en periodos de exámenes). | Encontrar el libro rápido y saber si puede ir a recogerlo físicamente "ya". |
| **Investigador Académico** | Alto (Uso de bases de datos). | Media / Constante. | Precisión en los metadatos, filtros por año/autor y acceso a PDFs directos. |
| **Bibliotecario de Sala** | Medio (Sistemas de gestión). | Muy Alta (Diaria). | Que el buscador refleje el inventario real para no dar información falsa al público. |

	

# **3.6	Necesidades de los interesados y usuarios** {#3.6-necesidades-de-los-interesados-y-usuarios}

Esta tabla resume los "puntos de dolor" que el sistema NexusLib debe atacar directamente:

| Prioridad | Necesidad | Interesado/Usuario | Solución Propuesta |
| :---- | :---- | :---- | :---- |
| **Crítica** | Acceso en un solo paso a múltiples fuentes. | Estudiante / Investigador | **Buscador Unificado** (Patrón Facade/Adapter). |
| **Alta** | Conocer si un libro físico está en estante o prestado. | Lector / Bibliotecario | **Sincronización en Tiempo Real** (Monitoreo de DB Local). |
| **Alta** | Recibir aviso cuando un libro se libera. | Estudiante | **Sistema de Suscripciones** (Patrón Observer). |
| **Media** | Poder buscar por "conceptos" o "temas" no exactos. | Investigador | **Estrategias de Búsqueda Avanzada** (Patrón Strategy). |
| **Media** | Reportes de qué recursos son los más buscados. | Dirección | **Módulo de Analítica** integrado en el backend. |

	

# **4\.	Vista General del Producto**	 {#4.-vista-general-del-producto}

# **4.1	Perspectiva del producto** {#4.1-perspectiva-del-producto}

NexusLib no es un sistema aislado, sino un middleware de integración inteligente. Se posiciona como una capa intermedia entre las interfaces de usuario modernas y las fuentes de datos heterogéneas.

* **Relación con Sistemas Externos:** El producto interactúa con bases de datos relacionales (inventario físico) mediante conectores directos y con servicios en la nube (repositorios digitales) a través de protocolos de red (HTTP/HTTPS).  
* **Independencia de Interfaz:** Está diseñado bajo una arquitectura desacoplada, lo que permite que el motor de búsqueda sea consumido por una aplicación web, una app móvil o un kiosco físico sin modificar la lógica de negocio.

	

# **4.2	Resumen de capacidades** {#4.2-resumen-de-capacidades}

El sistema ofrece un conjunto de capacidades core diseñadas para la eficiencia del usuario:

* **Búsqueda Polimórfica:** Capacidad de tratar un libro físico y un PDF digital como un mismo "Recurso" funcional, facilitando la comparación.  
* **Normalización de Datos:** Transforma formatos diversos (JSON, XML, SQL) en un modelo de datos único y coherente.  
* **Filtrado Multinivel:** Permite aplicar estrategias de ordenamiento por relevancia, fecha, autor o disponibilidad en tiempo real.  
* **Gestión de Suscripciones:** Monitoreo activo de ítems prestados con notificación automática al liberar el recurso.

	

# **4.3	Suposiciones y dependencias** {#4.3-suposiciones-y-dependencias}

Para el correcto funcionamiento de NexusLib, se asumen los siguientes factores:

* **Conectividad:** Se asume una conexión a internet estable para la consulta de recursos virtuales y una conexión de red local latente para los recursos físicos.  
* **Calidad de Origen:** El sistema depende de que las APIs de terceros (como Google Books o repositorios institucionales) mantengan sus servicios activos y sus esquemas de datos documentados.  
* **Integridad de Datos Legacy:** Se asume que la base de datos de la biblioteca física cuenta con campos mínimos de identificación (ISBN, Título, Estado de préstamo) para poder indexarlos.

	

# **4.4	Costos y precios** {#4.4-costos-y-precios}

Al ser un proyecto de desarrollo de software bajo demanda o de implementación institucional, el esquema de costos se divide en:

* Costo de Desarrollo: Inversión inicial en el diseño de la arquitectura, implementación de patrones de diseño y configuración de adaptadores.  
* Costo de Infraestructura: Pago de servidores (Cloud o On-premise) y mantenimiento de las bases de datos de caché (ej. Redis) para búsquedas rápidas.  
* Mantenimiento Operativo: Actualización de adaptadores en caso de que las APIs externas cambien su estructura o versiones.

# 	

# **4.5	Licenciamiento e instalación** {#4.5-licenciamiento-e-instalación}

* Licenciamiento: El software se distribuirá bajo una licencia de tipo Propiedad Intelectual Institucional o Open Source (MIT), permitiendo a la entidad modificar los adaptadores según sus necesidades futuras.  
* Instalación:  
  * Backend: Despliegue en contenedores (Docker) para asegurar que el entorno de ejecución sea idéntico en desarrollo y producción.  
  * Base de Datos: Requiere un motor compatible (PostgreSQL/MySQL) y una instancia de caché.  
  * Configuración: Uso de variables de entorno para las credenciales de las APIs externas y cadenas de conexión a las bases de datos físicas.

# 	

# **5\.	Características del producto** {#5.-características-del-producto}

Esta sección detalla las funcionalidades clave que definen la propuesta de valor de **NexusLib**:

* **C01 \- Interfaz de Búsqueda Omnicanal:** Un único punto de entrada capaz de procesar consultas y delegarlas a múltiples orígenes de datos simultáneamente.  
* **C02 \- Motor de Normalización de Metadatos:** Capacidad de recibir datos en formatos heterogéneos (JSON de APIs, registros SQL, XML) y transformarlos en un objeto de dominio único.  
* **C03 \- Gestión de Estrategias de Filtrado:** Permite al usuario alternar entre algoritmos de ordenamiento (por relevancia, por fecha de publicación o por cercanía física) sin recargar la aplicación.  
* **C04 \- Monitor de Disponibilidad en Tiempo Real:** Servicio en segundo plano que verifica el estado de los ejemplares físicos y actualiza la interfaz del usuario.  
* **C05 \- Sistema de Notificaciones Eventuales:** Gestión de suscripciones para alertar a los interesados cuando un recurso de alta demanda sea liberado.

# **6\.	Restricciones** {#6.-restricciones}

Las restricciones definen los límites de diseño y construcción del sistema:

* R01 \- Compatibilidad Legacy: El sistema debe ser capaz de conectarse a bases de datos relacionales antiguas (como SQL Server 2008 o versiones anteriores de MySQL) sin exigir una migración de los datos existentes.  
* R02 \- Limitaciones de API de Terceros: El volumen de búsquedas digitales estará sujeto a las cuotas y límites de tráfico (*Rate Limiting*) impuestos por los proveedores externos (Google Books, Open Library).  
* R03 \- Seguridad de Acceso: No se almacenarán credenciales de usuarios externos; toda autenticación con servicios de terceros deberá realizarse mediante protocolos estándar (OAuth 2.0).  
* R04 \- Lenguaje de Implementación: El núcleo del sistema debe desarrollarse utilizando un lenguaje que soporte tipado fuerte y programación orientada a objetos (POO) para garantizar la correcta aplicación de los patrones de diseño.

# 	

# **7\.	Rangos de calidad** {#7.-rangos-de-calidad}

Para asegurar que el producto cumple con los estándares de Robustez y Seguridad mencionados en las buenas prácticas, se definen los siguientes niveles:

| Atributo de Calidad | Rango Aceptable | Método de Medición |
| :---- | :---- | :---- |
| **Rendimiento (Latencia)** | Consultas unificadas en \< 2 segundos. | Pruebas de carga en el buscador. |
| **Disponibilidad** | 99.5% de tiempo de actividad del servicio core. | Monitoreo de uptime del servidor. |
| **Mantenibilidad** | Índice de complejidad ciclomática bajo (\< 15 por método). | Herramientas de análisis estático de código. |
| **Escalabilidad** | Capacidad de añadir un nuevo adaptador de API en \< 4 horas de desarrollo. | Tiempo de implementación de interfaces. |

	

# **8\.	Precedencia y Prioridad** {#8.-precedencia-y-prioridad}

En un entorno de desarrollo bajo el SDLC, es vital saber qué construir primero para mitigar riesgos.

1. Prioridad Alta (Fase 1): \* Implementación de la arquitectura base (Capa de Dominio).  
   * Desarrollo del Patrón Adapter para la base de datos física y una API virtual básica.  
   * Funcionalidad de búsqueda simple.  
2. Prioridad Media (Fase 2):  
   * Implementación del Patrón Strategy para filtros avanzados.  
   * Desarrollo de la interfaz de usuario responsiva.  
   * Normalización completa de metadatos.  
3. Prioridad Baja (Fase 3):  
   * Sistema de notificaciones (Patrón Observer).  
   * Módulo de analítica y reportes para administradores.  
   * Optimización de caché para resultados frecuentes.

# 	

# **9\.	Otros requerimientos del producto**	 {#9.-otros-requerimientos-del-producto}

## 	**[b) Estandares legales](#heading=h.r7wurbpv9a4q)** {#b)-estandares-legales}

Para asegurar que el sistema sea viable en un entorno real y respete la propiedad intelectual:

* **Protección de Datos Personales:** El sistema debe cumplir con la Ley de Protección de Datos Personales (LPDP**)** de la jurisdicción correspondiente (ej. GDPR en Europa o leyes locales de privacidad), asegurando que las búsquedas y suscripciones de los usuarios sean privadas y no se comercialicen.  
* **Derechos de Autor (Copyright):** El buscador solo mostrará metadatos (título, autor, resumen) y enlaces legales a los recursos. No se permitirá el almacenamiento ni la distribución de archivos PDF que no cuenten con licencias de acceso abierto (Open Access) o suscripciones activas.  
* **Términos de Uso de APIs:** El software debe respetar las cláusulas de "Uso Aceptable" de los proveedores externos (como Google o Springer), evitando el *scraping* masivo que infrinja sus políticas.

## 	**[c) Estándares de comunicación](#heading=h.r7wurbpv9a4q)** {#c)-estándares-de-comunicación}

	Para garantizar que la integración unificada sea fluida y profesional:

* **Protocolos de Red:** Toda comunicación entre el frontend, el backend y las APIs externas debe realizarse obligatoriamente sobre **HTTPS (TLS 1.2 o superior)**.  
* **Formato de Intercambio:** Se establece **JSON** como el estándar de comunicación interna entre módulos, facilitando la interoperabilidad entre los diferentes **Adaptadores** y el núcleo del sistema.  
* **Arquitectura RESTful:** El sistema debe exponer sus capacidades mediante una API REST bien documentada, facilitando que futuros clientes (como una App móvil) puedan integrarse sin fricción.

## 	**[d) Estándares de cumplimiento de la plataforma](#heading=h.r7wurbpv9a4q)** {#d)-estándares-de-cumplimiento-de-la-plataforma}

	Para asegurar la portabilidad y el despliegue eficiente:

* 		**Contenedorización (Docker):** El sistema debe ser capaz de ejecutarse en contenedores, facilitando su despliegue en cualquier servidor (On-premise o Cloud) sin conflictos de dependencias.  
* **Compatibilidad de Navegadores:** La interfaz de usuario debe cumplir con los estándares de **W3C** para asegurar el funcionamiento correcto en Chrome, Firefox, Safari y Edge (basado en Chromium).  
* **Responsividad:** Cumplimiento con el estándar *Mobile First*, asegurando que el buscador sea 100% funcional en dispositivos móviles y tablets.

## 	**[e) Estándares de calidad y seguridad](#heading=h.r7wurbpv9a4q)** {#e)-estándares-de-calidad-y-seguridad}

	Este es el pilar que sostiene la confianza en el software:

* **Seguridad (OWASP):** Las entradas de búsqueda deben ser saneadas para prevenir ataques de **Inyección SQL** y **Cross-Site Scripting (XSS)**.  
* **Autenticación y Autorización:** Uso de **JWT (JSON Web Tokens)** para manejar las sesiones de los usuarios de forma segura y sin estado (stateless).  
* **Calidad de Código (Clean Code):** Se realizarán auditorías de código para asegurar que se respeten los principios **SOLID** y que el código tenga una cobertura de pruebas unitarias de al menos el **80%**.  
* **Manejo de Errores (Robustness):** Implementación de *Graceful Degradation*; si una API externa (como la de e-books) falla, el sistema debe seguir mostrando los resultados de la biblioteca física sin colapsar la búsqueda completa.

# [**CONCLUSIONES**](#heading=h.3hxr54n1w5j0) {#conclusiones}

**Unificación Eficiente:** Se logró diseñar una solución que rompe los silos de información, demostrando que mediante el patrón **Adapter**, es posible integrar sistemas *legacy* y tecnologías modernas bajo un modelo de dominio único sin comprometer la integridad de los datos originales.

**Escalabilidad y Mantenimiento:** La aplicación de **SOLID** y **Domain-Driven Design (DDD)** garantiza que el sistema pueda crecer. Agregar una nueva fuente de recursos (como una nueva API de una editorial) no requiere modificar el núcleo del buscador, cumpliendo con el principio de Abierto/Cerrado.

**Optimización de la Experiencia:** El uso del patrón **Strategy** permite que el sistema sea versátil, ofreciendo diferentes tipos de búsqueda que se adaptan tanto al usuario académico riguroso como al estudiante que busca rapidez, mejorando los tiempos de respuesta y la precisión de los resultados.

**Robustez y Seguridad:** Al implementar estándares de comunicación cifrada (HTTPS) y saneamiento de entradas, el sistema no solo es funcional, sino que cumple con los rangos de calidad exigidos para proteger la privacidad del usuario y la estabilidad de la infraestructura institucional.

# [**RECOMENDACIONES**](#heading=h.c75ep12k44ho) {#recomendaciones}

* **Implementación de Caché:** Se recomienda integrar una capa de persistencia temporal (como **Redis**) para los resultados de las APIs externas más frecuentes, reduciendo la latencia y el consumo de cuotas de tráfico de terceros.  
* **Refactorización Continua:** Siguiendo el punto 09 de las buenas prácticas, es vital realizar revisiones de código periódicas para asegurar que la "abstracción moderada" no se convierta en una sobre-ingeniería que dificulte la entrada de nuevos desarrolladores al proyecto.  
* **Pruebas de Usuario (UX):** Antes de un despliegue masivo, se sugiere realizar pruebas de usabilidad con los diferentes perfiles definidos (estudiantes e investigadores) para ajustar las estrategias de búsqueda por defecto.  
* **Adopción de Microservicios:** En una etapa futura, se recomienda evaluar la migración del motor de búsqueda a una arquitectura de microservicios si la carga de usuarios aumenta significativamente, manteniendo el aislamiento de los contextos delimitados definidos en el diseño.

# [**BIBLIOGRAFIA**](#heading=h.n5qpz2nblnlj) {#bibliografia}

**Gamma, E., Helm, R., Johnson, R., & Vlissides, J. (1994).** *Design Patterns: Elements of Reusable Object-Oriented Software*. Addison-Wesley Professional. (El libro base para los patrones Adapter, Strategy y Observer).

**Evans, E. (2003).** *Domain-Driven Design: Tackling Complexity in the Heart of Software*. Addison-Wesley. (Referencia fundamental para el modelado de contextos y lenguaje ubicuo).

**Martin, R. C. (2008).** *Clean Code: A Handbook of Agile Software Craftsmanship*. Prentice Hall. (Base para los principios SOLID y legibilidad).

# [**WEBGRAFIA**](#heading=h.av9ddmv7ljg) {#webgrafia}

**ByteByteGo (2024).** *10 Good Programming Practices*. Recuperado de: \[Referencia a la infografía de la imagen proporcionada\].

**Refactoring.Guru.** *Patrones de Diseño: Estructurales y de Comportamiento*. Disponible en: [https://refactoring.guru/es/design-patterns](https://refactoring.guru/es/design-patterns)

**Microsoft Learn.** *Evolución de arquitecturas: DDD y Microservicios*. Disponible en: [https://learn.microsoft.com/es-es/dotnet/architecture/microservices/microservice-ddd-cqrs-patterns/](https://learn.microsoft.com/es-es/dotnet/architecture/microservices/microservice-ddd-cqrs-patterns/)

**OWASP Foundation.** *Top 10 Web Application Security Risks*. Disponible en: [https://owasp.org/www-project-top-ten/](https://owasp.org/www-project-top-ten/)

[image1]: <data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGkAAACNCAYAAAC0V1SuAAAmiUlEQVR4Xu1dB3wTR9Y3NUd6wAVy5NIAyaZqV5ILxfTejDHYkgyhhDRaKoQk+FIuBdIIYEs2hEC+L5eQdpfkUi53Id+lgG3ZOEBooYWOaaHjOt97szur0awkS8YYO+f/7/d+Ws28ae9NeVN2NiysAQ2oKcT3jM9mz3EJcUt5v1iL5T7+P6Jx48bpV11/9SD4nd7i+hb3g1Mz1atJs2v+kMbzNqCGEN89fhb+9neMWJDQP+FmfI4bG9di+GMTdsFjIy9mFdeG3/hE0qLplS1vb7MnxfVgpWXS4CPNrrrqmdTlj5KmTZt2F/kbcAnoM2bQo/H9eg7rNaRf59F/nnIOnBr1SRo4I9X5cGV8fLxF5OdxQ9uI5+xvP04GPpVO+j9uJ6Nfu584/mceGfz0xArw/oPI34BqYtgjjr3Qxc1IeWNWaeLogV+OXzq7JG3FY6WJgxPbgnfjuLi46WIYhqYtWlivaXV99tjM2cS+ai7plpJIsCWhooyDLftF/gZUE8PnTjgwYNLo87Y355BBU8eQgZOSykbMnbB51JOTLvZPG7ZI5BfQ/Oaud74zLvuhSlRM8pKZJPHBsVRJ2MKaNWvWWQzQgGqgX+qQp9Og9ic9N40Kd9RTk8nAqcknunfvHtcjsUf/hISE68QwAm5v0qTJ8Ph7hp/G8DHD42g8SIZBlj1NrmoyUAzQgCDQc3CfufgbK8u94afR+CWzybjFs8n4zAc1AdtXPU762Ucs9A7pF81u69Epb/iLd5OeM5JIlzE9aRx9HhlX2W9uWonI3IAgMPwRx5nBgwdfBYZBOow5LeN7Jnw+av7k80nP3n0eu79eIwZko78Yrgq0aHVHm/eZkpE6j+5Bf8EvRmRuQABA99Ut5dXplX3HDJwOSpo8YHLSd+g+YOLon0XeUNH8muYPmtMHkF6zk+n41Hl0d6qkFi2vf1vkbUAA9Jsw6gUU3Jjn7zk5cGrS1/aVcyuHPmj7EkzxF/skD5xsiotrJ4YJBU2uvnowxo9dX/f7R1El3finyEPXtLzGr5XYAAH9J478JG0ZmMlgfUEXR8YufKA0LfsRMjJjysGUxbMuhPmZvAaLxk2bPhphvKUYlZMILQpNcmxVt5gNRSJvA/wALDZa00dnTCG2FXM0Y2Hsyw9UyrJ8tchfDdwU0eGWb7CrMw6xko4j4mn83cb33icyNiAAhtyf8tcBk5Iqh85MJdDdkf624cvDMsIai3zVRBOgcFTMyAX3kL6PpVIltUvsuh3cbxSZGyDAYrF0jEtUxpw4q/XZ+O7xc2ITYkfi/54Deyd7c18CmjR6DVcgbG/NIWnQWrEiDHt+Clp5A0TWBgjoNazvNqvVen2PIX3u7jGgx9jeSYPmDZw2ds2gqcnv9h0/7A2R/xLQqPdDY0m/uTa68hA/bbhiijcJ6ycyNkDAyCcnnwWzOzI166Hy/qnDHh41f8qxVNdDFSjA2NjYaJH/EjAa40xeOpPcltCRKsgGrQncm4uMDRAwdHbaiaSnp252vD2PDHlgfCUoqXzM8/eSpOfuPinyXgoaX9V0RtKi6VQ5g+anK4ZDat9DYQ1jUtVI6NPHgKb3uEUzybg3ZpERjykCFPlqAL0HzZ9ATGl96eq4BL9qOreIjHUOZE1iU9HtUuB2yeFALrdTOl24RCbrX5dJ0avw+5pM8H++UzoGfs7cxZZWLMyge1PysSUNmpZMsBX1ThqAO6toVPTqHhvboxrLQTrcdGvkLlQKKskycRBVEExsTzP/LcsSrsvLkl7Md8oHCpbq8+12yhfA772CZSa6AVlTAFmxHWT/2PisNHD3isRL3gzLW2q+Jd8ln9j4jJkcSbSS41KsXzrS20o2PmsmkMHdLO2MjIzG3fv2esOdLS3OmmuhSzY9hvT9rHv/XrMSRw5I9U4tdJhS+5Y+s3Iyee1xE1VQ2puPkebNmxsJCWvkdkm5Py2QyaGBgfN9ND6WbH7STKCcJYVZ3bqKaVQHhS9JtEIGRHGf2KGFr8prRfdQADXsy81PyeSYVV+wQISFRuG4l1uGg5X38NZplrmo4O0zzdjivkl+YdrFvuOHroT509/ENENB06aNn3g7ZxjZOsdMK8j7M/qSHtNHV/YeFH2q8HW5srhnYOWIdMwcS7Y9jJVMKhTTCgWFS+UVR7vpz2vo8FvnHjcV97BiraZbBaHCnWXOOpoQWiFF2nm3hby4KLnsYGyC5rY3xUJysy3E/vr9JaPnTzkgphssVq8Oa/Lt690qd02xaHEfk+PIo67JZCsIWsxLKHTMYsXK9JWYZjDIXyoNOzjYSo5J1jjRzyeOmazlv463YjNeIPr5A8kIa1zgkv9zYKheQScHDCFn5s0nFz/7nJQWrielefnk/PK3yG/jbDpeRntnDian5j5BTsT10NyO9Iol7iyZTJg3vlprbFDxbgAhlqIwtLQsCeTU1HvJrwvsujww+i0phZzLdJKSH9eR0vVFpOSrr8nZZ/5CTg4ZoeM93CeW5GdJO4IaW1TkZ8n37LxHqTSin1+cfmDmFxjgwHBsUdKpvExzJ5GHx/ocuXtBplRaLLSgswteJpUVFaSysjIgXXh3ta6wleXlmn958VGPn1lRFA7YMOkNeg/oq4VdrgEFVRyN8+SxbMdOr3yIeTj3xlJdXn3R+WUrvMIdM1tJwRK5Mj9bHivmg8dP2da2BU7p119TFQWdHJu6VeShcGdJj4huFaWlB7UELbFk+2yzYtG4pJ1A78CYMyfPKWVAS/s/ENjFHfdBIrInk6em3EMqzp/XFSYQIf+JvoO0OET/yrIycvrue5U8wVhXkClX2MYk3IV7T2L+RaAxArW7tLinEvdvyamk4sIFXRonrN2p/4n4XqTi5Emdf0AqLSVnHpvnpazdEyyQT6kMDRGgZ8GKfRRa2JtQWbZB/skWGBOPxnn4y8+eKxfznuc0jQj75T4z2ffDy+d1iUIhTvTo45UoEg7k+0cDjbD6NAxO3z9TX4BgCVodSxNMXBwXSUFOHDm170eNp+Rf31B/rDzYooZPHe3GwkDBh0HFeYARdCETyOqUJgSsRKhUF4q7K/k7v2KlFte5o1vJ+hW9aDpItAzmeFJ58aI+b0HS2aef08kEWz/2SvtAbof76ocDrBwVx47p4jq65W/ntzxuJmHHJeuF3XdZyLZPp/nsmi58/HdyPNYzLvijE30GkLI9v3qFrSi7SA66s0nRyn5UCIVvKPMNVAAKZ+8PC4BHqNHQzZ1I6KXFi5ViwwtmcqjII9zy3XvoWIKCX5clV7ihVe1LspKS/TtJ6YlDlA4NsJKiV2Tynze6VeAzxlXqLtDiOL7jK+p/qL+1UisHxCm2sIqKMnKwIAfK0FfJN+R//SJFqetX9IYyLCRlF097hwGBnxw2SicjHUGFOO9a5lPuu7+ZT7bPMoMhEVsZdtQU+zwGODjESmtt2YXfdAGQyn/dS2sJdgV8QqcmTKaGgBc/JPrL5zNoQdBS47tCnnanWyjP7m+e8i7k4cPkMAh290RP2C1zreSnVQNIeVmJwldSQoWK3QbjqTh7TouDpVG4GKYCsXGk4vgJ1a+CbHovmWx6zmPd7bFbaE0v/WmDVz725y5WyjA1QBmgS0Plbf4oHfLm3QLLtm4jp++b7sV/AvJ8Zs4TpGzzFi9erezlpaD8RLJ3nFKxjpliv6T9HmjrJHWA7qvoZZns+fYZXeBg6fzxHVQwWGixQP5o71gLKYQKcu74LzSOXd88SXZNttA5DCpy8xOKaVzcA/NnJod/epvylZ07SedVLB5fSvp1PMSz8T3qdmLHP6EVmKkFhn44t8FKdBjSwcF768eTKF/J2WKy/s2eSiXxkV9fhK0VVyNOHyzUySRYOuB2kUJopThfxDhBQaVrEtUVoE0xMc3R7GYJ7rFB7YA5yekDQgupgn75YiZVslgAmiA0W/gtOirFLj9uil0C6X153GQt43l+WmgmxT9/QH6er5+vFEA3czA+jj7vH2mlte3csW1evL6UhGMntogN7wwHRai10xxbWrRAvohjBZ/GL/dbyKn9ubRbxjGPuUPeKyCvayDPmUDZ8LyOugl5RMKVk58/AMPERxfmj86f2EUKl8WTndO4uRvIqzIurqXHhAAQWb4axqfTGhMUYPNcMxUG1sCKcrWb8UG/7f0BWkK8d+sxQVwm64ribt3ar05JwZ1QnyBQQaDLncPC7bjXTDY8r1cSdjfbwMr8IcNSetAcRwW0C8ZSvlL4UtIeB7SQR8xqdxVXunmeZefmeWZaPjGNrY9ZqMWluZmsrx8IsF0Pk5pGB03xtyIfyK6YhTvUz0oKnWBYbftMJyuNKspBbt/TLnzT02YvIwxb0BGLpbWYHgUk2hhq+iY+4xh466NmUpCFg6WZbP7QTnb+63Gy699PwLON9tmbMszUglHDlBzqEh8pxl0VMG2opdsxjh33WmDQ9NPVQDpYqG2z5O0wOz9PxxyrUjl8KQkXR49aYkt2TLFs+Oklb5OXJ1T45sdVBZmsR0li6OuXR2JiroXwZ1mcWDmofFankF3/mkdltuXjiaQgWx3HnjRrXZtGJusRwrq4QDhiMier3ZNXBNgF4Fxj/2gL2ZcEfT3OO9QB9YApjkzpOOpvkdH2JyIN9nnVpbmdhn53SIqjaaCAd8BM/EgvTwvFCfPOKRby5cLYyk6WcQsk89hXcjPNdHA/u/kHcm5PEaW9KVYafkLysE/u6Jb63Id/ia/4ZbqF8Otyxd2tVDkw8SR7YOwrBrcFnQdtudQyjI4ZvXKnSV3SkpWxVJNZou+pC9JJyTpb1EWVOCpZbDB+nBIj4+kwCPSeTiNJpNFRo3Sn0Ubu6jiKPDdiIPkoI4F8t8RCvltsIe883YMk9Bqr44/tMZYMGTRaoz59x+h4usaOI8ue7Enj+R7i+/uz8eT5MQPI3ZD/jtGpOv5LpeSOSeSApIyjfskUe+6IKW6GKPtqI7LDhC5iRhqoeiTKtsbgpaRo272ifwMCI8Jg/2uDkuo4al1JEdGOgJtTUV0c10QYHX8PN9rfxP8woH4YbrBPRjdKBsenrQ3p5kijfRX+B/93Iw02+kIXuH2AblHGtFTGHwn8GGfLdva2+MvSaQ35gLDrIwzpLubmQUZjLr3P/hid1h7y/rkWpzHtIZ4b8jdLSdfRqW37CX+k+Tek0zy37pgeDfniwtq/wDAQX9Dn9OqIkkgjyMjHkcb0+WHytGYgvGMRHWzp6APPO/AX/EvaxoxtiXG1bjcpAgo8B/z+cW2HtHCWefhfBO4PoKUUFpPSXElzwlTFz3Ei3JieiM8t26fGRhjt31B3o93ne0pqnI0i29v633DrxBtbx9hjgBfit41pZbD35nmhAlzP8nCzMb0VKHYSVLI24HaqTZvhV0d0HH8nPG+NMtj6gEKfRz4oT9n1UB4WB+TnQmQHuwPyf565aX61riSjXbcXD27FETGOweBfSfmN9kzM2E0d77ol3GgbrrhhBqGGxzjoKVUozNegjFnhHWxD4LlY5TkUbpwo4zO2GohHie/21CjgPQT+76vxx9G8GBwJ+F8P0gj9ZagwqADmCoo+c0Nn2008JwPyt42Z0hJ41oehcqNB4Ib0dZx/OeSfzmOgTDLGFW5wzFR8U5pExKS0hjwWtpHTwlkYBtpb1AElzUUFhEenmvB/VMcJfaAQ20CIe8KUNyGo0EBxLlb7IMxFcFsDAt+MYdENniu052hbf/Cnm2EQz9pWtIt0nKIJKrxJGGd4tJ1eIcAjIub+ayH9ElQq30UGEhLk7VzraFsv1lIg/FtA2r0Ralj6Vge4H6I9gdFBe4mW0EXibzh0q4yfR51Qkg+gUsoiOzgexD/hxvEdINwR6qPOqlEhIMBIKmhjegfFzVMIKNhLOEaFpaQ0gd/TEH4X88cuUeGx2dSa7wUIOxKEvpH+gdakuQcQElSEdyDMWc9/+8bIaMdo5V9GY9aqW8IYhT0HxLUvUHw8II+1rSQbFVBVUFqF9ryQjgcdbN2hgGeVrsxBbr114h+gAP8BgXwLbrfzhQBFbABhv4itCPnC1NYYbkxLBLcSrLUQ7p8oNBaGAZUL6XwdDi0DWyy60XAwboi8DJEdbKNQUco/rBiOSiw3/ouCLhtbWhjmweD4Fd0gTzdiflgrCoQroCSlFleFm+8cr50Ijew0JYqnVobJ1+EvGgft2s24Cp/RmKBurHv0cktpQg0SeEZDo5Vh5HWYp3btfB+W5NNq3W5sBO8m8nqgpEEf0WgB3hu6TqRHj2mLV/PL4oiKgoqmloWLxCdASe/VSSU1wIMroaSG90tDBMitlpVksNfcouB/Ca6AktIblBQiwJBZ3aCkOo5aV5Jnll23gG834G5ovks6IfpdaUQa0xuUhMjPka3b37Zen++S78nPkoNe/KwNgNzeb1BSmKKkolVdrlm9OqVJvlP6VvS/kqh1JUX6WCsLBlGGCX0gbL9QSYzHH5iS6LNTomtq/oDLUGI6wRBbhQ8V9UZJdCmfxRECifH4g5eSXPKnoj+PiA6O18V0giKDo1rjXWStK8mYHvrJlrDaVVKeS35L8PZC7SvJ/kGo5QkZ3kpSVrZDRW0qKd8prxD9eTQoyQ9qU0lgiq8W/Xk0KMkPalNJBc7AL2j/FyjJ7nWII1jUppKguwt4t2qtK8lg/zDU8oSMmlASD13hOYowOD4S+YMBUxK+WAwm+GeifyBABdos5kMjg+OMyB8qII5aVpLB9rDoHyp0guDoUpQEyulT4JK/DPUCjAYl+YBOEBxVW0lOKRZaUUV1Lr74HSopvU4qKc/VbUjukhjf7/ZUgcutJCwTi0/0qzF4b1U4dFcLhAqdIDgKRUl4eVRRtvV2fIaWNDFvmZkeKVuXZe36+aJ2Ps8/+MLvUEn2R0X/UKETBEehKAmR75Lz3U7pc+jmHnFnS33zXdJP8BzSHUQNSvIBnSA4ClVJiFyn9BS7k8HtsqaI/lWhQUk+oBMER9VREprcTEkwR6InUEPB5VcSnpOvTSV1sD0m+ocKnSA4CkVJa/BaGpe8H6/TcTvNs6G7i8vHixBd0lbcVxL5/aFBST6gEwRHISkp49Y/MAPBnSn1zF2hvLm9aUnMtXh1mje3fzQoyQd0guAoFCUhIMxyhexvep7Tl4l8gfD7U5LRMYf3K3Cap+VnSe/CeKARjBHKYXk/0AmCo2ooSRdHpPoKTrCoSSXhshR0vY+uU6cGCIj/byw+nrdG4U9JhdnyBI9V5U18eBE6QXDkpaTExKb4jlEgEsOrVCnyicResUHUhJJys6UkGBv3sPJ7K8lR20pK167/hBb0XZ7TNB4ydTVP0JICrkroBMERryTl9Uc9Tw2RtuVyKUoqcMmPwdysgikHDJcKcHut7iipin0bf9AJgqP6pKQCp6kfTKTLqXKy5ef93cN6RZW0LlOKY8syPPCiQNGNh04QHNUnJTHgFgm0oC+g3L9sV61NoSVp5fCEqmEIY9LjvB9krA0ubsIcZTijqiaUOkFwVB+VxGMTTANAJquuqJLC8c3wS4ROEBzVdyX5AsT/CYtP9Ksx+FNSfla3tI1O6U7s8njCvpoPL0InCI7qk5IKckztClym5HVOaWBepjkVnidDK5oJ49S89Vldtdc0r4SSnmDuYNk5cp2mXmuzYtsjwQBqhEyeqykTHC+/wFOjgUgMr1KlyCfSH9vZ8dPcFNVVElbQNSu60lc28YJezxREOuXm7ge/okpigyR7hoxVUkunimO+OkFwVB8ns9CixmgmuI/pxxVQUrqmJIbcbEs3nB/4y6QInSA4qm9Kgq4tTym3fAZ+bxD9EREG+6csPtGvxsArCTL9JO8HmfvI08yVTEJ/fBvPI0InCI7qk5LWLIm5Vq2Y+Gkf7fOqeGm8l3V3JZXkzpa/xjFIpaNQq/YiqZn2C50gOKpPSkLkOSUn9h4ieSvJceWU5A/rFlmvF9146ATBUX1Tkj/g95jYc+0rqYP9Kea+LlOSeT4GyEmjNRn+L33VCYKj+qYkML2TwfQeyf5DT/JDvtOUjV/DYW5Qps9YfMytxuGlJKN9PnNHExyP9OpJKuPDi9AJgqP6pKQ8lzkVlLILytuGuW1aHdM8P1uegSY5c7sCSkr3UhJnNNT8VkUQEMOrVCtKcmfKKf6OjkFreoE9R9a+khwZzJ3vd3n8mCPcEC9AJwiOcJVB5A8EMbxKISkJ+Lf4iEMle0AjKN8lnYfeoxJa1CH4PZmvzhXXrLhVu1/8iirJF3Kd0kT8IqbozkMvCC+h0Oszg4U+PKXQlGSw/+IjDkbaHXu+gC0JFHOS60VKfuSWhBB4QyaLj3evUVSlJOiTO4Mp+lXNdHe2kPaoxPAqhaQk6GLp3XV+6DeR3xc2ZHa+CQ/A4POmjJjma3NitRvBal1JMDH7M3N3Z0mv8IrBVYc8p/lVaPbLueA6RCi3OorCUMjg2C7yB4IuvEIhKQn4T/iIg5X3mMjvD0XLzCaQw88oC36edGWVpLwLdB9+VxYUE/R7SzDuHBaFwcVfKvIHghhepRCVZK/wEQfLz0aRnwea2iADW766Q8uoziiJBx5UhC4vFzL4FoxJq0R/HhF4K6QPgVSnIGJYlUJUki68RmD5fSzyM7izpUFaL+KUSpE2qN0cP6GH3uHz6pQtJHgryfa06M8DctEIlBTw4kI0DkRh8CTyB4IYVqUaU1KkjzGYAa1bUEwf6En+DQpLgnJ/wPyg0mofvK99JUU7NCXhmwz4kUNsRd8vS7jue6d0J0zihoJ7lj/zHAFKesmHMDQKy/Act6oKYliVglaSev+3GN5D0emjxDAMWO6978W1wGesnFRhWXjuUP7Au7urDSUZbJ1ZIqCkZ5g7ZOZpvh/miVk6vhAZPbGfThgcRd3hCPo7TGJYlYJWUpTBMclHeA+1t90hhmHYtCQRV8FxhcXLUMJz6EWrPN+Sgnguv5JadUgzskR4JYF1Z8ddSMjkYVDYp9DcX4X/r8Dzexve8ZigItqot+r7J3uSGMYf9GEpBa0ksDTX+givkcjPYw0oiZ+0+gPfvYt+NYabO951C0sEBtJFzB0HTraQWJgV277AaXLgc4FLXgCKu5Px6UDv+tYLhKPvxSD+4CMsUtBK8hE26HjWZ8m9oSVVKEaDfAB+/w4Vd36ey5xesCz+VsYHxta3LE4+fI2CXvHMMg4JMveCTEkGhfy7cLk1BvvjdW90uR1a0jJ4PpeXafbbTSAgnjIfQtFI5PcHMZxKAYXLENkpNcpHWI3ACqUfHPYH/Oo1GA1HoMznxe5+82JLK8YHFXtnqOWqFrSMG9Sb8sOUgRPPQCPxvIh12VKc6MYDupl3RKF4CcjguEsM4wtiOJWCUhL/toMviogJnIc8l/T+mjXKlgwaStir4Pfi8Zjx9kWeO8tx7hdKvqoNLvM+17Iwk1CDUqAVrcNFRijAP0QeHrwx4ofwAx5VWnk+wgUnDP+H/TWKiEnxa/wgoKz/63bK+9a8ppwY8gctToPd74p6jUDLuMHhdSUMKKYIF1TF5g5dgNbi/AGFKQrGS0gG+z/FMCLEMCpVqSToyn72EY4n+vmEmgAX5z7Rr0YRwS3ns4+CIEAZh1TFYN+8BhcaqTsMoJ7QvhGpvPQlCseL2sjT/H7vFSHyqxRQSTgh9xHGi8Kj7ePEcNVBRMzE1ixOPNol+tcowPTOYYmhCc3c2Rzhx1fiWuACK9DbeHMjKs4T2jdQAaJwfFHEnco3l3xB5FXJr5Juikn/kw9+gZSPkNQEoDcYq5XDaJ8o+tcoWuEdqp6CeF2nhkYCvgICZui/85XzZ7iWdZTn8QfoPt/WC0lP0JI/57+FxCDyqaRTEn6NLIJb6AxE4pfKLgW8ceLv+0o1hwz8hpBWEC8F0O4uS3qR/S9c3i0i3yV9ku8y3cPz+QMMqCtFQQUidavDDTV+tuinUiXEuQwUezTQCrcvwq+MifnzBTzLARXzfdFdBOQBP+ZF4xb9LgtwK5lLUFuby3MqllzRwi7XKGtY2nHjF2BiN1mLIAAg7v2iwGqbIoK8kgfKNwOXhJRnaUue0+zIx01Pp/Qqf/SafnbIE7/uY1yXBZHG9BUsUfwIIXPH1/Fx1o3rdYWubgm0ZWXL36IfuBdpEQRGoyp2SC8zBX+PH5SpDKgcKueroKDF7MQuGE7rc50mM+NDpbP4L/t4xIBvOXCF+o73A8VQywW6vU9QSbnZlo5QkM7Yqni+KoBfG/uPXoCXlSpDWSv8DqxXKNN/cAzmphvfu+lb59LXPC/ErfUO/j7IdVnAEoVa4nW2DhTyMH6GgGUc3Qpc5mS655IlhXYCKDp9lA9h1jhB7T6SkhL8zSkicpXJO33VR+ne5f/x+CY25dLRvhVYKwDlfM0SD2+nfA0TsTanUxTLbK7Tor1EVoAHCMHtq4XK/ajBI6MxpKWZ/TVJYHGdxW/4iSlWBdyCyHNJ74AyzsI0Y/e6TKknuhcsMbXD3YB1b3t2Y6MMjpmeNH1/C/eyIcow/jatsEbHbt4P50poOOAzbiNjYTxdgvwuzxsscPANx8+J+hB2qEStwuiqz7L7A3Rnp3BBmSsTtp5s9CvMkYfyvJDeKS3dKpaXLgsioatjGWjTxrMigOe/ccERMv8hV4iPsAa68e2DLO+ChAr8fix+CxbM68XqOYkDaHFG8CvqmDeD4wz6KTz4Zc60+JiYlOZifKEA8p7m5t4/gh4inZWR34VF3HTHtBu4/Bzk/WoNUUb7s57aaac1CQHWzjxNOS75TFGmsjvpxks4wCJC9005MQFPt9ZVaNsR3PmNH9+La4FWLZTb6y4jaLF5mpJC+ChKDcNr0w6tN23OBIW4kJdl1j46gm9esKO3uU5pKp4BYH71CaCklawc8HsAJ+zojpudbu5Gf/rZVU029Fu7fs96XHZAC9Ju+Ygypmcyd5i8aq+B4JvZrGXlZnfthm64lVG0zNyJ8dQn4HgLytrI9RZ/KViWcHOhy5zIeMCSW8fkEh7Eu1yXFTgYcq2J4IdymV9htpxG91qUMalkA1h+6P79MsN16FbgNI/wxFT/oFwool5Xw23JeC8Ye75YfUUBmfEsWBq8D9rjJBb7a7ZMQjIy8KQnnVOgsnje+ghcZYGy7MfJLXMDxRxg8oAWpV3vc2WhfDxe27jjvQpyTCPwbDQ+5+fggQ3FcIAxi05s1c+6fQ1uPfhwdQFQwR6CbjtZdBfhXiqrH7AXJ+D4Mfuqd5VrDWDmzmGZa9UhtS/vB332E6z/VgnPVeMhQrwNnw7CPH9dAeRvmJJf6f9EP3+A8pdrSopO7y/6X2k0AiPiHOuH27YdS090MkBhm63N6nrb+hVdb8RnqKVfghDuVMYr5eox+H0G6JuqXoiuTWgt3yWXFGV2CWjo4F6Vp5tzbBD96wTwxKmWSYNjr+iPp2gKlePHzxZkS0fh930UwNrXFYMC17yo0rKlX8FSShDDX25AdzwADICfoSv+Ic/VjVpq+HIyGjjM7MajamI4FY0iuM8O+dqYrDPg9/Ij8RCHsHBZ4FIWH1krggngS/S/MpPHVkUPu7td5n/A3Mqr27xcULtdgtaa8l9equRFLsb/WKHo5U6gOLwdEvi/48+44yqG1s3hgjN39qPOgu+XxXU9BLSSIVDQDSgINByUeQftUrTtDNwCyHVJl/fAhjrBdGdJd9H0YQLOPCB/eHkTyVtuvgOU9ypzh5ak7TwryGjMt6A2Rrvk7V9HccOfbDfx29W+ToAWKK9t/ozPeKKICilHpuYqfgOJ1uQs+UM+TF6WNAvci8B9Ct4FzvsFizylgtD3pkApO5k75OdlmqZLpldpF2Z1wxUErDhz3fROWWklhBvI+Bmg5ezheo5y0b9OIzw63cRlHudPXgJHqOelE9WuxdOKXPIJVUndef7cbEsHdF8PVhe2RKAcekulE7cNTAvd2ebZaJggL/jdB4KdVYj3zmVLz0G4cjaXYffwqUpwsfg5I4Fef5aPS1su6X7q55RWMj6GSKPN60Xoa7nTU/UGkQabzUtRRscakQdqbAwI5Te2jASC+VgRlKQ7IevGL7qAH149ADU+G5+VMHTCvD93iaU1uhXih0XUt+/yXabpuNqBz9q3/mC+psaHbyRiZRhL/2dJ42ja2dJf6X+ntM/P2xKNoNJt4ssWXl+6OV+AwswSWtRmkUd9Uw4/BvIbFZpTOujr5TNw34L+GWAlggC3MSWpYZSuE4XslMoKlpq64DN+CQY/VK/y0K1+fMEAf9V0S9Fv02rtQAn9n+s0Dc7PMv1ZTdoDnLgrWyBamVobq/eZ7ToF6Bam8YXCI1biPIqBv4tHBLYIbDXQBdG33UGgLyM/VYxLXr1OaZXYCl/JXWlppSqMHtoEtyP4H+dg2OJofC55t2b2K8ppht9egt8zBTmmLt6pK1MMz1xQoagYR61YoLWC8A72cV4tCgsY7YgV+QJBEab8V7xHDg+4oBvu5aiK2Qu/lYWubkO8+F0yXUtcm2OKVvmOfQKGALoVqCd6QEE2VdEXsdWx8DwiDOkpYv5bxthjRL56Dzy5KR5SBPP1f8OC2GtxZ0pxao33umtcXcEgeK4PFIhvGp7Uwij8edp/p7K9wG4OA2vxxS3LEq4rzKFK+hPjE4CTVG3bgebZ4CjB+aDI+LsBzsT5w5WUDPZStAZFXh759EUAj4AZ8MYRtRX0UK04bR1QbUm/sP9ocPBxFDhl97psq3ZRrojWPlqPr5WU3yvwXN0qUQAwIO9oGzPF77Y6Ggx4lSbv5la36tfj/a/aKoZ5DPUDQwSUVAFK0Sw0aD3aa6T+ENl+0h2Ql+Ni/urOtkMtgr5A5nn7jSN7Eb4iKfL7A+7pbHzTfAs+Q2sal58tP7329diogmWmW0XeQGhlsBv8nJ49hVcIiPz/TYA5h+MFH4LBwy3FOGAjjxioxqDshU2lZ/D0eaiMMNoCXhjy34WYlOb4Rp8PQalkz1Rm9DWwiZaY2BRbBnRfu/TpKMoBWoUHbcSgDQjDQ5CDr4J5VMB3lZS5iu19XNFo3cFuueOOaT7v4UbgqR3owhIi6GUa9i8g7vNifN7KsS8MS8yo+6vYdQWRMQ678m6RTpg1TPR1G5/zowYEi0Q89G5/U31pzIeQq0P20+Ht04c2dGmXCWgVQgubDvQvtRWc8qHASvp2ncF+Ep73RdAvx9inXv5XIWse/w+foSb5XBuwgQAAAABJRU5ErkJggg==>
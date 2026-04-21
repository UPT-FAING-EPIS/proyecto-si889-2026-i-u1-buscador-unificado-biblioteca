**![C:\\Users\\EPIS\\Documents\\upt.png][image1]**

**UNIVERSIDAD PRIVADA DE TACNA**

**FACULTAD DE INGENIERIA**

**Escuela Profesional de Ingeniería de Sistemas**

 **Sistema NexusLib**

Curso: Patrones de Software

Docente: Ing. Patrick Cuadros Quiroga

Integrantes:

***Hurtado Ortiz, Leandro			(2015052384)***  
***Flores Navarro, Eduardo Gino		(2023076793)***  
***Cortez Mamani, Julio Samuel		(2023077283)***

**Tacna – Perú**  
***2026***

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

# **Versión *2.0***

| CONTROL DE VERSIONES |  |  |  |  |  |
| :---: | :---: | :---: | :---: | :---: | ----- |
| Versión | Hecha por | Revisada por | Aprobada por | Fecha | Motivo |
| 1.0 | EGFN | EGFN | EGFN | 02/04/2026 | Versión Original |
| 2.0 | LDHO | LDHO | LDHO | 17/04/2026 | Versión 2.0 |

**ÍNDICE GENERAL**

[1\. Introducción	4](#1.-introducción)

[1.1 Propósito	4](#1.1-propósito)

[1.2 Alcance	4](#1.2-alcance)

[1.3 Definiciones, Siglas y Abreviaturas	5](#1.3-definiciones,-siglas-y-abreviaturas)

[1.4 Referencias	6](#1.4-referencias)

[1.5 Visión General	6](#1.5-visión-general)

[2\. Posicionamiento	6](#2.-posicionamiento)

[2.1 Oportunidad de negocio	6](#2.1-oportunidad-de-negocio)

[2.2 Definición del problema	7](#2.2-definición-del-problema)

[3\. Descripción de los interesados y usuarios	8](#3.-descripción-de-los-interesados-y-usuarios)

[3.1 Resumen de los interesados	8](#3.1-resumen-de-los-interesados)

[3.2 Resumen de los usuarios	9](#3.2-resumen-de-los-usuarios)

[3.3 Entorno de usuario	9](#3.3-entorno-de-usuario)

[3.4 Perfiles de los interesados	10](#3.4-perfiles-de-los-interesados)

[3.5 Perfiles de los Usuarios	11](#3.5-perfiles-de-los-usuarios)

[3.6 Necesidades de los interesados y usuarios	12](#3.6-necesidades-de-los-interesados-y-usuarios)

[4\. Vista General del Producto	13](#4.-vista-general-del-producto)

[4.1 Perspectiva del producto	13](#4.1-perspectiva-del-producto)

[4.2 Resumen de capacidades	13](#4.2-resumen-de-capacidades)

[4.3 Suposiciones y dependencias	14](#4.3-suposiciones-y-dependencias)

[4.4 Costos y precios	14](#4.4-costos-y-precios)

[4.5 Licenciamiento e instalación	15](#4.5-licenciamiento-e-instalación)

[5\. Características del producto	15](#5.-características-del-producto)

[6\. Restricciones	16](#6.-restricciones)

[7\. Rangos de calidad	16](#7.-rangos-de-calidad)

[8\. Precedencia y Prioridad	17](#8.-precedencia-y-prioridad)

[9\. Otros requerimientos del producto	18](#9.-otros-requerimientos-del-producto)

[a) Estándares legales	18](#a\)-estándares-legales)

[b) Estándares de comunicación	18](#b\)-estándares-de-comunicación)

[c) Estándares de cumplimiento de la plataforma	19](#c\)-estándares-de-cumplimiento-de-la-plataforma)

[d) Estándares de calidad y seguridad	19](#d\)-estándares-de-calidad-y-seguridad)

[CONCLUSIONES	20](#conclusiones)

[RECOMENDACIONES	20](#recomendaciones)

[BIBLIOGRAFIA	21](#bibliografia)

[WEBGRAFIA	21](#webgrafia)

# **1\.	Introducción** {#1.-introducción}

# **1.1	Propósito** {#1.1-propósito}

El propósito de este proyecto es desarrollar una plataforma centralizada que unifique el acceso a colecciones bibliográficas físicas y recursos digitales dispersos. El sistema busca eliminar la fragmentación de la información, permitiendo que cualquier usuario, independientemente de su ubicación, pueda localizar, consultar la disponibilidad y acceder a materiales de lectura o investigación desde un único punto de entrada, optimizando así los tiempos de búsqueda y mejorando la visibilidad de los activos de la biblioteca.	

# **1.2	Alcance** {#1.2-alcance}

	El sistema NexusLib actuará como un integrador inteligente de recursos.

* **Funcionalidades Incluidas:**  
  * Búsqueda simultánea en inventarios locales (libros físicos, revistas, archivos) y repositorios remotos (e-books, artículos científicos, bases de datos en la nube).  
  * Sincronización de estados de disponibilidad en tiempo real para recursos físicos.  
  * Personalización de los criterios de búsqueda según las necesidades del usuario (búsquedas por relevancia, categorías o coincidencias exactas).  
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
| Disponibilidad Reactiva | Capacidad de la interfaz de reflejar en tiempo real y sin refrescar la página los cambios en el estado de préstamo del inventario físico. |

# 

# **1.4	Referencias** {#1.4-referencias}

**Estándares de Codificación:** Siguiendo las guías de la industria, específicamente el estándar PSR-12 (PHP Standard Recommendation) para asegurar la legibilidad y consistencia del código fuente en PHP 8.2.12.

**Principios de Calidad:** Basado en las 10 Buenas Prácticas de Programación (Referencia: Infografía de ByteByteGo) para garantizar un desarrollo robusto y mantenible.

**Documentación Técnica:** Manuales de integración de APIs de terceros, centrados principalmente en la Google Books API para la recuperación automatizada de metadatos bibliográficos.

	

# **1.5	Visión General** {#1.5-visión-general}

Este documento detalla el camino desde la identificación de la problemática de búsqueda fragmentada hasta la propuesta de una arquitectura de software robusta. Se abordará primero el análisis de la problemática actual, seguido por el diseño de la solución donde se aplicarán estrategias de software para manejar la diversidad de fuentes de datos. El informe culmina con la metodología de desarrollo y las pruebas que aseguran que el buscador sea rápido, seguro y fácil de mantener.

# **2\.	Posicionamiento**	 {#2.-posicionamiento}

# **2.1	Oportunidad de negocio** {#2.1-oportunidad-de-negocio}

La transformación digital ha cambiado el hábito de consumo de información, pero las bibliotecas físicas siguen siendo pilares de conocimiento y espacios de estudio esenciales. La oportunidad de negocio de **NexusLib** reside en la modernización de la experiencia híbrida.

* **Optimización de Recursos:** Muchas organizaciones (municipios, centros de investigación, corporaciones) pagan suscripciones digitales costosas que los usuarios no usan porque no saben que existen, al estar ocultas en portales distintos al catálogo físico.  
* **Centralización Operativa:** Al unificar la búsqueda, se reduce el gasto en mantenimiento de múltiples interfaces de usuario y se centraliza la analítica de datos (saber qué temas son los más buscados, ya sea en papel o en digital).  
* **Diferenciación de Servicio:** Una biblioteca que ofrece una búsqueda fluida y una visualización de estados de disponibilidad en tiempo real aumenta su tasa de retención de usuarios y se posiciona como una entidad a la vanguardia tecnológica.

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

**Licenciamiento:** El software se distribuirá bajo una licencia de tipo Propiedad Intelectual Institucional o Open Source (MIT), permitiendo a la entidad modificar los adaptadores y microservicios según sus necesidades futuras.

**Instalación:**

* **Backend:** Despliegue directo en Azure App Service configurado para un entorno Linux/PHP 8.2.12, asegurando una alta disponibilidad y escalabilidad de los servicios.  
* **Base de Datos:** Requiere el motor MySQL, utilizando Azure Database for MySQL para la persistencia en la nube y HeidiSQL para la administración remota de las tablas y relaciones.  
* **Configuración:** Uso de variables de entorno para la gestión segura de las credenciales de la Google Books API y las cadenas de conexión a las bases de datos locales y en la nube.

# 	

# **5\.	Características del producto** {#5.-características-del-producto}

Esta sección detalla las funcionalidades clave que definen la propuesta de valor de **NexusLib**:

* **C01 \- Interfaz de Búsqueda Omnicanal:** Un único punto de entrada capaz de procesar consultas y delegarlas a múltiples orígenes de datos simultáneamente.  
* **C02 \- Motor de Normalización de Metadatos:** Capacidad de recibir datos en formatos heterogéneos (JSON de APIs, registros SQL, XML) y transformarlos en un objeto de dominio único.  
* **C03 \- Gestión de Estrategias de Filtrado:** Permite al usuario alternar entre algoritmos de ordenamiento (por relevancia, por fecha de publicación o por cercanía física) sin recargar la aplicación.  
* **C04 \- Monitor de Disponibilidad en Tiempo Real:** Servicio en segundo plano que verifica el estado de los ejemplares físicos y actualiza la interfaz del usuario.

# **6\.	Restricciones** {#6.-restricciones}

	Las restricciones definen los límites de diseño y construcción del sistema:

* **R01 \- Compatibilidad Legacy**: El sistema debe ser capaz de conectarse a bases de datos relacionales antiguas (como versiones anteriores de MySQL) sin exigir una migración de los datos existentes, facilitando la integración con inventarios físicos actuales.  
* **R02 \- Limitaciones de API de Terceros**: El volumen de búsquedas digitales estará sujeto a las cuotas y límites de tráfico (*Rate Limiting*) impuestos por proveedores externos, principalmente la Google Books API.  
* **R03 \- Acceso Público:** El sistema no requerirá la creación de cuentas ni el almacenamiento de credenciales, garantizando un acceso anónimo y rápido a las consultas.  
* **R04 \- Lenguaje de Implementación**: El núcleo del sistema debe desarrollarse utilizando PHP 8.2.12, aprovechando sus capacidades de tipado fuerte y programación orientada a objetos (POO) para garantizar la correcta aplicación de patrones de diseño en una arquitectura de microservicios.

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
   * Optimización de algoritmos de búsqueda híbrida.  
   * Módulo de analítica y reportes para administradores.  
   * Optimización de caché para resultados frecuentes.

# 	

# **9\.	Otros requerimientos del producto**	 {#9.-otros-requerimientos-del-producto}

## 	**a[) Estándares legales](#heading=h.r7wurbpv9a4q)** {#a)-estándares-legales}

	Para asegurar que el sistema sea viable en un entorno real y respete la propiedad 		intelectual:

* **Privacidad y anonimato:** Al ser una plataforma de acceso abierto y sin registro de usuarios, el sistema no recolecta, procesa ni almacena datos de carácter personal (como nombres, correos electrónicos o credenciales). Esto garantiza el anonimato total en las búsquedas y elimina la necesidad de gestionar bases de datos sensibles, cumpliendo de forma intrínseca con los principios de minimización de datos de la Ley de Protección de Datos Personales  
* **Derechos de Autor (Copyright):** El buscador solo mostrará metadatos (título, autor, resumen) y enlaces legales a los recursos. No se permitirá el almacenamiento ni la distribución de archivos PDF que no cuenten con licencias de acceso abierto (Open Access) o suscripciones activas.  
* **Términos de Uso de APIs:** El software debe respetar las cláusulas de "Uso Aceptable" de los proveedores externos (como Google o Springer), evitando el *scraping* masivo que infrinja sus políticas.

## 	**b[) Estándares de comunicación](#heading=h.r7wurbpv9a4q)** {#b)-estándares-de-comunicación}

	Para garantizar que la integración unificada sea fluida y profesional:

* **Protocolos de Red:** Toda comunicación entre el frontend, el backend y las APIs externas debe realizarse obligatoriamente sobre **HTTPS (TLS 1.2 o superior)**.  
* **Formato de Intercambio:** Se establece **JSON** como el estándar de comunicación interna entre módulos, facilitando la interoperabilidad entre los diferentes **Adaptadores** y el núcleo del sistema.  
* **Arquitectura RESTful:** El sistema debe exponer sus capacidades mediante una API REST bien documentada, facilitando que futuros clientes (como una App móvil) puedan integrarse sin fricción.

## 	**c[) Estándares de cumplimiento de la plataforma](#heading=h.r7wurbpv9a4q)** {#c)-estándares-de-cumplimiento-de-la-plataforma}

	Para asegurar la portabilidad y el despliegue eficiente:

* **Despliegue en la Nube (Cloud-Native):** El sistema debe ser capaz de ejecutarse de forma nativa en Microsoft Azure, aprovechando los servicios de Azure App Service para el backend en PHP y Azure Database for MySQL para la persistencia.  
* **Compatibilidad de Navegadores:** La interfaz de usuario debe cumplir con los estándares de W3C para asegurar el funcionamiento correcto en Chrome, Firefox, Safari y Edge.  
* **Responsividad:** Cumplimiento con el estándar Mobile First, asegurando que el buscador sea 100% funcional en dispositivos móviles y tablets.

## 	**d[) Estándares de calidad y seguridad](#heading=h.r7wurbpv9a4q)** {#d)-estándares-de-calidad-y-seguridad}

	Este es el pilar que sostiene la confianza en el software:

* **Seguridad (OWASP):** Las entradas de búsqueda deben ser saneadas para prevenir ataques de **Inyección SQL** y **Cross-Site Scripting (XSS)**.  
* **Calidad de Código (Clean Code):** Se realizarán auditorías de código para asegurar que se respeten los principios **SOLID** y que el código tenga una cobertura de pruebas unitarias de al menos el **80%**.  
* **Manejo de Errores (Robustness):** Implementación de *Graceful Degradation*; si una API externa (como la de e-books) falla, el sistema debe seguir mostrando los resultados de la biblioteca física sin colapsar la búsqueda completa.

# [**CONCLUSIONES**](#heading=h.3hxr54n1w5j0) {#conclusiones}

**Unificación Eficiente:** Se logró diseñar una solución que rompe los silos de información, demostrando que mediante el patrón **Adapter**, es posible integrar sistemas *legacy* y tecnologías modernas bajo un modelo de dominio único sin comprometer la integridad de los datos originales.

**Escalabilidad y Mantenimiento:** La aplicación de **SOLID** y **Domain-Driven Design (DDD)** garantiza que el sistema pueda crecer. Agregar una nueva fuente de recursos (como una nueva API de una editorial) no requiere modificar el núcleo del buscador, cumpliendo con el principio de Abierto/Cerrado.

**Optimización de la Experiencia:** El uso del patrón **Strategy** permite que el sistema sea versátil, ofreciendo diferentes tipos de búsqueda que se adaptan tanto al usuario académico riguroso como al estudiante que busca rapidez, mejorando los tiempos de respuesta y la precisión de los resultados.

**Robustez y Seguridad:** Al implementar estándares de comunicación cifrada (HTTPS) y saneamiento de entradas, el sistema no solo es funcional, sino que cumple con los rangos de calidad exigidos para proteger la privacidad del usuario y la estabilidad de la infraestructura institucional.

# [**RECOMENDACIONES**](#heading=h.c75ep12k44ho) {#recomendaciones}

* **Implementación de Caché**: Se recomienda integrar una capa de persistencia temporal para los resultados de las APIs externas más frecuentes, optimizando la latencia y el consumo de cuotas de la Google Books API.  
* **Refactorización Continua**: Es vital realizar revisiones de código periódicas bajo estándares PSR-12 para asegurar que la arquitectura de microservicios en PHP 8.2.12 se mantenga limpia y facilite el mantenimiento por parte del equipo.  
* **Pruebas de Usuario (UX)**: Se sugiere realizar pruebas de usabilidad con los perfiles de estudiantes e investigadores definidos para ajustar las estrategias de búsqueda unificada antes del despliegue final.  
* **Escalabilidad de Microservicios**: Se recomienda mantener la independencia de los módulos de inventario físico y digital ya implementados, permitiendo que la plataforma crezca modularmente según aumente la demanda académica.

# [**BIBLIOGRAFIA**](#heading=h.n5qpz2nblnlj) {#bibliografia}

**Gamma, E., Helm, R., Johnson, R., & Vlissides, J. (1994).** *Design Patterns: Elements of Reusable Object-Oriented Software*. Addison-Wesley Professional. (El libro base para los patrones Adapter, Strategy y Observer).

**Evans, E. (2003).** *Domain-Driven Design: Tackling Complexity in the Heart of Software*. Addison-Wesley. (Referencia fundamental para el modelado de contextos y lenguaje ubicuo).

**Martin, R. C. (2008).** *Clean Code: A Handbook of Agile Software Craftsmanship*. Prentice Hall. (Base para los principios SOLID y legibilidad).

# [**WEBGRAFIA**](#heading=h.av9ddmv7ljg) {#webgrafia}

**ByteByteGo (2024).** *10 Good Programming Practices*. Recuperado de: \[Referencia a la infografía de la imagen proporcionada\].

**Refactoring.Guru.** *Patrones de Diseño: Estructurales y de Comportamiento*. Disponible en: [https://refactoring.guru/es/design-patterns](https://refactoring.guru/es/design-patterns)

**Microsoft Learn.** *Evolución de arquitecturas: DDD y Microservicios*. Disponible en: [https://learn.microsoft.com/es-es/dotnet/architecture/microservices/microservice-ddd-cqrs-patterns/](https://learn.microsoft.com/es-es/dotnet/architecture/microservices/microservice-ddd-cqrs-patterns/)

**OWASP Foundation.** *Top 10 Web Application Security Risks*. Disponible en: [https://owasp.org/www-project-top-ten/](https://owasp.org/www-project-top-ten/)

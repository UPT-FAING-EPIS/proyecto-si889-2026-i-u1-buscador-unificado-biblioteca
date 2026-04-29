![Logo Upt](media/logo-upt.png)

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

| CONTROL DE VERSIONES |  |  |  |  |  |
| :---: | :---: | :---: | :---: | :---: | ----- |
| Versión | Hecha por | Revisada por | Aprobada por | Fecha | Motivo |
| 1.0 | EGFN-JSCM | EGFN-JSCM | LDHO | 20/04/2026 | Versión Original |

# **ÍNDICE GENERAL**

[1\. Antecedentes	3](#1.-antecedentes)

[2\. Título	3](#2.-título)

[3\. Autores	3](#3.-autores)

[4\. Planteamiento del problema	3](#4.-planteamiento-del-problema)

[4.1. Problema	3](#4.1.-problema)

[4.2. Justificación	4](#4.2.-justificación)

[4.3. Alcance	4](#4.3.-alcance)

[5\. Marco Teórico	5](#5.-marco-teórico)

[6\. Desarrollo de la solución	6](#6.-desarrollo-de-la-solución)

[6.1. Análisis de Factibilidad (técnico, económico, operativa, social, legal, ambiental)	6](#6.1.-análisis-de-factibilidad-\(técnico,-económico,-operativa,-social,-legal,-ambiental\))

[6.2. Tecnología de Desarrollo	6](#6.2.-tecnología-de-desarrollo)

[6.3. Metodología de implementación	6](#6.3.-metodología-de-implementación)

[7\. Presupuesto	7](#7.-presupuesto)

[8\. Conclusiones y Recomendaciones	8](#8.-conclusiones-y-recomendaciones)

[9\. Bibliografía	8](#9.-bibliografía)

[Anexos	9](#anexos)

# **1\. Antecedentes** {#1.-antecedentes}

En los últimos años, las bibliotecas universitarias han experimentado una transición hacia modelos híbridos que combinan colecciones físicas tradicionales con recursos digitales. Sin embargo, esta evolución ha ocurrido de manera desarticulada, generando silos de información que dificultan la experiencia de búsqueda de los usuarios.

A nivel internacional, plataformas como WorldCat y Google Books han intentado unificar catálogos, pero su integración con sistemas locales sigue siendo limitada. En el ámbito nacional, la Universidad Privada de Tacna cuenta con un sistema de inventario físico legacy, pero carece de un buscador que integre sus recursos digitales suscritos.

# **2\. Título** {#2.-título}

Sistema de Buscador Unificado de Recursos para Bibliotecas Físicas y Virtuales NexusLib

# **3\. Autores** {#3.-autores}

Hurtado Ortiz (2015052384) ha participado en desarrollos previos de sistemas de gestión con PHP y MySQL.

Flores Navarro (2023076793) y Cortez Mamani (2023077283) han trabajado en integraciones de APIs REST.

El presente proyecto surge como respuesta a la necesidad de modernizar la experiencia de búsqueda bibliográfica, aplicando patrones de software para garantizar escalabilidad y mantenibilidad.	

# **4\. Planteamiento del problema** {#4.-planteamiento-del-problema}

## **4.1. Problema** {#4.1.-problema}

La fragmentación de la información bibliográfica entre inventarios físicos y repositorios digitales genera pérdida de tiempo en las búsquedas, subutilización de recursos digitales pagados y frustración por la falta de información sobre disponibilidad inmediata de ejemplares físicos.

Síntomas identificados:

* Estudiantes y docentes invierten entre 15-20 minutos por búsqueda al tener que consultar sistemas separados.  
* Las suscripciones digitales de la facultad tienen una tasa de uso inferior al 30% por falta de visibilidad.  
* El personal bibliotecario dedica tiempo excesivo a responder consultas de ubicación de libros.

## 

## **4.2. Justificación** {#4.2.-justificación}

| TIPO DE JUSTIFICACIÓN  | ARGUMENTO |
| :---- | :---- |
| Técnica  | La aplicación de patrones Adapter, Strategy y Facade permitirá una integración desacoplada y mantenible. |
| Económica | El VAN positivo (S/ 4,199.12) y B/C de 1.44 demuestran rentabilidad. |
| Social | Democratiza el acceso a la información y reduce brechas de investigación. |
| Académica | Aplica los conceptos del curso Patrones de Software a un caso real. |

## **4.3. Alcance** {#4.3.-alcance}

Incluye:

* Búsqueda simultánea en inventario físico (MySQL) y Google Books API.  
* Visualización de disponibilidad en tiempo real.  
* Filtrado por autor, ISBN, título.  
* Localización física (piso y estante).  
* Enlaces a recursos digitales.

Excluye:

* Gestión de préstamos (futuro).  
* Pasarelas de pago.  
* Digitalización de documentos.  
* Registro de usuarios (acceso anónimo).

Objetivo General:

Desarrollar una plataforma web unificada que optimice la localización y el acceso a recursos bibliográficos físicos y digitales, mejorando la experiencia de búsqueda y la gestión de información para la comunidad académica.

| N° | OBJETIVO ESPECÍFICO | FUENTE |
| :---: | ----- | :---: |
|  OE1 | Diseñar un sistema de búsqueda multicanal que filtre resultados por título, autor, categoría y tipo de recurso. |  Anexo 01 |
|  OE2 | Integrar una base de datos local de inventario físico que permita visualizar la disponibilidad en tiempo real. |  Anexo 01 |
|  OE3 | Configurar la infraestructura como código (IaC) mediante Terraform para automatizar el despliegue en Azure. |  Anexo 01 |
|  OE4 | Aplicar patrones de software (Adapter, Strategy, Facade) en la arquitectura del sistema. | Nuevo |
|  OE5 | Documentar la especificación de requerimientos y la arquitectura bajo estándares IEEE. | Anexos 03 y 04 |

# **5\. Marco Teórico** {#5.-marco-teórico}

Patrones de Software aplicados:

| PATRÓN | TIPO | PROPÓSITO EN NEXUSLIB |
| :---: | :---: | :---- |
| Adapter | Estructural | Conectar la Google Books API y MySQL legacy a una interfaz común |
| Strategy | Comportamiento | Intercambiar algoritmos de filtrado (por autor, ISBN, relevancia) |
| Facade  | Estructural | UnificationService que simplifica la complejidad de múltiples adaptadores |
| Observer | Comportamiento | Actualizar disponibilidad en tiempo real (futuro) |

Tecnologías Base

* PHP 8.2.12 \- POO, tipado fuerte  
* MySQL \- Persistencia de inventario  
* Google Books API \- Fuente de metadatos externa  
* Azure \- Infraestructura cloud  
* Terraform \- IaC

Arquitectura de Software

* Modelo de 4+1 vistas (Kruchten)  
* Patrón MVC  
* Principios SOLID





# **6\. Desarrollo de la solución** {#6.-desarrollo-de-la-solución}

## **6.1. Análisis de Factibilidad (técnico, económico, operativa, social, legal, ambiental)** {#6.1.-análisis-de-factibilidad-(técnico,-económico,-operativa,-social,-legal,-ambiental)}

| TIPO | CONCLUSIÓN | INDICADOR CLAVE |
| :---: | :---: | ----- |
| Técnica | Factible | Stack PHP/MySQL dominado por el equipo |
| Económica | Factible | VAN S/ 4,199.12; TIR 17% |
| Operativa | Factible | Interfaz intuitiva, sin capacitación especializada |
| Social | Factible | Democratiza el acceso a la información |
| Legal | Factible | Cumple Ley N° 29733 (datos personales) |
| Ambiental | Factible | Reduce impresión de catálogos físicos |

## **6.2. Tecnología de Desarrollo** {#6.2.-tecnología-de-desarrollo}

| CAPA | TECNOLOGÍA | VERSIÓN | PROPÓSITO |
| :---: | :---: | :---: | ----- |
| Backend | PHP | 8.2.12 | Lógica de negocio y microservicios |
| Fronted | HTML/CSS/JS | ES6 | Interfaz responsiva |
| Base de Datos | MySQL | 8.0 | Inventario físico |
| Infraestructura | Microsoft Azure | \- | App Service \+ DB MySQL |
| Iac | Terraform | 1.x | Automatización de despliegue |
| API Externa | Google Books API | v1 | Metadatos bibliográficos |

## **6.3. Metodología de implementación**  {#6.3.-metodología-de-implementación}

Se utilizará una metodología ágil basada en Scrum con sprints de 2 semanas:

* Sprint 1 (2 semanas): Configuración de infraestructura (Terraform \+ Azure)  
* Sprint 2 (2 semanas): Implementación de Adapters (MySQL \+ Google Books)  
* Sprint 3 (2 semanas): UnificationService (Facade) y lógica de búsqueda  
* Sprint 4 (2 semanas): Filtros (Strategy) e interfaz de usuario  
* Sprint 5 (1 semana): Pruebas y documentación

Documentos Tecnicos

| DOCUMENTO | VERSIÓN | UBICACIÓN |
| ----- | :---: | :---: |
| Informe de Factibilidad | 2.0 | Anexo 01 |
| Documento de Visión | 2.0 | Anexo 02 |
| SRS (Especificación de Requerimientos) | 1.0 | Anexo 03 |
| SAD (Arquitectura de Software) | 1.0 | Anexo 04 |

# **7\. Presupuesto** {#7.-presupuesto}

Resumen consolidado de la inversión inicial requerida para el Sistema de Buscador Unificado.

| Categoría | Costo (S/.) |
| :---- | :---- |
| Costos de Software | 1,320 |
| Costos de Recursos Humanos | 7,500 |
| Costos Generales de Administración | 720 |
| **Costo Total del Proyecto** | **9,540** |

## 

# **8\. Conclusiones y Recomendaciones** {#8.-conclusiones-y-recomendaciones}

* **Optimización de la búsqueda académica:** Se logró centralizar la información bibliográfica mediante el Sistema NexusLib, resolviendo el problema crítico de fragmentación entre inventarios físicos y digitales. Esta unificación permite reducir el tiempo de investigación de los usuarios, eliminando los procesos lentos de consulta en sistemas separados que anteriormente tomaban entre 15 y 20 minutos.  
* **Integridad y escalabilidad técnica:** La aplicación de patrones de software estructurales y de comportamiento, específicamente Adapter, Facade y Strategy, garantiza una arquitectura de software modular y desacoplada. Esto permite que la integración entre la Google Books API y la base de datos local MySQL sea eficiente, facilitando el mantenimiento futuro y la adición de nuevas fuentes de metadatos sin comprometer el núcleo del sistema.  
* **Viabilidad económica y rentabilidad:** El análisis financiero confirma que el proyecto es plenamente factible y rentable para la institución, presentando un VAN positivo de S/ 4,199.12 y una tasa interna de retorno (TIR) del 17%. Con una relación Beneficio/Costo de 1.44, se asegura que la inversión inicial de S/ 9,540 es recuperable y generará un valor agregado significativo a largo plazo.  
* **Cumplimiento de requerimientos y usabilidad:** El sistema cumple con los 6 requerimientos funcionales estratégicos, permitiendo no solo la búsqueda híbrida, sino también la localización física exacta (piso y estante) y el acceso digital directo. Esto, sumado al enfoque de diseño Mobile First, asegura una alta usabilidad y satisfacción para el estudiante e investigador sin requerir capacitación especializada.  
* **Eficiencia en la infraestructura cloud:** La configuración de la infraestructura como código (IaC) mediante Terraform para el despliegue en Microsoft Azure garantiza la alta disponibilidad y seguridad del sistema. Esta implementación técnica asegura que NexusLib sea una plataforma robusta, capaz de manejar consultas simultáneas con tiempos de respuesta optimizados.

# **9\. Bibliografía** {#9.-bibliografía}

* Sánchez-Tarragó, N., & Alfonso-Sánchez, I. R. (2005). Biblioteca híbrida: el bibliotecario en medio del tránsito de lo tradicional a lo moderno. *ACIMED*, 13(2). [http://eprints.rclis.org/6474/1/Biblioteca\_hibrida.pdf](http://eprints.rclis.org/6474/1/Biblioteca_hibrida.pdf)  
* Guerrero-Cedeño, M., et al. (2025). Sistemas integrados de gestión bibliotecaria en universidades: una revisión sistemática. *Dialnet*. [https://dialnet.unirioja.es/descarga/articulo/10442413.pdf](https://dialnet.unirioja.es/descarga/articulo/10442413.pdf)  
* Daramola, C. F. (2025). Exploring the impact of Digital and Physical Resources on Accessibility and Efficiency in College Libraries. *ResearchGate*. [https://www.researchgate.net/publication/390300560\_Exploring\_the\_impact\_of\_Digital\_and\_Physical\_Resources](https://gemini.google.com/app/23de6b84b664f6e2?utm_source=app_launcher&utm_medium=owned&utm_campaign=base_all)

# **Anexos** {#anexos}

Anexo 01 Informe de Factibilidad

Anex0 02 Documento de Visión

Anexo 03 Documento SRS

Anexo 04 Documento SAD

Anexo 05 Manuales y otros documentos


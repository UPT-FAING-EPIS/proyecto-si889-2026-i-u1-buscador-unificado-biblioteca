![Logo Upt](media/logo-upt.png)

**UNIVERSIDAD PRIVADA DE TACNA**

**FACULTAD DE INGENIERÍA**

**Escuela Profesional de Ingeniería de Sistemas**

# **Sistema NexusLib**

Curso: Patrones de Software

Docente: Ing. Patrick Cuadros Quiroga

Integrantes:

***Hurtado Ortiz, Leandro			(2015052384)***  
***Flores Navarro, Eduardo Gino		(2023076793)***  
***Cortez Mamani, Julio Samuel		(2023077283)***

**Tacna – Perú**  
**2026**

# **Sistema NexusLib**

# 

# **Versión *2.0***

| CONTROL DE VERSIONES |  |  |  |  |  |
| :---: | :---: | :---: | :---: | :---: | ----- |
| Versión | Hecha por | Revisada por | Aprobada por | Fecha | Motivo |
| 1.0 | LDHO | LDHO | LDHO | 02/04/2026 | Versión Original |
| 2.0 | LDHO | LDHO | LDHO | 17/04/2026 | Versión 2.0 |

**ÍNDICE GENERAL**

[**1\. Descripción del proyecto	4**](#1.-descripción-del-proyecto)

[1.1 Nombre del proyecto	4](#1.1-nombre-del-proyecto)

[1.2 Duración del proyecto	4](#1.2-duración-del-proyecto)

[1.3 Descripción	4](#1.3-descripción)

[1.4 Objetivos	4](#1.4-objetivos)

[1.4.1. Objetivo general	4](#1.4.1.-objetivo-general)

[1.4.2 Objetivos específicos	4](#1.4.2-objetivos-específicos)

[**2\. Riesgos	5**](#2.-riesgos)

[**3\. Análisis de la situación actual	5**](#3.-análisis-de-la-situación-actual)

[3.1 Planteamiento del problema	5](#3.1-planteamiento-del-problema)

[3.2 Consideraciones de hardware y software	6](#3.2-consideraciones-de-hardware-y-software)

[**4\. Estudio de Factibilidad	6**](#4.-estudio-de-factibilidad)

[4.1 Factibilidad Técnica	6](#4.1-factibilidad-técnica)

[4.2 Factibilidad Económica	7](#4.2-factibilidad-económica)

[4.2.1 Costos de software	8](#4.2.1-costos-de-software)

[4.2.2 Costos de recursos humanos	8](#4.2.2-costos-de-recursos-humanos)

[4.2.3 Costos generales de Administración	9](#costos-generales-de-administración)

[4.2.4 Tabla general de costos	9](#4.2.4-tabla-general-de-costos)

[4.3 Factibilidad Operativa	9](#4.3-factibilidad-operativa)

[4.4 Factibilidad Legal	10](#4.4-factibilidad-legal)

[4.5 Factibilidad Social	10](#4.5-factibilidad-social)

[4.6 Factibilidad Ambiental	10](#4.6-factibilidad-ambiental)

[**5\. Análisis Financiero	11**](#5.-análisis-financiero)

[5.1 Justificación de la Inversión	11](#5.1-justificación-de-la-inversión)

[5.1.1. Beneficios del proyecto	11](#5.1.1.-beneficios-del-proyecto)

[5.1.2. Criterios de Inversión	12](#5.1.2.-criterios-de-inversión)

[**6\. Conclusiones	14**](#6.-conclusiones)

**Informe de Factibilidad**

# **1\. Descripción del proyecto** {#1.-descripción-del-proyecto}

## **1.1 Nombre del proyecto** {#1.1-nombre-del-proyecto}

Sistema de Buscador Unificado de Recursos para Bibliotecas Físicas y Virtuales NexusLib

## **1.2 Duración del proyecto** {#1.2-duración-del-proyecto}

Inicio: 25 de Marzo  
Fin: 24 de junio

## **1.3 Descripción** {#1.3-descripción}

El proyecto consiste en el diseño y desarrollo de una plataforma web de acceso abierto orientada a centralizar y simplificar el acceso a la información bibliográfica. El sistema funciona como un motor de búsqueda híbrido que permite a los usuarios realizar consultas simultáneas en dos entornos: el inventario físico local de la facultad y el ecosistema digital global. La solución optimiza la investigación académica al proporcionar, en una sola interfaz, la disponibilidad de textos en estanterías y enlaces directos a recursos bibliográficos en formato PDF alojados en repositorios validados. El sistema se basa en una arquitectura de servicios distribuidos que integra la Google Books API para el enriquecimiento de metadatos en tiempo real. Para su implementación, se utiliza el lenguaje PHP 8.2.12 y MySQL para la persistencia de datos, empleando Terraform para la gestión de infraestructura como código (IaC) sobre Microsoft Azure.

## **1.4 Objetivos** {#1.4-objetivos}

### **1.4.1. Objetivo general** {#1.4.1.-objetivo-general}

* Desarrollar una plataforma web unificada que optimice la localización y el acceso a recursos bibliográficos físicos y digitales, mejorando la experiencia de búsqueda y la gestión de información para la comunidad académica.

### **1.4.2 Objetivos específicos** {#1.4.2-objetivos-específicos}

* Diseñar un sistema de búsqueda multicanal que filtre resultados por título, autor, categoría y tipo de recurso (físico o virtual).  
* Integrar una base de datos local de inventario físico que permita visualizar la disponibilidad de textos en tiempo real.  
* Integrar un repositorio digital seguro que permita el almacenamiento y la visualización de archivos electrónicos.  
* Configurar la infraestructura como código (IaC) mediante Terraform para automatizar el despliegue de los servicios en Microsoft Azure y estimar con precisión los costos operativos.  
* Garantizar la escalabilidad del sistema, permitiendo la futura integración con bases de datos de otras facultades o instituciones.

# **2\. Riesgos** {#2.-riesgos}

* **Desincronización de Inventario Físico:** Existe la posibilidad de que la base de datos no refleje en tiempo real si un libro físico ha sido tomado de la estantería sin ser registrado, lo que podría generar desconfianza en el usuario al encontrar datos inexactos.  
* **Complejidad en la Integración de Recursos:** La carga de archivos digitales de gran tamaño o formatos no compatibles podría afectar los tiempos de respuesta del servidor y la experiencia de navegación del estudiante.  
* **Limitación de Créditos en la Nube:** Al utilizar Azure para el despliegue final, existe el riesgo de agotar la cuota de servicios gratuitos o créditos de estudiante antes de finalizar las pruebas de rendimiento, lo que dificultará la disponibilidad operativa a largo plazo.  
* **Curva de Aprendizaje en Infraestructura como Código:** El uso de Terraform para el análisis económico y despliegue requiere una configuración precisa; cualquier error en los scripts podría resultar en una estimación de costos errónea o fallos en la provisión de recursos en Azure.

# **3\. Análisis de la situación actual** {#3.-análisis-de-la-situación-actual}

## **3.1 Planteamiento del problema** {#3.1-planteamiento-del-problema}

Si bien las instituciones académicas enfatizan constantemente la importancia del acceso a la información y la investigación de calidad, los métodos de búsqueda y localización de recursos bibliográficos pueden parecer anticuados y poco efectivos. Es necesario modernizar la forma en que se procesa el acceso a la información en las facultades y bibliotecas universitarias. Aunque los estudiantes y docentes obtienen bases teóricas para sus investigaciones, no encuentran herramientas tecnológicas integradas que les permitan localizar de manera ágil tanto el material físico como el digital en un solo lugar.  
La falta de una plataforma centralizada que combine el inventario físico con el repositorio virtual limita la posibilidad de que el tiempo invertido en la búsqueda se traduzca en una investigación eficiente. Este desajuste entre la existencia del recurso y su accesibilidad genera desmotivación: los investigadores no logran visualizar la totalidad de la oferta bibliográfica de la institución en una sola interfaz, mientras que los administradores de la biblioteca carecen de un sistema unificado que vincule la gestión de estanterías con los archivos electrónicos.

## **3.2 Consideraciones de hardware y software** {#3.2-consideraciones-de-hardware-y-software}

Hardware:

* **CPU:** 2 vCPU mínimo  
* **Memoria RAM**: 4 GB  
* **Almacenamiento:** SSD para la persistencia de datos de MySQL, logs de transacciones e historiales de búsqueda.

Software:

* **Entorno de Desarrollo:** Visual Studio Code (configurado con extensiones para PHP 8.2.12 y validación de sintaxis).  
* **Servidor Local:** XAMPP (Apache para el servidor web y motor de base de datos MySQL).   
* **Motor de Base de Datos:** MySQL (Gestionado con HeidiSQL para la administración de tablas y relaciones).  
* **Arquitectura de Servicios:** Integración con la Google Books API para la recuperación automatizada de metadatos bibliográficos.   
* **Nube:** Azure App Service y Azure Database for MySQL.  
* **Infraestructura como Código:** Terraform v1.x (para el aprovisionamiento de recursos en la nube y análisis económico).  
* **Gestión de Versiones:** GitHub (Integración con Wikis, Projects y Actions).

# **4\. Estudio de Factibilidad** {#4.-estudio-de-factibilidad}

## **4.1 Factibilidad Técnica** {#4.1-factibilidad-técnica}

El proyecto resulta factible desde el punto de vista técnico, ya que el equipo de desarrollo cuenta con las competencias necesarias en ingeniería de sistemas para implementar y mantener la arquitectura propuesta bajo un enfoque de microservicios utilizando PHP. La solución utiliza tecnologías de código abierto con amplio soporte comunitario, garantizando la estabilidad operativa y la flexibilidad del buscador unificado.

La viabilidad técnica se sustenta en los siguientes pilares:

* **Dominio del Stack Tecnológico**: El equipo posee experiencia en el desarrollo web con PHP 8.2.12 y el uso de Visual Studio Code, facilitando la creación de una lógica de negocio distribuida para la búsqueda de recursos.  
* **Arquitectura de Microservicios**: Se implementará una estructura que separa la lógica de presentación del servicio de unificación de datos, integrando microservicios externos como la Google Books API para asegurar un procesamiento eficiente de consultas híbridas  
* **Gestión de Base de Datos**: Se utilizará MySQL (gestionado mediante HeidiSQL) para la administración de inventarios locales, asegurando una integración fluida con los servicios de Azure Database for MySQL para la persistencia en la nube.  
* **Infraestructura y Automatización**: El uso de Microsoft Azure proporciona la escalabilidad necesaria para el almacenamiento de archivos, mientras que Terraform permite gestionar dicha infraestructura mediante código, minimizando errores de configuración manual.  
* **Control de Versiones y Calidad**: La integración con GitHub permite un seguimiento riguroso del avance del proyecto y facilita la implementación de pruebas de aseguramiento de calidad (QA) en cada componente del sistema distribuido.

La estructura modular y distribuida del sistema asegura que la plataforma pueda escalar y adaptarse con facilidad, permitiendo integrar nuevas fuentes de datos bibliográficos en el futuro sin afectar la disponibilidad de los servicios actuales.

## **4.2 Factibilidad Económica** {#4.2-factibilidad-económica}

Este apartado evalúa la inversión necesaria para el desarrollo y puesta en marcha del sistema, asegurando que los recursos financieros sean utilizados de manera eficiente.

### **4.2.1 Costos de software** {#4.2.1-costos-de-software}

| N° | Descripción | Precio Unitario (S/.) | Tiempo | Costo (S/.) |
| :---- | :---- | :---- | :---- | :---- |
| 1 | Azure Database for MySQL | 220 | 3 meses | 660 |
| 2 | Azure App Service Plan (Linux/PHP) | 170 | 3 meses | 510 |
| 4 | Certificado SSL / Dominio | 150 | 1 año | 150 |
| **Total** |  |  |  | **1,320** |

Incluye las herramientas digitales y servicios de infraestructura en la nube proyectados. Como indica la rúbrica, los costos de Azure se basan en el análisis técnico de Terraform.

### **4.2.2 Costos de recursos humanos** {#4.2.2-costos-de-recursos-humanos}

Contempla la inversión en horas de trabajo para el equipo de tres integrantes que cubren las áreas de Frontend, Backend/Microservicios y DevOps.

| N° | Descripción | Precio Unitario (S/.) | Horas | Costo (S/.) |
| :---- | :---- | :---- | :---- | :---- |
| 1 | Desarrollo Backend | 35 | 100 | 3,500 |
| 2 | Desarrollo Frontend | 35 | 80 | 2,800 |
| 3 | Pruebas y QA | 30 | 40 | 1,200 |
| **Total** |  |  |  | **7,500** |

3. ### **Costos generales de Administración** {#costos-generales-de-administración}

Gastos operativos básicos necesarios para el sostenimiento del equipo durante el desarrollo.

| N° | Descripción | Precio Unitario (S/.) | Meses | Costo (S/.) |
| :---- | :---- | :---- | :---- | :---- |
| 1 | Servicios de Internet de alta velocidad | 120 | 3 | 360 |
| 2 | Energía Eléctrica | 70 | 3 | 210 |
| 3 | Gastos Administrativos / Oficina | 50 | 3 | 150 |
| **Total** |  |  |  | **720** |

### **4.2.4 Tabla general de costos** {#4.2.4-tabla-general-de-costos}

Resumen consolidado de la inversión inicial requerida para el Sistema de Buscador Unificado.

| Categoría | Costo (S/.) |
| :---- | :---- |
| Costos de Software | 1,320 |
| Costos de Recursos Humanos | 7,500 |
| Costos Generales de Administración | 720 |
| **Costo Total del Proyecto** | **9,540** |

## 

## 

## 

## 

## 

## 

## 

## 

## **4.3 Factibilidad Operativa** {#4.3-factibilidad-operativa}

El proyecto del Sistema de Buscador Unificado es operativamente viable, ya que su implementación se adapta al entorno académico y a las capacidades de los usuarios previstos, tanto estudiantes como bibliotecarios. La interfaz intuitiva y el enfoque centralizado facilitan su uso sin necesidad de capacitación especializada, permitiendo una transición fluida desde los métodos de búsqueda tradicionales. Además, el equipo de desarrollo ha considerado la automatización de procesos de consulta y validación de inventario, lo que permite una operación eficiente y sostenible en el tiempo. La arquitectura modular basada en microservicios y PHP también posibilita la incorporación de mejoras o nuevas funcionalidades, como la integración de bases de datos externas adicionales, con mínima afectación al sistema en funcionamiento.

## **4.4 Factibilidad Legal** {#4.4-factibilidad-legal}

El desarrollo e implementación del sistema se encuentra estrictamente dentro del marco legal vigente. La plataforma no infringe derechos de propiedad intelectual, ya que emplea tecnologías de libre uso y de código abierto, como el motor MySQL y el lenguaje PHP. Asimismo, la integración con la Google Books API se realiza bajo sus términos de servicio para fines académicos, asegurando el respeto a la autoría y los metadatos bibliográficos.  
El sistema funciona como un facilitador de acceso a la información mediante el redireccionamiento a repositorios públicos y recursos de consulta académica, sin incurrir en el almacenamiento no autorizado de obras protegidas. Al ser una plataforma de acceso abierto y sin registro de usuarios, se elimina la necesidad de gestionar datos sensibles o personales, simplificando el cumplimiento de las normativas de privacidad y seguridad exigidas por la facultad.

## **4.5 Factibilidad Social** {#4.5-factibilidad-social}

El proyecto demuestra una elevada viabilidad social, ya que atiende una demanda académica crítica: optimizar el acceso al conocimiento y fomentar la investigación científica mediante herramientas digitales modernas. Su diseño considera la inclusión y facilidad de uso para investigadores de diferentes niveles, eliminando las barreras tecnológicas que suelen segmentar la información física de la virtual. Al unificar estos recursos, se promueve una cultura de investigación más dinámica y eficiente, reforzando valores como la democratización de la información y el trabajo intelectual en comunidad. Su puesta en marcha influirá positivamente en los hábitos de estudio y en la excelencia académica de la institución.

## **4.6 Factibilidad Ambiental** {#4.6-factibilidad-ambiental}

El sistema es ambientalmente factible, ya que su implementación promueve prácticas sostenibles que reducen el impacto ecológico de la gestión administrativa. Al centralizar la consulta en una plataforma digital y permitir el acceso directo a recursos virtuales, se reduce drásticamente la necesidad de materiales impresos, fotocopias y el uso excesivo de papel. Además, el uso de infraestructura en la nube (Azure) optimiza el consumo energético al evitar el mantenimiento de servidores físicos locales que requieren refrigeración constante. Por lo tanto, el proyecto no solo es respetuoso con el medio ambiente, sino que también impulsa un cambio positivo hacia la digitalización sostenible de los recursos educativos.

# **5\. Análisis Financiero** {#5.-análisis-financiero}

## **5.1 Justificación de la Inversión** {#5.1-justificación-de-la-inversión}

La contribución al desarrollo de una plataforma unificada para identificar y monitorear el acceso a recursos bibliográficos físicos y virtuales responde a la creciente necesidad de modernizar la infraestructura de investigación académica. Al proporcionar recursos financieros a esta iniciativa, se busca reemplazar los métodos tradicionales de búsqueda manual y catálogos fragmentados que no fomentan experiencias interactivas que integren la teoría y la práctica en un solo entorno digital.Esto facilitará la adopción de hábitos de investigación eficientes para estudiantes y docentes, de acuerdo con los objetivos estratégicos de transformación digital para la educación superior. Además, la integración de la infraestructura como código mediante Terraform añade un valor significativo al proyecto, potenciando la transparencia en el gasto de nube y mejorando el rendimiento técnico y social de la inversión inicial.

### **5.1.1. Beneficios del proyecto** {#5.1.1.-beneficios-del-proyecto}

#### **5.1.1.1 Beneficios tangibles**

* **Reducción de costos operativos**: La plataforma digital permite disminuir los gastos en materiales de oficina y fotocopias al integrar el monitoreo y la consulta de recursos en un entorno virtual centralizado.  
* **Optimización de recursos físicos**: Las operaciones de búsqueda y gestión automatizadas eliminan la necesidad de catálogos impresos, reduciendo el consumo de papel y otros insumos administrativos de la biblioteca.  
* **Ahorro en infraestructura TI**: Al implementar una solución en la nube con Azure y Terraform, la institución evita grandes inversiones iniciales en servidores físicos locales, pagando únicamente por los recursos computacionales que realmente utiliza.  
* **Eficiencia en la gestión del tiempo**: La automatización de la disponibilidad de libros y acceso a PDFs libera la carga administrativa del personal bibliotecario, permitiendo una mejor distribución del talento humano en tareas de asesoría académica.


  


#### **5.1.1.2 Beneficios intangibles**

* **Incremento en la motivación académica**: El diseño centralizado y moderno de la aplicación potencia la motivación intrínseca de los estudiantes, favoreciendo una investigación más fluida que se refleja en la calidad de sus trabajos académicos.  
* **Desarrollo de competencias digitales**: Gracias a esta herramienta, tanto docentes como estudiantes mejoran sus habilidades en el manejo de repositorios digitales y entornos de búsqueda avanzada.  
* **Fortalecimiento de la imagen institucional**: La implementación de esta solución de vanguardia refuerza el compromiso de la universidad con la innovación tecnológica y la responsabilidad educativa, mejorando su percepción ante la comunidad y otras entidades.  
* **Fomento de una cultura de investigación**: El programa promueve un acceso democrático a la información, generando un impacto positivo en la conciencia colectiva sobre la importancia de utilizar recursos bibliográficos validados y actualizados

### **5.1.2. Criterios de Inversión** {#5.1.2.-criterios-de-inversión}

#### **5.1.2.1. Costo inicial**

El costo inicial comprende todas las inversiones requeridas para poner en marcha el Sistema de Buscador Unificado antes de que se empiecen a generar valor o beneficios académicos. En el análisis financiero, la totalidad de la inversión, que asciende a S/ 9,540, se registra en el año 0 de la tabla de Flujo de Caja Neto (FCN), lo que implica que dicho desembolso aparece como un flujo de salida inmediato. Este gasto es fundamental, ya que establece la base tecnológica (infraestructura en Azure y desarrollo de software) sobre la cual se recuperará la inversión a través de la optimización de procesos y ahorros proyectados.

#### **5.1.2.2. Costo anual de operación**

En la tabla de Flujos de Caja Neto (FCN), los costos se presentan de manera anual durante los primeros cinco años y se descuentan de los beneficios proyectados para calcular el FCN correspondiente a cada período. Desde un punto de vista analítico, estos costos operativos disminuyen los flujos netos anuales, lo que afecta directamente el cálculo del VAN y la relación beneficio/costo. Un nivel de operación excesivamente alto puede poner en riesgo la rentabilidad del proyecto, mientras que una gestión austera contribuye a tener indicadores financieros más sólidos.

#### **5.1.2.3 Tiempo de elaboración**

El tiempo de elaboración es el lapso que transcurre desde el inicio del proyecto hasta que la plataforma unificada está lista para su fase piloto o atención a los primeros usuarios. El proyecto tiene un tiempo estimado de 3 meses para la completa elaboración, pruebas de integración de recursos físicos/digitales y puesta en marcha final del sistema.

#### **5.1.2.4 Tasa de interés**

La tasa de interés utilizada en el análisis financiero actúa como una tasa de descuento o como el costo de oportunidad del capital invertido. Esta tasa representa el rendimiento mínimo esperado de un proyecto con un perfil de riesgo similar. En nuestro prototipo, hemos establecido esta tasa en un 3% anual, lo que refleja un costo de oportunidad moderado y pone énfasis en el impacto social y educativo de la biblioteca, priorizando el valor académico sobre la presión financiera inmediata  
**Inversión:** S/. 9,540

**Tasa de interés:** 3%

![Tabla Costos](media/tablacostos.png)

#### **5.1.2.5. Relación Beneficio/Costo**

| B/C | 1.44 |
| :---- | ----: |

Al ser mayor a 1, el indicador confirma que los beneficios proyectados superan la inversión y los costos operativos. Esto significa que por cada sol invertido, el sistema genera un retorno de 1.44 soles en valor presente.

#### **5.1.2.6. Valor actual neto**

| VAN | 4,199.12 |
| :---- | ----: |

Este valor representa la ganancia neta del proyecto tras recuperar la inversión inicial y cubrir todos los egresos descontados a cinco años. Un VAN positivo asegura que el sistema es financieramente viable y genera valor para la institución.

#### **5.1.2.7. Tasa Interna de Retorno (TIR)**

| TIR | 17% |
| :---- | ----: |

La TIR del 17% demuestra que la rentabilidad propia del proyecto es significativamente superior a la tasa de descuento del 3% propuesta. Esto garantiza que el buscador unificado es una inversión sólida y resistente a variaciones de costos en la nube.

# **6\. Conclusiones** {#6.-conclusiones}

* El proyecto del Sistema de Buscador Unificado demuestra ser factible en todos los aspectos evaluados: técnico, económico, operativo, legal, social y ambiental.  
* La propuesta tecnológica basada en una arquitectura de microservicios e integración de APIs externas, utilizando PHP 8.2.12, MySQL e infraestructura en Azure, garantiza una solución robusta y escalable para la gestión de recursos bibliográficos.  
* El análisis financiero respalda la inversión con indicadores positivos, destacando un VAN de S/ 4,199.12 y una relación Beneficio/Costo de 1.44, lo que asegura la rentabilidad del sistema bajo el nuevo modelo de desarrollo distribuido.  
* La optimización del presupuesto, al utilizar herramientas de código abierto como Visual Studio Code y HeidiSQL, permite una gestión eficiente de los recursos institucionales, priorizando la inversión en infraestructura de nube y talento humano.  
* El sistema representa una oportunidad real de modernización académica, permitiendo a estudiantes y docentes acceder de manera eficiente a la totalidad de la oferta bibliográfica de la institución mediante la unificación de catálogos físicos y digitales.  
* En conjunto, el proyecto se presenta como una solución sólida con un alto impacto social y educativo, alineado con las metas de transformación digital de la facultad y las exigencias técnicas actuales.

[image1]: <data:image/png;base64,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>

[image2]: <data:image/png;base64,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>
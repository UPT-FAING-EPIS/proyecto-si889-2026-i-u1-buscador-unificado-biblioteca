![Logo Upt](media/logo-upt.png)

**UNIVERSIDAD PRIVADA DE TACNA**

**FACULTAD DE INGENIERÍA**

**Escuela Profesional de Ingeniería de Sistemas**

# **Sistema NexusLib**

Curso: Patrones de Software

Docente: Ing. Patrick Cuadros Quiroga

Integrantes:

***Hurtado Ortiz, Leandro Diego		(2015052384)***  
***Flores Navarro, Eduardo Gino		(2023076793)***  
***Cortez Mamani, Julio Samuel		(2023077283)***

**Tacna – Perú**  
**2026**

# **Sistema NexusLib**

# 

# **Versión *3.0***

| CONTROL DE VERSIONES |  |  |  |  |  |
| :---: | :---: | :---: | :---: | :---: | ----- |
| Versión | Hecha por | Revisada por | Aprobada por | Fecha | Motivo |
| 1.0 | LDHO | LDHO | LDHO | 02/04/2026 | Versión Original |
| 2.0 | LDHO | LDHO | LDHO | 17/04/2026 | Versión 2.0 |
| 3.0 | LDHO | LDHO | LDHO | 08/06/2026 | Versión 3.0 |

**ÍNDICE GENERAL**

[**1\. Descripción del proyecto	4**](#1.-descripción-del-proyecto)

[1.1 Nombre del proyecto	4](#1.1-nombre-del-proyecto)

[1.2 Duración del proyecto	4](#1.2-duración-del-proyecto)

[1.3 Descripción	4](#1.3-descripción)

[1.4 Objetivos	4](#1.4-objetivos)

[1.4.1. Objetivo general	4](#1.4.1.-objetivo-general)

[1.4.2 Objetivos específicos	4](#1.4.2-objetivos-específicos)

[**2\. Riesgos	5**](#2.-riesgos)

[**3\. Análisis de la situación actual	6**](#3.-análisis-de-la-situación-actual)

[3.1 Planteamiento del problema	6](#3.1-planteamiento-del-problema)

[3.2 Consideraciones de hardware y software	6](#3.2-consideraciones-de-hardware-y-software)

[**4\. Estudio de Factibilidad	7**](#4.-estudio-de-factibilidad)

[4.1 Factibilidad Técnica	7](#4.1-factibilidad-técnica)

[4.2 Factibilidad Económica	8](#4.2-factibilidad-económica)

[4.2.1 Costos de software	8](#4.2.1-costos-de-software)

[4.2.2 Costos de recursos humanos	8](#4.2.2-costos-de-recursos-humanos)

[4.2.3 Costos generales de Administración	9](#4.2.3-costos-generales-de-administración)

[4.2.4 Tabla general de costos	9](#4.2.4-tabla-general-de-costos)

[4.3 Factibilidad Operativa	9](#4.3-factibilidad-operativa)

[4.4 Factibilidad Legal	10](#4.4-factibilidad-legal)

[4.5 Factibilidad Social	11](#4.5-factibilidad-social)

[4.6 Factibilidad Ambiental	11](#4.6-factibilidad-ambiental)

[**5\. Análisis Financiero	11**](#5.-análisis-financiero)

[5.1 Justificación de la Inversión	11](#5.1-justificación-de-la-inversión)

[5.1.1. Beneficios del proyecto	12](#5.1.1.-beneficios-del-proyecto)

[5.1.2. Criterios de Inversión	13](#5.1.2.-criterios-de-inversión)

[**6\. Conclusiones	15**](#6.-conclusiones)

**Informe de Factibilidad**

# **1\. Descripción del proyecto** {#1.-descripción-del-proyecto}

## **1.1 Nombre del proyecto** {#1.1-nombre-del-proyecto}

Sistema de Buscador Unificado de Recursos para Bibliotecas Físicas y Virtuales NexusLib

## **1.2 Duración del proyecto** {#1.2-duración-del-proyecto}

Inicio: 25 de Marzo  
Fin: 24 de junio

## **1.3 Descripción** {#1.3-descripción}

El proyecto consiste en el diseño y desarrollo de una plataforma web de acceso unificado orientada a centralizar y simplificar el descubrimiento de recursos bibliográficos para la comunidad académica de la Universidad Privada de Tacna. El sistema funciona como un meta-buscador híbrido que integra tres pilares estratégicos: la base de datos local de la biblioteca física de la UPT, el catálogo digital especializado de Alpha Cloud y la extensa colección académica de E-Libro, lo que permite una cobertura mucho más amplia y categorizada.  La solución optimiza la investigación académica al proporcionar, en una sola interfaz, la consulta simultánea de la disponibilidad de textos en estanterías físicas y el acceso directo a recursos electrónicos validados de alta calidad. El sistema se basa en una arquitectura de servicios distribuidos que orquesta la recuperación de metadatos desde repositorios institucionales y externos para ofrecer un catálogo enriquecido. Para su implementación, se utiliza el lenguaje PHP 8.2.12 y MySQL para la persistencia de datos, empleando Terraform para la gestión de infraestructura como código (IaC) sobre Microsoft Azure.

## **1.4 Objetivos** {#1.4-objetivos}

### **1.4.1. Objetivo general** {#1.4.1.-objetivo-general}

* Desarrollar una plataforma web unificada que optimice la localización y el acceso a recursos bibliográficos físicos y digitales, mejorando la experiencia de búsqueda y la gestión de información para la comunidad académica.

### **1.4.2 Objetivos específicos** {#1.4.2-objetivos-específicos}

* Diseñar e implementar un sistema de búsqueda multicanal que permita filtrar resultados por título, autor y categoría, unificando la consulta de recursos físicos y virtuales en una sola interfaz.    
* Integrar la base de datos local de la biblioteca de la UPT para permitir a los usuarios visualizar la disponibilidad de los textos físicos en estantería en tiempo real.    
* Vincular los catálogos digitales de Alpha Cloud y E-Libro para expandir significativamente la oferta bibliográfica y garantizar el acceso a una mayor variedad de categorías académicas.    
* Configurar la infraestructura como código (IaC) mediante Terraform para automatizar el despliegue de los servicios en Microsoft Azure y gestionar con precisión los costos operativos.    
* Garantizar la escalabilidad de la arquitectura, facilitando la futura incorporación de bases de datos de otras facultades o repositorios institucionales adicionales. 

# **2\. Riesgos** {#2.-riesgos}

* **Desincronización del Inventario Físico:** Existe la posibilidad de que la base de datos no refleje en tiempo real si un libro físico ha sido tomado de la estantería de la UPT sin ser registrado, lo que generaría desconfianza en el usuario ante datos inexactos.  
* **Interrupción o Latencia de APIs Externas:** Al depender de las plataformas Alpha Cloud y E-Libro, el sistema queda sujeto a la disponibilidad técnica de estos proveedores; cualquier caída en sus servicios o lentitud en sus tiempos de respuesta afectará directamente la experiencia de búsqueda unificada.  
* **Inconsistencia en la Consolidación de Metadatos:** La integración de tres fuentes distintas (UPT, Alpha Cloud y E-Libro) aumenta el riesgo de encontrar registros duplicados o formatos de metadatos incompatibles, lo que podría complicar la visualización homogénea de los recursos.  
* **Limitación de Créditos en la Nube:** Al utilizar Microsoft Azure para el despliegue, persiste el riesgo de agotar la cuota de créditos de estudiante antes de completar las pruebas de rendimiento, afectando la disponibilidad operativa a largo plazo.  
* **Gestión de Infraestructura como Código:** El uso de Terraform requiere una configuración extremadamente precisa; errores en los scripts de automatización podrían derivar en fallos en la provisión de recursos en la nube o estimaciones de costos erróneas

# **3\. Análisis de la situación actual** {#3.-análisis-de-la-situación-actual}

## **3.1 Planteamiento del problema** {#3.1-planteamiento-del-problema}

Si bien las instituciones académicas enfatizan constantemente la importancia del acceso a la información y la investigación de calidad, los métodos de búsqueda y localización de recursos bibliográficos pueden parecer anticuados y poco efectivos. Es necesario modernizar la forma en que se procesa el acceso a la información en las facultades y bibliotecas universitarias. Aunque los estudiantes y docentes obtienen bases teóricas para sus investigaciones, no encuentran herramientas tecnológicas integradas que les permitan localizar de manera ágil tanto el material físico como el digital en un solo lugar.  
La falta de una plataforma centralizada que combine el inventario físico con el repositorio virtual limita la posibilidad de que el tiempo invertido en la búsqueda se traduzca en una investigación eficiente. Este desajuste entre la existencia del recurso y su accesibilidad genera desmotivación: los investigadores no logran visualizar la totalidad de la oferta bibliográfica de la institución en una sola interfaz, mientras que los administradores de la biblioteca carecen de un sistema unificado que vincule la gestión de estanterías con los archivos electrónicos.

## **3.2 Consideraciones de hardware y software** {#3.2-consideraciones-de-hardware-y-software}

Hardware:

* **CPU:** 2 vCPU mínimo  
* **Memoria RAM**: 4 GB  
* **Almacenamiento:** Unidad SSD para garantizar la eficiencia en la persistencia de datos de MySQL, logs de transacciones e historiales de búsqueda.

Software:

* **Entorno de Desarrollo:** Visual Studio Code (configurado con extensiones para PHP 8.2.12 y validación de sintaxis).  
* **Servidor Local:** XAMPP (Apache para el servidor web y motor de base de datos MySQL).   
* **Motor de Base de Datos:** MySQL (Gestionado con HeidiSQL para la administración de tablas y relaciones).  
* **Arquitectura de Servicios:** Integración multicanal con Alpha Cloud, E-Libro y la base de datos local de la UPT para la recuperación y unificación automatizada de recursos bibliográficos.  
* **Nube:** Azure App Service y Azure Database for MySQL.  
* **Infraestructura como Código:** Terraform v1.x (para el aprovisionamiento de recursos en la nube y análisis económico).  
* **Gestión de Versiones:** GitHub (Integración con Wikis, Projects y Actions).

# **4\. Estudio de Factibilidad** {#4.-estudio-de-factibilidad}

## **4.1 Factibilidad Técnica** {#4.1-factibilidad-técnica}

El proyecto resulta factible desde el punto de vista técnico, ya que el equipo de desarrollo cuenta con las competencias necesarias en ingeniería de sistemas para implementar y mantener la arquitectura propuesta bajo un enfoque de microservicios utilizando PHP. La solución utiliza tecnologías de código abierto con amplio soporte comunitario, garantizando la estabilidad operativa y la flexibilidad del buscador unificado.

La viabilidad técnica se sustenta en los siguientes pilares:

* **Dominio del Stack Tecnológico:** El equipo posee experiencia en el desarrollo web con PHP 8.2.12 y el uso de Visual Studio Code, facilitando la creación de una lógica de negocio distribuida para la búsqueda de recursos.  
* **Arquitectura de Microservicios:** Se implementará una estructura que unifica el acceso a Alpha Cloud, E-Libro y la base de datos local de la UPT, asegurando un procesamiento eficiente de consultas híbridas mediante microservicios que integran estos catálogos de manera transparente.  
* **Gestión de Base de Datos:** Se utilizará MySQL (gestionado mediante HeidiSQL) para la administración de inventarios locales, asegurando una integración fluida con los servicios de Azure Database for MySQL para la persistencia en la nube.  
* **Infraestructura y Automatización:** El uso de Microsoft Azure proporciona la escalabilidad necesaria para el almacenamiento de archivos, mientras que Terraform permite gestionar dicha infraestructura mediante código, minimizando errores de configuración manual.  
* **Control de Versiones y Calidad:** La integración con GitHub permite un seguimiento riguroso del avance del proyecto y facilita la implementación de pruebas de aseguramiento de calidad (QA) en cada componente del sistema distribuido.

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

### **4.2.3 Costos generales de Administración** {#4.2.3-costos-generales-de-administración}

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

El proyecto del Sistema NexusLib es operativamente viable, ya que su implementación se adapta de manera óptima al entorno académico y a las capacidades de los usuarios previstos, tanto estudiantes como bibliotecarios. La interfaz intuitiva y el enfoque centralizado facilitan su uso sin necesidad de capacitación especializada, permitiendo una transición fluida desde los métodos de búsqueda tradicionales.

Un factor determinante en esta viabilidad operativa es la optimización exhaustiva de la plataforma para dispositivos móviles mediante un diseño web adaptable (responsive design). Esta arquitectura de interfaz garantiza que todo el flujo del usuario incluyendo la consulta unificada de catálogos, el uso de filtros avanzados y la gestión de módulos personales como libros guardados y reservados sea 100% funcional y fluido en smartphones y tabletas. Al mitigar la sobrecarga visual y priorizar la ligereza en el renderizado móvil, se asegura una experiencia consistente que responde al patrón de uso tecnológico predominante en la comunidad universitaria sin sacrificar el rendimiento del sistema.  
Además, el equipo de desarrollo ha considerado la automatización de procesos de consulta y validación de inventario, lo que permite una operación eficiente y sostenible en el tiempo. La arquitectura modular basada en microservicios y PHP también posibilita la incorporación de mejoras o nuevas funcionalidades, como la integración de bases de datos externas adicionales o evoluciones en la capa de datos, con mínima afectación al sistema en funcionamiento.

## **4.4 Factibilidad Legal** {#4.4-factibilidad-legal}

El desarrollo e implementación del sistema se encuentra estrictamente dentro del marco legal vigente. La plataforma no infringe derechos de propiedad intelectual, ya que emplea tecnologías de libre uso y de código abierto, como el lenguaje PHP y un motor de base de datos relacional. Asimismo, la integración con las plataformas Alpha Cloud y E-Libro se realiza bajo sus respectivos términos de servicio para fines académicos, asegurando el respeto a la autoría y la correcta gestión de los metadatos bibliográficos.  
El sistema funciona como un facilitador de acceso a la información mediante la unificación de catálogos y el redireccionamiento a repositorios validados y recursos de consulta académica, sin incurrir en el almacenamiento no autorizado de obras protegidas.  
Respecto a la gestión de usuarios, la plataforma incorpora módulos dinámicos de registro, inicio de sesión y persistencia de datos (necesarios para las funciones de libros guardados y reservados). El tratamiento de esta información se alinea estrictamente con la Ley de Protección de Datos Personales en el Perú (Ley N° 29733\) y su reglamento. Para asegurar su cumplimiento, el sistema implementa medidas técnicas de seguridad defensiva, tales como el cifrado de credenciales, el manejo de sesiones mediante tokens protegidos en el cliente y la restricción estricta de acceso a los directorios del servidor. Esto garantiza que la recopilación de datos básicos (nombres y correos electrónicos) se limite exclusivamente a fines operativos y pedagógicos de la biblioteca, salvaguardando la privacidad y confidencialidad exigidas por la facultad y la normativa nacional.

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

* El proyecto del Sistema NexusLib demuestra ser plenamente factible en todos los aspectos evaluados: técnico, económico, operativo, legal, social y ambiental.  
* La propuesta tecnológica, basada en una arquitectura de microservicios que integra de manera unificada la base de datos local de la UPT, Alpha Cloud y E-Libro, garantiza una solución robusta y escalable empleando PHP 8.2.12, MySQL e infraestructura en Azure.  
* El análisis financiero respalda la inversión con indicadores positivos, destacando un VAN de S/ 4,199.12 y una relación Beneficio/Costo de 1.44, lo que asegura la rentabilidad del sistema bajo el nuevo modelo de desarrollo distribuido.  
* La optimización del presupuesto, al utilizar herramientas de código abierto como Visual Studio Code y HeidiSQL, permite una gestión eficiente de los recursos institucionales, priorizando la inversión en infraestructura de nube gestionada por Terraform y el talento humano.  
* El sistema representa una oportunidad real de modernización académica, permitiendo a estudiantes y docentes acceder de manera eficiente a la totalidad de la oferta bibliográfica de la institución mediante la unificación de catálogos físicos y digitales en una sola interfaz.  
* En conjunto, el proyecto se presenta como una solución tecnológica sólida con un alto impacto social y educativo, alineada con las metas de transformación digital de la facultad y las exigencias técnicas actuales.

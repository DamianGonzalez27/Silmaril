<p align="center"><img src="Ivy.png" width="300"></a></p>

# Ivy Silmaril 

--- 

## Una vision diferente y sencilla en la forma en la que construimos la web 

---

**Ivy Silmaril** es un Framework de trabajo que tiene como principal objetivo la construccion de aplicaciones robustas, escalables y de fácil mantenimiento, separando al maximo posible el desarrollo de las interfaces de usuario con la programacion de la logica de negocios.

## Generalidades
---
### MVVM
---
**Ivy Silmaril** esta desarrollado con el patron de diseño ``MVVM`` con el objetivo de separar al maximo posible el desarrollo de las interfaces de usuario y la logica de negocios, esto lo hace con un enfoque ``orientado a data`` y no a recursos, en donde servimos un ``Model-View`` y este tiene una comunicacion bi direccional y ágil  con el servidor de backend sin la necesidad de recargar el ``Model-View`` en ningun momento.

---

#### **Model-View** 
---
Se trata de aplicaciones web de una sola página construidas de forma independiente y modular. Estas aplicaciones se constituyen de ``componentes reactivos`` que interactuan directamente con el backend manteniendo estados y dandole dinamismo a la aplicación sin la necesidad de cambiar o recargar la página.

Cada ``Model-View`` servido implementa su propia logica y contiene todas las herramientas necesarias para hacer uso de la coleccion de endpoints disponibles desde el backend para desarrollar.

--- 

#### **Protocolo de comunicación**
---

**Silmaril** hace uso únicamente de dos verbos ``HTTP`` para la definicion de todo su flujo de trabajo, los cuales son: 

- **GET**: Es usado para acceder a los diferentes ``Model-View`` de la aplicacion.

- **POST**: Es usado para la comunicación entre el ``Model-View`` y la aplicacion Backend

Esto con la finalidad de reducir la complejidad de comunicacion y facilitar la escalabilidad de las aplicaciones desarrolladas

---
## ¿Como empiezo a usarlo?

---

Es muy sencillo, actualmente Ivy Silmaril se encuentra en su primer realease y esta en los paquetes de composer, comenzar a usarlo es tan sencillo como teclear en tu terminal 

``$ composer create-project damian/silmaril nombre_proyecto``

Esto te creara la carpeta nombre_proyecto, la cual contendra todo el codigo necesario para comenzar una aplicacion **Ivy Silmaril** sencilla. 

---

## Entornos de desarrollo y produccion

---

### **Servidor**

---
El servidor es el equipo de computo en el que se ejecuta el programa, en terminos comunes: es la maquina en donde se ejecutan nuestros scripts php, en terminos de desarrollo lo podriamos comparar con el localhost.

Cuando nos disponemos a desarrollar una aplicacion php, es muy comun que nos dispongamos a instalar una serie de herramientas que nos permiten comenzar con la programación de nuestra aplicación, es aqui cuando comenzamos a investigar en los entornos de desarrollo, y nos encontramos con varios programas informaticos.

Un servidor web es un programa informatico que se encarga de procesar una aplicacion y realizar conexiones bidireccionales o unidireccionales, sincronicas o asincronicas con el cliente, generando una respuesta en cualquier lenguaje o aplicacion, para este caso hare bastante enfasis en dos tecnologias importantes [Apache](https://httpd.apache.org) y [Nginx](https://www.nginx.com), servidores web con mucha documentacion y con un uso bastante expandido.

En ambos casos es recomendable que si el servidor que se usará, es una instalacion limpia de alguno de estos, debemos configurar un ``Virtual Host`` para que este apunte a la carpeta ``public/`` de nuestro proyecto **Ivy Silmaril**.

---

### **Peticiones (Request) y Respuestas (Response)**
---
La comunicacion HTTP se basa en un modelo de solicitud/respuesta, de modo que hay dos tipos de solicitud hacia un servidor de informacion. Ambos mensajes contienen en una linea de entrada, una linea de salida y en ocaciones los mensajes contienen un cuerpo del mensaje. 

Estos objetos son interptretados por nuestro servidor web y son procesadas estas peticiones en el equipo de computo que recibe esta peticion.

La linea de salida o linea de peticion, siempre es la primeta linea del mensaje y contiene 3 campos:

- Un metodo HTTP
- Un identificador universal de recursos (URI)
- Una version del protocolo HTTP

Aunque existen varios metodos HTTP los mas usados son GET y POST. Tradicionalmente el metodo GET se usa para obtener un recurso en el servidor indicado en el campo URI y el metodo POST es usado para enviar explisitamente informacion al servidor. Este protocolo de intercabio de informacion ha sido la base de la construccion web actual y es algo que debemos tener bien en mente al momento de crear aplicaciones Ivy.

---

## Algunos entornos de desarrollo compatibles
---
### [Laragon](https://laragon.org)
---

La carpeta raiz del proyecto debe estar localizada en la carpeta www de tu carpeta de instalacion laragon. Para mas informacion consulta la [documentacion oficial](https://laragon.org/docs/install.html).

---

### [Valet](https://laravel.com/docs/7.x/valet)
---

En el caso de estar usando el entorno de desarrollo valet ya sea en MacOS o en Linux, es importante realizar un link simbolico de la aplicacion dentro de la carpeta ``public/`` del proyecto que has creado. Bastaria con situarte con la terminal dentro de la carpeta ``public/`` y ejecutar:

``$ valet link app_name``

Esto con la finalidad de hacer que la carpeta principal del servidor sea la carpeta ``public/`` ejecutando el archivo ``index.php`` y las reglas contenidas en el archivo ``.htaccess``.

Con estas configuraciones basicas podremos ejecutar aplicaciones **Ivy Silmaril**, si quieres mas informacion al respecto visita la [documentacion oficial](https://laravel.com/docs/7.x/valet).

Sigueme en mis redes sociales:
- [Facebook](https://www.facebook.com/DamianGonzalezDev)
- [Twitter](https://twitter.com/DamianDev1)
- [Linkedin](https://www.linkedin.com/in/damiangonzalezdev/)
- [Youtube](https://www.youtube.com/channel/UCS2RPa81nBPQAiUFjmy2aWA?view_as=subscriber)


Visita mi web
 
 - [DamianDev](https://damiandev.herokuapp.com)


> Dudas, comentarios o sugerencias, enviame un correo electronico: [ing.gonzaleza@outlook.com](mailto:ing.gonzaleza@outlook.com)

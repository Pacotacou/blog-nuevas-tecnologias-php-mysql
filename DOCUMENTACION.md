# Documentación del Proyecto

Este proyecto es una aplicación web de blog que permite a los usuarios registrarse, iniciar sesión, crear publicaciones, y comentar en ellas. A continuación se detalla el funcionamiento de los principales componentes del sistema.

## Estructura del Proyecto

- **classes/**: Contiene las clases PHP que manejan la lógica de negocio, como `User`, `Post`, y `Comment`.
- **config/**: Incluye archivos de configuración, como `db.php` para la conexión a la base de datos.
- **assets/**: Contiene archivos estáticos como estilos CSS, scripts JavaScript, e imágenes.
- **uploads/**: Carpeta para almacenar imágenes subidas por los usuarios.
- **database/**: Scripts SQL para configurar la base de datos.

## Descripción de Archivos Clave

### classes/User.php
Maneja el registro y el inicio de sesión de los usuarios. Utiliza la clase `PDO` para interactuar con la base de datos.

### classes/Post.php
Gestiona la creación, lectura, actualización y eliminación de publicaciones. También maneja la carga de imágenes asociadas a las publicaciones.

### classes/Comment.php
Administra la creación y recuperación de comentarios asociados a las publicaciones.

### config/db.php
Configura la conexión a la base de datos utilizando PDO. Define los parámetros de conexión como el host, nombre de la base de datos, usuario y contraseña.

### index.php
Página principal que muestra todas las publicaciones recientes. Incluye enlaces para ver detalles de cada publicación.

### single_post.php
Muestra los detalles de una publicación específica junto con sus comentarios. Permite a los usuarios autenticados agregar comentarios.

### post.php
Permite a los usuarios autenticados crear nuevas publicaciones. Incluye un formulario para ingresar el título, contenido y cargar una imagen.

### edit_post.php
Permite a los usuarios editar sus publicaciones existentes. Incluye la opción de actualizar la imagen de la publicación.

## Base de Datos

El sistema utiliza una base de datos MySQL con las siguientes tablas:

- **users**: Almacena información de los usuarios como nombre de usuario, correo electrónico y contraseña.
- **posts**: Contiene las publicaciones creadas por los usuarios, incluyendo título, contenido, y ruta de la imagen.
- **comments**: Guarda los comentarios realizados en las publicaciones, vinculados a usuarios y publicaciones específicas.

## Configuración Inicial

1. Configurar la base de datos utilizando los scripts en `database/setup.sql`.
2. Asegurarse de que el servidor web tenga permisos de escritura en la carpeta `uploads`.
3. Configurar las credenciales de la base de datos en `config/db.php`.

Este documento proporciona una visión general del funcionamiento del sistema. Para más detalles, consulte los comentarios en el código fuente.

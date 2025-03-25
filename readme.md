# Ecommerce con PHP Vanilla y API REST

Este proyecto es un ecommerce desarrollado con **PHP Vanilla** aplicando el patrón de diseño **MVC (Modelo-Vista-Controlador)**, 
implementando un **front controller** y un **router propio**. Además, se utilizan middleware para realizar validaciones antes de llegar a los controladores y 
un `autoload.php` para cargar las clases a medida que se utilizan.

---

## Tecnologías Utilizadas

- **Lenguajes:** JavaScript, PHP
- **Base de datos:** MySQL
- **Patrones de diseño:** MVC, Front Controller, Repository, Singleton, Fluent Interface, entre otros.

---

## Descripción del Proyecto

El sistema permite gestionar un ecommerce con las siguientes funcionalidades:

- **Gestión de Productos y Categorías:**  
  Los productos se pueden agregar a un carrito, realizar pedidos y enviar un correo electrónico a la tienda con el detalle del pedido y el precio total.
  
- **Autenticación y Roles de Usuario:**  
  Se implementa un sistema de autenticación basado en tokens, similar a JWT, sin utilizar librerías externas.  
  Existen tres roles:
  - **read:** Permite únicamente consultas.
  - **admin:** Permite consultas, creación, eliminación y actualización de productos y categorías.
  - **superAdmin:** Además de lo anterior, permite administrar usuarios (consultar, actualizar y eliminar).

- **API REST:**  
  La API permite administrar el sitio. Entre sus funciones se incluyen:
  - Gestión de productos: Obtener, crear, actualizar (total y parcial) y eliminar productos.
  - Gestión de categorías: Obtener, crear, actualizar (total y parcial) y eliminar categorías.
  - Gestión de usuarios: Obtener, actualizar parcialmente y eliminar usuarios (solo para superAdmin).

- **Problemas y Solución en la API REST:**  
  Debido a que PHP maneja por defecto solo los verbos HTTP `POST` y `GET`, se desarrolló el método `ParseInput` en la clase `Request` para:
  - Parsear datos del cuerpo de solicitudes con métodos distintos a `POST` y `GET` a un array asociativo.
  - Manejar archivos binarios (como imágenes) y asignarlos al array global `$_FILES` con sus correspondientes propiedades (`error`, `name`, `tmp_name`, `size`, `type`).

- **Acceso a la Base de Datos:**  
  Se implementó el patrón **Repository** para separar la lógica de negocio de la lógica de acceso a datos. Esto permite que, en el futuro, si se decide cambiar de MySQL a una base de datos NoSQL, solo se modifique 
la clase de conexión sin alterar el resto del proyecto.

---

## Endpoints de la API

### Productos

- **Obtener todos los productos:**  
  `GET https://localhost/api/producto`

- **Obtener un producto por ID:**  
  `GET https://localhost/api/producto/{id_producto}`

- **Crear un producto:**  
  `POST https://localhost/api/producto`  
  **Parámetros obligatorios (multipart/form-data):**
  - `nombre`: Nombre del producto.
  - `id_categoria`: Debe existir la categoría.
  - `precio`
  - `contenido`
  - `file`: Imagen del producto.  
  *Requiere rol `admin` o `superAdmin`.*

- **Actualizar completamente un producto:**  
  `PUT https://localhost/api/producto/{id_producto}`  
  **Parámetros obligatorios (multipart/form-data):**
  - `nombre`
  - `id_categoria`: La categoría debe existir.
  - `precio`
  - `contenido`
  - `file`: Imagen del producto.  
  *Requiere rol `admin` o `superAdmin`.*

- **Actualizar parcialmente un producto:**  
  `PATCH https://localhost/api/producto/{id_producto}`  
  **Parámetros aceptados (multipart/form-data o application/x-www-form-urlencoded):**
  - `nombre`
  - `id_categoria`
  - `precio`
  - `contenido`
  - `file`: Si se sube una imagen, se debe enviar también el `id_categoria`.  
  *Requiere rol `admin` o `superAdmin`.*

- **Eliminar un producto:**  
  `DELETE https://localhost/api/producto/{id_producto}`  
  *Requiere rol `admin` o `superAdmin`.*

### Categorías

- **Obtener todas las categorías:**  
  `GET https://localhost/api/categoria`

- **Obtener una categoría por ID:**  
  `GET https://localhost/api/categoria/{id_categoria}`

- **Crear una categoría:**  
  `POST https://localhost/api/categoria`  
  **Parámetros obligatorios (multipart/form-data):**
  - `nombre`
  - `descripcion`
  - `file`: Imagen de la categoría.  
  *Requiere rol `admin` o `superAdmin`.*

- **Actualizar completamente una categoría:**  
  `PUT https://localhost/api/categoria/{id_categoria}`  
  **Parámetros obligatorios (multipart/form-data):**
  - `nombre`
  - `descripcion`
  - `file`: Imagen de la categoría.  
  *Requiere rol `admin` o `superAdmin`.*

- **Actualizar parcialmente una categoría:**  
  `PATCH https://localhost/api/categoria/{id_categoria}`  
  **Parámetros aceptados (multipart/form-data o application/x-www-form-urlencoded):**
  - `nombre`
  - `descripcion`
  - `file`: Imagen de la categoría.  
  *Requiere rol `admin` o `superAdmin`.*

- **Eliminar una categoría:**  
  `DELETE https://localhost/api/categoria/{id_categoria}`  
  *Requiere rol `admin` o `superAdmin`.*

### Usuarios

- **Obtener todos los usuarios:**  
  `GET https://localhost/api/usuario`  
  *Requiere rol `superAdmin`.*

- **Obtener un usuario por ID:**  
  `GET https://localhost/api/usuario/{id_usuario}`  
  *Requiere rol `superAdmin`.*

- **Actualizar parcialmente un usuario:**  
  `PATCH https://localhost/api/usuario/{id_usuario}`  
  **Parámetros aceptados (multipart/form-data o application/x-www-form-urlencoded):**
  - `email`
  - `password`
  - `rol`  
  *Requiere rol `superAdmin`.*  
  > **Nota:** Al actualizar cualquier dato, el usuario recibirá un correo con la información del cambio. Si se cambia el rol, se generará un nuevo token que se enviará
 por correo al usuario.

- **Eliminar un usuario:**  
  `DELETE https://localhost/api/usuario/{id_usuario}`  
  *Requiere rol `superAdmin`.*

---

## Instalación y Configuración del Proyecto

### Requisitos

- Servidor Apache
- PHP
- MySQL  
  Se recomienda utilizar **XAMPP** ya que incluye todo lo necesario para el desarrollo local.

### Configuración del Envío de Correos

Para el envío de correos se utiliza un servidor SMTP. En el ejemplo se utiliza [Mailtrap](https://mailtrap.io/signin), que es gratuito.

1. Regístrate en Mailtrap y obtén los datos de configuración.
2. Dirígete al archivo `app/mail/mailer/PhpmailerMailer.php`.
3. Configura las siguientes propiedades con los datos obtenidos de Mailtrap:

   ```php
   $mail->Host       = 'datos obtenidos de mailtrap';
   $mail->SMTPAuth   = true;
   $mail->Username   = 'datos obtenidos de mailtrap';
   $mail->Password   = 'datos obtenidos de mailtrap';
   $mail->SMTPSecure = '';
   $mail->Port       = 465;


# Configuración de la Base de Datos

- En la carpeta **DB** encontrarás el archivo SQL para importar.
- Crea una base de datos en tu máquina local.
- Importa el archivo **.sql** ubicado en la carpeta **DB**.
- Actualiza los valores de conexión en el archivo **/app/dataSource/MysqlDataSource.php**:

```php
class MysqlDataSource implements IDataSource {
    private ?PDO $pdo = null;
    static public $instance = null;

    private function __construct() {
        $host = 'localhost';
        $db   = 'name_database';
        $user = 'root';
        $pass = '';
        // ...
    }
}


# Puntos Clave del Desarrollo

## Patrones de Diseño Aplicados:

- **MVC:** Separación de la lógica de negocio, presentación y control.
- **Front Controller y Router Propio:** Centralización de todas las solicitudes HTTP.
- **Repository:** Separación de la lógica de acceso a datos, facilitando cambios futuros en el tipo de base de datos.
- **Otros patrones:** Singleton, Fluent Interface, entre otros.

## Manejo de Verbs HTTP:

Se implementó el método `ParseInput` en la clase `Request` para soportar métodos como `PUT`, `PATCH` y `DELETE`, y para gestionar archivos (imágenes) en 
las solicitudes.

## Autenticación Basada en Tokens:

Se creó una clase propia para la generación y validación de tokens, emulando el funcionamiento de JWT.

## Documentación y Modularidad:

La estructura del código y la separación de responsabilidades permiten un mantenimiento sencillo y la escalabilidad del sistema.

# Peticiones a la API

Se recomienda utilizar la extensión de Google Chrome **Talend API Tester**, que es liviana y fácil de usar, para realizar las pruebas de los endpoints de la API.

# Conclusión

Este proyecto fue creado con la finalidad de aplicar y comprender a fondo diversos patrones de diseño, así como su implementación desde cero en un entorno real de desarrollo. La arquitectura modular y el uso de técnicas modernas permiten que el código sea limpio, escalable y adaptable a futuras necesidades.








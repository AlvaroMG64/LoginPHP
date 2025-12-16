# LoginPHP

## Descripción

**LoginPHP** es un sistema de autenticación y registro de usuarios desarrollado en **PHP** con soporte **PDO**, siguiendo el patrón **Modelo-Vista-Controlador (MVC)**. Incluye medidas de seguridad como:

- Validaciones en frontend y backend.
- CSRF token para formularios sensibles.
- Cookies seguras y gestión de sesiones.
- Control de intentos de acceso.
- Registro de usuario con aprobación de administrador.

Está pensado como proyecto didáctico, incorporando buenas prácticas de seguridad y estructura clara.

---

## Estructura del proyecto

LoginPHP/
│
├── index.php # Vista de login
├── autenticacion.php # Controlador de autenticación
├── registro.php # Vista de registro de usuario
├── procesar-registro.php # Controlador de registro
├── establecer-sesion.php # Configuración y seguridad de sesiones
├── inicio.php # Vista protegida tras login
├── logout.php # Cierre de sesión seguro
├── admin.php # Vista de gestión de usuarios pendientes (admin)
├── procesar-admin.php # Controlador de aprobación/rechazo de usuarios
├── validaciones.js # Validaciones frontend
├── usuarios.sql # Script de base de datos
└── README.md # Documentación del proyecto


---

## Base de datos

Archivo: **usuarios.sql**

```sql
CREATE TABLE usuarios (
    coduser INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idusuario VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    admitido BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

- `coduser`: identificador único de usuario.  
- `idusuario`: nombre de usuario (único).  
- `password`: contraseña (en el ejemplo simple, texto plano; en producción usar **hash**).  
- `nombre` y `apellidos`: datos personales del usuario.  
- `admitido`: indica si el usuario está aprobado por el administrador; los nuevos usuarios se insertan con `FALSE` por defecto.

## Funcionalidades y archivos asociados

A continuación se detallan los 10 apartados del proyecto y cómo se han implementado:

### 1. Validación front-end con JavaScript
- **Archivo:** `validaciones.js`  
- **Validaciones:**
  - `idusuario`: 8–15 caracteres, solo letras, números y guión bajo.
  - `password`: 8–15 caracteres, al menos una mayúscula, una minúscula, un número y un símbolo permitido (`!@#$%&*?-`).  
- Mensajes de error en alertas Bootstrap dentro de los formularios (`index.php`, `registro.php`).  

### 2. Cookies de sesión seguras
- **Archivo:** `establecer-sesion.php`  
- Configuración:
  - `httponly` para que JavaScript no pueda acceder a la cookie.
  - `samesite=Strict` para prevenir CSRF.
  - `path='/'` para que la cookie esté disponible en toda la aplicación.

### 3. Token CSRF
- Generado en: `establecer-sesion.php`  
- Pasado en formularios como campo oculto:
  - `index.php` (login)  
  - `registro.php` (registro)  
  - `admin.php` (aprobación/rechazo)  
- Comprobado en:
  - `autenticacion.php`  
  - `procesar-registro.php`  
  - `procesar-admin.php`  

### 4. Eliminación explícita de la cookie de sesión
- **Archivo:** `logout.php`  
- Además de `session_destroy()`, se borra la cookie manualmente con `setcookie(session_name(), '', time() - 42000, ...)`.  

### 5. Observación de parámetros php.ini
- Se revisaron los archivos:
  - `php.ini-development`  
  - `php.ini-production`  
- Propósito: conocer los valores por defecto de `session.cookie_lifetime`, `session.cookie_httponly`, etc.  

### 6. Tiempo de expiración de cookie
- Configurado en `establecer-sesion.php`:
```php
session_set_cookie_params([
    'lifetime' => 3600,
    ...
]);```
- Expira automáticamente al pasar 1 hora.

### 7. Regeneración de cookie y límite de sesión
- **Archivo:** `establecer-sesion.php`
- Funcionalidad:
  - Regeneración de ID de sesión cada 20 minutos.  
  - Límite de sesión: 2 horas (`inicio_sesion`).  

### 8. Control de intentos de acceso
- **Archivos:** `autenticacion.php` y `procesar-registro.php`  
- Funcionalidad:
  - Limitado a **5 intentos** por sesión.  
  - Mensaje de error y bloqueo temporal tras superar el límite.  

### 9. Registro de usuario
- **Archivos:** `registro.php` (vista) y `procesar-registro.php` (controlador)  
- Funcionalidad:
  - Los usuarios pueden registrarse en un solo paso.  
  - Se valida longitud y formato de campos.  
  - Se comprueba si el `idusuario` ya existe.  
  - Inserción en base de datos con `admitido = FALSE` por defecto.  

### 10. Aprobación de usuarios por administrador
- **Archivos:** `admin.php` (vista) y `procesar-admin.php` (controlador)  
- Funcionalidad:
  - Lista usuarios con `admitido = FALSE`.  
  - Permite **aprobar** (establecer `admitido = TRUE`) o **rechazar** (eliminar) usuarios.  
  - Garantiza que los usuarios no acceden al sistema hasta ser aprobados.  

### Estilo visual
- **Tipografía:** Poppins (Google Fonts)  
- **Colores:** Azul oscuro de fondo (`#1f2a44`) y tarjetas (`#2c3e70`)  
- **Formulario:** Tarjetas centradas y anchas, con campos y botones estilizados, placeholders visibles  
- Compatible con **Bootstrap 5.3.2**

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

coduser: identificador único de usuario.

idusuario: nombre de usuario (único).

password: contraseña (en el ejemplo simple, texto plano; en producción usar hash).

nombre y apellidos: datos personales del usuario.

admitido: indica si el usuario está aprobado por el administrador; los nuevos usuarios se insertan con FALSE por defecto.
# LoginPHP

## 📌 Descripción

**LoginPHP** es un sistema de autenticación y registro de usuarios desarrollado en **PHP** utilizando **PDO**, siguiendo una separación clara entre vistas y controladores, con fines **didácticos**.

El proyecto incorpora medidas de seguridad habituales en aplicaciones web modernas, manteniendo una estructura sencilla y comprensible.

---

## 📂 Estructura del proyecto

- **index.php** → Vista de login  
- **autenticacion.php** → Controlador de autenticación  
- **registro.php** → Vista de registro de usuario  
- **procesar-registro.php** → Controlador de registro  
- **establecer-sesion.php** → Configuración y seguridad de sesiones  
- **inicio.php** → Vista protegida tras login  
- **logout.php** → Cierre de sesión seguro  
- **admin.php** → Vista de gestión de usuarios pendientes  
- **procesar-admin.php** → Controlador de aprobación/rechazo  
- **validaciones.js** → Validaciones en frontend  
- **usuarios.sql** → Script de base de datos  

---

## 🗄️ Base de datos

La base de datos `login-php` contiene la tabla `usuarios` con los siguientes campos:

- **coduser**: identificador único del usuario (clave primaria).  
- **idusuario**: nombre de usuario único.  
- **password**: contraseña almacenada mediante hash seguro.  
- **nombre** y **apellidos**: datos personales del usuario.  
- **admitido**: indica si el usuario está aprobado por el administrador.

**Reglas de estado:**
- Usuarios existentes → `admitido = TRUE`  
- Nuevos registros → `admitido = FALSE` (pendientes de aprobación)

---

## ⚙️ Funcionalidades implementadas

### 1. Validación front-end
- Implementada en `validaciones.js`.
- Controla formato y longitud de usuario y contraseña.
- Muestra errores mediante alertas Bootstrap.

### 2. Cookies de sesión seguras
- Configuradas en `establecer-sesion.php`.
- Uso de `httponly`, `samesite=Strict` y `path=/`.

### 3. Protección CSRF
- Token generado al iniciar sesión.
- Incluido en todos los formularios.
- Verificado en los controladores.

### 4. Cierre de sesión seguro
- Destrucción completa de la sesión.
- Eliminación explícita de la cookie de sesión.

### 5. Parámetros de sesión
- Revisión de parámetros relevantes en `php.ini`.
- Aplicación práctica en la configuración del proyecto.

### 6. Expiración de sesión
- Cookies con duración limitada a 1 hora.
- Caducidad automática por inactividad.

### 7. Regeneración de sesión
- Regeneración del ID cada 20 minutos.
- Límite máximo de sesión de 2 horas.

### 8. Control de intentos de acceso
- Máximo de 5 intentos por sesión.
- Bloqueo temporal tras superar el límite.

### 9. Registro de usuarios
- Validación de datos.
- Comprobación de usuario existente.
- Inserción como pendiente de aprobación.

### 10. Aprobación por administrador
- Panel exclusivo para usuarios pendientes.
- Opciones de aprobar o rechazar.
- Acceso restringido hasta la aprobación.

---

## 🎨 Estilo visual

- **Tipografía:** Poppins (Google Fonts)  
- **Colores:** Azul oscuro (#1f2a44) y tarjetas (#2c3e70)  
- **Diseño:** Tarjetas centradas, formularios anchos, placeholders visibles  
- **Framework:** Bootstrap 5.3.2  

---

## 📥 Uso básico

1. Clonar el repositorio  
2. Importar `usuarios.sql` en MySQL  
3. Configurar la conexión a la base de datos en los archivos de sesión y autenticación  
4. Abrir `index.php` en el navegador para iniciar sesión o registrarse  
5. Los usuarios nuevos deben ser aprobados por el administrador antes de acceder a la aplicación  
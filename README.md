# LoginPHP

## 📌 Descripción

**LoginPHP** es un sistema de autenticación de usuarios desarrollado en **PHP** utilizando **PDO**, con separación clara entre vistas y controladores, diseñado con fines **didácticos**.

El proyecto incorpora medidas de seguridad habituales en aplicaciones web modernas, manteniendo una estructura sencilla y comprensible. Incluye validación de datos, protección de sesión y control de acceso, adaptado para que los usuarios existentes puedan iniciar sesión de manera segura.

---

## 📂 Estructura del proyecto

- **index.php** → Vista de login  
- **autenticacion.php** → Controlador de autenticación  
- **establecer-sesion.php** → Configuración y seguridad de sesiones  
- **inicio.php** → Vista protegida tras login  
- **logout.php** → Cierre de sesión seguro  
- **validaciones.js** → Validaciones en frontend  
- **usuarios.sql** → Script de base de datos  

---

## 🗄️ Base de datos

La base de datos `login-php` contiene la tabla `usuarios` con los siguientes campos:

- **coduser**: identificador único del usuario (clave primaria).  
- **idusuario**: nombre de usuario único.  
- **password**: contraseña almacenada en texto plano (solo para fines didácticos).  
- **nombre** y **apellidos**: datos personales del usuario.  
- **admitido**: campo booleano (siempre 1 en este proyecto, usado como ejemplo para prácticas futuras).

**Usuarios existentes en la base de datos:**
- `Alvaro_MG64`  
- `Zazza_I5`  

---

## ⚙️ Funcionalidades implementadas

### 1. Validación front-end
- Implementada en `validaciones.js`.
- Controla formato y longitud de usuario y contraseña.
- Muestra errores mediante alertas visuales en los formularios.

### 2. Cookies de sesión seguras
- Configuradas en `establecer-sesion.php`.
- Uso de `httponly`, `samesite=Strict` y `path=/`.

### 3. Protección CSRF
- Token generado al iniciar sesión.
- Incluido en todos los formularios.
- Verificado en los controladores de autenticación.

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

---

## 🎨 Estilo visual

- **Tipografía:** Poppins (Google Fonts)  
- **Colores:** Azul oscuro (#1f2a44) para fondo, tarjetas (#2c3e70) para formularios  
- **Diseño:** Tarjetas centradas, formularios anchos, placeholders visibles  
- **Framework:** Bootstrap 5.3.2  

---

## 📥 Uso básico

1. Clonar el repositorio  
2. Importar `usuarios.sql` en MySQL  
3. Configurar la conexión a la base de datos en `establecer-sesion.php` y `autenticacion.php`  
4. Abrir `index.php` en el navegador para iniciar sesión  
5. Todos los usuarios existentes tienen acceso automáticamente; el campo `admitido` es solo de relleno.
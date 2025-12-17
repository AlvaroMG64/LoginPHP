# LoginPHP

## 📌 Descripción

**LoginPHP** es un sistema de autenticación y registro de usuarios desarrollado en **PHP** utilizando **PDO** y siguiendo el patrón **Modelo–Vista–Controlador (MVC)**.

El proyecto incluye medidas de seguridad habituales en aplicaciones web:

- Validaciones en frontend y backend  
- Protección CSRF mediante tokens  
- Cookies de sesión seguras  
- Control de intentos de acceso  
- Registro de usuarios con aprobación por administrador  

Está pensado como **proyecto didáctico**, incorporando buenas prácticas de seguridad y una estructura clara.

---

## 📂 Estructura del proyecto

- **index.php** → Vista de login  
- **autenticacion.php** → Controlador de autenticación  
- **registro.php** → Vista de registro de usuario  
- **procesar-registro.php** → Controlador de registro  
- **establecer-sesion.php** → Configuración y seguridad de sesiones  
- **inicio.php** → Vista protegida tras login  
- **logout.php** → Cierre de sesión seguro  
- **admin.php** → Vista de gestión de usuarios pendientes (admin)  
- **procesar-admin.php** → Controlador de aprobación/rechazo de usuarios  
- **validaciones.js** → Validaciones frontend  
- **usuarios.sql** → Script de base de datos  
- **README.md** → Documentación del proyecto  

---

## 🗄️ Base de datos

La base de datos contiene una tabla `usuarios` con los siguientes campos:

- **coduser** → Identificador único del usuario (clave primaria)  
- **idusuario** → Nombre de usuario (único)  
- **password** → Contraseña del usuario (en producción usar hash seguro)  
- **nombre, apellidos** → Datos personales del usuario  
- **admitido** → Indica si el usuario está aprobado por el administrador  

**Reglas de estado:**  
- Usuarios existentes: admitidos = TRUE  
- Nuevos registros: admitidos = FALSE (pendientes de aprobación)  

---

## ⚙️ Funcionalidades

1. **Validación front-end**  
   - Comprobaciones de usuario y contraseña mediante JavaScript  
   - Mensajes de error mostrados con alertas Bootstrap  

2. **Cookies de sesión seguras**  
   - Configuración con `httponly`, `samesite=Strict` y `path=/`  
   - Expiran automáticamente tras 1 hora  

3. **Token CSRF**  
   - Generado al iniciar sesión  
   - Incluido en formularios y comprobado en los controladores  

4. **Cierre de sesión seguro**  
   - Destrucción completa de la sesión  
   - Eliminación explícita de la cookie  

5. **Parámetros php.ini**  
   - Revisión de valores relacionados con sesiones y cookies  

6. **Regeneración de sesión**  
   - ID de sesión regenerado cada 20 minutos  
   - Límite máximo de sesión: 2 horas  

7. **Control de intentos de acceso**  
   - Limitado a 5 intentos por sesión  
   - Bloqueo temporal tras superar el límite  

8. **Registro de usuario**  
   - Validación de datos y comprobación de existencia  
   - Inserción con estado pendiente de aprobación  

9. **Aprobación de usuarios por administrador**  
   - Listado de usuarios pendientes  
   - Opción de aprobar o rechazar  
   - Acceso restringido hasta la aprobación  

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
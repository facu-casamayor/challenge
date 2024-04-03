**Descripción del Proyecto: Sistema de Gestión de Gifs**

El Sistema de Gestión de Gifs es una plataforma desarrollada utilizando PHP 8.2 y el framework Laravel versión 10, con MySQL como base de datos. El objetivo principal de este sistema es proporcionar una interfaz API para gestionar y buscar gifs de la plataforma GIPHY.

**Funcionalidades Principales:**

Registro de Usuarios (register): Permite a los usuarios registrarse en la plataforma proporcionando información básica como email y contraseña.

Inicio de Sesión (login): Los usuarios pueden iniciar sesión en la plataforma utilizando sus credenciales. Al autenticarse correctamente, se genera un token de acceso que será utilizado para autorizar las solicitudes a las APIs restantes. La duración de este token es de 30 minutos.

Búsqueda de Gifs por Término (search): Esta API permite a los usuarios buscar gifs utilizando un término específico. Se integra con la API de GIPHY para recuperar información sobre gifs relacionados con el término de búsqueda proporcionado. Se puede limitar la devolución de los datos y un offset.

Guardado de Gifs (save): Los usuarios autenticados pueden guardar gifs seleccionados en su cuenta para acceder posteriormente. Proporcionando el id del gif y el usuario al cuál desea guardar dicho gif. 

Búsqueda de Gifs por Identificador (searchById): Permite a los usuarios buscar un gif específico utilizando su identificador único. Esto facilita la recuperación rápida de gifs guardados previamente.

**Integración con GIPHY API:**

El sistema integra dos APIs de GIPHY para enriquecer la experiencia del usuario:

Búsqueda de Gifs por Término: Utiliza la API de GIPHY para recuperar gifs relacionados con el término de búsqueda proporcionado por el usuario.

Búsqueda de Detalles de Gifs por String: Esta funcionalidad permite al usuario obtener información detallada sobre los gifs utilizando un string específico.

**Autenticación y Autorización:**

El sistema utiliza un sistema de autenticación basado en tokens JWT (JSON Web Tokens). Al iniciar sesión, se genera un token de acceso que tiene una duración de 30 minutos. Este token debe ser incluido en las solicitudes a las APIs protegidas para autorizarlas. En el caso de utilizar el link debajo, automaticamente en cada inicio de sesión coloca el token a cada API que precisa dicho token.

Persistencia de Datos:

La información de los usuarios registrados, los gifs guardados y otros datos relevantes se almacenan en una base de datos MySQL, lo que garantiza la persistencia de los datos y la capacidad de escalar el sistema según sea necesario.

En resumen, el Sistema de Gestión de Gifs proporciona una plataforma robusta y fácil de usar para buscar, guardar y gestionar gifs, aprovechando la potencia de Laravel y la API de GIPHY para ofrecer una experiencia de usuario fluida y atractiva.



Colección POSTMAN: https://www.postman.com/warped-escape-32979/workspace/public-workspace/collection/24365255-ea3d5557-18c2-4e18-9ec3-6d58bab23f2d?action=share&creator=24365255

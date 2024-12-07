<p align="center"><a href="#" target="_blank"><img src="resources/img/Logo.jpg" width="150" alt="Logo Asociación Mutual El Paraíso"></a></p>

<h1 align="center">Asociación Mutual El Paraíso</h1>

<p align="center">
Gestión de aportantes, beneficiarios, y desembolsos.
</p>

---

## Descripción

Este proyecto es una aplicación web para gestionar la afiliación de aportantes, beneficiarios, registro de fallecidos, y desembolsos. Está construido con el framework **Laravel** y diseñado para facilitar el manejo de registros y procesos de facturación.

---

## Requisitos

Antes de comenzar, asegúrate de tener instalado lo siguiente:

- **PHP**: ^8.1  
- **Composer**: ^2.0  
- **MySQL**: ^5.7 o ^8.0  
- **Node.js**: ^16.x  
- **NPM/Yarn**: Última versión  
- **Servidor Web**: Apache o Nginx

---

## Instalación

Sigue estos pasos para clonar y configurar el proyecto:

1. **Clonar el repositorio**:
   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd <NOMBRE_DEL_PROYECTO>

1. **dependecias**:
   composer install
   npm install


2. **configuraciones**
   **Copiar en el archivo de entorno:** cp .env.example .env
   **Configurar el archivo .env**
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=amep
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña

3. **Generar la clave de aplicación:**
   php artisan key:generate

4. **Ejecutar migraciones y seeders:**
    php artisan migrate --seed


5. **Compilar recursos de frontend:**
   npm run dev

6. **Uso:**
    Admin:
    Usuario: admin
    Contraseña: admin

    Secretaria:
    Usuario: secretaria
    Contraseña: secretaria


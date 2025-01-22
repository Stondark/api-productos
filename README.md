
# Bienvenidos

Los requisitos para correr este proyecto son:
- Composer > 2.6
- PHP > 8.2
- Laravel > 11.#
## Deployment


- Clona el repositorio
```bash
  https://github.com/Stondark/api-productos.git
```

- Abre el archivo .env y configura las credenciales de la base de datos
```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=api-productos
    DB_USERNAME=root
    DB_PASSWORD=
```

- Abre la terminal de tu sistema y accede a la ruta de donde guardaste el repositorio
```bash
  cd C:...
```

- Instala las librerías
```bash
    composer install 
```

- Ejecuta el comando
```bash
    php artisan serve
```
Esto levantará el servidor en http://127.0.0.1:8000 (por defecto).

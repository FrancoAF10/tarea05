## 🚀 PASOS PARA INICIAR EL PROYECTO

1. **Clonar el repositorio** dentro de la carpeta `laragon/www` en caso de uso de laragon, si se usa XAMPP seria dentro de la carpeta `xampp/htdocs` hacemos click derecho y seleccionamos git bash here donde ingresaremos el siguiente comando:  
   ```
   git clone <url del repositorio>
   ```
2. **Instalar dependencias con Composer**

- Ubicarse dentro del proyecto con el comando:

```
cd <nombre_del_proyecto>
```
- Instalar dependencias:

```
composer install
```
3. Configurar el archivo **.env** + **Database**
- En este archivo se deben colocar todos los datos necesarios para la conexión a la base de datos:
```
CI_ENVIRONMENT = development

database.default.hostname =
database.default.database =
database.default.username =
database.default.password =
database.default.DBDriver =
database.default.port =

```
4. Generar las carpetas de escritura
Debido a que la carpeta writable/ está en .gitignore, debemos asegurarnos de tener las carpetas necesarias ejecutando:
```
mkdir -p writable/cache writable/logs writable/session writable/uploads writable/debugbar
```
5. Vista del Proyecto
- Al haber realizado todos los pasos anteriores, procedemos a darle al boton de **Iniciar Todo** en el caso de laragon, en el caso de XAMPP start a MySQL y Apache.
- Ingresamos la ruta de nuestro proyecto 'http://tarea05.test/reporte/filtro' en nuestro navegador.
- Para poder hacer uso del conversor html2pdf instalamos la libreria con el siguiente comando en la terminal dentro de nuestro proyecto
```
composer require spipu/html2pdf
```
- Por ultimo, adjuntamos link de las tareas realizadas en clase 'https://github.com/FrancoAF10/superhero.git'.
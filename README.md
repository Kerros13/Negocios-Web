# SimplePHPMvcOOP

## Instalación
* Clonar repositorio en una carpeta en htdos o www segun el servidor web
* Instalar composer [https://getcomposer.org]
* Instalar las dependencias en la misma carpeta donde esta composer.json
    ``` php composer.phar install ```
    ``` composer install ```
* Copiar el archivo ```renameTo_parameters.env``` a ```parameters.env``` y actualizar los valores segun sus parámetros
* En un navegar ir al proyecto con ```index.php?page=index```
* Para generar 
## Pasos

1. Crear en ```src>Controllers``` dos archivos de ```Entidad.control.php``` extendiento la clase de ```PublicController```

2. Crear en la carpeta ```src>Views``` dos archivos de
```Entidad.view.tpl```

3. Crear en la carpeta ```src>Dao``` un archivo ```Entidad.class.php``` que extienda la clase ```Table.class.php``` donde elaborará la manipulación de la tabla.

# Ranking de encrypta2 — Meet cryptocurrencies

Este proyecto consiste en una base de datos de puntuaciones con ranking en pantalla desarrollado específicamente para los talleres Meet cryptocurrencies de encrypta2, un grupo de estudiantes de la Facultad de Informática de la Universidad Complutense de Madrid.

Destacar que se hizo rápidamente y sin posibilidad de hacerlo de una forma más eficiente. Así, se priorizó la apariencia gráfica en concordancia con la imagen del taller y la robustez en las vistas públicas. Por tanto, no se incluyó, tampoco, acceso privado a la vista de administración.

Las páginas de registro de usuario y de ranking utilizan llamadas AJAX al servidor para obtener o enviar un estado. Además, se usa una base de datos MySQL y una modificación en el servidor de Apache para ocultar las extensiones `.php`.

## Instalación

1. Ubicar los archivos en el directorio correspondiente del servidor.
2. Editar el archivo `sys/main.php` para adaptar las configuraciones de MySQL y de información.
3. Crear las tablas en la base de datos mediante las siguientes operaciones:

```mysql
CREATE TABLE `e2mcspa_contestants` (
  `id` int(16) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(512) NOT NULL,
  `score` double NOT NULL,
  `registration_date` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `e2mcspa_contestants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `e2mcspa_contestants`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;
```

## Uso básico

Las direcciones de acceso y uso de la aplicación son las siguientes:

* `./` - Inicio, no hay nada, pide la URL directa.
* `./entrar` - Vista de participante, permite a cada participante registrar su nombre y no hacer nada más.
* `./landing` - Página que deberá proyectarse desde la apertura de puertas para que los usuarios vean la URL y se registren.
* `./ranking` - Vista de ranking, en la que aparece una lista ordenada de los participantes y sus puntuaciones, se actualiza cada 4 segundos vía AJAX.
* `./manage` - Vista de administrador, muestra una lista de participantes con sus puntuaciones y permite editar estas y eliminar participantes, se actualiza manualmente cada vez que se recarga la página (cuidado con no reenviar datos) o se modifica un participante.
* `./encuesta` - Redirecciona a algún enlace.

## Demostración

Durante la realización de los talleres, alojamos la aplicación en [encrypta2.ml](https://encrypta2.ml).

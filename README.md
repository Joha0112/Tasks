# Lista-de-tareas.

Pasos de instalación:
1) Ingresar a la página oficial de XAMPP para descargar el entorno de desarrollo de PHP, MariaDB y Perl:  https://www.apachefriends.org/index.html
2) En la página de inicio, encontrarás enlaces para descargar XAMPP para diferentes sistemas operativos, como Windows, macOS y Linux. Elige el que corresponda a tu sistema y sigue las instrucciones de instalación proporcionadas en la página.
3) Luego de hacer la debida instalación de XAMPP, se procede  a abrir el entorno de XAMMP  y se conecta a apache y MySQL, desde ahi mismo se ingresa al admin o directamente a está dirección: http://localhost/phpmyadmin para administrar la base de datos que se va utilizar en el proyecto.
4) Una vez se ingresa a la interfaz de phpMyAdmin, se procede a crear la base de datos en la opción que dice nueva que se encuentra a lado izquierdo, ahi se elige una opción llamada SQL, para proceder a crear la base de datos usando esté query sql:
5) CREATE DATABASE tareas;
USE tareas;

CREATE TABLE `tareas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tareas` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
 
INSERT INTO `tareas` (`tareas`) VALUES 
('Tarea 1'),
('Tarea 2'),
('Tarea 3');

ALTER TABLE nombre_de_tu_tabla AUTO_INCREMENT = 1;
6) con los pasos anteriores y la creación de la base de datos se puede proceder al proyecto que está bien documentado cada linea. 

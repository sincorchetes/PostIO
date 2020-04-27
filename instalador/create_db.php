<?php
/*
 * create_db.php
 * 
 * Copyright 2014 Álvaro Castillo <sincorchetes@fedoraproject.org>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

 include("../codificacion.php");

if (isset($_POST['server']) && !empty($_POST['server']) && 
isset ($_POST['user']) && !empty($_POST['user']) &&
isset ($_POST['passwd']) && !empty($_POST['passwd']) &&
isset ($_POST['dbname']) && !empty($_POST['dbname']))
	{
$con=mysql_connect($_POST['server'],$_POST['user'],$_POST['passwd']) or die ("Connection problems");
mysql_query("CREATE SCHEMA IF NOT EXISTS $_POST[dbname] DEFAULT CHARACTER SET utf8;") or die ("Problemas al crear la DB");
mysql_query("USE $_POST[dbname];") or die ("Problemas al cambiar de DB");
mysql_query("CREATE TABLE IF NOT EXISTS $_POST[dbname].usuario (
  id INT NOT NULL AUTO_INCREMENT,
  nick VARCHAR(45) NOT NULL,
  passwd VARCHAR(255) NOT NULL,
  nombre VARCHAR(45) NOT NULL,
  apellidos VARCHAR(45) NOT NULL,
  fecha_nac VARCHAR(45) NOT NULL,
  nacionalidad VARCHAR(45) NOT NULL,
  email VARCHAR(45) NOT NULL,
  url VARCHAR(45) NOT NULL,
  sobre MEDIUMTEXT NOT NULL,
  PRIMARY KEY (id))
ENGINE = InnoDB;") or die ("Problemas al crear la tabla usuario");

mysql_query("CREATE TABLE IF NOT EXISTS $_POST[dbname].rol (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(45) NOT NULL,
  descripcion VARCHAR(45) NOT NULL,
  estado VARCHAR(45) NOT NULL,
  fecha_nuevo TIMESTAMP NOT NULL,
  fecha_mod TIMESTAMP NULL,
  fecha_baja TIMESTAMP NULL,
  fecha_alta TIMESTAMP NULL,
  PRIMARY KEY (id))
ENGINE = InnoDB;") or die ("Problemas al crear tabla rol");

mysql_query("CREATE TABLE IF NOT EXISTS $_POST[dbname].blog (
  id INT NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(100) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  palabra_clave VARCHAR(45) NOT NULL,
  fecha_creacion TIMESTAMP NOT NULL,
  fecha_mod TIMESTAMP NULL,
  enlace VARCHAR(255) NOT NULL,
  PRIMARY KEY (id))
ENGINE = InnoDB;") or die ("Problemas al crear la tabla blog");

mysql_query("CREATE TABLE IF NOT EXISTS $_POST[dbname].categoria (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(30) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  estado VARCHAR(12) NOT NULL,
  fecha_creacion TIMESTAMP NOT NULL,
  fecha_baja TIMESTAMP NULL,
  fecha_edicion TIMESTAMP NULL,
  fecha_alta TIMESTAMP NULL,
  PRIMARY KEY (id))
ENGINE = InnoDB;") or die ("Problemas al crear la tabla categoría");

mysql_query("CREATE TABLE IF NOT EXISTS $_POST[dbname].articulo (
  id INT NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(45) NOT NULL,
  texto TEXT NOT NULL,
  palabra_clave VARCHAR(45) NOT NULL,
  estado VARCHAR(20) NOT NULL,
  fecha_publicacion TIMESTAMP NOT NULL,
  fecha_edicion TIMESTAMP NULL,
  fecha_baja TIMESTAMP NULL,
  usuario_id INT NOT NULL,
  blog_id INT NOT NULL,
  categoria_id INT NOT NULL,
  PRIMARY KEY (id, usuario_id, blog_id, categoria_id),
  INDEX fk_articulo_usuario1_idx (usuario_id ASC),
  INDEX fk_articulo_blog1_idx (blog_id ASC),
  INDEX fk_articulo_categoria1_idx (categoria_id ASC),
  CONSTRAINT fk_articulo_usuario1
    FOREIGN KEY (usuario_id)
    REFERENCES $_POST[dbname].usuario (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_articulo_blog1
    FOREIGN KEY (blog_id)
    REFERENCES $_POST[dbname].blog (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_articulo_categoria1
    FOREIGN KEY (categoria_id)
    REFERENCES $_POST[dbname].categoria (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;") or die ("Problemas al crear la tabla artículo");

mysql_query("CREATE TABLE IF NOT EXISTS $_POST[dbname].comentario (
  id INT NOT NULL AUTO_INCREMENT,
  autor VARCHAR(45) NOT NULL,
  email VARCHAR(45) NOT NULL,
  url VARCHAR(50) NOT NULL,
  texto VARCHAR(200) NOT NULL,
  estado VARCHAR(15) NOT NULL,
  fecha_publicacion TIMESTAMP NOT NULL,
  fecha_edicion TIMESTAMP NULL,
  fecha_baja TIMESTAMP NULL,
  articulo_id INT NOT NULL,
  PRIMARY KEY (id, articulo_id),
  INDEX fk_comentario_articulo1_idx (articulo_id ASC),
  CONSTRAINT fk_comentario_articulo1
    FOREIGN KEY (articulo_id)
    REFERENCES $_POST[dbname].articulo (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;") or die ("Problema al crear la tabla comentario");

mysql_query("CREATE TABLE IF NOT EXISTS $_POST[dbname].usuario_tiene_rol (
  usuario_id INT NOT NULL,
  rol_id INT NOT NULL,
  estado VARCHAR(45) NOT NULL,
  fecha_alta TIMESTAMP NULL,
  fecha_baja TIMESTAMP NULL,
  fecha_mod TIMESTAMP NULL,
  fecha_registro TIMESTAMP NOT NULL,
  PRIMARY KEY (usuario_id, rol_id),
  INDEX fk_usuario_tiene_rol_rol1_idx (rol_id ASC),
  INDEX fk_usuario_tiene_rol_usuario_idx (usuario_id ASC),
  CONSTRAINT fk_usuario_tiene_rol_usuario
    FOREIGN KEY (usuario_id)
    REFERENCES $_POST[dbname].usuario (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_usuario_tiene_rol_rol1
    FOREIGN KEY (rol_id)
    REFERENCES $_POST[dbname].rol (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;") or die ("Problema al crear la tabla usuario_tiene_rol");

 echo "<head><link rel='stylesheet' href='../style.php'></head>";


		echo "<div class='setup-admin'><h1>¡Base de datos creada con éxito!</h1>";
		echo "<p>Antes de proceder con la instalación, copiaremos la siguiente información en un fichero llamado conexion.php
		El cuál tendrá los permisos 644 en el directorio principal.</p>";
		echo "<textarea>
<?php
/*
 * conexion.php
 * 
 * Copyright 2014 Álvaro Castillo <netSys@fedoraproject.org>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
\$db_server = '$_REQUEST[server]';
\$db_user = '$_REQUEST[user]';
\$db_pass = '$_REQUEST[passwd]';
\$db_database = '$_REQUEST[dbname]';

\$conexion=mysql_connect(\$db_server, \$db_user, \$db_pass) or die ('Problemas al conectar con el servidor');
mysql_select_db(\$db_database, \$conexion) or die ('Problemas al escoger la base de datos');
?>
</textarea>";

echo "<p>Después puede continuar la instalación haciendo clic <a href='setup_blog.php'>aquí</a></p>";
	echo "</div>";
	
}
else{
	echo "<div class='op_ex'><h1>¡Ha ocurrido un error!</h1>";
	echo "<p>No sé han introducido todos los campos.</p>";
	echo "</div>";
}
?>

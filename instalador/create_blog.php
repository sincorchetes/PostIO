<?php
/*
 * create_blog.php
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
include("../conexion.php");

if (isset($_POST['blog_title']) && !empty($_POST['blog_title']) && 
isset ($_POST['blog_desc']) && !empty($_POST['blog_desc']) &&
isset ($_POST['blog_link']) && !empty($_POST['blog_link']) &&
isset ($_POST['blog_keyword']) && !empty($_POST['blog_keyword']))
	{
		if (($_POST['d_ex']) == 'NO'){
			$passwd=md5('admin')."rtWEqwDASdd213";
		
		mysql_query("INSERT INTO usuario (nick, passwd) VALUES ('admin','$passwd');") or die ("Problema creando el administrador");
		
		mysql_query("INSERT INTO rol (id,nombre,descripcion,estado,fecha_nuevo,fecha_alta) 
			VALUES(1,'Deshabilitado','Para otras futuras funciones','Desactivado',NOW(),NOW());") or die ("Problema al crear el primer rol");
		
		mysql_query("INSERT INTO rol (id,nombre,descripcion,estado,fecha_nuevo,fecha_alta) 
			VALUES(2,'Editor','Persona que redacta articulos.','Activado',NOW(),NOW());") or die ("Problema al crear el segundo rol");
		
		mysql_query("INSERT INTO rol (id,nombre,descripcion,estado,fecha_nuevo,fecha_alta) 
			VALUES(3,'Moderador','Encargado/a de hacer cumplir las guidelines del blog.','Activado',NOW(),NOW());") or die ("Problema al crear el tercer rol");
			
		mysql_query("INSERT INTO rol (id,nombre,descripcion,estado,fecha_nuevo,fecha_alta) 
			VALUES(4,'Administrador','Responsable de todo el sitio.','Activado',NOW(),NOW());") or die ("Problema al crear el último rol");
			
		mysql_query("INSERT INTO usuario_tiene_rol (usuario_id,rol_id,estado,fecha_alta,fecha_registro) 
			VALUES(1,4,'Activado',NOW(),NOW());") or die ("Problemas al insertar el admin");
			
		mysql_query("INSERT INTO blog (titulo, descripcion, enlace, palabra_clave,fecha_creacion) 
		VALUES ('$_POST[blog_title]','$_POST[blog_desc]','$_POST[blog_link]','$_POST[blog_keyword]',NOW());") or die ("Problemas al insertar datos del blog");
		
		
		 echo "<head><link rel='stylesheet' href='../style.php'></head>";
		echo "<div class='op_ex'><h1>¡Operación realizada con éxito!</h1>";
	echo "<p>En unos segundos te rediregiremos a la página principal de su nuevo blog!</p>
	<p>No se olvide de eliminar el directorio /instalador/ para evitar problemas de seguridad.</p>";
	header('Refresh:5 ; URL=../index.php');
	echo "</div>";
}elseif (($_POST['d_ex']) == 'YES'){
	$passwd=md5('admin')."rtWEqwDASdd213";
	
			mysql_query("INSERT INTO usuario (nick, passwd) VALUES ('admin','$passwd');") or die ("Problema creando el administrador");
		
		mysql_query("INSERT INTO rol (id,nombre,descripcion,estado,fecha_nuevo,fecha_alta) 
			VALUES(1,'Deshabilitado','Para otras futuras funciones','Desactivado',NOW(),NOW());") or die ("Problema al crear el primer rol");
		
		mysql_query("INSERT INTO rol (id,nombre,descripcion,estado,fecha_nuevo,fecha_alta) 
			VALUES(2,'Editor','Persona que redacta articulos.','Activado',NOW(),NOW());") or die ("Problema al crear el segundo rol");
		
		mysql_query("INSERT INTO rol (id,nombre,descripcion,estado,fecha_nuevo,fecha_alta) 
			VALUES(3,'Moderador','Encargado/a de hacer cumplir las guidelines del blog.','Activado',NOW(),NOW());") or die ("Problema al crear el tercer rol");
			
		mysql_query("INSERT INTO rol (id,nombre,descripcion,estado,fecha_nuevo,fecha_alta) 
			VALUES(4,'Administrador','Responsable de todo el sitio.','Activado',NOW(),NOW());") or die ("Problema al crear el último rol");
			
		mysql_query("INSERT INTO usuario_tiene_rol (usuario_id,rol_id,estado,fecha_alta,fecha_registro) 
			VALUES(1,4,'Activado',NOW(),NOW());") or die ("Problemas al insertar el admin");
			
		mysql_query("INSERT INTO blog (titulo, descripcion, enlace, palabra_clave,fecha_creacion) 
		VALUES ('$_POST[blog_title]','$_POST[blog_desc]','$_POST[blog_link]','$_POST[blog_keyword]',NOW());") or die ("Problemas al insertar datos del blog");
		
		// Creating users
		
		mysql_query("INSERT INTO usuario (id, nick, passwd, nombre, apellidos, fecha_nac, nacionalidad, email, url, sobre) VALUES (NULL, 'Fedora', 'e11c718b99e26b1ca8b45f2df455c70brtWEqwDASdd213', 'Fedora', 'Project', '12/08/2009', 'Internacional', 'fedoraproject@localhost', 'http://www.fedoraproject.org', 'Fedora Project :-)');") or die ("Problema al crear el usuario Fedora");
		mysql_query("INSERT INTO usuario (id, nick, passwd, nombre, apellidos, fecha_nac, nacionalidad, email, url, sobre) VALUES (NULL, 'RHEL', 'ddc4fc0e95c69dce8ab0d84d131b00ebrtWEqwDASdd213', 'RHEL', '6', '12/12/2020', 'Internacional', 'redhat@localhost', 'http://www.redhat.com', 'Red Hat Inc 8-)');") or die ("Problema al crear el usuario RHEL");
		mysql_query("INSERT INTO usuario (id, nick, passwd, nombre, apellidos, fecha_nac, nacionalidad, email, url, sobre) VALUES (NULL, 'CentOS', 'cdc872db616ac66adb3166c75e9ad183rtWEqwDASdd213', 'CentOS', '6', '10/12/2030', 'Internacional', 'centos@localhost', 'http://www.centos.org', 'CentOS ;-)');") or die ("Problema al crear el usuario CentOS");
		mysql_query("INSERT INTO usuario (id, nick, passwd, nombre, apellidos, fecha_nac, nacionalidad, email, url, sobre) VALUES (NULL, 'openSUSE', '30f4f2f599735c36b84b8f3ad0eef3e2rtWEqwDASdd213', 'openSUSE', '13.1', '02/09/2030', 'Internacional', 'opensuse@localhost', 'http://www.opensuse.org', 'openSUSE ;-|');") or die ("Problema al crear el usuario openSUSE");
		mysql_query("INSERT INTO usuario (id, nick, passwd, nombre, apellidos, fecha_nac, nacionalidad, email, url, sobre) VALUES (NULL, 'Korora', '1f9d03785ee6a5a5e0dd6cf54df6dd47rtWEqwDASdd213', 'Korora', '20', '02/10/2230', 'Internacional', 'korora@localhost', 'http://www.korora.org', 'Korora :-%');") or die ("Problema al crear el usuario Korora");

		// Creating usersXrols statement
		
		mysql_query("INSERT INTO usuario_tiene_rol (usuario_id,rol_id,estado,fecha_registro) VALUES(2,4,'Activado',NOW());") or die ("Problema al registrar Fedora + rol");
		mysql_query("INSERT INTO usuario_tiene_rol (usuario_id,rol_id,estado,fecha_registro) VALUES(3,2,'Desactivado',NOW());") or die ("Problema al registrar RHEL + rol");
		mysql_query("INSERT INTO usuario_tiene_rol (usuario_id,rol_id,estado,fecha_registro) VALUES(4,2,'Activado',NOW());") or die ("Problema al registrar CentOS + rol");
		mysql_query("INSERT INTO usuario_tiene_rol (usuario_id,rol_id,estado,fecha_registro) VALUES(5,3,'Activado',NOW());") or die ("Problema al registrar openSUSE + rol");
		mysql_query("INSERT INTO usuario_tiene_rol (usuario_id,rol_id,estado,fecha_registro) VALUES(6,3,'Desactivado',NOW());") or die ("Problema al registrar Korora + rol");

		// Creating categories
		
		mysql_query("INSERT INTO categoria (id, nombre, descripcion, estado, fecha_creacion, fecha_baja, fecha_edicion, fecha_alta) VALUES (NULL, 'Sistemas Operativos', 'Hablamos de sistemas operativos, ¿Que crees?', 'Activada', NOW(), NULL, NULL, NULL);") or die ("Problema al crear primera categoría");
		mysql_query("INSERT INTO categoria (id, nombre, descripcion, estado, fecha_creacion, fecha_baja, fecha_edicion, fecha_alta) VALUES (NULL, 'Networking', 'Redes, no. No de pesca, redes de computacion', 'Activada', NOW(), NULL, NULL, NULL);") or die ("Problema al crear segunda categoría");
		mysql_query("INSERT INTO categoria (id, nombre, descripcion, estado, fecha_creacion, fecha_baja, fecha_edicion, fecha_alta) VALUES (NULL, 'Base de datos', 'Desde una hoja hasta un centro de datos, todo es valido aqui', 'Activada', NOW(), NULL, NULL, NULL);") or die ("Problema al crear tercera categoría");
		mysql_query("INSERT INTO categoria (id, nombre, descripcion, estado, fecha_creacion, fecha_baja, fecha_edicion, fecha_alta) VALUES (NULL, 'Seguridad', 'Más divertido cuanta menos tengas es.', 'Desactivada', NOW(), NULL, NULL, NULL);") or die ("Problema al crear cuarta categoría");

		// Creating articles
		
		mysql_query("INSERT INTO articulo (id, titulo, texto, palabra_clave, estado, fecha_publicacion, fecha_edicion, fecha_baja, usuario_id, blog_id, categoria_id) VALUES (NULL, '¿Por que Lorem  Ipsum?', 'Es un hecho establecido hace demasiado tiempo que un lector se distraera con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribucion mas o menos normal de las letras, al contrario de usar textos como por ejemplo Contenido aqui, contenido aqui. Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedicion y editores de paginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una busqueda de Lorem Ipsum va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a traves de los años, algunas veces por accidente, otras veces a proposito (por ejemplo insertandole humor y cosas por el estilo).', 'lorem,ipsum', 'Publicado', CURRENT_TIMESTAMP, NULL, NULL, '3', '1', '3');") or die ("Problema al crear primer articulo");
		mysql_query("INSERT INTO articulo (id, titulo, texto, palabra_clave, estado, fecha_publicacion, fecha_edicion, fecha_baja, usuario_id, blog_id, categoria_id) VALUES (NULL, 'Why Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'lorem,ipsum,english', 'Publicado', CURRENT_TIMESTAMP, NULL, NULL, '5', '1', '2');") or die ("Problema al crear segundo articulo");
		mysql_query("INSERT INTO articulo (id, titulo, texto, palabra_clave, estado, fecha_publicacion, fecha_edicion, fecha_baja, usuario_id, blog_id, categoria_id) VALUES (NULL, 'xXXx', 'Disabled', 'lorem,ipsum,dis', 'Desactivado', CURRENT_TIMESTAMP, NULL, NULL, '5', '1', '2');") or die ("Problema al crear tercer articulo");
		
		// Creating comments
		
		mysql_query("INSERT INTO comentario (id, autor, email, url, texto, estado, fecha_publicacion, fecha_edicion, fecha_baja, articulo_id) VALUES (NULL, 'Anonymous', 'anon@ciz.ch', 'http://www.google.es', 'Esto me parece muy bonito.', 'Publicado', CURRENT_TIMESTAMP, NULL, NULL, '1');") or die ("Problema al crear primer comentario");
		mysql_query("INSERT INTO comentario (id, autor, email, url, texto, estado, fecha_publicacion, fecha_edicion, fecha_baja, articulo_id) VALUES (NULL, 'Anon', 'dock@ciz.ch', 'http://www.anonymouse.org', 'Parece bueno.', 'Publicado', CURRENT_TIMESTAMP, NULL, NULL, '2');") or die ("Problema al crear tercer articulo");
		
		echo "<head><link rel='stylesheet' href='../style.php'></head>";
		echo "<div class='op_ex'><h1>¡Operación realizada con éxito!</h1>";
	echo "<p>En unos segundos te rediregiremos a la página principal de su nuevo blog!</p>
	<p>No se olvide de eliminar el directorio /instalador/ para evitar problemas de seguridad.</p>";
	header('Refresh:5 ; URL=../index.php');
	echo "</div>";
}


}else {
	echo "<head><link rel='stylesheet' href='../style.php'></head>";
	echo "<div class='op_ex'><h1>¡Algo ha ido mal!</h1>";
	echo "<p>Posiblemente haya introducido mal los datos</p>";
	echo "</div>";
	header('Refresh:3 ; URL=setup_blog.php');
}

?>

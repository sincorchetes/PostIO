<?php

/*
 * registrando.php
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
 
 
include("../conexion.php");
include("../codificacion.php");
include("../info.php");
echo "<head><link rel='stylesheet' href='../style.php'></head>";
session_start();

 if ($_SESSION['rol'] == 4){

if (isset ($_POST['nick']) && !empty($_POST['nick']) && 
isset ($_POST['passwd']) && !empty($_POST['passwd']) &&
isset ($_POST['nombre']) && !empty($_POST['nombre']) &&
isset ($_POST['apellidos']) && !empty($_POST['apellidos']) &&
isset ($_POST['fecha_nac']) && !empty($_POST['fecha_nac']) &&
isset ($_POST['nacionalidad']) && !empty($_POST['nacionalidad']) &&
isset ($_POST['email']) && !empty($_POST['email']) &&
isset ($_POST['url']) && !empty($_POST['url']) &&
isset ($_POST['sobre']) && !empty($_POST['sobre']) &&
isset ($_POST['rol']) && !empty($_POST['rol']) &&
isset ($_POST['estado']) && !empty($_POST['estado']))
{
	//~ @$archivo=$_FILES['archivo']['tmp_name'];
	//~ @$nombre=$_FILES['archivo']['name'];
	//~ $directorio="../PostIO/imagenes/perfiles/";
	//~ $archivo_subir=$directorio.$nombre;
	$password=md5($_POST[passwd])."rtWEqwDASdd213";
		mysql_query("INSERT INTO usuario (nick,passwd,nombre,apellidos,fecha_nac,nacionalidad,email,url,sobre) 
	VALUES('$_POST[nick]',
	'$password',
	'$_POST[nombre]',
	'$_POST[apellidos]',
	'$_POST[fecha_nac]',
	'$_POST[nacionalidad]',
	'$_POST[email]',
	'$_POST[url]',
	'$_POST[sobre]');") or die ("Primera insercción de datos mal");
	
	$registro_usuario=mysql_query("SELECT * FROM usuario,rol WHERE nick='$_POST[nick]';") or die ("Consulta mal hecha");
	
	$id_nick=mysql_fetch_array($registro_usuario);
	
	
	mysql_query("INSERT INTO usuario_tiene_rol (usuario_id,rol_id,estado,fecha_registro) VALUES($id_nick[0],$_POST[rol],'$_POST[estado]',NOW());") or die ("Consulta 3 mal");
		   echo "<div class='op_ex'><h1>¡Operación realizada con éxito!</h1>";
	echo "<p>En unos segundos te rediregiremos a la página principal</p>";
	echo "</div>";
	header('Refresh:3 ; URL=../index.php');

}else{
	echo "<div class='op_ex'><h1>¡Ha ocurrido un error!</h1>";
	echo "<p>No sé han introducido todos los campos.</p>";
	echo "</div>";
}
}else{
	@$_SESSION['rol']='';
	header('Location:../error404.php');
}
?>

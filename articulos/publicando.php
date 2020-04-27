<?php

/*
 * publicando.php
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
 
include("../conexion.php");
include("../codificacion.php");
include("../info.php");
echo "<head><link rel='stylesheet' href='../style.php'></head>";

session_start();
if (($_SESSION['rol'] == 2) OR ($_SESSION['rol'] == 4)){

if (isset($_POST['titulo']) && !empty($_POST['titulo']) && 
isset ($_POST['texto']) && !empty($_POST['texto']) &&
isset ($_POST['palabra_clave']) && !empty($_POST['palabra_clave']) &&
isset ($_POST['estado']) && !empty($_POST['estado']) &&
isset ($_POST['categoria_id']) && !empty($_POST['categoria_id']))

{
	mysql_query("INSERT INTO articulo (titulo,texto,palabra_clave,estado,fecha_publicacion,usuario_id,blog_id,categoria_id) 
	VALUES('$_POST[titulo]',
	'$_POST[texto]',
	'$_POST[palabra_clave]',
	'$_POST[estado]',
	NOW(),
	$_SESSION[id_nick],
	$_POST[blog_id],
	$_POST[categoria_id]);") or die ("Primera insercción de datos mal");
	
   echo "<div class='op_ex'><h1>¡Operación realizada con éxito!</h1>";
	echo "<p>En unos segundos te rediregiremos a la página principal</p>";
	echo "</div>";
	header('Refresh:3 ; URL=index.php');

}else{
		echo "<div class='op_ex'><h1>¡Ha ocurrido un error!</h1>";
	echo "<p>No sé han introducido todos los campos.</p>";
	echo "</div>";
}
}else{
	@$_SESSION['rol']='';
	header('Location:../error404.php');
}
//~ header('Location: index.php');
?>


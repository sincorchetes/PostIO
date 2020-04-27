<?php
/*
 * alta_comentario.php
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
session_start();
echo "<head><link rel='stylesheet' href='../style.php'></head>";
$id_article=$_REQUEST['id'];

if (isset ($_POST['autor']) && !empty($_POST['autor']) && 
isset ($_POST['email']) && !empty($_POST['email']) &&
isset ($_POST['url']) && !empty($_POST['url']) &&
isset ($_POST['texto']) && !empty($_POST['texto']))
{
		mysql_query("INSERT INTO comentario (autor,email,url,texto,estado,fecha_publicacion,articulo_id) VALUES('$_POST[autor]',
		'$_POST[email]',
		'$_POST[url]',
		'$_POST[texto]',
		'Publicado',
		NOW(),
		$id_article);") or die ("Primera insercción de datos mal");
	
	   echo "<div class='op_ex'><h1>¡Operación realizada con éxito!</h1>";
	echo "<p>En unos segundos te rediregiremos a la página principal</p>";
	echo "</div>";
	header('Refresh:3 ; URL=../index.php');

}
else {
	@$_SESSION['rol']='';
	header('Location:../error404.php');
}
?>


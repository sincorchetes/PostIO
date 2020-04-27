<?php

/*
 * baja.php
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
if ($_SESSION['rol'] == 4) {
	
$id=$_REQUEST['id'];
$proceso=mysql_query("UPDATE usuario_tiene_rol SET estado='Desactivado',fecha_baja=NOW() WHERE usuario_id='$id';") or die ("No se ha hecho nada");

	echo "<div class='op_ex'><h1>¡Operación realizada con éxito!</h1>";
	echo "<p>En unos segundos te rediregiremos a la página principal</p>";
	echo "</div>";
	header('Refresh:3 ; URL=index.php');
	
}else{
	@$_SESSION['rol']='';
		header('Location:../error404.php');
}
?>

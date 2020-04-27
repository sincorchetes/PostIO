<?php

/*
 * logueando.php
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
 
include("conexion.php");
include("codificacion.php");
echo "<head><link rel='stylesheet' href='style.php'></head>";
session_start();

if (isset($_POST['nick']) && !empty($_POST['nick']) && 
isset ($_POST['passwd']) && !empty($_POST['passwd']))
	{ 
		$consulta1=mysql_query("SELECT id FROM usuario WHERE nick='$_POST[nick]';");
		$celda=mysql_fetch_array($consulta1);
		$password=md5($_POST['passwd'])."rtWEqwDASdd213";
		$consulta2=mysql_query("SELECT * FROM usuario,usuario_tiene_rol WHERE usuario.id=$celda[0] AND usuario.passwd='$password' AND usuario.id=usuario_tiene_rol.usuario_id AND usuario_tiene_rol.estado='Activado'");
		$x=mysql_fetch_array($consulta2);
		
		
		if (($password == $x[2])) {
			if (($x[12] == "Activado"))
			{
				$_SESSION['nick'] = $x[1];
			$_SESSION['id_nick'] = $x[0];
			$_SESSION['rol'] = $x[11];
			
	echo "<div class='op_ex'><h1>¡Operación realizada con éxito!</h1>";
	echo "<p>En unos segundos te rediregiremos a la página principal</p>";
	echo "</div>";
	header('Refresh:3 ; URL=index.php');
	
		}else
		{	
		}
	}else{
	echo "<div class='op_ex'><h1>¡Ha ocurrido un error!</h1>";
				echo "<p>Puede que su cuenta haya sido desactivada o simplemente no se encuentre registrado.</p>";
				echo "</div>";
				header('Refresh:3 ; URL=index.php');
}
		
}else{
	echo "<div class='op_ex'><h1>¡Ha ocurrido un error!</h1>";
	echo "<p>No sé han introducido todos los campos.</p>";
	echo "</div>";
	header('Refresh:3 ; URL=index.php');
}
?>

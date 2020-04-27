<?php
/*
 * index.php
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
 echo "<head><link rel='stylesheet' href='../style.php'></head>";

 echo "<head>
			<title>¡Bienvenido al instalador de PostIO!</title></head>";
			
echo "<div id='main'>
	<div id='setup-container'>
	<h1>¡Bienvenido al instalador de PostIO!</h1>
	<h2>Gracias por descargar este pequeño CMS destinado para entornos blog.</h2>
	<br/>";
	echo "<form>";?>
		<input type="button" onclick="location.href='license.php' " value="Comencemos!" name="boton" />
	<?php
	echo "</form>";
	echo "</div></div>";

	?>

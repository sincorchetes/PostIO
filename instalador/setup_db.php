<?php
/*
 * setup_db.php
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
			
			echo "<body>
			<div id='main'>
			<div id='setup-container'>

<body>
	<form action='create_db.php' method='post'>
		<h1>Valores del servidor</h1>
		<p>Servidor:</p><input type='text' name='server' value='' />
		<p>Usuario:</p><input type='text' name='user' value='' />
		<p>Contraseña:</p><input type='password' name='passwd' value='' />
		<p>Nombre de la base de datos:</p><input type='text' name='dbname' value='postio' />
		<p><input type='submit' value='Continuar' /></p>
	</form>
	</div>
</div>
</body>

</html>";
?>

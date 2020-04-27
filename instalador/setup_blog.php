<?php
/*
 * setup_blog.php
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
				echo "<head>
 <!-- Place inside the <head> of your HTML -->
<script type='text/javascript' src='../tinymce/tinymce.min.js'></script>
<script type='text/javascript'>
tinymce.init({
	plugins: 'wordcount link',
	width : 600,
	height : 150,
    selector: 'textarea'
 });
</script></head>";
			echo "<body>
			<div id='main'>
			<div id='setup-container'>";
echo "<body>
	<h1>Ya queda poco para finarlizar la instalación</h1>
		<div class='setup-admin2'>
			<h2>Una vez finalizada la instalación...</h2>
			<p>El usuario y la contraseña que se van a crear son exactamente iguales. Por favor cámbielas para evitar desastres.</p>
			<p>Usuario: admin</p>
			<p>Contraseña: admin</p>";
			
		echo "</div>
	<form action='create_blog.php' method='post'>
		<p>Título del blog:</p><input type='text' name='blog_title' value='' />
		<p>Descripción:</p><textarea name='blog_desc' value=''></textarea>
		<p>Añade unos cuántos enlaces:</p><textarea name='blog_link'></textarea>
		<p>Palabras clave:</p><input type='text' name='blog_keyword' value='' />
		<p>Instalar datos ejemplo:</p><select name='d_ex'>
		<option value='YES'>Sí</option>
		<option value='NO'>No</option>
		</select>
		<br/><br/><input type='submit' value='Continuar' />
	</form>
</body>
</div>
</div>";
 
?>

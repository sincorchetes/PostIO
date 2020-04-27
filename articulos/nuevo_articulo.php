<?php

/*
 * nuevo_articulo.php
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
 
include("../conexion.php");		 //Añadimos la "librería" de conexión que incluyen los datos del servidor, usuario...;
include("../codificacion.php");	//Añadimos la codificación UTF-8 para visualizar los caracteres mejor;
include("../info.php");

echo "<head><link rel='stylesheet' href='../style.php'></head>";

session_start();

$consulta=mysql_query("SELECT * FROM usuario,articulo WHERE usuario.id=articulo.usuario_id AND articulo.estado='Publicado' ORDER BY articulo.fecha_publicacion DESC LIMIT 0,10;");
$consulta2=mysql_query("SELECT * FROM blog");
$blog_data=mysql_fetch_array($consulta2);

echo "<html>
		<body>";	
		
		echo "<div id='main'>";
			
			echo "<div id='menu'>";
				
				echo "<div id='socialmedia'>";
					echo "<h2>¡Síguenos!<hr/ id='hr'></h2>
					<a href='mailto:#@#.#'><img width='40px' src='../imagenes/icons/email.png'></a>
							<a href='http://index.php#'><img width='40px' src='../imagenes/icons/facebook.png' ></a>
							<a href='http://index.php#'><img width='40px' src='../imagenes/icons/g+.png'></a>
							<a href='http://index.php#'><img width='40px' src='../imagenes/icons/twitter.png'></a>";
				
				echo "</div>";
			
				echo "<div id='search'>";
					echo "<h2>Busca en este blog<hr/></h2>";
					echo "<form action='../search.php' method='post'><input type='text' name='search'>
							<input type='image' width='15px' src='../imagenes/icons/find.png'>
						</form>";
				
				echo "</div>";
					
				echo "<div id='m_link'>";
					$get_link=mysql_query("SELECT enlace FROM blog;");
					$gl=mysql_fetch_array($get_link);
					echo "<h2>Enlaces<hr/></h2>";
					echo "<a href='../index.php'>Inicio</a></a><br/><br/>";
					if (($_SESSION['rol'] == 4) OR ($_SESSION['rol'] == 3) OR ($_SESSION['rol'] == 2)){
						echo "<a href='../usuarios/profile_edit.php'>Editar mi perfil </a>";
					}else{}
					echo $gl[0];
				echo "</div>";
				
				echo "<div id='login'>";
				
				if (($_SESSION['rol'] == 4) OR ($_SESSION['rol'] == 3) OR ($_SESSION['rol'] == 2)){
							if (($_SESSION['rol'] == 4)){
								echo "<h2>Administración</h2><hr/>";
								
								echo "<a href='../articulos'>Artículos</a><br/>";
								echo "<a href='../articulos/nuevo_articulo.php'>· Nuevo artículo</a><br/>";
								echo "<a href='../categorias'>Categorías</a><br/>";
								echo "<a href='../categorias/nueva_categoria.php'>· Crear</a><br/>";
								echo "<a href='../comentarios'>Comentarios</a><br/>";
								echo "<a href='../admin'>Configuración</a><br/>";
								echo "<a href='../roles'>Roles</a><br/>";
								echo "<a href='../usuarios'>Usuarios</a><br/>";
								echo "<a href='../usuarios/registrar.php'>· Registrar</a><br/>";
								echo "<a href='../logout.php'>Cerrar sesión</a>";
								
							}elseif (($_SESSION['rol'] == 3)){
								echo "<h2>Gestión</h2><hr/>";
								
								echo "<a href='../articulos'>Artículos</a><br/>";
								echo "<a href='../articulos/nuevo_articulo.php'>· Nuevo artículo</a><br/>";
								echo "<a href='../categorias'>Categorías</a><br/>";
								echo "<a href='../comentarios'>Comentarios</a><br/>";
								echo "<a href='../usuarios'>Usuarios</a><br/>";
								echo "<a href='../logout.php'>Cerrar sesión</a>";
								
							}elseif (($_SESSION['rol'] == 2)){
								echo "<h2>Edición</h2><hr/>";
								
								echo "<a href='../articulos'>Artículos</a><br/>";
								echo "<a href='../articulos/nuevo_articulo.php'>· Nuevo artículo</a><br/>";								
								echo "<a href='../categorias'>Categorías</a><br/>";
								echo "<a href='../comentarios'>Comentarios</a><br/>";
								echo "<a href='../logout.php'>Cerrar sesión</a>";
							}else{}
							
				}else{
					echo "<h2>Login</h2><hr/>";
					echo "<form action='../logueando.php' method='post'>";

					echo "<p>Nombre:</p><input type='text' name='nick'></p>";
					echo "<p>Contraseña:</p><input type='password' name='passwd'>"."<br/>"."<br/>"."<br/>";
					echo "\n<input type='submit' value='Iniciar sesión'>";

				echo "</form>";
			}
				echo "</div>";
				
				echo "<div id='categories'>";
					echo "<h2>Categorías</h2><hr/>";
					$get_categories=mysql_query("SELECT * FROM categoria WHERE estado='Activada';");
					while($gcat=mysql_fetch_array($get_categories)){
						echo "<a href='../cat.php?id=$gcat[0]'>$gcat[1]</a><br/><br/>"; 
						}
				echo "</div>";
				
				echo "<div id='recent_post'>";
			
				echo "<h2>Artículos recientes</h2><hr/>";
	
				$get_recent_posts=mysql_query("SELECT * FROM articulo,categoria WHERE articulo.estado='Publicado' AND articulo.categoria_id=categoria.id AND categoria.estado='Activada' ORDER BY articulo.fecha_publicacion DESC LIMIT 0,4;");
			while($grp=mysql_fetch_array($get_recent_posts)){
			echo "<a href='../show.php?id=$grp[0]'>$grp[1]</a><br/><br/>";
		}
				echo "</div>";
				
				
			echo "</div>";
			
			echo "<div id='post'>";

if (($_SESSION['rol'] == 2) OR ($_SESSION['rol'] == 4) OR ($_SESSION['rol'] == 3)){
	echo "<head>
 <!-- Place inside the <head> of your HTML -->
<script type='text/javascript' src='../tinymce/tinymce.min.js'></script>
<script type='text/javascript'>
tinymce.init({
	plugins: 'wordcount link',
    selector: 'textarea',
        width : 700,
	height : 250
 });
</script></head>";

	$categoria=mysql_query("SELECT * FROM categoria");

echo "<h1>Redacte su nuevo artículo</h1>";

echo "<form action='publicando.php' method='post'>
			<p>Título: <br/><br/><input type='text' name='titulo'></p>
			<p>Componer:<br/></p><textarea name='texto'></textarea>
			<p>Palabras clave:</p><input type='text' name='palabra_clave'>
			<input type='hidden' name='estado' value='Publicado'><br/>
			<input type='hidden' name='blog_id' value='1'>
			<p>Selecciona la categoría:</p><select name='categoria_id'>";
			
			while($celda=mysql_fetch_array($categoria)){
				echo "<option value='$celda[0]'>$celda[1]</option>";
			}
			echo "</select><br/>
			<br/><input type='submit' value='Publicar'>
			<input type='reset' value='Borrar todo'>
		</form>";

				echo "</div>";
				
				echo "<div id='author'>";
				echo "Desarrollado por <a href='http://www.netSysblog.info' >Álvaro Castillo</a><hr/ width='100px'><br/>";
				echo "Este proyecto se encuentra bajo los términos de la licencia GPLv2.";
			echo "</div>";
		echo "</div>";
		echo "</body>
		</html>";	
}else{
	@$_SESSION['rol']='';
	header('Location:../error404.php');
}
?>



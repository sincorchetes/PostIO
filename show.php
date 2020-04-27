<?php
/*
 * show.php
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

include("codificacion.php");
include("conexion.php");
include("info.php");

$id_article=$_REQUEST['id'];
session_start();

$query=mysql_query("SELECT * FROM articulo,usuario,comentario,categoria WHERE articulo.id=$id_article AND articulo.estado='Publicado' AND articulo.usuario_id=usuario.id AND comentario.estado='Publicado' AND articulo.categoria_id=categoria.id AND categoria.estado='Activada';");
//SELECT * FROM articulo,usuario,comentario,categoria WHERE articulo.id=$id_article AND articulo.estado='Publicado' AND articulo.usuario_id=usuario.id AND comentario.estado='Publicado' AND articulo.categoria_id=categoria.id AND comentario.articulo_id=articulo.id"

$row=mysql_fetch_array($query);

echo "<head><link rel='stylesheet' href='style.php'></head>";
	echo "<body>
		<div id='main'>";
			echo "<div id='menu'>";
				
				echo "<div id='socialmedia'>";
					echo "<h2>¡Síguenos!<hr/ id='hr'></h2>
					<a href='mailto:#@#.#'><img width='40px' src='imagenes/icons/email.png'></a>
							<a href='http://index.php#'><img width='40px' src='imagenes/icons/facebook.png' ></a>
							<a href='http://index.php#'><img width='40px' src='imagenes/icons/g+.png'></a>
							<a href='http://index.php#'><img width='40px' src='imagenes/icons/twitter.png'></a>";
				
				echo "</div>";
			
				echo "<div id='search'>";
					echo "<h2>Busca en este blog<hr/></h2>";
					echo "<form action='search.php' method='post'><input type='text' name='search'>
							<input type='image' width='15px' src='imagenes/icons/find.png'>
						</form>";
				
				echo "</div>";
					
				echo "<div id='m_link'>";
					$get_link=mysql_query("SELECT enlace FROM blog;");
					$gl=mysql_fetch_array($get_link);
					echo "<h2>Enlaces<hr/></h2>";
					echo "<a href='index.php'>Inicio</a></a><br/><br/>";
					if (($_SESSION['rol'] == 4) OR ($_SESSION['rol'] == 3) OR ($_SESSION['rol'] == 2)){
						echo "<a href='usuarios/profile_edit.php'>Editar mi perfil </a>";
					}else{}
					echo $gl[0];
				echo "</div>";
				
				echo "<div id='login'>";
				
				if (($_SESSION['rol'] == 4) OR ($_SESSION['rol'] == 3) OR ($_SESSION['rol'] == 2)){
							if (($_SESSION['rol'] == 4)){
								echo "<h2>Administración</h2><hr/>";
								
								echo "<a href='articulos'>Artículos</a><br/>";
								echo "<a href='articulos/nuevo_articulo.php'>· Nuevo artículo</a><br/>";
								echo "<a href='categorias'>Categorías</a><br/>";
								echo "<a href='categorias/nueva_categoria.php'>· Crear</a><br/>";
								echo "<a href='comentarios'>Comentarios</a><br/>";
								echo "<a href='admin'>Configuración</a><br/>";
								echo "<a href='roles'>Roles</a><br/>";
								echo "<a href='usuarios'>Usuarios</a><br/>";
								echo "<a href='usuarios/registro.php'>· Registrar</a><br/>";
								echo "<a href='logout.php'>Cerrar sesión</a>";
								
							}elseif (($_SESSION['rol'] == 3)){
								echo "<h2>Gestión</h2><hr/>";
								
								echo "<a href='articulos'>Artículos</a><br/>";
								echo "<a href='articulos/nuevo_articulo.php'>· Nuevo artículo</a><br/>";
								echo "<a href='categorias'>Categorías</a><br/>";
								echo "<a href='comentarios'>Comentarios</a><br/>";
								echo "<a href='usuarios'>Usuarios</a><br/>";
								echo "<a href='logout.php'>Cerrar sesión</a>";
								
							}elseif (($_SESSION['rol'] == 2)){
								echo "<h2>Edición</h2><hr/>";
								
								echo "<a href='articulos'>Artículos</a><br/>";
								echo "<a href='articulos/nuevo_articulo.php'>· Nuevo artículo</a><br/>";								
								echo "<a href='categorias'>Categorías</a><br/>";
								echo "<a href='comentarios'>Comentarios</a><br/>";
								echo "<a href='logout.php'>Cerrar sesión</a>";
							}else{}
							
				}else{
					echo "<h2>Login</h2><hr/>";
					echo "<form action='logueando.php' method='post'>";

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
						echo "<a href='cat.php?id=$gcat[0]'>$gcat[1]</a><br/><br/>"; 
						}
				echo "</div>";
				
				echo "<div id='recent_post'>";
			
				echo "<h2>Artículos recientes</h2><hr/>";
	
				$get_recent_posts=mysql_query("SELECT * FROM articulo,categoria WHERE articulo.estado='Publicado' AND articulo.categoria_id=categoria.id AND categoria.estado='Activada' ORDER BY articulo.fecha_publicacion DESC LIMIT 0,4;");
			while($grp=mysql_fetch_array($get_recent_posts)){
			echo "<a href='show.php?id=$grp[0]'>$grp[1]</a><br/><br/>";
		}
				echo "</div>";
				
				
			echo "</div>";
			
			echo "<div id='post'>";
			
			echo "<h2>".$row[1]."</h2>"."<br/>$row[2]<br/>
			<p>Palabra Clave\n:$row[3]</p><p>Redactado por:\n<a href='usuarios/profile.php?id=$row[11]'>$row[12]</a><br/>
			Fecha de Publicación:\n".substr($row[5],8,2)."-".substr($row[5],5,2)."-".substr($row[5],0,4); echo"</p>";
			echo "<p>Categoría: $row[33]</p>";
			echo"<h2>Comentarios</h2><br/>";
			$query2=mysql_query("SELECT * FROM comentario,articulo WHERE articulo.id=$id_article AND comentario.articulo_id=articulo.id AND comentario.estado='Publicado' ;");
			while($comentarios=mysql_fetch_array($query2)){
			
			echo "Nombre:\n$comentarios[1]</br>
			URL, blog:\n <a target='_blank' href='$comentarios[3]'>$comentarios[3]</a></br>
			Fecha:\n".substr($comentarios[6],8,2)."-".substr($comentarios[6],5,2)."-".substr($comentarios[6],0,4).
			"<br>Hora:\n".substr($comentarios[6],10,3)."-".substr($comentarios[6],14,3)."-".substr($comentarios[6],17,3).
			"<br>Opinión:\n$comentarios[4]</br><br>";
		}
		echo "<h1>Nuevo comentario</h1>";

if (($_SESSION['rol'] == 4) OR ($_SESSION['rol'] == 3) OR ($_SESSION['rol'] == 2)){
	$query3=mysql_query("SELECT * FROM usuario WHERE id=$_SESSION[id_nick];");
	$a=mysql_fetch_array($query3);
	
	echo "<form action='comentarios/alta_comentario.php' method='post'>
			<input type='hidden' name='id' value='$id_article'>
			<p>Nombre:</p>$a[1]<input type='hidden' name='autor' value='$a[1]' >
			<p>E-mail:</p>$a[7]<input type='hidden' name='email' value='$a[7]'>
			<p>URL, blog:</p>$a[8]<input type='hidden' name='url' value='$a[8]'>
			<p>Comentar:</p><textarea name='texto'></textarea><br/><br/>
			<br/><input type='submit' value='Comentar'>
			<input type='reset' value='Borrar todo'>
		</form>";
	}else{
		@$_SESSION['rol']='';
		echo "<form action='comentarios/alta_comentario.php' method='post'>
			<input type='hidden' name='id' value='$id_article'>
			<p>Nombre:</p><input type='text' name='autor'>
			<p>E-mail:</p><input type='text' name='email'>
			<p>URL, blog:</p><input type='text' name='url'>
			<p>Comentar:</p><textarea name='texto'></textarea><br/>
			<br/><input type='submit' value='Comentar'>
			<input type='reset' value='Borrar todo'>
		</form>";
	}
				echo "</div>";
			echo "<div id='author'>";
				echo "Desarrollado por <a href='http://www.netSysblog.info' >Álvaro Castillo</a><hr/ width='100px'><br/>";
				echo "Este proyecto se encuentra bajo los términos de la licencia GPLv2.";
			echo "</div>";
		echo "</div>";


?>

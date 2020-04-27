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
 
include("../conexion.php");
include("../codificacion.php");
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
								echo "<a href='../usuarios/registro.php'>· Registrar</a><br/>";
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
					echo "<h1>Artículos</h1>";
if (($_SESSION['rol'] == 3) OR ($_SESSION['rol'] == 4)){


		echo "<table>
			<tr>
				<td>Título</td>
				<td>Texto</td>
				<td>Autor</td>
				<td>Estado</td>
				<td>Fecha Publicación</td>
				<td>Fecha última edición</td>
				<td>Fecha de baja</td>
				<td>Modificar</td>
				<td>Alta</td>
				<td>Baja</td>
			</tr>";
$registros=mysql_query("SELECT * FROM articulo,usuario WHERE articulo.usuario_id=usuario.id");
while($articulo=mysql_fetch_array($registros))
{
	echo "<tr>
				<td>$articulo[1]</td>
				<td>".substr($articulo[2],0,120)."..."."</td>
				<td>$articulo[12]</td> 
				<td>$articulo[4]</td>
				<td>".substr($articulo[5],11,8)."<br/>".substr($articulo[5],8,2)."-".substr($articulo[5],5,2)."-".substr($articulo[5],0,4)."</td>
				<td>".substr($articulo[6],11,8)."<br/>".substr($articulo[6],8,2)."-".substr($articulo[6],5,2)."-".substr($articulo[6],0,4)."</td>
				<td>".substr($articulo[7],11,8)."<br/>".substr($articulo[7],8,2)."-".substr($articulo[7],5,2)."-".substr($articulo[7],0,4)."</td>
				<td><a href='modificar.php?id=$articulo[0]&&titulo=$articulo[1]&&
				texto=$articulo[2]&&palabra_clave=$articulo[3]&&estado=$articulo[4]&&autor=$articulo[12]'><input type='image' width='15px' src='../imagenes/icons/edit.png'></a></td>
				<td><a href='alta.php?id=$articulo[0]&&titulo=$articulo[1]&&texto=$articulo[2]&&palabra_clave=$articulo[3]
				&&estado=$articulo[4]&&autor=$articulo[12]'><input type='image' width='15px' src='../imagenes/icons/ok.png'></a></td>
				<td><a href='baja.php?id=$articulo[0]&&titulo=$articulo[1]&&texto=$articulo[2]&&palabra_clave=$articulo[3]
				&&estado=$articulo[4]&&autor=$articulo[12]'><input type='image' width='15px' src='../imagenes/icons/remove.png'></a></td>
			</tr>";
}
echo "</table>";

}elseif ($_SESSION['rol'] == 2){

echo "<table>
			<tr>
				<td>Título</td>
				<td>Texto</td>
				<td>Palabras Clave</td>
				<td>Autor</td>
				<td>Estado</td>
				<td>Fecha Publicación</td>
				<td>Fecha última edición</td>
				<td>Fecha de baja</td>
				<td>Modificar</td>
				<td>Alta</td>
				<td>Baja</td>
			</tr>";
$registros=mysql_query("SELECT * FROM articulo,usuario WHERE usuario_id=$_SESSION[id_nick] AND articulo.usuario_id=usuario.id;");
while($articulo=mysql_fetch_array($registros))
{
	echo "<tr>
				<td>$articulo[1]</td>
				<td>".substr($articulo[2],0,120)."..."."</td>
				<td>$articulo[3]</td>
				<td>$articulo[12]</td>
				<td>$articulo[4]</td>
				<td>".substr($articulo[5],11,8)."<br/>".substr($articulo[5],8,2)."-".substr($articulo[5],5,2)."-".substr($articulo[5],0,4)."</td>
				<td>".substr($articulo[6],11,8)."<br/>".substr($articulo[6],8,2)."-".substr($articulo[6],5,2)."-".substr($articulo[6],0,4)."</td>
				<td>".substr($articulo[7],11,8)."<br/>".substr($articulo[7],8,2)."-".substr($articulo[7],5,2)."-".substr($articulo[7],0,4)."</td>
				<td><a href='modificar.php?id=$articulo[0]&&titulo=$articulo[1]&&
				texto=$articulo[2]&&palabra_clave=$articulo[3]&&estado=$articulo[4]&&autor=$b[1]'><input type='image' width='15px' src='../imagenes/icons/edit.png'></a></td>
				<td><a href='alta.php?id=$articulo[0]&&titulo=$articulo[1]&&texto=$articulo[2]&&palabra_clave=$articulo[3]
				&&estado=$articulo[4]&&autor=$b[1]'><input type='image' width='15px' src='../imagenes/icons/ok.png'></a></td>
				<td><a href='baja.php?id=$articulo[0]&&titulo=$articulo[1]&&texto=$articulo[2]&&palabra_clave=$articulo[3]
				&&estado=$articulo[4]&&autor=$b[1]'><input type='image' width='15px' src='../imagenes/icons/remove.png'></a></td>
			</tr>";
}
echo "</table>";

				echo "</div>";
				
				echo "<div id='author'>";
				echo "Desarrollado por <a href='http://www.sincorchetesblog.info' >Álvaro Castillo</a><hr/ width='100px'><br/>";
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

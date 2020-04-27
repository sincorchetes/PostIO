<?php
/*
 * error404.php
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
echo "<head><link rel='stylesheet' href='style.php'></head>";
echo "<div class='op_ex'><h1>Error 404</h1>";
echo "Esta página no existe."."<br/>";
echo "En unos segundos será redirigido hacia la página principal.";
echo "</div>";
header('Refresh:3 ; URL=index.php');

?>

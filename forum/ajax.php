<?php
/*
 * ajax.php
 * 
 * Copyright 2014 Jim <jim@noideersoftware.co.uk>
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
 if (isset($_GET['doc']))
 {
 $doc = $_GET['doc']; // get the file to open
header("Cache-Control: no-cache must-revalidate"); // set headers
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  // set headers
echo $doc;
echo "<br>file contents = <br>"; 
 @readfile($doc);

//echo $printout;
}
else {
	echo "bad construct";
}
?>
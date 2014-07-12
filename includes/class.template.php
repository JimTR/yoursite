<?php
/*
 * class.template.php
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

class Template {

   public $template;

   function load($filepath) {

      $this->template = file_get_contents($filepath);

   }

   function replace($var, $content) {

      $this->template = str_replace("#$var#", $content, $this->template);

   }

   function publish() {
			//echo "test";
			//echo $this->template;
			//die();
     		eval("?>".$this->template."<?");

   }
   
   function removephp() {
	   // remove php if required
	   do {
		   
	   $start = stripos($this->template, "<?");// tag start
	   if ($start <>0){
	   $end = stripos($this->template, "?>");// tag end
	   $chr = $end-$start;
	   $getrid= substr($this->template, $start, $chr+2);// full string to replace
	   $this->template = str_replace($getrid,"",$this->template);
   }
	   	}
	    while ($start >0);  
	
   }

	function listv ($file,$group) {
		/* return template with the vars in place 
		 *use $vars as the variable list
		 * each var populated or left blank if the var has no value
		 * source being the html file
		 */ 
		  include "lang/".$file;
		 $lang->usercp = &$l;
		 //print_r ($lang); 
		 //echo $lang->usercp['redirect_avatarupdated'];
		 //die ("<br>we are here");
		 foreach ($lang->usercp as $k => $v) {
			$this->template = str_replace("#$k#", $v, $this->template);
	}
 
	} // end of list v
	// add class function here 
}

?>


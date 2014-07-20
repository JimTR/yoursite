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
		// replaces a single variable
      $this->template = str_replace("#$var#", $content, $this->template);

   }

   function publish() {
			
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

	function listv ($file) {
		/* return template with the vars in place from a lang file
		  *use $file as the variable list in php array format
		 * each var populated or left blank if the var has no value
		 * 
		 */ 
		  include $file;
		 $lang->group = &$l;
		
		 foreach ($lang->group as $k => $v) {
			$this->template = str_replace("#$k#", $v, $this->template);
	}
 
	} 
	
		function get_template() {
		/* returns a template main use is for sub templates
		 * this function must be called AFTER the variables have been replaced
		 */ 
		$sub_template = $this->template ;
		return $sub_template;
	}  
	
	function replace_vars($vars) {
		/* replace vars as an array
		 * supply an array
		 * you should have defined the template with the template->load function
		 * simular to listv but uses an array rather than a file
		 */
		 foreach ($vars as $k => $v) {
			 $this->template = str_replace("#$k#", $v, $this->template);
		 } 
	 }
}

?>


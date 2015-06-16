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

   function load($filepath, $set = true) {
      //$die ("set = ".$set); 
      $filecontents = file_get_contents($filepath);
      $file_name = basename($filepath);
      if ($set == 1 ) 
             {$this->template = add_comments ($file_name,$filecontents);}
      else 
          {$this->template = $filecontents;}
      return $this->template; 
   }

   function replace($var, $content) {
		// replaces a single variable
		// perhaps use <!--name--> rather than #name# ?
      $this->template = str_replace("#$var#", $content, $this->template);

   }

   function publish() {
			
     		eval("?>".$this->template."<?");

   }
   
   function removephp() {
	   // remove php if required
	   // early disable plugin code
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
		/* returns a template, main use is for sub templates
		 * this function must be called AFTER the sub template variables have been replaced.
		 * and before the major template is published or had it variables replaced
		 * it used to add repetitive data (in a sub template) to a major template
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
	function code_hook($hook_name) {
		/* run plugin code
		* spool through the plugins looking for the hook 
		* then add the code as an include in html
		* code_hook should be called before remove_php
		 or should this be in a pre parse in another class ?
		 * plugin hook now defined as #plugin_$hook_name#
		 * then run it from function $hook_name_run
		 */   
	}
	
	function add_comments ($template_name,$filecontents) {
		// adds comments to the begining and end of each template
		// this does sort of point at each template should have a unique name 
		// so it can be debuged for html errors, perhaps add the module name so templates can have the same name but appear in a different module ? 
		$filecontents =  "<!-- start ".$template_name." -->".$filecontents ."<!-- end ".$template_name." -->";
		return $filecontents;
	}  
	
	function remove_comments() {
		// remove all file comments
			//echo "hit it";
			//die("hit do");	
		do {
			$start = stripos($this->template, "<!--");
			
				 if ($start <> 0) {
					$end = stripos($this->template, "-->");// tag end
					$chr = $end-$start;
					$getrid= substr($this->template, $start, $chr+3);// full string to replace
					$this->template = str_replace($getrid,"",$this->template);
				}
		}
		while ($start > 0);
	}
?>


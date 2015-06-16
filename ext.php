<?php
require 'includes/master.inc.php'; // do login and stuff
printr(get_loaded_extensions());
echo "<br> server setup <br>";
printr ($_SERVER);
phpinfo();
?>

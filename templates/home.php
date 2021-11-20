<?php 
require 'class/SideBar.php';
$sidebar = new SideBar();

echo $sidebar->begin();

?>
<?php
echo $sidebar->end();
?>
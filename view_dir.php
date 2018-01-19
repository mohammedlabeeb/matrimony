<?php
$dir    = getcwd();
$files1 = scandir($dir);
echo '<pre>'; print_r($files1); echo '</pre>';
?>
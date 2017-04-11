<?php
header('Content-Type: text/xml');
echo '<? xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
echo '<response>';
 $sessid=session_regenerate_id();
 echo $sessid;
echo '</response>'; 
?>
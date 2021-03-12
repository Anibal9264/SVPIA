<?php
 session_start();
 $_SESSION['Logeado']=FALSE;
 header ("Location: index.php");
exit;


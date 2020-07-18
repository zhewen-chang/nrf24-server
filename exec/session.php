<?php
ob_start();
session_start();

if(isset($_SESSION['valid'])&&$_SESSION['valid']=='true')
    echo "true";
else
    echo "false";
?>
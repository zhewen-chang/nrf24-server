<?php
ob_start();
session_start();

if(isset($_SESSION['user'])&&$_SESSION['user']=='dclab')
    echo "true";
else
    echo "false";
?>
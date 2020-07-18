<?php
ob_start();
session_start();

unset($_SESSION['valid']);
header("Location:/index.html");
?>
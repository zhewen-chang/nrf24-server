<?php
$id = $_POST['id'];
$level = $_POST['level'];
$config = json_decode(file_get_contents("/var/www/html/config.json"));
$mysqli = new mysqli($config->db_host, $config->db_name, $config->db_password, $config->db_table);
$sql="UPDATE `customer` SET `level`='$level' WHERE `id`=$id";
$stmt=$mysqli->prepare($sql);
$stmt->execute();
$stmt->close();
$mysqli->close();
?>
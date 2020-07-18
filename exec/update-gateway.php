<?php
$config = json_decode(file_get_contents("/var/www/html/config.json"));
$mysqli = new mysqli($config->db_host, $config->db_name, $config->db_password, $config->db_table);
if(isset($_POST['id'])) {
    $id =$_POST['id'];
    $ip=$_POST['ip'];
    $sql="UPDATE `gateway` SET `id`=$id WHERE `ip`='$ip'";
    $stmt=$mysqli->prepare($sql);
    $stmt->execute();
    $stmt->close();
}
else if(isset($_POST['counter'])){
    $counter =$_POST['counter'];
    $ip=$_POST['ip'];
    $sql="UPDATE `gateway` SET `counter`=$counter WHERE `ip`='$ip'";
    $stmt=$mysqli->prepare($sql);
    $stmt->execute();
    $stmt->close();
}
$mysqli->close();
?>
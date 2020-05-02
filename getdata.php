<?php
$data = $_GET["data"];
$date = date("Y-m-d H:i:s");
echo $data;
$log = fopen("log.txt", "a+");
fwrite($log, $date." ".$data."\n");
fclose($log);
?>
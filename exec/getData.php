<?php
    $config = json_decode(file_get_contents("/var/www/html/config.json"));
    $mysqli = new mysqli($config->db_host, $config->db_name, $config->db_password, $config->db_table);
    $sql="SELECT id FROM customer";
    $stmt=$mysqli->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id);
    while($stmt->fetch()){
        $ids[]=$id;
    }

    foreach($ids as $id){
        $date = time();
        $sql="SELECT a.level,b.sign,b.time,c.id ,a.pipe from customer as a left join log as b on a.id=b.id left join gateway as c on b.near_gateway=c.ip WHERE a.id=? order by b.time DESC limit 1";
        $stmt=$mysqli->prepare($sql);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->bind_result($level, $sign,$time,$near_gateway,$pipe);
        $stmt->fetch();
        $misstime=$date-strtotime($time);

        echo "<tr>
                <td>$id</td>
                <td class='level'>$level</td>
                <td class='sign'>$sign</td>
                <td class='miss-time'>$misstime s</td>
                <td>$near_gateway</td>
                <td>$pipe</td>
            </tr>";
        
        $stmt->close();
    }
    $mysqli->close();
?>
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
        $sql="SELECT level, time, sign,near_gateway,pipe FROM log WHERE id =? order by time desc";
        $stmt=$mysqli->prepare($sql);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->bind_result($level,$time,$sign,$near_gateway,$pipe);
        $stmt->fetch();
        $misstime=$date-strtotime($time);
        echo "<tr>
                <td>$id</td>
                <td>$level</td>
                <td class='sign'>$sign</td>
                <td class='miss-time'>$misstime s</td>
                <td>$near_gateway</td>
                <td>$pipe</td>
            </tr>";
        
        $stmt->close();
    }
    $mysqli->close();
?>
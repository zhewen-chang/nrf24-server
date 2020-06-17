<?php
    $config = json_decode(file_get_contents("/var/www/html/config.json"));
    $mysqli = new mysqli($config->db_host, $config->db_name, $config->db_password, $config->db_table);
    $sql="SELECT id, level FROM customer";
    $stmt=$mysqli->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id, $level);
    while($stmt->fetch()){
        $ids[]=$id;
        $levels[]=$level;
    }

    $index=0;
    foreach($ids as $id){
        $date = time();
        $sql="SELECT time, sign,near_gateway,pipe FROM log WHERE id =? order by time desc";
        $stmt=$mysqli->prepare($sql);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->bind_result($time,$sign,$near_gateway,$pipe);
        $stmt->fetch();
        $misstime=$date-strtotime($time);

        echo "<tr>
                <td>$id</td>
                <td class='level'>$levels[$index]</td>
                <td class='sign'>$sign</td>
                <td class='miss-time'>$misstime s</td>
                <td>$near_gateway</td>
                <td>$pipe</td>
            </tr>";
        
        $stmt->close();
        $index++;
    }
    $mysqli->close();
?>
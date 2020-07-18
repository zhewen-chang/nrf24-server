<?php
    $config = json_decode(file_get_contents("/var/www/html/config.json"));
    $mysqli = new mysqli($config->db_host, $config->db_name, $config->db_password, $config->db_table);
    $sql="SELECT * FROM gateway ";
    $stmt=$mysqli->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id,$ip,$counter);
    while($stmt->fetch()){
        echo "<tr>
                <td>$ip</td>
                <td>
                    <input type='number' class='gateway-id' value=$id> 
                </td>
                <td>
                    <label>
                        <input type='checkbox' class='counter'".($counter?"checked":"").">                    
                        <span></span>
                    </label>
                </td>
            </tr>";
        
    }
    $mysqli->close();
?>
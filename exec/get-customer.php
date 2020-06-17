<?php
    $config = json_decode(file_get_contents("/var/www/html/config.json"));
    $mysqli = new mysqli($config->db_host, $config->db_name, $config->db_password, $config->db_table);
    $sql="SELECT * FROM customer";
    $stmt=$mysqli->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id, $level, $pipe);
    while($stmt->fetch()){
        echo "<tr>
                <td class='id'>$id</td>
                <td class='level'>
                    <select >";
        if ($level=='Low') {
            echo "<option value='1' selected>Low</option>";
        } else {
            echo "<option value='1'>Low</option>";
        }
        if ($level=='Mid') {
            echo "<option value='2' selected>Mid</option>";
        } else {
            echo "<option value='2'>Mid</option>";
        }
        if ($level=='High') {
            echo "<option value='3' selected>High</option>";
        } else {
            echo "<option value='3'>High</option>";
        }
        echo "      </select>
                </td>
                <td>$pipe</td>
            </tr>";
        
    }
    $mysqli->close();
?>
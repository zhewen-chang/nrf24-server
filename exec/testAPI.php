<?php
$config = json_decode(file_get_contents("/var/www/html/config.json"));
$res = [];
$mysqli = new mysqli($config->db_host, $config->db_name, $config->db_password, $config->db_table);
$sql="SELECT id FROM customer";
$stmt=$mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($id);
while($stmt->fetch()){
    $ids[]=$id;
}

$res = [];
$res['Upload time'] = date('Y-m-d H:i:s');
$res['Result'] = [];

foreach($ids as $id){
    $date = time();
    $sql="SELECT a.level,b.sign,b.time,c.id from customer as a left join log as b on a.id=b.id left join gateway as c on b.near_gateway=c.ip WHERE a.id=? order by b.time DESC limit 1";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->bind_result($level, $sign,$time,$gateway_id);
    if ($stmt->fetch()) {
        $misstime=$date-strtotime($time);
        if($sign=='Alive')
        {
            if($level=='LOW')
            {
                if($misstime>=30)
                {
                        $resRow = array(
                            "User ID" => $id,
                            "Missing Time" => $misstime,
                            //"Near gateway"=> $gateway_id,
                        );
                }
            }
            else if($level=='MID')
            {
                if($misstime>=50)
                {
                    $resRow = array(
                        "User ID" => $id,
                        "Missing Time" => $misstime,
                        //"Near gateway"=> $gateway_id,
                    
                    );
                }
            }
            else if($level=='HIGH')
            {
                if($misstime>=70)
                {
                    $resRow = array(
                        "User ID" => $id,
                        "Missing Time" => $misstime,
                        //"Near gateway"=> $gateway_id,
                    );
                }
            }
            if (isset($resRow)) {
                $res['Result'][] = $resRow;
                unset($resRow);
            }
        }
    }
    $stmt->close();
}
$mysqli->close();

$res['Count'] = count($res['Result']);

echo json_encode($res, JSON_PRETTY_PRINT);
?>
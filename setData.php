<?php
$data = isset($_GET["data"])? $_GET["data"] : "";
$code = isset( $_GET["code"])?$_GET["code"] : "";
$near_gateway = isset( $_GET["gateway"])?$_GET["gateway"] : "";
if($code=='DCLAB')
{
    $date = date("Y-m-d H:i:s");

    if($data[0]=='L')
        $level="Low";
    else if($data[0]=='M')
        $level="Mid";
    else if($data[0]=='H')
        $level="High";

    $id=substr($data,1,3);
    $id=intval($id);

    if($data[4]=='R')
        register($id,$level,$date,$near_gateway);
    else if($data[4]=='S')
        nrf_sleep($id,$level,$date,$near_gateway);
    else if($data[4]=='W')
        wrakeup($id,$level,$date,$near_gateway);
    else if($data[4]=='A')
        alive($id,$level,$date,$near_gateway);
}

function isregister($id){
    $mysqli=new mysqli('localhost','root','Callum@1996','swimmingpool');

    $sql="SELECT * FROM customer WHERE id =?";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->bind_result($id,$level);

    if($stmt->fetch())
    {
        $flag=true;//already register
    }
    else
        $flag=false;

    $stmt->close();
    $mysqli->close();
    
    return $flag;
}

function issleep($id){
    $mysqli=new mysqli('localhost','root','Callum@1996','swimmingpool');

    $sql="SELECT sign FROM log WHERE id =? order by time desc";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->bind_result($sign);

    if($stmt->fetch())
    {
        if ($sign=='Sleep')
            $flag=true;
        else
            $flag=false;
    }
    else
        $flag=false;

    $stmt->close();
    $mysqli->close();
    
    return $flag;
}

function register($id,$level,$date,$near_gateway)
{
    if(isregister($id)==true)
        return ;
    $mysqli=new mysqli('localhost','root','Callum@1996','swimmingpool');

    $sql="INSERT INTO `customer` (id,level)VALUES(?,?)";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('is',$id,$level);
    $stmt->execute();
    
    $stmt->close();
    $mysqli->close();

    writelog($id,$level,$date,"Register",$near_gateway);

}

function writelog($id,$level,$time,$sign,$near_gateway){

    $mysqli=new mysqli('localhost','root','Callum@1996','swimmingpool');

    $sql="INSERT INTO `log` (id,level,time,sign,near_gateway)VALUES(?,?,?,?,?)";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('issss',$id,$level,$time,$sign,$near_gateway);
    $stmt->execute();
    
    $stmt->close();
    $mysqli->close();

}

function nrf_sleep($id,$level,$date,$near_gateway){
    if(issleep($id)==true)
        return;
    writelog($id,$level,$date,"Sleep",$near_gateway);
}    

function wakeup($id,$level,$date,$near_gateway){
    if(issleep($id)==false)
        return;
    writelog($id,$level,$date,"Wakeup",$near_gateway);
} 

function alive($id,$level,$date,$near_gateway){
    if(issleep($id)==true)
        return;
    writelog($id,$level,$date,"Alive",$near_gateway);
} 

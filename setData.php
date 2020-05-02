<?php
$data = isset($_GET["data"])? $_GET["data"] : "";
$code = isset( $_GET["code"])?$_GET["code"] : "";
$near_gateway = isset( $_GET["gateway"])?$_GET["gateway"] : "";
<<<<<<< HEAD

=======
>>>>>>> 3a56ccdb3b229012a0bfa1e74e91e4d2cc888ceb
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

<<<<<<< HEAD
function isregister($id)
{
    $mysqli=new mysqli('localhost','zhe','DCLAB@zaq1xsw2','swimmingpool');
=======
function isregister($id){
    $mysqli=new mysqli('localhost','root','Callum@1996','swimmingpool');
>>>>>>> 3a56ccdb3b229012a0bfa1e74e91e4d2cc888ceb

    $sql="SELECT * FROM customer WHERE id =?";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->bind_result($id,$level);

    if($stmt->fetch())
    {
<<<<<<< HEAD
        $flag=true; //already register
=======
        $flag=true;//already register
>>>>>>> 3a56ccdb3b229012a0bfa1e74e91e4d2cc888ceb
    }
    else
        $flag=false;

    $stmt->close();
    $mysqli->close();
    
    return $flag;
}

<<<<<<< HEAD
function issleep($id)
{
    $mysqli=new mysqli('localhost','zhe','DCLAB@zaq1xsw2','swimmingpool');
=======
function issleep($id){
    $mysqli=new mysqli('localhost','root','Callum@1996','swimmingpool');
>>>>>>> 3a56ccdb3b229012a0bfa1e74e91e4d2cc888ceb

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
<<<<<<< HEAD
    $mysqli=new mysqli('localhost','zhe','DCLAB@zaq1xsw2','swimmingpool');
=======
    $mysqli=new mysqli('localhost','root','Callum@1996','swimmingpool');
>>>>>>> 3a56ccdb3b229012a0bfa1e74e91e4d2cc888ceb

    $sql="INSERT INTO `customer` (id,level)VALUES(?,?)";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('is',$id,$level);
    $stmt->execute();
    
    $stmt->close();
    $mysqli->close();

    writelog($id,$level,$date,"Register",$near_gateway);
<<<<<<< HEAD
}

function writelog($id,$level,$time,$sign,$near_gateway){
    $mysqli=new mysqli('localhost','zhe','DCLAB@zaq1xsw2','swimmingpool');
=======

}

function writelog($id,$level,$time,$sign,$near_gateway){

    $mysqli=new mysqli('localhost','root','Callum@1996','swimmingpool');
>>>>>>> 3a56ccdb3b229012a0bfa1e74e91e4d2cc888ceb

    $sql="INSERT INTO `log` (id,level,time,sign,near_gateway)VALUES(?,?,?,?,?)";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('issss',$id,$level,$time,$sign,$near_gateway);
    $stmt->execute();
    
    $stmt->close();
    $mysqli->close();
<<<<<<< HEAD
=======

>>>>>>> 3a56ccdb3b229012a0bfa1e74e91e4d2cc888ceb
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

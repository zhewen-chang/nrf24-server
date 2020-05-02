<!doctype html>
<html>
<head>
    <title>Anti-drown system</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><!--when use chineese, need this-->
    <meta name="viewport" content="width=device-width, user-scalable=no" /><!--mobile mode-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> <!--use materialize-->  
    <script src="//cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script><!--javascript library-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script><!--use materialize-->
    <script src="main.js"></script><!--call main.js-->
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header class="center-align">
        <div class="header-inner">
            <h1>Customer Information</h1>
        </div>
    </header>
    <main>
        <div class="main-inner container">
            <div class="card">
                <table class="striped centered">
                    <thead>
                        <tr>
                            <th> ID</th>
                            <th> Level</th>
                            <th> Sign</th>
                            <th> Alive time</th>
                            <th> Near gateway</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
<<<<<<< HEAD
                            $mysqli=new mysqli('localhost','zhe','DCLAB@zaq1xsw2','swimmingpool');
=======
                            $mysqli=new mysqli('localhost','root','Callum@1996','swimmingpool');

>>>>>>> 3a56ccdb3b229012a0bfa1e74e91e4d2cc888ceb
                            $sql="SELECT id FROM customer";
                            $stmt=$mysqli->prepare($sql);
                            $stmt->execute();
                            $stmt->bind_result($id);
                            while($stmt->fetch()){
                                $ids[]=$id;
                            }

                            foreach($ids as $id){
                                $date = time();
                                $sql="SELECT level, time, sign,near_gateway FROM log WHERE id =? order by time desc";
                                $stmt=$mysqli->prepare($sql);
                                $stmt->bind_param('i',$id);
                                $stmt->execute();
                                $stmt->bind_result($level,$time,$sign,$near_gateway);
                                $stmt->fetch();
                                $misstime=$date-strtotime($time);
                                echo "<tr><td>$id</td><td>$level</td><td>$sign</td><td class='miss-time'>$misstime s</td><td>$near_gateway</td></tr>";
                                
                                $stmt->close();
                            }
                            $mysqli->close();

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer class="page-footer center-align white">
        <div class="footer-copyright white black-text">
            <div class="container">
                <span>&copy; 2020 Zhe</span>
            </div>
        </div>
    </footer>
</body>
</html>
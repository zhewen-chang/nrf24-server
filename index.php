<!doctype html>
<html>
<head>
    <title>Anti-drown system</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!--when use chineese, need this-->
    <meta name="viewport" content="width=device-width, user-scalable=no" /> <!--mobile mode-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> <!--use materialize-->  
    <script src="//cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script> <!--javascript library-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> <!--use materialize-->
    <script src="asserts/main.js"></script> <!--call main.js-->
    <link rel="stylesheet" href="asserts/main.css">
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
                            <th> Pipe </th>
                        </tr>
                    </thead>
                    <tbody id="ajax-body">
                        <?php
                            include_once("./exec/getData.php");
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
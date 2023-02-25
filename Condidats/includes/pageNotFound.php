<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="bootstrap-5.2.3/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="../MDB/css/mdb.min.css" />
    <link rel="stylesheet" href="../style.css" />
    <title>Erreur</title>
</head>

<body>
    <style>
    body {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    section {
        margin: 0;
        padding: 10px;
        position: relative;
        background-image: url(../inscreptionSteps/bgimg.png);
        min-height: 100vh;
    }

    h1 {
        text-align: center;
        position: relative;
        margin: 0 auto 40px auto;
        color: red;
        font-weight: 700;
        font-family: monospace;

    }

    div {
        margin: 0 auto;
        min-height: 75vh;
        padding: 30px;
        background-image: url(../images/maxresdefault.jpg);
        background-repeat: no-repeat;
        background-size: 100%;
        width: 70%;
        border-radius: 15px;
        box-shadow: 1px 2px 20px black;
    }
    </style>
    <section>
        <h1>Le délai d'inscription est expiré</h1>
        <div>
            <!-- <img src="../images/maxresdefault.jpg"> -->
        </div>

    </section>
    <script src="MDB/js/mdb.min.js"></script>
    <script src="js.js"></script>
</body>

</html>
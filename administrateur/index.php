<?php
session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="bootstrap-5.2.3/css/bootstrap.min.css" /> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../Condidats/MDB/css/mdb.min.css" />
    <link rel="stylesheet" href="css/css.css" />
    <title>Admin authentification</title>
</head>

<body>
    <?php
    if(isset($_POST["signIn"])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    require_once "../Condidats/includes/conn.php";

    $req="SELECT id_admin,Nom,password from administrateur where email='$email' AND password='$password'";
    // $preReq=$conn->prepare($req);
    // $preReq->bindParam("ssss", $nom, $prenom, $email,$password);
    $result = $conn->query($req);
    if ($result->rowCount() > 0){
    $row=$result->fetch();
    $_SESSION['id_admin']=$row[0];
    $_SESSION['Nom']=$row[1];
    // $_SESSION['Prenom']=$row[2];
    $conn=null;
    header("location:deadline.php");
    }else {
    $conn=null;
    // header("location:index.php");\
    echo "<script>
    swal('Attention!', 'Email ou mot de passe incorect', 'error')
    </script>";

    }
    }
    ?>

    <section class="vh-100" style="background-image: url(images/bgimg.png);">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 5px;height: 60vh;  box-shadow: 1px 5px 5px 5px gray;">
                            <div class="card-body p-4">
                                <h2 class="text-uppercase text-center">
                                    Sign in
                                </h2>

                                <form method="post">
                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" id="form3Example3cg"
                                            class="form-control form-control-lg" />
                                        <label class="form-label" for="form3Example3cg">Email</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="form3Example4cg"
                                            class="form-control form-control-lg" />
                                        <label class="form-label" for="form3Example4cg">Mot de passe</label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" name="signIn" value="S'identifier"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <script src="bootstrap-5.2.3/js/bootstrap.min.js"></script> -->
    <script src="../Condidats/MDB/js/mdb.min.js"></script>
    <script src="js.js"></script>
</body>

</html>
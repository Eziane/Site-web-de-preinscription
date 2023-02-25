<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="bootstrap-5.2.3/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="MDB/css/mdb.min.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Index</title>
</head>

<body>
    <?php
require "./includes/endInsc.php";
// session_start();
if(isset($_POST["signIn"])){
 $email=$_POST['email'];
  $password=$_POST['password'];
    require_once "./includes/conn.php";
    
    $req="SELECT id_etudiant,Nom,Prenom,email,password from Etudiant where email='$email' AND password='$password'";
    $result=$conn->query($req);
    // $params=array($email,$password);
    // $result = $conn->query();
    if ($result->rowCount() > 0){
        $row=$result->fetch();
        $_SESSION['id_etudiant']=$row[0];
        $_SESSION['Nom']=$row[1];
        $_SESSION['Prenom']=$row[2];
            $conn=null;
            header("location:./inscreptionSteps/step1.php");
    }else {
        $conn=null;
        // header("location:index.php");
        echo "<script>swal('Attention!','Email ou mot de passe incorect','error')</script>";
    }
}

?>
    <section class="vh-100" style="background-image: url(inscreptionSteps/bgimg.png);">
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
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example3cg">Email</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="form3Example4cg"
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example4cg">Mot de passe</label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" name="signIn" value="S'identifier"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">

                                    </div>
                                </form>
                                <p class="text-center text-muted mt-5 mb-0">
                                    Vous n'avez pas de compte?
                                    <a href="signUP.php" class="fw-bold text-body"><u>Inscrivez-vous ici</u></a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <script src="bootstrap-5.2.3/js/bootstrap.min.js"></script> -->
    <script src="MDB/js/mdb.min.js"></script>
    <script src="js.js"></script>
</body>

</html>
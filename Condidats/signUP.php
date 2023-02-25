<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="bootstrap-5.2.3/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="MDB/css/mdb.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign up</title>
</head>

<body>
    <?php

if(isset($_POST["signUp"])){
  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $passwordConf=$_POST['passwordConf'];
  if($password != $passwordConf){
    // header("location:signUp.php");
  }else{
    require "./includes/conn.php";
     $req="SELECT id_etudiant from Etudiant where email='$email'";
     $preReq=$conn->prepare($req);
     $preReq->execute();
    if($preReq->rowCount() > 0){
            echo "<script>swal('Attention!','Cet e-mail est déjà utilisée','error')</script>";
    }else{
            $sql="INSERT into Etudiant (Nom,Prenom,email,password)values('$nom', '$prenom', '$email','$password')";
            $preSql=$conn->prepare($sql);
            $preSql->execute();
            // $preReq->bindParam("ssss", $nom, $prenom, $email,$password);
            header("location:index.php");
            $conn=null;
    }
  }
}
?>


    <section class="vh-100" style=" background-image: url('inscreptionSteps/bgimg.png');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 5px;height: 95vh;box-shadow: 1px 5px 5px 5px gray;">
                            <div class="card-body p-4">
                                <h2 class="text-uppercase text-center">
                                    Sign up
                                </h2>

                                <form method="post">
                                    <div class="form-outline mb-4">
                                        <input type="text" name="nom" id="form3Example1cg"
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example1cg">Nom</label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="text" name="prenom" id="form3Example1cg"
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example1cg">Prenom</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" id="form3Example3cg"
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example3cg">Email</label>
                                    </div>


                                    </script>
                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="form3Example4cg"
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example4cg">Mot de passe</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="passwordConf" id="form3Example4cdg"
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example4cdg">Répétez votre mot de
                                            passe</label>
                                        <span id='message' style="position: absolute;right: 0;font-size: 20
                                        px;"></span>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" name="signUp" value="S'inscrire"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" />
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">
                                        Vous avez déjà un compte?
                                        <a href="index.php" class="fw-bold text-body"><u>Connectez-vous ici</u></a>
                                    </p>
                                </form>

                                <script>
                                $('#form3Example4cg, #form3Example4cdg').on('keyup', function() {
                                    if ($('#form3Example4cg').val() == $('#form3Example4cdg').val()) {
                                        $('#message').html('<i class="fa-solid fa-check"></i>').css('color',
                                            'green');
                                    } else
                                        $('#message').html('<i class="fa-solid fa-xmark"></i>').css('color',
                                            'red');
                                });
                                </script>
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
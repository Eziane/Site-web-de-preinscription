<?php
session_start();
if($_SESSION['id_etudiant']==null){
    header("location:../index.php");
}else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MDB/css/mdb.min.css" />
    <link rel="stylesheet" href="sty.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Step 2</title>
</head>

<body>
    <?php
    $id_etudiant = $_SESSION['id_etudiant'];
    // $nom=$_SESSION['Nom'];
    // $prenom=$_SESSION['Prenom'];
    
    if (isset($_POST["insertStep2"])) {
        $done = 1;
        // name of the uploaded file
        $BAC = $_FILES['BAC']['name'];
        $releve = $_FILES['releve']['name'];
        // destination of the file on the server
        $destination = '../uploads/';
        // get the file extension
        $BACExtension = pathinfo($BAC, PATHINFO_EXTENSION);
        $releveExtension = pathinfo($releve, PATHINFO_EXTENSION);
        // the physical file on a temporary uploads directory on the server
        $file1 = $_FILES['BAC']['tmp_name'];
        $size1 = $_FILES['BAC']['size'];
        // var_dump($file1);
        
        $file2 = $_FILES['releve']['tmp_name'];
        $size2 = $_FILES['releve']['size'];
        
        if (!in_array($BACExtension, ['pdf', 'docx'])) {
            $BAC = null;
            echo '<script>swal("Attention!", "Le fichier de Bac doit etre .pdf or .docx", "error");</script>';
            $done = 0;
        } elseif ($_FILES['BAC']['size'] > 2000000) { // file shouldn't be larger than 1Megabyte
            echo "<script>swal('Attention!','Le fichier du Bac tres long','error')</script>";
            $BAC = null;
            $done = 0;
        } else {
            // move the uploaded (temporary) file to the specified destination
            // $newName=$id_etudiant.$BAC;
            move_uploaded_file($file1, $destination . "Bac" . $id_etudiant . "." . $BACExtension);
        }
        if (!in_array($releveExtension, ['pdf', 'docx'])) {
            $releve = null;
            echo "<script>swal('Attention!','Le fichier de releve notes doit etre .pdf or .docx','error')</script>";
            $done = 0;
        } elseif ($_FILES['releve']['size'] > 2000000) { // file shouldn't be larger than 1Megabyte
            echo "<script>swal('Attention!','Le fichier de releve notes est tres long !','error')</script>";
            $releve = null;
            $done = 0;
        } else {
            // move the uploaded (temporary) file to the specified destination
            move_uploaded_file($file2, $destination . "Releve" . $id_etudiant . "." . $releveExtension);
        }
        // end upload files
        $lyce = $_POST['lyce'];
        $specialite = $_POST['specialite'];
        $anne_obtention = $_POST['anne_obtention'];
        $N_regionale = $_POST['N_regionale'];
        $N_nationale = $_POST['N_nationale'];
        
        require_once "../includes/conn.php";
        // $requete = "SELECT id_filiere from filiere_bac where nom_filiere='$specialite'";
        // $res = $conn->query($requete);
        // $row = $res->fetch();
        $note_calculer=($N_nationale*0.75)+($N_regionale*0.25);
        $req = "UPDATE Etudiant set lyce='$lyce',anneBac='$anne_obtention' ,note_regionale='$N_regionale',
                                note_nationale='$N_nationale',note_calculer='$note_calculer' ,BAC='$BAC' ,releve_note='$releve', id_filiere='$specialite' where id_etudiant='$id_etudiant'";
        // $preReq=$conn->prepare($req);
        // $preReq->bindParam("ssss", $nom, $prenom, $email,$password);
        $conn->query($req);
        $conn = null;
        if ($done == 1) {
            // echo "<script>swal('Tres bien!','le deuxeme etape est bien enregestrer','success')</script>";
            header("location:./step3.php");
        }
    }
    // if (isset($_GET['backToStep2'])) {
        require "../includes/conn.php";
        $req2 = "SELECT lyce,anneBac,id_filiere,note_regionale,note_nationale,Bac,releve_note from Etudiant where id_etudiant='$id_etudiant'";
        $result = $conn->query($req2);
        // var_dump($result);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            $_SESSION['lyce'] = $row[0];
            $_SESSION['anneBac']=$row[1];
            $_SESSION['specialite']=$row[2];
            $_SESSION['N_regionale'] = $row[3];
            $_SESSION['N_nationale'] = $row[4];
            $_SESSION['BAC']=$row[5];
            $_SESSION['releve']=$row[6];
        }
            $conn = null;
    // }
    ?>
    <div class="All">
        <header>
            <!-- progressbar -->
            <div>
                <ul id="progressbar">
                    <li class="active">Les informations personnel</li>
                    <li class="active">Uplaod fichiers</li>
                    <li>choisir filiere</li>
                </ul>
                <a href="../logout.php" id="dconnecter">Se déconnecter</a>
            </div>

        </header>
        <!-- multistep form -->
        <div id="msform">
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Uplaod fichiers</h2>
                <!-- <h3 class="fs-subtitle">Your presence on the social network</h3> -->
                <form method="post" enctype="multipart/form-data">
                    <div>
                        <label for="lyce">Le lycée</label>
                        <input type="text" name="lyce" value="<?php echo $_SESSION['lyce'] ?>" required />
                    </div>
                    <div>
                        <label for="specialite">Specialite</label>
                        <select name="specialite" id="specialite" required>
                            <option value="1">Math</option>
                            <option value="2">technologie</option>
                            <option value="3">PC</option>
                            <option value="4">SVT</option>
                        </select>
                    </div>
                    <div>
                        <label for="anne_obtention">L'année d'obtention</label>
                        <select name="anne_obtention" id="anne_obtention" required>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                    <script type="text/javascript">
                    document.getElementById('specialite').value = "<?php echo $_SESSION['specialite'] ?>";
                    document.getElementById('anne_obtention').value = "<?php echo $_SESSION['anneBac'] ?>";
                    </script>
                    <div>
                        <label for="N_regionale">La note du regional</label>
                        <input type="text" name="N_regionale" value="<?php echo $_SESSION['N_regionale'] ?>" required />
                    </div>
                    <div>
                        <label for="N_nationale">La note du national</label>
                        <input type="text" name="N_nationale" value="<?php echo $_SESSION['N_nationale'] ?>" required />
                    </div>
                    <div>
                        <label for="BAC">BAC (pdf ou word)</label>
                        <input type="file" name="BAC" value="<?php echo $_SESSION['BAC'] ?>" required />
                    </div>
                    <div>
                        <label for="releve">Releve de notes (pdf ou word)</label>
                        <input type="file" name="releve" value="<?php echo $_SESSION['relever'] ?>" required />
                    </div>
                    <input type="button"
                        onclick="document.location.href='/PHP_conding/Condidats/inscreptionSteps/step1.php'" ;
                        class=" previous action-button" value="Previous" />
                    <input type="submit" name="insertStep2" class="next action-button" value="Next" />
                </form>
                <!-- <form action="step1.php" method="get" id="backToStep1"> -->
                <!-- </form> -->
            </fieldset>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="MDB/js/mdb.min.js"></script>

    <script src="../js.js"></script>
</body>

</html>
<?php
}
?>
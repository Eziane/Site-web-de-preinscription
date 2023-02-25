<?php 
session_start(); 
if($_SESSION['id_etudiant']==null){
    header("location:../index.php");
}else{
    $id_etudiant = $_SESSION['id_etudiant'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MDB/css/mdb.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sty.css">
    <title>Step 3</title>
</head>

<body>
    <?php
        require_once "../includes/conn.php";
        $sql="SELECT id_choix_filiere from choisir where id_etudiant='$id_etudiant' ORDER BY nbr_choix";
        $q=$conn->query($sql);
        // $q->setFetchMode(PDO::FETCH_ASSOC);
        $resultat=$q->fetchAll();
            $_SESSION['Choix_1']=$resultat[0][0];
            $_SESSION['Choix_2']=$resultat[1][0];
            
    if (isset($_POST["insertStep3"])) {
        $done=1;
        $Choix_1 = $_POST['Choix_1'];
        $Choix_2 = $_POST['Choix_2'];
            // echo "<script>swal('Attention!','Choisir deux filieres differente','info'); </script>";
        
        $requete="SELECT id_choix_filiere from choisir where id_etudiant='$id_etudiant' AND nbr_choix=1";
        $res1=$conn->query($requete);
        if ($res1->rowCount() > 0) {
            $requete = "UPDATE choisir set id_choix_filiere='$Choix_1' where id_etudiant='$id_etudiant' AND nbr_choix=1";
            // $conn->query($requete2);
        }else{
            $requete="INSERT into choisir (id_etudiant,id_choix_filiere,nbr_choix) values('$id_etudiant','$Choix_1',1)";
            // $conn->query($requete3);
        }
        $req="SELECT id_choix_filiere from choisir where id_etudiant='$id_etudiant' AND nbr_choix=2";
        $res1=$conn->query($req);
        if ($res1->rowCount() > 0) {
            $req = "UPDATE choisir set id_choix_filiere='$Choix_2' where id_etudiant='$id_etudiant' AND nbr_choix=2";
            // $conn->query($req2);
        }else{
            $req="INSERT into choisir (id_etudiant,id_choix_filiere,nbr_choix) values('$id_etudiant','$Choix_2',2)";
            // $conn->query($req3);
        }
            $conn->query($requete);
            $conn->query($req);
        $conn = null;
        // if(1){
            echo "<script>swal('Tres bien!','le troiseme etape est bien enregestrer','success');</script>";
             $_SESSION['Choix_1']=$Choix_1;
            $_SESSION['Choix_2']=$Choix_2;
            // header("location:./step3.php");
        }
    
    ?>
    <div class="All">
        <header>
            <script>
            // swal('Tres bien!', 'le troiseme etape est bien enregestrer', 'success');
            </script>
            <!-- progressbar -->
            <div>
                <ul id="progressbar">
                    <li class="active">Les informations personnel</li>
                    <li class="active">Uplaod fichiers</li>
                    <li class="active">choisir filiere</li>
                </ul>
                <a href="../logout.php" id="dconnecter">Se déconnecter</a>
            </div>

        </header>
        <!-- multistep form -->
        <div id="msform">
            <!-- fieldsets -->
            <fieldset>
                <?php 
                // var_dump($resultat[0][0]);
                // echo $resultat[1][0];
                ?>
                <h2 class="fs-title">Choisir le filiere</h2>
                <form method="post">
                    <div>
                        <label for="Choix_1">Premiere choix</label>
                        <select name="Choix_1" id="Choix_1">
                            <option selected>Choisi une filiere :</option>
                            <option value="1">Génie Informatique</option>
                            <option value="2">Techniques de Management</option>
                            <option value="3">Génie Industriel et Maintenance</option>
                            <option value="4">Techniques Instrumentales et Management de la Qualité</option>
                        </select>
                    </div>
                    <div>
                        <label for="Choix_2">Deuxeme choix</label>
                        <select name="Choix_2" id="Choix_2">
                            <option selected>Choisi une filiere :</option>
                            <option value="1">Génie Informatique</option>
                            <option value="2">Techniques de Management</option>
                            <option value="3">Génie Industriel et Maintenance</option>
                            <option value="4">Techniques Instrumentales et Management de la Qualité</option>
                        </select>
                    </div>
                    <script type="text/javascript">
                    document.getElementById('Choix_1').value = "<?php echo $_SESSION['Choix_1'];?>";
                    document.getElementById('Choix_2').value = "<?php echo $_SESSION['Choix_2'];?>";
                    </script>
                    <input type="button"
                        onclick="document.location.href='/PHP_conding/Condidats/inscreptionSteps/step2.php'" ;
                        class=" previous action-button" value="Previous" />
                    <input type="submit" name="insertStep3" class="next action-button" value="SAVE" />
                </form>
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
<?php
session_start();
if($_SESSION['id_etudiant']==null){
    header("location:../index.php");
}else{
$id_etudiant=$_SESSION['id_etudiant'];
require_once "../includes/conn.php";

if(isset($_POST["InsertStep1"])){
$nom=$_POST['Nom'];
$prenom=$_POST['Prenom'];
$CIN=$_POST['CIN'];
$dateN=$_POST['dateN'];
$telephone=$_POST['telephone'];
$CNE=$_POST['CNE'];
$sexe=$_POST['sexe'];
$regione=$_POST['regione'];
$ville=$_POST['ville'];
$adresse=$_POST['adresse'];

$_SESSION['Nom']=$nom;
$_SESSION['Prenom']=$prenom;

    
    $req="UPDATE Etudiant set Nom='$nom', Prenom='$prenom', CIN='$CIN' ,dateN='$dateN',tele='$telephone', CNE='$CNE' ,sexe='$sexe',region='$regione',ville='$ville',adresse='$adresse' where id_etudiant='$id_etudiant'";
    // $preReq=$conn->prepare($req);
    // $preReq->bindParam("ssss", $nom, $prenom, $email,$password);
    $conn->query($req);
    $conn=null;
    header("location:./step2.php");

}
// if(isset($_GET['backToStep1'])){
    require_once "../includes/conn.php";
    $req2="SELECT CIN,dateN,tele,CNE,sexe,region,ville,adresse from Etudiant where id_etudiant='$id_etudiant'";
    $result = $conn->query($req2);
    $conn=null;
    if ($result->rowCount() > 0){
        $row=$result->fetch();
        $_SESSION['CIN']=$row[0];
        $_SESSION['dateN']=$row[1];
        $_SESSION['telephone']=$row[2];
        $_SESSION['CNE']=$row[3];
        $_SESSION['sexe']=$row[4];
        $_SESSION['regione']=$row[5];
        $_SESSION['ville']=$row[6];
        $_SESSION['adresse']=$row[7];
    }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MDB/css/mdb.min.css" />
    <link rel="stylesheet" href="sty.css">
    <title>Step 1</title>
</head>

<body>
    <div class="All">
        <header>
            <!-- progressbar -->
            <div>
                <ul id="progressbar">
                    <li class="active">Les informations personnel</li>
                    <li>Uplaod fichiers</li>
                    <li>choisir filiere</li>
                </ul>
                <a href="../logout.php" id="dconnecter">Se déconnecter</a>
            </div>

        </header>
        <!-- multistep form -->
        <div id="msform">
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">informations personnelles</h2>
                <form method="post">
                    <div>
                        <label for="Nom">Nom</label>
                        <input type="text" name="Nom" value="<?php  echo $_SESSION['Nom']?>" />
                    </div>
                    <div>
                        <label for="Prenom">Prenom</label>
                        <input type="text" name="Prenom" value="<?php echo  $_SESSION['Prenom'] ?>" />
                    </div>
                    <div>
                        <label for="CIN">CNI ou Passport</label>
                        <input type="text" name="CIN" value="<?php echo $_SESSION['CIN']?>" />
                    </div>
                    <div>
                        <label for="sexe">Sexe</label>
                        <select name="sexe" id="sexe">
                            <option selected>Choisir :</option>
                            <option value="Masculin">Masculin</option>
                            <option value="Féminin">Féminin</option>
                        </select>
                    </div>
                    <div>
                        <label for="dateN">Date de naissance</label>
                        <input type="date" name="dateN" value="<?php echo $_SESSION['dateN']?>" />
                    </div>
                    <div>
                        <label for="telephone">Telephone</label>
                        <input type="tel" name="telephone" value="<?php echo $_SESSION['telephone']?>" />
                    </div>
                    <!-- <hr style="margin: 4px 0 15px 0;height:2px;background-color: black;">
                    <div style="text-align: center;width: 50%;margin: 20px auto;">
                        <label for="Etrangere">Je ne suis pas maroocaine</label>
                        <input type="checkbox" name="Etrangere" style="margin-top: 0px;width: 20px;height: 20px;" />
                    </div>
                    <hr style="margin: 4px 0 15px 0;height:2px;background-color: black;"> -->
                    <div>
                        <label for="CNE">CNE</label>
                        <input type="text" name="CNE" value="<?php echo $_SESSION['CNE']?>" />
                    </div>

                    <div>

                        <label for="regione">Regione</label>
                        <select name="regione" id="regione" onchange="getVille()">
                            <option value="null" selected>Choisir :</option>
                            <option value="1">Tanger-Tétouan-Al Hoceïma</option>
                            <option value="2">Oriental</option>
                            <option value="3">Fès-Meknès</option>
                            <option value="4">Dakhla-Oued Ed Dahab</option>
                            <option value="5">Dakhla-Oued Ed Dahab</option>
                            <option value="6">Casablanca-Settat</option>
                            <option value="7">Marrakech-Safi</option>
                            <option value="8">Drâa-Tafilalet</option>
                            <option value="9">Souss-Massa</option>
                            <option value="10">Guelmim-Oued Noun</option>
                            <option value="11">Laâyoune-Sakia El Hamra</option>
                            <option value="12">Dakhla-Oued Ed Dahab</option>
                        </select>
                        <!-- <input type="text" name="regione" value="" /> -->
                    </div>
                    <script>
                    function getVille() {
                        var ville = document.getElementById('ville');
                        var regione = document.getElementById('regione').value;
                        const xhr = new XMLHttpRequest();
                        xhr.onload = function() {
                            ville.innerHTML = "";
                            if (this.status == 200) {
                                var obj = JSON.parse(xhr.responseText);
                                for (var i = 1; i < 100; i++) {
                                    if (obj[i]['region'] == regione) {
                                        var City = obj[i]['ville'];
                                        ville.innerHTML += "<option value='" + City + "'>" + City;
                                    }
                                }

                            } else {
                                console.warn('did not recieve any thing');
                            }
                        };
                        xhr.open('get', 'villes.json');
                        xhr.send();
                    }
                    </script>
                    <div>
                        <label for="ville">Ville</label>
                        <select name="ville" id="ville">
                            <option selected>Choisir :</option>
                        </select>
                        <!-- <input type="text" name="ville" value="" /> -->
                    </div>
                    <script type="text/javascript">
                    document.getElementById('sexe').value = "<?php echo $_SESSION['sexe']?>";
                    document.getElementById('regione').value = "<?php echo $_SESSION['regione'] ?>";
                    document.getElementById('ville').value = "<?php echo $_SESSION['ville'] ?>";
                    </script>
                    <div>
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse" value="<?php echo $_SESSION['adresse']?>" />
                    </div>
                    <input type="submit" name="InsertStep1" class="next action-button" value="Next" />
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
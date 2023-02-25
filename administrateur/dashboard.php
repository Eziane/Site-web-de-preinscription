<?php
session_start();
if($_SESSION['id_admin']==null){
    header("location:index.php");
}else{
    require_once "../Condidats/includes/conn.php";
    // include "deadline.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"></script>
    <link rel="stylesheet" href="../Condidats/MDB/css/mdb.min.css" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/css.css" />
</head>

<body class="sb-nav-fixed">
    <style>
    #myModal {
        font-size: 15px;
    }
    </style>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="post" action="generateList.php" id="modalForm">
                <div class="row">
                    <div class="col col-8 mb-3" id="GITOGGLE">
                        <p>Génie Informatique</p>
                    </div>
                    <div class="col col-4 mb-3">
                        <label>Nombre d'étudiants</label>
                        <input type="number" name="NbrCondidats_GI" min="0" class='nbrInput' required>
                    </div>
                </div>
                <div class="row " id="row">
                    <div class="col col-3 mb-3">
                        <label for="">% Math</label>
                        <input type="number" name="MathP_GI" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% PC</label>
                        <input type="number" name="PCP_GI" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% Tech</label>
                        <input type="number" name="TecP_GI" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% SVT</label>
                        <input type="number" name="SVTP_GI" min="0" max="100" required>
                    </div>
                </div>
                <!-- TM -->
                <hr />
                <div class="row">
                    <div class="col col-8 mb-3">
                        <p>Techniques de Management</p>
                    </div>
                    <div class="col col-4 mb-3">
                        <label for="">Nombre d' étudiants</label>
                        <input type="number" name="NbrCondidats_TM" min="0" class="nbrInput" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-3 mb-3">
                        <label for="">% Math</label>
                        <input type="number" name="MathP_TM" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% PC</label>
                        <input type="number" name="PCP_TM" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% Tech</label>
                        <input type="number" name="TecP_TM" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% SVT</label>
                        <input type="number" name="SVTP_TM" min="0" max="100" required>
                    </div>
                </div>
                <!-- GIM -->
                <hr />
                <div class="row">
                    <div class="col col-8 mb-3">
                        <p>Génie Industriel et Maintenance</p>
                    </div>
                    <div class="col col-4 mb-3">
                        <label for="nbr">Nombre d'étudiants</label>
                        <input type="number" name="NbrCondidats_GIM" min="0" id="nbr" class="nbrInput" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-3 mb-3">
                        <label for="">% Math</label>
                        <input type="number" name="MathP_GIM" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% PC</label>
                        <input type="number" name="PCP_GIM" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% Tech</label>
                        <input type="number" name="TecP_GIM" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% SVT</label>
                        <input type="number" name="SVTP_GIM" min="0" max="100" required>
                    </div>
                </div>
                <!-- TIMQ -->
                <hr />
                <div class="row">
                    <div class="col col-8 mb-3">
                        <p>TIMQ</p>
                    </div>
                    <div class="col col-4 mb-3">
                        <label for="">Nombre d'étudiants</label>
                        <input type="number" name="NbrCondidats_TIMQ" min="0" class="nbrInput" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-3 mb-3">
                        <label for="">% Math</label>
                        <input type="number" name="MathP_TIMQ" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% PC</label>
                        <input type="number" name="PCP_TIMQ" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% Tech</label>
                        <input type="number" name="TecP_TIMQ" min="0" max="100" required>
                    </div>
                    <div class="col col-3 mb-3">
                        <label for="">% SVT</label>
                        <input type="number" name="SVTP_TIMQ" min="0" max="100" required>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col col-8" id="NB">* Ecrire le percentage sans %</div>
                    <div class="col col-4">
                        <input type="reset" name="reset" value="Reset" class="btn bnt p-2">
                        <input type="submit" name="submitGenere" value="Valider" class="btn bnt p-2">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <nav class="sb-topnav navbar navbar-expand navbar"
        style="background-color:#f27b34;box-shadow: 1px 2px 10px #dde9f5">
        <!-- Navbar Brand-->
        <img class=" navbar-brand ps-3" src="images/logoEst.png" style="background-color:#dde9f5; height: 9vh;" />
        <!-- Sidebar Toggle-->
        <button class="m-3 btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 " style=" color:white;"
            id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar-->

        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style=" color:white;" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav" id="sidenavAccordion"
                style="background-color:#dde9f5;box-shadow: 1px 2px 10px #dde9f5;">
                <div class="sb-sidenav-menu pt-3">
                    <div class="nav">
                        <a class="nav-link" href="dashboard.php"
                            style="background-color:#27AE60;color:aliceblue;margin-bottom:3px;">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" id="GenererListe"
                            style=" background-color:#27AE60;color:aliceblue;margin-bottom:20px;cursor: pointer;">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-hand-pointer"></i></div>
                            Gestion de selection
                        </a>
                        <script>
                        // function toggleDivDisplay() {
                        //     var x = document.getElementById("row");
                        //     if (x.style.display === "none") {
                        //         // x.children.style.display = "block";
                        //         x.style.display = "block";
                        //     } else {
                        //         x.style.display = "none";
                        //         x.children.style.display = "none";

                        //     }
                        // }
                        // document.getElementById("GITOGGLE").addEventListener("click", toggleDivDisplay);
                        // Get the modal
                        modal = document.getElementById("myModal");
                        // Get the button that opens the modal
                        var btn = document.getElementById("GenererListe");

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];

                        // When the user clicks the button, open the modal 
                        btn.onclick = function() {
                            modal.style.display = "block";
                        }

                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() {
                            modal.style.display = "none";
                        }

                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                        </script>
                        <div class="sb-sidenav-menu-heading"><img style="width: 100%;" src="images/estLogo.png" />
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer" style="background-color:#27AE60;color:aliceblue;">
                    <form action="deadline.php" method="post">
                        <label for="deadline">La date de fermeture</label>
                        <input type="date" name="deadline" id="deadline" value="<?php echo $_SESSION['deadline'];?>">
                        <input type="hidden" name="filename" value="<?php echo __FILE__;?>">
                        <input type="submit" value="Save" class="btn-primary">
                    </form>
                </div>
                <div class="sb-sidenav-footer" style="background-color:#27AE60;color:aliceblue;">
                    <div class="small">Connecté en tant que:</div>
                    <?php echo "Monsieur ".$_SESSION['Nom'];?>
                </div>
            </nav>
        </div>

        <?php
            require "../Condidats/includes/conn.php";
            $sql="SELECT count(id_filiere) FROM `etudiant` GROUP BY id_filiere ORDER BY id_filiere;";
            $result = $conn->query($sql);
                $row=$result->fetchAll();
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Nombre de condidats par filiere</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card  text-white mb-4" style="background-color: rgb(52, 82, 136);">
                                <div class="card-body">SM</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-info">
                                    <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                    <div class="small text-black">
                                        <?php echo $row[0][0] ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: rgb(52, 82, 136);">
                                <div class="card-body">PC</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-info">
                                    <!-- <a class="small text-white stretched-link">View Details</a> -->
                                    <div class="small text-black">
                                        <?php echo $row[1][0] ;?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card  text-white mb-4" style="background-color: rgb(52, 82, 136);">
                                <div class="card-body">Technologie</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-info">
                                    <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                    <div class="small text-black">
                                        <?php if($row[3][0]!=0) echo $row[2][0];
                                                else echo 0;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: rgb(52, 82, 136);">
                                <div class="card-body">SVT</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-info">
                                    <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                    <div class="small text-black">
                                        <?php echo $row[3][0];?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Table de condidats
                        </div>
                        <div class="card-body">
                            <table id="tableCondidats" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>CNE</th>
                                        <th>Email</th>
                                        <th>Date de naissance</th>
                                        <th>La note calcule</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    require_once "../Condidats/includes/conn.php";
                                
                                        $req="SELECT nom,prenom,CNE,email,dateN,note_regionale,note_nationale,note_calculer from etudiant ORDER BY id_etudiant";
                                        $result = $conn->query($req);
                                        if ($result->rowCount() > 0) {
                                            // output data of each row
                                            while($row = $result->fetch()) {
                                                echo "<tr>";
                                                    echo "<td>".$row[0]."</td>";
                                                    echo "<td>".$row[1]."</td>";
                                                    echo "<td>".$row[2]."</td>";
                                                    echo "<td>".$row[3]."</td>";
                                                    echo "<td>".$row[4]."</td>";
                                                    echo "<td>".$row[5]."</td>";
                                                echo "</tr>";
                                            }
                                            } else {
                                            echo "0 results";
                                            }
                                            $conn=null;
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>CNE</th>
                                        <th>Email</th>
                                        <th>Date de naissance</th>
                                        <th>La note calcule</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script> -->
                            <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
                            <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
                            <!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script> -->
                            <!-- <script src="js/datatables-simple-demo.js"></script> -->

                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
                            </script>
                            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
                            </script>
                            <script src="js/scripts.js"></script>
</body>

</html>
<?php } ?>
<?php
session_start();
if($_SESSION['id_admin']==null){
    header("location:index.php");
}else{
    require_once "../Condidats/includes/conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - SB Admin</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"></script>
    <link rel="stylesheet" href="../Condidats/MDB/css/mdb.min.css" />

</head>

<body class="sb-nav-fixed">
    <style>

    </style>


    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="post" action="generateList.php" id="modalForm">
                <div class="row">
                    <div class="col col-6 mb-4">
                        <select name="choixFiliere" id="choixFiliere" required>
                            <option selected>Choisi une filiere :</option>
                            <option value="1">Génie Informatique</option>
                            <option value="2">Techniques de Management</option>
                            <option value="3">Génie Industriel et Maintenance</option>
                            <option value="4">TIMQ</option>
                        </select>
                    </div>
                    <div class="col col-6 mb-4">
                        <label for="">Nombre de condidats</label>
                        <input type="number" name="NbrCondidats" min="0" placeholder="Sans %" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-6 mb-4">
                        <label for="">Percentage de filiere Math</label>
                        <input type="number" name="MathP" min="0" max="100" placeholder="Sans %" required>
                    </div>
                    <div class="col col-6 mb-4">
                        <label for="">Percentage de filiere PC</label>
                        <input type="number" name="PCP" min="0" max="100" placeholder="Sans %" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-6 mb-4">
                        <label for="">Percentage de filiere Technologie</label>
                        <input type="number" name="TecP" min="0" max="100" placeholder="Sans %" required>
                    </div>
                    <div class="col col-6 mb-4">
                        <label for="">Percentage de filiere SVT</label>
                        <input type="number" name="SVTP" min="0" max="100" placeholder="Sans %" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-9">

                    </div>
                    <div class="col col-3">
                        <input type="reset" name="reset" value="Reset" class="btn p-2 btn-outline-info">
                        <input type="submit" name="submitGenere" value="Valider" class="btn p-2 btn-outline-success">
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
                        <a class="nav-link" href="Selection.php"
                            style="background-color:#27AE60;color:aliceblue;margin-bottom:20px;">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-hand-pointer"></i></div>
                            Gestion de selection
                        </a>
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
                    <h1 class="mt-4 text-center">Les listes de preinscription</h1>
                    <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Nombre de condidats par filiere</li>
                    </ol> -->

                    <div class="row mt-5">
                        <div class="col-xl-6 col-md-6">
                            <div class="card  text-white mb-4" style="background-color: rgb(52, 82, 136);">
                                <div class="card-body">Génie Informatique</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-info">
                                    <div class="liste icon stext-black">

                                    </div>
                                    <div class="listesActions text-black">
                                        <button class="btn-success " id="myBtn">Create</button>
                                        <button class="btn-danger">Delete</button>
                                    </div>
                                </div>
                                <script>

                                </script>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card text-white mb-4" style="background-color: rgb(52, 82, 136);">
                                <div class="card-body">Techniques de Management</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-info">
                                    <div class="small text-black">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <div class="card  text-white mb-4" style="background-color: rgb(52, 82, 136);">
                                <div class="card-body">Génie Industriel et Maintenance</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-info">
                                    <div class="small text-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card text-white mb-4" style="background-color: rgb(52, 82, 136);">
                                <div class="card-body">Techniques Instrumentales et Management de la Qualité</div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-info">
                                    <div class="small text-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
                    </script>
                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
                    </script>
                    <!-- <script src="js/js.js"></script> -->
                    <script src="js/scripts.js"></script>
                    <script src="../Condidats/MDB/js/mdb.min.js">
                    </script>
</body>

</html>
<?php } ?>
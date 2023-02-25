<?php 
session_start();
    require_once "../Condidats/includes/conn.php";
    if(isset($_POST['deadline'])){
        $deadline=$_POST['deadline'];
        $filename=$_POST['filename'];
        $stm=$conn->prepare("UPDATE administrateur set deadline='$deadline'");
        $stm->execute();
        $_SESSION['deadline']=$deadline;
        // $conn=null;
        $url=explode('administrateur\\',$filename,5);
        
        header("location:".$url[1]);
        // header("location:dashboard.php");
    }else{
        $sql="SELECT deadline FROM administrateur;";
            $result = $conn->query($sql);
                $row=$result->fetch();
                $_SESSION['deadline']=$row[0];
        $conn=null;
        header("location:dashboard.php");
    }
?>
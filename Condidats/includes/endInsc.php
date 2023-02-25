<?php 
session_start();
    require_once "conn.php";
     $sql="SELECT deadline from administrateur";
     $result = $conn->query($sql);
     $row=$result->fetch();
    //  $now=date_diff($row[0],true);
     
    // $now=date("Y-m-d");
    // echo "now= ".$now;
    // $date2=$row[0];
    // echo "<br>date2= ".$date2."<br>";
    $date1=date_create(date("Y-m-d"));
    $date2=date_create($row[0]);
    $diff=date_diff($date1,$date2);
    // echo $diff->format("%R%a days")."<br>";
if($diff->format("%R%a")<0){
    header("location:./includes/pageNotFound.php");
}
?>
<?php
session_start();
require('fpdf184/fpdf.php');
include "../Condidats/includes/conn.php";
    function generateList($conn,$bacFiliere,$choixFiliere,$nbrChoix,$nbrEtu,$selected){
        $req1="SELECT etudiant.id_etudiant,etudiant.nom,etudiant.prenom,etudiant.CNE from Etudiant join choisir on (etudiant.id_etudiant=choisir.id_etudiant)where etudiant.id_filiere=$bacFiliere and choisir.id_choix_filiere=$choixFiliere and choisir.nbr_choix=$nbrChoix and etudiant.selected=$selected ORDER BY etudiant.note_calculer limit $nbrEtu";
        $result= $conn->query($req1);
        $row = $result->fetchAll();
        return $row;
    }
    function checkSelected($conn,$idEtudiant,$selected){
        $req1="UPDATE etudiant set selected=$selected where id_etudiant=$idEtudiant";
        $conn->query($req1);
    }
     // metter selected =0;
     function selected0($conn){
        $req1="UPDATE etudiant set selected=0";
        $conn->query($req1);
    }
    
if(isset($_POST['submitGenere'])){
    // $choixFiliere=$_POST['choixFiliere'];
    $NbrCondidats_GI=$_POST['NbrCondidats_GI'];
    $NbrCondidats_TM=$_POST['NbrCondidats_TM'];
    $NbrCondidats_GIM=$_POST['NbrCondidats_GIM'];
    $NbrCondidats_TIMQ=$_POST['NbrCondidats_TIMQ'];
    
    $MathP_GI=$_POST['MathP_GI'];
    $PCP_GI=$_POST['PCP_GI'];
    $TecP_GI=$_POST['TecP_GI'];
    $SVTP_GI=$_POST['SVTP_GI'];
    
    $MathP_TM=$_POST['MathP_TM'];
    $PCP_TM=$_POST['PCP_TM'];
    $TecP_TM=$_POST['TecP_TM'];
    $SVTP_TM=$_POST['SVTP_TM'];
    
    $MathP_GIM=$_POST['MathP_GIM'];
    $PCP_GIM=$_POST['PCP_GIM'];
    $TecP_GIM=$_POST['TecP_GIM'];
    $SVTP_GIM=$_POST['SVTP_GIM'];

    $MathP_TIMQ=$_POST['MathP_TIMQ'];
    $PCP_TIMQ=$_POST['PCP_TIMQ'];
    $TecP_TIMQ=$_POST['TecP_TIMQ'];
    $SVTP_TIMQ=$_POST['SVTP_TIMQ'];
    //calcule the number of etudiant in each filiere(math,pc,tech,svt)
    $nbrMath_GI=round(($MathP_GI*$NbrCondidats_GI)/100);
    $nbrPC_GI=round(($PCP_GI*$NbrCondidats_GI)/100);
    $nbrTec_GI=round(($TecP_GI*$NbrCondidats_GI)/100);
    $nbrSVT_GI=round(($SVTP_GI*$NbrCondidats_GI)/100);

    $nbrMath_TM=round(($MathP_TM*$NbrCondidats_TM)/100);
    $nbrPC_TM=round(($PCP_TM*$NbrCondidats_TM)/100);
    $nbrTec_TM=round(($TecP_TM*$NbrCondidats_TM)/100);
    $nbrSVT_TM=round(($SVTP_TM*$NbrCondidats_TM)/100);

    $nbrMath_GIM=round(($MathP_GIM*$NbrCondidats_GIM)/100);
    $nbrPC_GIM=round(($PCP_GIM*$NbrCondidats_GIM)/100);
    $nbrTec_GIM=round(($TecP_GIM*$NbrCondidats_GIM)/100);
    $nbrSVT_GIM=round(($SVTP_GIM*$NbrCondidats_GIM)/100);

    $nbrMath_TIMQ=round(($MathP_TIMQ*$NbrCondidats_TIMQ)/100);
    $nbrPC_TIMQ=round(($PCP_TIMQ*$NbrCondidats_TIMQ)/100);
    $nbrTec_TIMQ=round(($TecP_TIMQ*$NbrCondidats_TIMQ)/100);
    $nbrSVT_TIMQ=round(($SVTP_TIMQ*$NbrCondidats_TIMQ)/100);
    // echo $nbrMath.'<br>'.$nbrPC.'<br>'.$nbrTec.'<br>'.$nbrSVT.'<br>'.$NbrCondidats.'<br><br>'.$choixFiliere;
    // liste principale de GI
    $row1=generateList($conn,1,1,1,$nbrMath_GI,0);
    $row2=generateList($conn,2,1,1,$nbrTec_GI,0);
    $row3=generateList($conn,3,1,1,$nbrPC_GI,0);
    $row4=generateList($conn,4,1,1,$nbrSVT_GI,0);
    $GIprincipale=array_merge($row4,$row3,$row2,$row1);
    foreach($GIprincipale as $row){
        checkSelected($conn,$row[0],1);
    }
    
    
    // liste principale de TM
    $ro1=generateList($conn,1,2,1,$nbrMath_TM,0);
    $ro2=generateList($conn,2,2,1,$nbrTec_TM,0);
    $ro3=generateList($conn,3,2,1,$nbrPC_TM,0);
    $ro4=generateList($conn,4,2,1,$nbrSVT_TM,0);
    $TMprincipale=array_merge($ro1,$ro2,$ro3,$ro4);
    foreach($TMprincipale as $row){
        checkSelected($conn,$row[0],1);
    }
    //  liste principale de GIM
    $r1=generateList($conn,1,3,1,$nbrMath_GIM,0);
    $r2=generateList($conn,2,3,1,$nbrTec_GIM,0);
    $r3=generateList($conn,3,3,1,$nbrPC_GIM,0);
    $r4=generateList($conn,4,3,1,$nbrSVT_GIM,0);
    $GIMprincipale=array_merge($r1,$r2,$r3,$r4);
    foreach($GIMprincipale as $row){
        checkSelected($conn,$row[0],1);
    }

    // liste principale de TIMQ
    $r_1=generateList($conn,1,4,1,$nbrMath_TIMQ,0);
    $r_2=generateList($conn,2,4,1,$nbrTec_TIMQ,0);
    $r_3=generateList($conn,3,4,1,$nbrPC_TIMQ,0);
    $r_4=generateList($conn,4,4,1,$nbrSVT_TIMQ,0);
    $TIMQprincipale=array_merge($r_1,$r_2,$r_3,$r_4);
    foreach($TIMQprincipale as $row){
        checkSelected($conn,$row[0],1);
    }
    //GI search for the choice 2
    if(count($row1)<$nbrMath_GI){
        $row=generateList($conn,1,1,2,$nbrMath_GI,0);
        $row1=array_merge($row1,$row);
    }
    if(count($row2)<$nbrTec_GI){
        $row=generateList($conn,2,1,2,$nbrTec_GI,0);
        $row2=array_merge($row2,$row);
    }
    if(count($row3)<$nbrPC_GI){
        $row=generateList($conn,3,1,2,$nbrPC_GI,0);
        $row3=array_merge($row3,$row);
    }
    if(count($row4)<$nbrSVT_GI){
        $row=generateList($conn,4,1,2,$nbrSVT_GI,0);
        $row4=array_merge($row4,$row);
    }
    $GIprincipale=array_merge($row1,$row2,$row3,$row4);
    foreach($GIprincipale as $row){
        checkSelected($conn,$row[0],1);
    }
    //TM search for the choice 2
    if(count($ro1)<$nbrMath_TM){
        $row=generateList($conn,1,1,2,$nbrMath_TM,0);
        $ro1=array_merge($ro1,$row);
    }
     if(count($ro2)<$nbrTec_TM){
        $row=generateList($conn,2,1,2,$nbrTec_TM,0);
        $ro2=array_merge($ro2,$row);
    }
    if(count($ro3)<$nbrPC_TM){
        $row=generateList($conn,3,1,2,$nbrPC_TM,0);
        $ro3=array_merge($ro3,$row);
    }
    if(count($ro4)<$nbrSVT_TM){
        $row=generateList($conn,4,1,2,$nbrSVT_TM,0);
        $ro4=array_merge($ro4,$row);
    }
    $TMprincipale=array_merge($ro1,$ro2,$ro3,$ro4);
    foreach($TMprincipale as $row){
        checkSelected($conn,$row[0],1);
    }
//GIM search for the choice 2
    if(count($r1)<$nbrMath_GIM){
        $row=generateList($conn,1,1,2,$nbrMath_GIM,0);
        $r1=array_merge($r1,$row);
    }
    if(count($r2)<$nbrTec_GIM){
        $row=generateList($conn,2,1,2,$nbrTec_GIM,0);
        $r2=array_merge($r2,$row);
    }
    if(count($r3)<$nbrPC_GIM){
        $row=generateList($conn,3,1,2,$nbrPC_GIM,0);
        $r3=array_merge($r3,$row);
    }
    if(count($r4)<$nbrSVT_GIM){
        $row=generateList($conn,4,1,2,$nbrSVT_GIM,0);
        $r4=array_merge($r4,$row);
    }
    $GIMprincipale=array_merge($r1,$r2,$r3,$r4);
    foreach($GIMprincipale as $row){
        checkSelected($conn,$row[0],1);
    }
    //TIMQ search for the choice 2
    if(count($r_1)<$nbrMath_TIMQ){
        $row=generateList($conn,1,1,2,$nbrMath_TIMQ,0);
        $r_1=array_merge($r_1,$row);
    }
    if(count($r_2)<$nbrTec_TIMQ){
        $row=generateList($conn,2,1,2,$nbrTec_TIMQ,0);
        $r_2=array_merge($r_2,$row);
    }
    if(count($r_3)<$nbrPC_TIMQ){
        $row=generateList($conn,3,1,2,$nbrPC_TIMQ,0);
        $r_3=array_merge($r_3,$row);
    }
    if(count($r_4)<$nbrSVT_TIMQ){
        $row=generateList($conn,4,1,2,$nbrSVT_TIMQ,0);
        $r_4=array_merge($r_4,$row);
    }
    $TIMQprincipale=array_merge($r_1,$r_2,$r_3,$r_4);
    foreach($TIMQprincipale as $row){
        checkSelected($conn,$row[0],1);
    }

   
    //try the second choice
    // $row5=generateList($conn,1,$choixFiliere,2,$nbrMath,1);
    // $row6=generateList($conn,2,$choixFiliere,2,$nbrTec,1);
    // $row7=generateList($conn,3,$choixFiliere,2,$nbrPC,1);
    // $row8=generateList($conn,4,$choixFiliere,2,$nbrSVT,1);
    // $Glob=array_merge($row1,$row2,$row3,$row4);
    
    
    // ,$row5,$row6,$row7,$row8
    
    // $req3="SELECT etudiant.nom,etudiant.prenom,etudiant.CNE from Etudiant join choisir on (etudiant.id_etudiant=choisir.id_etudiant)
    // where etudiant.id_filiere=2 and choisir.id_choix_filiere=$choixFiliere and choisir.nbr_choix=1
    // ORDER BY etudiant.note_calculer limit $nbrTec" ;
    
    // $req2="SELECT etudiant.nom,etudiant.prenom,etudiant.CNE from Etudiant join choisir on (etudiant.id_etudiant=choisir.id_etudiant)
    // where etudiant.id_filiere=3 and choisir.id_choix_filiere=$choixFiliere and choisir.nbr_choix=1 
    // ORDER BY etudiant.note_calculer limit $nbrPC" ;
    
    // $req4="SELECT etudiant.nom,etudiant.prenom,etudiant.CNE from Etudiant join choisir on (etudiant.id_etudiant=choisir.id_etudiant)
    // where etudiant.id_filiere=4 and choisir.id_choix_filiere=$choixFiliere and choisir.nbr_choix=1 
    // ORDER BY etudiant.note_calculer limit $nbrSVT" ;
    // echo "<br>";
    // $result1= $conn->query($req1);
    // $result2 = $conn->query($req2);
    // $result3 = $conn->query($req3);
    // $result4 = $conn->query($req4);
    // if ($result->rowCount() > 0){
        
        // $row2 = $result2->fetchAll();
        // $row3 = $result3->fetchAll();
        // $row4 = $result4->fetchAll();
        // $row=array_merge($row1,$row2);
            // var_dump($row1) ;
            // echo $row[0]."<br>";
        // for($i=0;$i<3;$i++){
        //     echo $row1[$i]."<br>";
        
        // }
        //  for($i=0;$i<3;$i++){
        //     echo $row2[$i]."<br>";
        
        // }
        //  for($i=0;$i<3;$i++){
        //      for($j=0;$j<3;$j++){
        //     echo $row[$i][$j]."<br>";
        //      }echo "<br>";
        // }
        
    
// $pdf=new FPDF('p','mm','A4');
// $pdf->AddPage();
// // $pdf->SetMargins();
// $pdf->Image('images/pdfHeader.png');
// $pdf->setfont('Arial','I',16);
// $pdf->cell(1,5, 'Liste principale du filiere GI','C',0,1);//end of line


class PDF extends FPDF
{
// Page header
function header()
{
    // Logo
    $this->Image('images/pdfHeader.png',0,1);
    // Arial bold 15
    $this->SetFont('Arial','I',15);
    // Move to the right
    // $this->Cell(80,20,"",10,1);
    $this->Cell(80);
    // Title
    // Line break
    // $this->Ln(10);
}


// Colored table
function fancyTable($header, $data,$title)
{
    $this->SetFont('Arial','U');
    $this->Cell(-10,50,$title,0,1,'C');
    // Colors, line width and bold font
    $this->SetFillColor(99,190,160);
    $this->SetTextColor(0);
    $this->SetDrawColor(0,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(25, 45, 45,45);
    
    for($i=0;$i<count($header);$i++)
    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    $i=1;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,number_format($i),'LR',0,'C',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
        // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
        $i++;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
// Page footer
function footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class

$pdf = new PDF();
$pdf->SetMargins(25,10);
// Column headings GI PDF
if($GIprincipale!=null){
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $header = array('Num','Nom', 'Prenom', 'CNE');
    // sort($GIprincipale);
    // var_dump($GIprincipale);
    // array_multisort($GIprincipale,SORT_REGULA);
    // var_dump($GIprincipale);
    $pdf->fancyTable($header,$GIprincipale,'Liste principale du filiere Genie informatique');
    $pdf->AliasNbPages();
}

// Column headings TM PDF
if($TMprincipale!=null){
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $header = array('Num','Nom', 'Prenom', 'CNE');
    $pdf->fancyTable($header,$TMprincipale,'Liste principale du filiere Technique de management');
    $pdf->AliasNbPages();
}

// Column headings GIM PDF
if($GIMprincipale!=null){
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $header = array('Num','Nom', 'Prenom', 'CNE');
    $pdf->fancyTable($header,$GIMprincipale,'Liste principale du filiere Genie Industriel et Maintenance');
    $pdf->AliasNbPages();
}

// Column headings TIMQ PDF
if($TIMQprincipale!=null){
    $pdf->AddPage();
    $header = array('Num','Nom', 'Prenom', 'CNE');
    $pdf->SetFont('Times','',12);
    $pdf->fancyTable($header,$TIMQprincipale,'principale du filiere Techniques Instrumentales et Management de la Qualite');
    $pdf->AliasNbPages();
}
selected0($conn); 
$pdf->Output();
}

?>
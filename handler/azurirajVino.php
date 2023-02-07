<?php
 require '../konekcija.php';
 require '../model/vino.php';
 require '../model/tip.php';


 if(isset($_POST['idKnjige']) && isset($_POST['idZanra']) && isset($_POST['nazivVina']) && isset($_POST['kolicina']) && isset($_POST['cena']) && isset($_POST['tipId'])){
  $vinoId=$_POST['idKnjige'];
  $nazivVina=$_POST['nazivVina'];
  $kolicina=$_POST['kolicina'];
  $cena=$_POST['cena'];
  $tipId=$_POST['tipId'];


  $vino=new Vino($vinoId,$nazivVina,$kolicina,$cena,$tipId);
  $rezultat=$vino->update($conn);
  
  if($rezultat){
    echo 'Ok';
 }else{ 
   echo 'No';
   echo $status;
 }
 } 
  ?>
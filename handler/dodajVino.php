<?php
 require '../konekcija.php';
 require '../model/vino.php';


 if(isset($_POST['nazivVina']) && isset($_POST['kolicina']) && isset($_POST['cena']) && isset($_POST['tipId'])){
  $vino = new Vino(null,$_POST['nazivVina'],$_POST['kolicina'],($_POST['cena']),($_POST['tipId']));
  $rez=$vino->insert($conn);
  
  if($rez){ //ako vrati objekat
    echo 'Ok';
 }else{ 
   echo 'No';
 }
 } 
  ?>
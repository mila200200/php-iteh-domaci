<?php
 require '../konekcija.php';
 require '../model/vino.php';
 require '../model/tip.php';


 if(isset($_POST['vinoId']) && isset($_POST['tip'])&& isset($_POST['nazivVina']) && isset($_POST['kolicina']) ){
  $vinoId=$_POST['vinoId'];
  $nazivVina=$_POST['nazivVina'];
  $kolicina=$_POST['kolicina'];


  $vino=new Vino($vinoId,$nazivVina,$kolicina);
  $rezultat=$vino->update($conn);
  
  if($rezultat){
    echo 'Ok';
 }else{ 
   echo 'No';
   echo $status;
 }
 } 
  ?>
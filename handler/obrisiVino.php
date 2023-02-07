<?php
require '../konekcija.php';
require '../model/vino.php';

    $id =$_POST['id'];  //post id iz ajaxa smo poslali
    $vino = new Vino($id,null,null,null);
    if($vino->delete($conn,$id)){
      echo "Ok";
    }else{
      echo "No";
    }
 ?>
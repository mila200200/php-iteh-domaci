<?php
include 'konekcija.php';
include 'model/vino.php';
include 'model/tip.php';


session_start();

$user="";

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
if (isset($_COOKIE["admin"]))
    {
        $user=$_COOKIE["admin"];
    }
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vinarije Srbije</title>

    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

    <link href="css/main.css" rel="stylesheet">
</head>

<body class="stranica" style="background-color: #EFB9AD ; margin-bottom:100px">
   
    <nav class="navbar navbar-expand-lg navbar-light" id="navCont" style="height:80px;background-color: #A2484F; ">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <a class="navbar-brand " href="index.php"style="color:white ; margin-top:10px ;font-size:29px">Vinarije Srbije</a>
                <div class="navbar-nav p-lg-0 " style="margin-left: 54%; color:white ; ">
                    <li><a id="btn-Pocetna" href="index.php" type="button" class="btn btn-success btn-block" style="margin-top:-60px; background-color: #CB918D;margin-left:18px ; margin-right:18px ">
                        Početna</a></li>
                    <li><a id="btn-Dodaj" type="button" class="btn btn-success btn-block"  data-toggle="modal" data-target="#my" style="margin-top:-60px; background-color: #CB918D; margin-left:18px ; margin-right:18px">
                        Dodaj novo vino</a></li>
                    <li><a id="btn-Prikazi" href="pogledajVina.php" type="button" class="btn btn-success btn-block"style="margin-top:-60px; background-color: #CB918D;margin-left:18px; margin-right:18px">
                        Pogledaj vina</a></li>
                    <li><a id="btn-Pocetna" href="odjava.php" type="button" class="btn btn-success btn-block" style="background-color:#EFB9AD; color:white; margin-left:60px; margin-top:-60px">
                    Odjavi se</a> </li>
                </div>
                
            </div>
        </nav>

        <div id="ww"style="background-color:#EFB9AD" >
        <div class="container"style="background-color: none" >
            <div class="row">
                <div class="deoslika" style="background-color: #A2484F; margin-top:40px ;">
                    <img src="https://pennsylvaniawine.com/wp-content/uploads/2020/07/WEB_PicnicSpreads.jpg" alt="pocetna" class="slikaPocetna"
                    style="width: 1170px; height:550px; align:center">
                    <h2 style="color:white ; text-align: center; padding-bottom:18px "> Duša bez vina kratkog je daha - Heraklit</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="my" role="dialog" >
        <div class="modal-dialog">
            
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="dodajForm">
                            <h3 style="color: #A2484F; text-align: center;font-size:25px">Dodaj novo vino</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label style="color:#EFB9AD;font-size:18px" for="">Naziv vina</label>
                                        <input type="text" style="border: 1px solid #A2484F" name="nazivVina" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label style="color:#EFB9AD;font-size:18px" for="">Kolicina</label>
                                        <input type="text" style="border: 1px solid #A2484F" name="kolicina" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label style="color:#EFB9AD ;font-size:18px" for="">Cena</label>
                                        <input type="text" style="border: 1px solid #A2484F " name="cena" class="form-control" />
                                    </div>
                                    <div class="form-group" >
                                        <select style="color:#EFB9AD ;font-size:18px ;font-weight:bold" id="tipId" name="tipId" class="form-control">
                                            <?php
                                            $rez = $conn->query("SELECT * from tip");
                                            while ($red = $rez->fetch_array()) {
                                            ?>
                                                <option  name="value" value="<?php echo $red['tipId'] ?>"> <?php echo $red['nazivTipa'] ?></option>
                                            <?php  }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success btn-block" style="background-color:#EFB9AD ; color:white ; font-weight:bold; padding-top:10px; font-size:17px">
                                        Dodaj vino</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="container pt" style="margin-top:550px">
    <div id="searchDiv" >
        <label for="pretraga"style="color:white;font-weight:400px ;font-size:25px">Pretraži vina za odabrani tip</label>
        <select id="pretraga" onchange="pretraga()" class="form-control" style="color:#EFB9AD; font-weight:bold ;font-size:20px ;" >
            <?php
            $rez = $conn->query("SELECT * from tip");
            while ($red = $rez->fetch_assoc()) {
            ?>
                <option style="color:#EFB9AD; font-weight:bold ;font-size:20px ;" 
                value="<?php echo $red['tipId'] ?>"> <?php echo $red['nazivTipa'] ?></option>
            <?php   }
            ?>
        </select>
    </div>


    <div id="podaciPretraga"style="font-weight:bold ;font-size:20px ; margin-top:-80px" ></div>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function pretraga() {
            $.ajax({
                url: "handler/pretragaVina.php",
                data: {
                    tipId: $("#pretraga").val()
                },
                success: function(html) {
                    $("#podaciPretraga").html(html);
                }
            })
        }
    </script>



</body>
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

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link href="css/main.css" rel="stylesheet">
</head>

<body class="stranica" style="background-color: #EFB9AD ; margin-bottom:800px">
   
    <nav class="navbar navbar-expand-lg navbar-light" id="navCont" style="height: 80px;background-color: #A2484F;">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <a class="navbar-brand" href="index.php"style="color:white ;">Vinarije Srbije</a>
                <h6 id="por" style="font-weight: 400;  margin-left:20px; border-radius: 5px; padding: 10px; background-color: #CB918D; color:aliceblue">ULOGOVAN: <?= $user;?></h6>
                <div class="navbar-nav p-lg-0" style="margin-left: 22%; padding-top: 4%;">
                    <li><a id="btn-Pocetna" href="index.php" type="button" class="btn btn-success btn-block">Početna</a></li>
                    <li><a id="btn-Dodaj" type="button" class="btn btn-success btn-block"  data-toggle="modal" data-target="#my">Dodaj novo vino</a></li>
                    <li><a id="btn-Prikazi" href="pogledajVina.php" type="button" class="btn btn-success btn-block">Pogledaj vina</a></li>
                </div>
                <div>
                    <a class="btn btn-danger" href="odjava.php" style="margin-left: 100px; ">Odjavi se</a>
            </div>
            </div>
        </nav>

        <div id="ww"style="background-color:#EFB9AD" >
        <div class="container"style="background-color: none" >
            <div class="row">
                <div class="deoslika" style="background-color: #A2484F; margin-top:50px ;">
                    <img src="https://pennsylvaniawine.com/wp-content/uploads/2020/07/WEB_PicnicSpreads.jpg" alt="pocetna" class="slikaPocetna"
                    style="width: 1100px; height:550px; align:center">
                    <h2 style="color:white ; text-align: center; padding-bottom:20px "> Duša bez vina kratkog je daha - Heraklit</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="my" role="dialog" style="margin-top:500px">
        <div class="modal-dialog">
            
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="dodajForm">
                            <h3 style="color: black; text-align: center">Dodaj novo vino</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label for="">Naziv vina</label>
                                        <input type="text" style="border: 1px solid black" name="naziv" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tip vina</label>
                                        <input type="text" style="border: 1px solid black" name="tip" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <select id="tipId" name="tipId" class="form-control">
                                            <?php
                                            $rez = $conn->query("SELECT * from tip");
                                            while ($red = $rez->fetch_array()) {
                                            ?>
                                                <option name="value" value="<?php echo $red['tipId'] ?>"> <?php echo $red['nazivTipa'] ?></option>
                                            <?php  }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success btn-block" tyle="background-color: orange; border: 1px solid black;">Dodaj</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="container pt" style="margin-top:600px">
    <div id="searchDiv" >
        <label for="pretraga"style="color:white; padding-bottom:20px ;font-weight:400px ;font-size:25px">Pretraži vina za odabrani tip</label>
        <select id="pretraga" onchange="pretraga()" class="form-control" style="color:#EFB9AD; font-weight:400px ;font-size:25px background-color:aqua" >
            <?php
            $rez = $conn->query("SELECT * from tip");
            while ($red = $rez->fetch_assoc()) {
            ?>
                <option value="<?php echo $red['tipId'] ?>"> <?php echo $red['nazivTipa'] ?></option>
            <?php   }
            ?>
        </select>
    </div>


    <div id="podaciPretraga"></div>
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
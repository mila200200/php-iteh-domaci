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

<body class="stranica" style="background-color: #CB918D ; margin-bottom:800px">
   
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

        <div id="ww"style="background-color: #CB918D" >
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



</body>
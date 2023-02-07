<?php
include 'konekcija.php';
include 'model/vino.php';
include 'model/tip.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php          
if (isset($_POST['tip'])) {
  $icko = $_POST['tip'];
}
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
</head>

<body class="stranica" style="background-color: #EFB9AD ; margin-bottom:100px" >
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

    <!--lista svih vina -->
 
  <div class="container pt">
    <?php
    $niz = [];
    $rez = $conn->query("select * from vino v join tip t on v.tipId=t.tipId");
    while ($red = $rez->fetch_array()) {
      $Tip = new Tip($red['tipId'], $red['nazivTipa']);
      $vino = new Vino($red['vinoId'], $red['nazivVina'], $red['kolicina'],$red['cena'], $Tip);
      array_push($niz, $vino);
    }
    ?>
    <p id="p">Lista svih vina</p>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Naziv vina</th>
          <th>Kolicina vina</th>
          <th>Cena</th>
          <th>Tip vina</th>
          <th>Obrisi</th>
          <th>Izmeni</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($niz as $vrednost) {
        ?>
          <tr>
            <td style="display:none" data-target="tipId"><?php echo $vrednost->tipId->tipId?></td>
            <td data-target="nazivVina"><?php echo $vrednost->nazivVina ?> </td>
            <td data-target="kolicina"><?php echo $vrednost->kolicina ?> </td>
            <td data-target="cena"><?php echo $vrednost->cena ?> </td>
            <td data-target="tipId"><?php echo $vrednost->tipId->nazivTipa ?></td>
            <td><button id="btnObrisi" name="btnObrisi" class="btn btn-danger" data-id1="<?php echo $vrednost->vinoId ?>">Obrisi</a></td>
            <td><button class="btn btn-info" data-toggle="modal" data-target="#my1" data-id2="<?php echo $vrednost->vinoId ?>">Izmeni</a></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

  </div>

<!--kartica za izmenu -->
<div class="modal fade" id="my1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="container prijava-form">
            <form action="#" method="post" id="izmeniForma">


              <h3 style="color: black; text-align: center">Izmeni podatke o vinu</h3>
              <div class="row">
                <div class="col-md-11 ">

                  <div style="display: none;" class="form-group">
                    <label for="">vinoId</label>
                    <input  id="vinoId" type="text" style="border: 1px solid black" name="vinoId" class="form-control" />
                  </div>

                  <div class="form-group" style="display: none;">
                    <label for="">tipId</label>
                    <input id="tipId"  type="text" style="border: 1px solid black" name="tip" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label for="">Naziv vina</label>
                    <input id="nazivVina" type="text" style="border: 1px solid black" name="nazivVina" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label for="">Kolicina</label>
                    <input id="kolicina" type="text" style="border: 1px solid black" name="kolicina" class="form-control" />
                  </div>
                 
                  <div class="form-group">
                    <button id="btnIzmeni" type="submit" class="btn btn-success btn-block" tyle="background-color: orange; border: 1px solid black;">Izmeni</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

  </div>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    
    
</body>

</html>
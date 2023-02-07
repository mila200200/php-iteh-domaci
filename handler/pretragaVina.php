<?php
    require '../konekcija.php';
    require '../model/tip.php';
    require '../model/vino.php';

    if(isset($_GET['tipId']))
    {
        $id = mysqli_real_escape_string($conn,$_GET['tipId']);
        $niz = [];
        $rez = $conn->query("select * from vino where tip=$id");
       // $rez = $conn->query("select * from vino where tip=$id") or die($conn->error);
        while($red=$rez->fetch_assoc()):
        $vina = new Vino($red['vinoId'],$red['nazivVina'],$red['cena'],$id);
        array_push($niz,$vina);
        endwhile;
    ?>
    <table class="table table-hover" >
    <thead>
        <tr>
            <th scope="col">Naziv vina</th>
            <th scope="col">cena vina</th>
        </tr>
    </thead>
    <tbody>
        <?php echo "<br>"?>
        <?php echo "<br>"?>
        <?php echo "<br>"?>
        <?php echo "<br>"?>
        <?php
        foreach($niz as $vrednost):
            ?>
                <tr>
                <td> <?php echo $vrednost->nazivVina  ?></td>
              <td><?php echo $vrednost->cena ?>  </td>
                </tr>
            <?php
        endforeach;
        ?>
    </tbody>
    </table>
    <?php
    }else{
    echo("Molimo vas da prosledite tip za koji želite vina.");
    }
 ?>
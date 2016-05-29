<?php require_once 'header.php' ?>
<?php require 'functions.php' ?>

<?php
if (isset($_GET['woid'])) {
    $woid = $_GET['woid'];
}

$sql_result = getAllFromWoning($woid, $conn);

?>

<div id="main">
    <?php
    while ($row = mysqli_fetch_assoc($sql_result)) {
        ?>
        <div id="adresgegevens">
            <div class="head"><?php echo $row['address'] ?></div>
            <div class="adres"><?php echo $row['pc'] . " " . $row['city'] ?></div>
            <div class="prijs"><?php echo $row['vraagprijs'] ?></div>
            <div class="prijs">Geplaatst op: <?php echo $row['plaatsingdatum']?></div>
        </div>

        <div id="details">
            <ul>
                <li><a href="detail.php?woid=<?php echo $woid ?>" class="licht">Overzicht</a></li>
                <li><a href="omschrijving.php?woid=<?php echo $woid ?>" class="licht">Omschrijving</a></li>
                <li><a href="kenmerken.php?woid=<?php echo $woid ?>" class="active">Kenmerken</a></li>
                <li><a href="hypotheek.php?woid=<?php echo $woid ?>" class="licht">Hypotheek</a></li>
                <li><a href="afspraak.php?woid=<?php echo $woid ?>" class="licht">Afspraak makelaar</a></li>

            </ul>
            <div class="content">
                <table class="kenmerken">
                    <tr>
                        <th colspan="2">Kenmerken</th>
                    </tr>
                    <tr>
                        <td class="kop">Addres</td>
                        <td><?php echo $row['address'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Postcode</td>
                        <td><?php echo $row['pc'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Plaats</td>
                        <td><?php echo $row['city'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Vraagprijs</td>
                        <td><?php echo $row['vraagprijs'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Soort object</td>
                        <td><?php echo $row['soortobject'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Soort woning</td>
                        <td><?php echo $row['soortwoning'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Type woning</td>
                        <td><?php echo $row['typewoning'] ?></td>
                    </tr><tr>
                        <td class="kop">Soortbouw</td>
                        <td><?php echo $row['soortbouw'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Ligging1</td>
                        <td><?php echo $row['ligging1'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Ligging2</td>
                        <td><?php echo $row['ligging2'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Ligging3</td>
                        <td><?php echo $row['ligging3'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Ligging4</td>
                        <td><?php echo $row['ligging4'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Ligging5</td>
                        <td><?php echo $row['ligging5'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Ligging6</td>
                        <td><?php echo $row['ligging6'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Ligging7</td>
                        <td><?php echo $row['ligging7'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Ligging8</td>
                        <td><?php echo $row['ligging8'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Bouwjaar</td>
                        <td><?php echo $row['bouwjaar'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Tuinaanwezig</td>
                        <td><?php
                            if ($row['tuinaanwezig'] == 1){
                                echo "Ja";
                            }else{
                                echo "Nee";
                            }?>
                        a</td>
                    </tr>
                    <tr>
                        <td class="kop">Tuinoppervlakte</td>
                        <td><?php echo $row['tuinoppervlakte'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Status</td>
                        <td><?php echo $row['status'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Woonoppervlakte</td>
                        <td><?php echo $row['woonoppervlakte'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Inhoud in m<sup>3</sup></td>
                        <td><?php echo $row['inhoud'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Aantal badkamers</td>
                        <td><?php echo $row['aantalbadkamers'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Aantal kamers</td>
                        <td><?php echo $row['aantalkamers'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Aantal woonlagen</td>
                        <td><?php echo $row['aantalwoonlagen'] ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Perceeloppervlakte in m<sup>2</sup></td>
                        <td><?php echo $row['perceeloppervlakte'] ?></td>
                    </tr>

                </table>
            </div>
        </div>
        <?php
    }
    ?>
</div>
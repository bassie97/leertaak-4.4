<?php
/**
 * Created by PhpStorm.
 * User: Bas de Ruiter
 * Date: 29-5-2016
 * Time: 21:43
 */
require_once 'header.php';
require 'functions.php';

if (isset($_GET['woid'])) {
    $woid = $_GET['woid'];
}

$sql_result = getAllFromWoning($woid, $conn);

?>

<div id="main">
    <?php
    while ($row = mysqli_fetch_assoc($sql_result)) {
        $koopsom = $row['vraagprijs'];
        $kosten_koper = $koopsom * 0.02;
        ?>
        <div id="adresgegevens">
            <div class="head"><?php echo $row['address'] ?></div>
            <div class="adres"><?php echo $row['pc'] . " " . $row['city'] ?></div>
            <div class="prijs"><?php echo $row['vraagprijs'] ?></div>
            <div class="prijs">Geplaatst op: <?php echo $row['plaatsingdatum'] ?></div>
        </div>

        <div id="details">
            <ul>
                <li><a href="detail.php?woid=<?php echo $woid ?>" class="licht">Overzicht</a></li>
                <li><a href="omschrijving.php?woid=<?php echo $woid ?>" class="licht">Omschrijving</a></li>
                <li><a href="kenmerken.php?woid=<?php echo $woid ?>" class="licht">Kenmerken</a></li>
                <li><a href="hypotheek.php" class="active">Hypotheek</a></li>
                <li><a href="afspraak.php?woid=<?php echo $woid ?>" class="licht">Afspraak makelaar</a></li>

            </ul>

            <div class="content">
                <table class="kenmerken">
                    <tr>
                        <th colspan="2">Wat kost een droomhuis?</th>
                    </tr>
                    <tr>
                        <td colspan="2">Je hebt je droomhuis op Funda gevonden. Dit is de eerste stap naar de aankoop van je nieuwe huis. Hieronder zie je het bedrag wat je nodig zal hebben voor je droomhuis.</td>
                    </tr>
                    <tr>
                        <td class="kop">Koopsom huis:</td>
                        <td>€<?php echo $koopsom ?></td>
                    </tr>
                    <tr>
                        <td class="kop">Inschatting kosten koper:</td>
                        <td>€<?php echo $kosten_koper ?></td>
                    </tr>
                    <tr>
                        <td class="totaal">TOTAAL:</td>
                        <td class="totaal">€<?php echo $koopsom + $kosten_koper ?></td>
                    </tr>
                    <tr>
                        <td class="totaal">Maandlasten:</td>
                        <td class="totaal">€<?php echo ($koopsom + $kosten_koper)/30 ?> p.m.</td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
    }
    ?>
</div>
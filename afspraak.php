<?php
/**
 * Created by PhpStorm.
 * User: Bas de Ruiter
 * Date: 29-5-2016
 * Time: 22:17
 */

require_once 'header.php';
require 'functions.php';

if (isset($_GET['woid'])) {
    $woid = $_GET['woid'];
}

$sql_result = getMakelaarForWoid($woid, $conn);
while ($row = mysqli_fetch_assoc($sql_result)) {
$mkid = $row['mkid'];
$afspraken = array();
$query = "SELECT * FROM afspraak WHERE MKID = '$mkid' AND van > NOW()";
$result = mysqli_query($conn, $query);

while ($afspraak = mysqli_fetch_array($result)) {
    $afspraken[] = $afspraak['van'];
}

$aantal_mogelijkheden = 0;
$datetime = new DateTime('tomorrow');
$datetime->modify("+9 hours");
$mogelijkheden = array();
while ($aantal_mogelijkheden < 5) {
    if (!in_array(date_format($datetime, 'Y-m-d H:i:s'), $afspraken)) {
        $mogelijkheden[] = date_format($datetime, 'Y-m-d H:i:s');
        $aantal_mogelijkheden++;
    }
    if (date_format($datetime, 'H:i:s') == '16:30:00') {
        $datetime->modify("+990 minutes");
    } else {
        $datetime->modify("+30 minutes");
    }
}

if (isset($_POST['submit'])) {
    $starttijd_string = $_POST['tijden'];
    $starttijd = new DateTime ($starttijd_string);
    $eindtijd = new DateTime ($_POST['tijden']);
    $eindtijd->modify("+30 minutes");
    $eindtijd_string = date_format($eindtijd, 'Y-m-d H:i:s');

    $query = "INSERT INTO afspraak (mkid, woid, van, tot) VALUES ('$mkid', '$woid', '$starttijd_string', '$eindtijd_string')";
    mysqli_query($conn, $query);
    $makelaar = $row['name'];
    $bevestiging = "U heeft een afspraak gepland met $makelaar' op " . date_format($starttijd, 'd-m-Y') . " om " . date_format($starttijd, 'H:i') . " tot " . date_format($eindtijd, 'H:i');
}
?>

<div id="main">
    <div id="details">
        <ul>
            <li><a href="detail.php?woid=<?php echo $woid ?>" class="licht">Overzicht</a></li>
            <li><a href="omschrijving.php?woid=<?php echo $woid ?>" class="licht">Omschrijving</a></li>
            <li><a href="kenmerken.php?woid=<?php echo $woid ?>" class="licht">Kenmerken</a></li>
            <li><a href="hypotheek.php?woid=<?php echo $woid ?>" class="licht">Hypotheek</a></li>
            <li><a href="afspraak.php?woid=<?php echo $woid ?>" class="active">Afspraak makelaar</a></li>
        </ul>
        <div class="content">
            <table class="kenmerken">
                <tr>
                    <th colspan="2">Maak een afspraak met de makelaar</th>
                </tr>
                <tr>
                    <th colspan="2">Adresgegevens makelaar:</th>
                </tr>
                <tr>
                    <td class="kop">Naam</td>
                    <td><?php echo $row['name'] ?></td>
                </tr>
                <tr>
                    <td class="kop">Adres</td>
                    <td><?php echo $row['address'] ?></td>
                </tr>
                <tr>
                    <td class="kop">Postcode</td>
                    <td><?php echo $row['pc'] ?></td>
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
                    <td class="kop">Telefoon</td>
                    <td><?php echo $row['phone'] ?></td>
                </tr>
                <tr>
                    <th colspan="2">Plan afspraak:</th>
                </tr>
                <tr>
                    <td>
                        <?php
                        if (isset($bevestiging)) {
                            echo $bevestiging;
                        } else {
                        ?>
                        Maak een afspraak met <?php echo $row['name']; ?>
                    </td>
                    <td>
                        <form action="?woid=<?php echo $woid; ?>" method="post">
                            <select name='tijden'>
                                <?php
                                foreach ($mogelijkheden as $tijdstip) {
                                    $starttijd = new DateTime($tijdstip);
                                    $eindtijd = new DateTime($tijdstip);
                                    $eindtijd = $eindtijd->modify("+30 minutes");
                                    echo "<option value='$tijdstip'>" . date_format($starttijd, 'd-m-Y H:i') . " tot " . date_format($eindtijd, 'd-m-Y H:i') . "</option>";
                                }
                                ?>
                            </select>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <input type='submit' name='submit' value='Plan afspraak'>
                        </form>
                        <?php } ?>
                    </th>
                </tr>
            </table>
        </div>
    </div>
    <?php
    }
    ?>
</div>

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
print_r($sql_result);
?>

<div id="main">
    <?php
    while ($row = mysqli_fetch_assoc($sql_result)) {
        ?>
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
                    <form method="POST" action="confirm.php">
                        <tr>
                            <td></td>
                            <?php
//                            createAppointmentList($mkid, $conn);
                            ?>
                        </tr>


                    </form>

                </table>
            </div>
        </div>
        <?php
    }
    ?>
</div>

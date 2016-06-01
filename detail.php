<?php require_once 'header.php' ?>
<?php require 'functions.php' ?>

<?php
session_start();

if (isset($_GET['woid'])) {
    $woid = $_GET['woid'];
}

$sql_result = getWoning($woid, $conn);

?>

<div id="main">
    <?php
    while ($row = mysqli_fetch_assoc($sql_result)) {
        ?>
        <div id="adresgegevens">
            <div class="head"><?php echo $row['Address']?></div>
            <div class="adres"><?php echo $row['PC'] . " " . $row['City'] ?></div>
            <div class="prijs"><?php echo $row['Vraagprijs'] ?></div>
        </div>

        <div id="details">
            <ul>
                <li><a href="detail.php?woid=<?php echo $woid ?>" class="active">Overzicht</a></li>
                <li><a href="omschrijving.php?woid=<?php echo $woid ?>" class="licht">Omschrijving</a></li>
                <li><a href="kenmerken.php?woid=<?php echo $woid ?>" class="licht">Kenmerken</a></li>
                <li><a href="hypotheek.php?woid=<?php echo $woid ?>" class="licht">Hypotheek</a></li>
                <li><a href="afspraak.php?woid=<?php echo $woid ?>" class="licht">Afspraak makelaar</a></li>

            </ul>

            <div class="content">
                <?php
                $str_to_display = $row['omschrijving'];
                $str_to_display = implode(' ', array_slice(explode(' ', $str_to_display), 0, 30));
                $str_to_display .= "...<a href=omschrijving.php?woid=" . $woid . ">Volledige omschrijving</a>";
                echo $str_to_display;

                ?>
                <table class="kenmerken">
                    <tr>
                        <th colspan="2">Kenmerken</th>
                    </tr>

                    <tr>
                        <td class="kop">Soort appartement</td>
                        <td>Gallerij</td>
                    </tr>
                    <tr>
                        <td class="kop">Soort appartement</td>
                        <td>Gallerij</td>
                    </tr>
                    <tr>
                        <td class="kop">Soort appartement</td>
                        <td>Gallerij</td>
                    </tr>
                    <tr>
                        <td class="kop">Soort appartement</td>
                        <td>Gallerij</td>
                    </tr>
                    <tr>
                        <td class="kop">Soort appartement</td>
                        <td>Gallerij</td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
    }
    ?>
</div>


</body></html>




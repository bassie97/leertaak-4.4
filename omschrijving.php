<?php
require_once 'header.php';
require 'functions.php';

if (isset($_GET['woid'])) {
    $woid = $_GET['woid'];
}

$sql_result = getWoning($woid, $conn);

?>
<div id="main">
    <div id="details">
        <ul>
            <li><a href="detail.php?woid=<?php echo $woid ?>" class="active">Overzicht</a></li>
            <li><a href="omschrijving.php?woid=<?php echo $woid ?>" class="licht">Omschrijving</a></li>
            <li><a href="kenmerken.php?woid=<?php echo $woid ?>" class="licht">Kenmerken</a></li>
            <li><a href="hypotheek.html" class="licht">Hypotheek</a></li>
            <li><a href="afspraak.html" class="licht">Afspraak makelaar</a></li>
        </ul>
        <div class="content">
            <table class="kenmerken">
                <tr>
                    <td>
                        <?php
                        while ($row = mysqli_fetch_assoc($sql_result)) {
                            echo $row['omschrijving'];
                            echo "<a href=kenmerken.php?woid=" . $woid . ">Alle kenmerken van " . $row['Address'] . "</a>";
                        }

                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body></html>

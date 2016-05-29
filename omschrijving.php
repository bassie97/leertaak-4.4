<?php
require_once 'header.php';
require 'functions.php';

if (isset($_GET['woid'])) {
    $woid = $_GET['woid'];
}

$sql_result = getWoning($woid, $conn);

?>
<div style="border: solid gray 1px; width: 600px; padding: 6px; margin-left: 30px;">
    <?php
    while ($row = mysqli_fetch_assoc($sql_result)) {
        echo $row['omschrijving'];
        echo "<a href=kenmerken.php?woid=" . $woid . ">Alle kenmerken van " . $row['Address'] . "</a>";
    }

    ?>
</div>

</body></html>

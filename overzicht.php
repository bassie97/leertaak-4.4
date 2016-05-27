<?php require_once 'header.php' ?>
<?php require 'functions.php' ?>

<?php
session_start();

if (isset($_POST['submit'])) {
    $soort_bouw = $_POST['woning'];
    $straat_naam = $_POST['straatnaam'];
    $huis_nummer = $_POST['huisnummer'];
    $post_code = $_POST['postcode'];
    $plaats_naam = $_POST['plaatsnaam'];
    $_SESSION['soort_bouw'] = $soort_bouw;
    $_SESSION['straat_naam'] = $straat_naam;
    $_SESSION['huis_nummer'] = $huis_nummer;
    $_SESSION['post_code'] = $post_code;
    $_SESSION['plaats_naam'] = $plaats_naam;
}

$sql = "SELECT 
                wo.Address, 
                Vraagprijs,
                wo.PC, 
                wo.City, 
                AantalKamers, 
                WoonOppervlakte,
                mkantoor.name
              FROM wo 
              JOIN mkantoor
              ON wo.mkid = mkantoor.mkid
              WHERE SoortBouw 
              LIKE '%$soort_bouw%' 
              AND wo.Address 
              LIKE '%$straat_naam%' 
              AND wo.PC 
              LIKE '%$post_code%' 
              AND wo.City 
              LIKE '%$plaats_naam%' 
              AND wo.Address 
              LIKE '%$huis_nummer%'";
$sql_result = mysqli_query($conn, $sql);

?>

<div id="txt">
    <?php
    getAmountOfHouses($sql_result);
    ?>
</div>

<div id="main">
    <?php
    $search_query = "U heeft gezocht op: ";
    if (isset($soort_bouw)) {
        $sql = "SELECT name
              FROM soortbouw
              WHERE id = '$soort_bouw'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $search_query .= " " . $row['name'];
            }
        }
    }

    if (isset($plaats_naam)) {
        $search_query .= " " . $plaats_naam;
    }

    if (isset($straat_naam)) {
        $search_query .= " " . $straat_naam;
    }

    if (isset($huis_nummer)) {
        $search_query .= " " . $huis_nummer;
    }

    if (isset($post_code)) {
        $search_query .= " " . $post_code;
    }

    ?>
    <div id="search_query">
        <?php echo $search_query; ?>
    </div>
    <table>
        <tr>
            <td id="data" valign="top">
                <div class="head">Prijsklasse van</div>
                <input type="range" id="myRangeVan" min="0" max="10000000" step="1000" value="0" oninput="showValVan();"
                       onmouseup="getResults()">
                <br/>
                <div id="van">€0</div>
                <h4>Tot:</h4>
                <br/>
                <input type="range" id="myRangeTot" min="0" max="10000000" step="1000" value="0" oninput="showValTot()"
                       ; onmouseup="getResults()">
                <br/>
                <div id="tot">€0</div>
                <br/>

                <div class="head">Soort object</div>
                <div class="content">
                    <a href="#" class="licht">Data</a>
                    <!-- DATA WEERGEVEN -->
                </div>

                <div class="head">Soort bouw</div>
                <div class="content">
                    <a href="#" class="licht">Data</a>
                    <!-- DATA WEERGEVEN -->
                </div>

                <div class="head">Aantal kamers</div>
                <div class="content">
                    <a href="#" class="licht">Data</a>
                    <!-- DATA WEERGEVEN -->
                </div>

                <div class="head">Woonoppervlakte</div>
                <div class="content">
                    <a href="#" class="licht">Data</a>
                    <!-- DATA WEERGEVEN -->
                </div>
            </td>

            <td valign="top" id="results">
                <?php
                if (mysqli_num_rows($sql_result) > 0) {
                    while ($row = mysqli_fetch_assoc($sql_result)) {
                        ?>
                        <div class="huisdata">
                            <div class="head"><a class="normal" href="detail.html"><?php echo $row['Address'] ?></a>
                            </div>
                            <div class="prijs">€ <?php echo $row['Vraagprijs'] ?> k.k.</div>
                            <br/>
                            <span class="adres"><?php echo $row['PC'] . " " . $row['City'] ?>
                                <br/><?php echo $row['WoonOppervlakte'] . "m" ?>
                                <sup>2</sup> - <?php echo $row['AantalKamers'] . " kamers" ?></span><br/>
                            <span><a class="makelaar" href="makelaar.html"><?php echo $row['name']?></a></span>
                        </div>
                        <?php
                    }
                }?>
            </td>
        </tr>
    </table>

</div>
</body>
</html>
         

      



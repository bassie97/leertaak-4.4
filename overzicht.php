<?php require_once 'header.php' ?>
<?php require 'functions.php' ?>

<?php
session_start();

if (isset($_SESSION['exit'])){
    session_unset();
}
$_SESSION['exit'] = true;

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
                woid,
                wo.Address, 
                Vraagprijs,
                wo.PC, 
                wo.City, 
                AantalKamers, 
                WoonOppervlakte,
                wo.mkid
              FROM wo";
$arr1 = [];
if (!empty($soort_bouw)) {
    $arr1["SoortBouw"] = $soort_bouw;
}
if (!empty($straat_naam)) {
    $arr1["wo.Address"] = $straat_naam;
}
if (!empty($post_code)) {
    $arr1["wo.PC"] = $post_code;
}
if (!empty($plaats_naam)) {
    $arr1["wo.City"] = $plaats_naam;
}
if (!empty($huis_nummer)) {
    $arr1["wo.Address"] .= " " . $huis_nummer;
}

$sql = createQuery($arr1, $sql);
$amount_of_houses = getAmountOfHouses($sql, false, $conn);
$sql .= " LIMIT 15";
$sql_result = mysqli_query($conn, $sql);

?>

<div class="txt">
    <?php
    echo $amount_of_houses;
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
                    <select id="mySelectSoortObject" onchange="selectSoortObject()">
                        <?php
                        $sql1 = "SELECT id, name FROM soortobject;";
                        $result = mysqli_query($conn, $sql1);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value='<?php echo $row['id'] ?>'><?php echo $row['name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="head">Soort bouw</div>
                <div class="content">
                    <select id="mySelectSoortBouw" onchange="selectSoortBouw()">
                        <?php
                        $sql1 = "SELECT id, name FROM soortBouw;";
                        $result = mysqli_query($conn, $sql1);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value='<?php echo $row['id'] ?>'><?php echo $row['name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="head">Aantal kamers</div>
                    <select id="mySelectAantalKamers" onchange="selectAantalKamers()">
                        <?php
                        $sql1 = "SELECT MAX(`AantalKamers`) AS AantalKamers FROM wo;";
                        $result = mysqli_query($conn, $sql1);
                        print_r($result);
                        while ($row = mysqli_fetch_assoc($result)) {
                            for ($i = 0; $i <= $row['AantalKamers']; $i++){
                                ?>
                                <option value='<?php echo $i ?>'><?php echo $i ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="head">Woonoppervlakte van</div>
                <div class="content">
                    <input type="range" id="myRangeOppervlakteVan" min="0" max="1000" step="1" value="0" oninput="showValoppervlakteVan();"
                           onmouseup="getOppervlakte()">
                    <br/>
                    <div id="oppervlakteVan">0m<sup>2</sup></div>
                    <h4>Tot:</h4>
                    <br/>
                    <input type="range" id="myRangeOppervlakteTot" min="0" max="1000" step="1" value="0" oninput="showValoppervlakteTot();"
                           onmouseup="getOppervlakte()">
                    <br/>
                    <div id="oppervlakteTot">0m<sup>2</sup></div>
                </div>
            </td>

            <td valign="top" id="results">
                <div id="pagination">
                    <button onclick="pagination(0)" >Volgende 15</button>
                    <?php
                    if (mysqli_num_rows($sql_result) > 0) {
                        while ($row = mysqli_fetch_assoc($sql_result)) {
                            ?>
                            <div id="huisdata" class="huisdata">
                                <div class="head"><a class="normal" href="detail.php?woid=<?php echo $row['woid']?>"><?php echo $row['Address'] ?></a>
                                </div>
                                <div class="prijs">€ <?php echo $row['Vraagprijs'] ?> k.k.</div>
                                <br/>
                                <span class="adres"><?php echo $row['PC'] . " " . $row['City'] ?>
                                    <br/><?php echo $row['WoonOppervlakte'] . "m" ?>
                                    <sup>2</sup> - <?php echo $row['AantalKamers'] . " kamers" ?></span><br/>
                                <span><a class="makelaar" href="makelaar.html"><?php getMakelaar($row['mkid'], $conn) ?></a></span>
                            </div>
                            <?php
                        }
                    } ?>
                </div>
            </td>
        </tr>
    </table>

</div>
</body>
</html>
         

      



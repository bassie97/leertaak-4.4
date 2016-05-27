<?php require_once 'header.php' ?>
<?php require 'functions.php' ?>

<?php
if (isset($_POST['submit'])) {
    $soort_bouw = $_POST['woning'];
    $straat_naam = $_POST['straatnaam'];
    $huis_nummer = $_POST['huisnummer'];
    $post_code = $_POST['postcode'];
    $plaats_naam = $_POST['plaatsnaam'];
}

$sql = "SELECT 
                Address, 
                Vraagprijs,
                PC, 
                City, 
                AantalKamers, 
                WoonOppervlakte 
              FROM wo 
              WHERE SoortBouw 
              LIKE '%$soort_bouw%' 
              AND Address 
              LIKE '%$straat_naam%' 
              AND PC 
              LIKE '%$post_code%' 
              AND City 
              LIKE '%$plaats_naam%' 
              AND Address 
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
                <div class="head">Prijsklasse van/tot</div>
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


            <td valign="top">
                <div class="huisdata">
                    <div class="head"><a class="normal" href="detail.html">Bekemaheerd 22</a></div>
                    <div class="prijs">€ 135.000 k.k.</div>
                    <br/>
                    <span class="adres">9737 PT Groningen<br/>75 m<sup>2</sup> - 3 kamers</span><br/>
                    <span><a class="makelaar" href="makelaar.html">Hypodomus Groningen</a></span>
                </div>

                <div class="huisdata">
                    <div class="head"><a class="normal" href="detail.html">Bekemaheerd 22</a></div>
                    <div class="prijs">€ 135.000 k.k.</div>
                    <br/>
                    <span class="adres">9737 PT Groningen<br/>75 m<sup>2</sup> - 3 kamers</span><br/>
                    <span><a class="makelaar" href="makelaar.html">Hypodomus Groningen</a></span>
                </div>

                <div class="huisdata">
                    <div class="head"><a class="normal" href="detail.html">Bekemaheerd 22</a></div>
                    <div class="prijs">€ 135.000 k.k.</div>
                    <br/>
                    <span class="adres">9737 PT Groningen<br/>75 m<sup>2</sup> - 3 kamers</span><br/>
                    <span><a class="makelaar" href="makelaar.html">Hypodomus Groningen</a></span>
                </div>

                <div class="huisdata">
                    <div class="head"><a class="normal" href="detail.html">Bekemaheerd 22</a></div>
                    <div class="prijs">€ 135.000 k.k.</div>
                    <br/>
                    <span class="adres">9737 PT Groningen<br/>75 m<sup>2</sup> - 3 kamers</span><br/>
                    <span><a class="makelaar" href="makelaar.html">Hypodomus Groningen</a></span>
                </div>
            </td>
        </tr>
    </table>

</div>


</body></html>


         

      



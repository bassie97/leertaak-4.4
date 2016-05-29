<?php
/**
 * Created by PhpStorm.
 * User: Bas de Ruiter
 * Date: 27-5-2016
 * Time: 20:59
 */

require 'functions.php';

session_start();

$arr = [];
$limit = 15;

if (isset($_GET['page'])) {
    $page = intval($_GET['page']) + 1;
    $offset = $limit * $page;

    $_SESSION['page'] = $page;
    $_SESSION['offset'] = $offset;
} else {
    $page = 0;
    $offset = 0;
    $_SESSION['page'] = $page;
    $_SESSION['offset'] = $offset;
}

if (isset($_GET['van'])) {
    $van = intval($_GET['van']);
    $_SESSION['van'] = $van;
//    array_push($arr, "AND vraagprijs > " . $van . " ");
}

if (isset($_GET['tot'])) {
    $tot = intval($_GET['tot']);
    $_SESSION['tot'] = $tot;
}

if (isset($_GET['soort_object'])) {
    $soort_object = intval($_GET['soort_object']);
    $_SESSION['soort_object'] = $soort_object;
}

if (isset($_GET['aantal_kamers'])) {
    $aantal_kamers = intval($_GET['aantal_kamers']);
    $_SESSION['aantal_kamers'] = $aantal_kamers;
}

if (isset($_GET['oppervlakteVan'])) {
    $oppervlakteVan = intval($_GET['oppervlakteVan']);
    $_SESSION['oppervlakteVan'] = $oppervlakteVan;
}

if (isset($_GET['oppervlakteTot'])) {
    $oppervlakteTot = intval($_GET['oppervlakteTot']);
    $_SESSION['oppervlakteTot'] = $oppervlakteTot;
}

$soort_bouw = $_SESSION['soort_bouw'];
$straat_naam = $_SESSION['straat_naam'];
$post_code = $_SESSION['post_code'];
$plaats_naam = $_SESSION['plaats_naam'];
$huis_nummer = $_SESSION['huis_nummer'];

if (isset($_SESSION['page'])) {
    $page = intval($_SESSION['page']);
    $offset = intval($_SESSION['offset']);
}

if (isset($_GET['soort_bouw'])) {
    $soort_bouw = intval($_GET['soort_bouw']);
    $_SESSION['soort_bouw'] = $soort_bouw;
}

if (isset($_SESSION['soort_object'])) {
    $soort_object = $_SESSION['soort_object'];
    array_push($arr, "AND soortobject = " . $soort_object . " ");
}
if (isset($_SESSION['van'])) {
    $van = $_SESSION['van'];
    array_push($arr, "AND vraagprijs > " . $van . " ");
}
if (isset($_SESSION['tot'])) {
    $tot = $_SESSION['tot'];
    array_push($arr, "AND vraagprijs < " . $tot . " ");
}

if (isset($_SESSION['aantal_kamers'])) {
    $aantal_kamers = $_SESSION['aantal_kamers'];
    array_push($arr, "AND aantalkamers = " . $aantal_kamers . " ");
}

if (isset($_SESSION['oppervlakteVan'])) {
    $oppervlakteVan = $_SESSION['oppervlakteVan'];
    array_push($arr, "AND woonoppervlakte > " . $oppervlakteVan . " ");
}

if (isset($_SESSION['oppervlakteTot'])) {
    $oppervlakteTot = $_SESSION['oppervlakteTot'];
    array_push($arr, "AND woonoppervlakte < " . $oppervlakteTot . " ");
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "funda_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
                woid,
                wo.Address, 
                Vraagprijs,
                wo.PC, 
                wo.City, 
                AantalKamers, 
                WoonOppervlakte,
                mkid
              FROM wo
              WHERE SoortBouw 
              LIKE '%$soort_bouw%' 
              AND wo.Address 
              LIKE '%$straat_naam%' 
              AND wo.PC 
              LIKE '%$post_code%' 
              AND wo.City 
              LIKE '%$plaats_naam%' 
              AND wo.Address 
              LIKE '%$huis_nummer%' ";
if (count($arr) > 0) {
    foreach ($arr as $value) {
        $sql .= $value;
    }
}

$amount = getAmountOfHouses($sql, true, $conn);

$sql .= " LIMIT " . $limit . " OFFSET " . $offset;
print_r($sql);
$sql_result = mysqli_query($conn, $sql);
$rec_count = mysqli_num_rows($sql_result);

$left_rec = $rec_count - ($page * $limit);

echo "<div id=pagination>";
if ($page > 0) {
    $last = $page - 2;
    echo "<button onclick='pagination($last)'>Vorige 15</button>";
    echo "<button onclick='pagination($page)'>Volgende 15</button>";
} else if ($page == 0) {
    echo "<button onclick='pagination($page)'>Volgende 15</button>";
} else if ($left_rec < $limit) {
    $last = $page - 2;
    echo "<button onclick='pagination($last)'>Vorige 15</button>";
}

if ($rec_count > 0) {
    echo "<div class=txt>
            $amount
        </div>";
    while ($row = mysqli_fetch_assoc($sql_result)) {
        ?>
        <div class="huisdata">
            <div class="head"><a class="normal" href="detail.php?woid=<?php echo $row['woid'] ?>"><?php echo $row['Address'] ?></a>
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
}
echo "</div>";
?>



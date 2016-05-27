<?php
/**
 * Created by PhpStorm.
 * User: Bas de Ruiter
 * Date: 27-5-2016
 * Time: 20:59
 */

session_start();

$van = intval($_GET['van']);
$tot = intval($_GET['tot']);

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
            Address, 
            Vraagprijs,
            PC, 
            City, 
            AantalKamers, 
            WoonOppervlakte 
        FROM wo
        WHERE vraagprijs > '$van'
        AND vraagprijs < '$tot'
        LIMIT 15";

$sql_result = mysqli_query($conn,$sql);

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
            <span><a class="makelaar" href="makelaar.html">Hypodomus Groningen</a></span>
        </div>
        <?php
    }
}
?>
<?php require_once 'header.php'; ?>

<body>

  <?php
    if(isset($_POST['submit'])){
      $soort_bouw = $_POST['woning'];
      $straat_naam = $_POST['straatnaam'];
      $huis_nummer = $_POST['huisnummer'];
      $post_code = $_POST['postcode'];
      $plaats_naam = $_POST['plaatsnaam'];
    }

      $sql = 'SELECT * FROM `wo` WHERE vraagprijs < 100000 AND Vraagprijs > 10000 ';
      $sql_result = mysqli_query($conn, $sql);

  ?>

<div id="txt">
  <?php
    echo mysqli_num_rows($sql_result) . " koopwoningen gevonden."
  ?>
</div>

<div id="main">

<table>
  <tr>
    <td id="data" valign="top">
      <div class="head">Prijsklasse van/tot</div><br/>
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
        <div class="head"><a class="normal" href="detail.html">Bekemaheerd 22</a></div><div class="prijs">€ 135.000 k.k.</div><br/>
        <span class="adres">9737 PT Groningen<br/>75 m<sup>2</sup> - 3 kamers</span><br/>
        <span><a class="makelaar" href="makelaar.html">Hypodomus Groningen</a></span>
      </div>

      <div class="huisdata">
        <div class="head"><a class="normal" href="detail.html">Bekemaheerd 22</a></div><div class="prijs">€ 135.000 k.k.</div><br/>
        <span class="adres">9737 PT Groningen<br/>75 m<sup>2</sup> - 3 kamers</span><br/>
        <span><a class="makelaar" href="makelaar.html">Hypodomus Groningen</a></span>
      </div>

      <div class="huisdata">
        <div class="head"><a class="normal" href="detail.html">Bekemaheerd 22</a></div><div class="prijs">€ 135.000 k.k.</div><br/>
        <span class="adres">9737 PT Groningen<br/>75 m<sup>2</sup> - 3 kamers</span><br/>
        <span><a class="makelaar" href="makelaar.html">Hypodomus Groningen</a></span>
      </div>

      <div class="huisdata">
        <div class="head"><a class="normal" href="detail.html">Bekemaheerd 22</a></div><div class="prijs">€ 135.000 k.k.</div><br/>
        <span class="adres">9737 PT Groningen<br/>75 m<sup>2</sup> - 3 kamers</span><br/>
        <span><a class="makelaar" href="makelaar.html">Hypodomus Groningen</a></span>
      </div>
    </td>
  </tr>
</table>

</div>



</body></html>


         

      



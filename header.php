<?php print "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head> 
<title>Funda</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <link rel="stylesheet" href="css/style.css" type="text/css"/>
  <script type="text/javascript" src="js/filter.js"></script>
  <script type="text/javascript" src="js/pagination.js"></script>
  <?php require_once("db_connection.php") ?>
</head>

<body>

<div id="logo">
  <img src="img/logo.png" id="toplogo" alt="toplogo"/>
</div>


<div id="balk">
  <ul>
    <li class="active">Woningaanbod</li>
    <li>Verkoop</li>
    <li>NVM Makelaars</li>
    <li>Gids</li>
    <li>Verhuizen</li>
    <li>My Funda</li>
  </ul>
</div>

<div id="nav">
  <ul>
    <li><a href="index.php" class="active">Koopwoningen</a></li>
    <li>Huurwoningen</li>
    <li>Nieuwbouwprojecten</li>
    <li>Recreatiewoningen</li>
    <li>Europa</li>
  </ul>
</div>

<?php

echo "<!DOCTYPE html>
  <html lang='en'>
  <head>
    <title>Grad Tracker</title>
    <link rel='icon' type='image/png' href='../Assets/img/favicon.png' sizes='32x32'>
    <link rel='stylesheet' href='../Assets/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='../Assets/css/main.css'>
    <link rel='stylesheet' href='../Assets/css/font-awesome.min.css'>
    <script src='../Assets/js/jquery.min.js'></script>
    <script src='../Assets/js/bootstrap.min.js'></script>
    
  </head>
<body>
<nav class='navbar navbar-default'>
  <div class='container'>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
        <span class='sr-only'>Toggle navigation</span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
      </button>
      <a class='navbar-brand' href='/GradTracker'>Grad Tracker</a> 
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
      <ul class='nav navbar-nav'>
      </ul>
<ul class='nav navbar-nav navbar-right'>";
  if(isset($_SESSION['uid'])) {
      echo "<label class='navbar-text' href=''><b>";
      echo htmlspecialchars($_SESSION['firstName']." ".$_SESSION['lastName']); echo "</b></label>
        <form class='navbar-form navbar-left'>
          <a type='submit' class='btn btn-danger nav-signup' href='../Auth/logout.php'>Log out</a>
        </form>";
      }
      echo "</ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>";

?>

<!-- <script type='text/javascript' src='../Assets/js/bootstrap-multiselect.js'></script>
    <link rel='stylesheet' href='../Assets/css/bootstrap-multiselect.css' type='text/css'/> -->

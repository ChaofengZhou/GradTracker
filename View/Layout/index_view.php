<!-- Author: Chaofeng Zhou, date: 1/28/2016 -->
<!-- Purpose: The index.php for listing students status -->
<?php 
// force https
if(!isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != "off"))
{
  $redirect = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  header("Location:$redirect");
  exit();
}
$pathPrefix = "";
if($message != "") {
  $pathPrefix = "../";
}
echo "<!DOCTYPE html>
  <html lang='en'>
  <head>
    <title>Grad Tracker</title>
    <link rel='icon' type='image/png' href='{$pathPrefix}Assets/img/favicon.png' sizes='26x32'>
    <link rel='stylesheet' href='{$pathPrefix}Assets/css/bootstrap.min.css'>
    <link rel='stylesheet' href='{$pathPrefix}Assets/css/main.css'>
    <link rel='stylesheet' href='{$pathPrefix}Assets/css/font-awesome.min.css'>
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
          <a class='navbar-brand' href='{$pathPrefix}index.php'>Grad Tracker</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
          <ul class='nav navbar-nav'>
          </ul>
          <ul class='nav navbar-nav navbar-right'>
            <form class='navbar-form navbar-left' role='login' action='{$pathPrefix}Auth/login.php' method='post'>
              <div class='form-group'>
                <input type='text' class='nav-form form-control' name='uid' placeholder='UID' required>
                <input type='password' class='nav-form form-control' name='password' placeholder='Password' required>
              </div>
              <button type='submit' class='btn btn-success nav-signin'><i class='fa fa-chevron-circle-right' aria-hidden='true'></i> Sign In</button>
              <a class='btn btn-info nav-signup' href='{$pathPrefix}Auth/register.php'><i class='fa fa-chevron-circle-up' aria-hidden='true'></i> Sign Up</a>
            </form>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
      <div class='container vertical-center'>";
      if($message) {
        echo "<div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-circle' aria-hidden='true'></i> $message</div>";
      }
      echo "
    <div class='jumbotron front_page'>
      <h1>Grad Tracker</h1>
      <p>
        Grad Tracker is a web tool to help graduate students submit and check their graduate study progress, help graduate advisors
            track statuses of their students and help the Directory of Graduate Student to monitor the whole statuses of students and advisors.
      </p>
    </div>
    </div>
      <div class='container'>
      <div class='row index-column'>
        <div class='col-md-4'>
          <h2><i class='fa fa-check-circle-o' aria-hidden='true'></i> User Direction</h2>
          <p>Sign up to create an account with your UID specifying your role (student, faculty).</p>
          <p>Sign in to update detailed profile and act with your user role privilege.</p>
        </div>
        <div class='col-md-4'>
          <h2><i class='fa fa-check-circle-o' aria-hidden='true'></i> User Roles</h2>
          <p>DGS can monitor the status of all students, change user's role, and check faculty's profile.</p>
          <p>Advisors can monitor the status of his/her students and approve their progress.</p>
          <p>Students can update their progress forms, and modify them.</p>
       </div>
        <div class='col-md-4'>
          <h2><i class='fa fa-check-circle-o' aria-hidden='true'></i> Acknowledgement</h2>
          <p>Bootstrap<p>
          <p> Jim's code</p>
          <p> W3Schools</p>
          <p> Mozilla Developer Network </p>
        </div>
      </div>
    </div> 
    <script src='{$pathPrefix}Assets/js/jquery.min.js'></script>
    <script src='{$pathPrefix}Assets/js/bootstrap.min.js'></script>
  </body>
</html>";

?>

<!-- <div class='footer'>
      <div class='footer-text'>
        <a class='footer-link' href='/'>Home</a>
        <a class='footer-link' href='/Projects/Grad_Progress/README.html'>Readme</a>
        <p class='copyright'>Chaofeng Zhou - All Rights Reserved.</p>
      </div>
    </div> -->

<?php
if(!isset($_SESSION))
{
  session_start();

}
require_once "dbconnect.php";
if (isset($_POST['login'])) //$_POST is super global array
{
  $email = $_POST['email']; // retrieve email value of users
  $password = $_POST['password']; // retrieve password value of users

  $sql = "SELECT * FROM admin WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$email]);
  $adminInfo = $stmt->fetch(PDO::FETCH_ASSOC); // single row returns
  //$adminInfo['ID'], $adminInfo['email'], $adminInfo['password'], $adminInfo['remark']
  if ($adminInfo) {
    if (password_verify($password, $adminInfo['password'])) //checks password and hash match
    {
      $_SESSION['loginSuccess'] = true;
      $_SESSION['email'] = $email;


    } else // not match
    {
      $errorMessge = "Email or password might be incorrect.!!";
    }
  } // if end
  else // admin's filled email does not exist. 
  {
    $errorMessge = "Email or password might be incorrect.!!";
  }

  //echo"email is $email and password you typed is $password";


}

?>









<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <?php
      require_once("navbarcopy.php");
      ?>
    </div>
    <div class="row">
      <form action="adminLogin.php" method="post" class="form">
        <?php
        if (isset($errorMessge)) {
          echo "<p class= 'alert alert-danger'>$errorMessge</p>";
        }
        ?>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" id="exampleInputEmail1"
            value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">

          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary" name="login">Login</button>
      </form>

    </div>
  </div>
</body>

</html>
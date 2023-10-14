<?php
//Include Configuration File
include('config.php');
$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}
//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'" class="btn btn-sm btn-google text-uppercase btn-outline"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> Signup Using Google</a>';
}

?>

<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP Login using Google Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 
 </head>
 <body>
  <div class="container">
   <div class="panel panel-default">
   
   </div>
  </div>
 </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <script src="script.js"> </script>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

</head>
<body>
    <div class="container mt-5" >
        <h2 class="mb-3 text-center">Login Form</h2>
         <div class="row">
        <div class="col-md-6 offset-md-3">

        <form  method="post">
            
            
            <div class="form-group">
                
                <input type="email" class="form-control" id="email" name="email" placeholder="Email"  required>
                <span id="lblErrorEmail" style="color: red"></span>
            </div>
            
            
            <div class="form-group">
               
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password"  required>
                <i class="bi bi-eye-slash" id="togglePassword"></i>
                <span id="lblErrorPass" style="color: red"></span>
            </div>

           <a href="recover_psw.php">forgot password ?</a><br><br>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="login" id ="login"class="btn btn-secondary">Login</button>
            <?php


if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'" class="btn btn-sm btn-google text-uppercase btn-outline"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> Signup Using Google</a>';
}

 ?>
             <p>Not have an account <a href="signup.php">sign up</a> </p>

</form>
     </div>
    
 </div>
 </div>
 <?php
   if($login_button == '')
   {
    $email=$_SESSION['Email'];
    $query = "SELECT * FROM tblrole WHERE email='$email'";
    $result = $dbh->prepare($sql);
      $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
          if(count($row) > 0) {
        $role=$result[0]['role'];

        if($role==0){
            $query = "SELECT * FROM tbladmin WHERE Email='$email'";
            $result = $dbh->prepare($sql);
      $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
          if(count($row) > 0) {
              $_SESSION['name'] = $result[0]['user_name']; // Access name from $result array
              $_SESSION['id'] = $result[0]['user_id'];
              echo"<script>window.location.href='dashboard.php';</script>";
          }
        }
        elseif($role==1){
            $query = "SELECT * FROM tblpatient WHERE Email='$email'";
            $result = $dbh->prepare($sql);
      $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
          if(count($row) > 0) {
              $_SESSION['name'] = $result[0]['seller_name']; // Access name from $result array
              $_SESSION['sellerid'] = $result[0]['seller_id'];
              echo"<script>window.location.href='seller/sellerdashboard.php';</script>";
          }
        }
        else{
            echo"<script>window.location.href='admindashboard.php';</script>"; 
        }
      }
      else{
        echo"<div class='text-center'>Not a registered user <a href='logout.php'>Create Account </div> ";
      }
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
    ?>
    <!-- Include Bootstrap JS and jQuery -->
    <script src="js/myscripts.js"> </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
               

<?php

    //  include('connection.php');
    if (isset($_POST['login'])) {
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $password = filter_var($_POST['pwd'],FILTER_SANITIZE_SPECIAL_CHARS);

      $query = "SELECT * FROM tbl_role WHERE email='$email' AND password='$password'";
      $find_user = mysqli_query($conn,$query);
      $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
      if(count($result) > 0) {
        $role=$result[0]['role'];

        if($role=='customer'){
            $query = "SELECT * FROM tbl_user_register WHERE user_email='$email' AND user_password='$password'";
            $find_user = mysqli_query($conn,$query);
            $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
          if(count($result) > 0) {
              $_SESSION['name'] = $result[0]['user_name']; // Access name from $result array
              $_SESSION['id'] = $result[0]['user_id'];
              echo"<script>window.location.href='dashboard.php';</script>";
          }
        }
        elseif($role=='seller'){
            $query = "SELECT * FROM tbl_seller_register WHERE seller_email='$email' AND seller_password='$password'";
            $find_user = mysqli_query($conn,$query);
            $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
          if(count($result) > 0) {
              $_SESSION['name'] = $result[0]['seller_name']; // Access name from $result array
              $_SESSION['sellerid'] = $result[0]['seller_id'];
              echo"<script>window.location.href='seller/sellerdashboard.php';</script>";
          }
        }
        else{
            echo"<script>window.location.href='admindashboard.php';</script>";
        }
      }
      else {
        echo "Email or password incorrect";
    }
    }


?>
</body>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('pwd');

    toggle.addEventListener('click', function(){
        if(password.type === "pwd"){
            password.type = 'text';
        }else{
            password.type = 'pwd';
        }
        this.classList.toggle('bi-eye');
    });
</script>

</html>
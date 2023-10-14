<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM tblrole WHERE Email=:email AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        $role = $results[0]['Role'];

        if ($role == 0) {
            // Admin login
            $sql_admin = "SELECT ID, Email FROM tbladmin WHERE Email=:email";
            $query_admin = $dbh->prepare($sql_admin);
            $query_admin->bindParam(':email', $email, PDO::PARAM_STR);
            $query_admin->execute();
            $result_admin = $query_admin->fetch(PDO::FETCH_ASSOC);
            if ($result_admin) {
            $_SESSION['damsid'] = $result_admin['ID'];
            $_SESSION['damsemailid'] = $result_admin['Email'];

            $_SESSION['login'] = $_POST['email'];
            header("Location: ../admin/profile.php");
            exit();
            }
        } elseif ($role == 1) {
            // Patient login
            $sql_patient = "SELECT ID, Email FROM tblpatient WHERE Email=:email";
            $query_patient = $dbh->prepare($sql_patient);
            $query_patient->bindParam(':email', $email, PDO::PARAM_STR);
            $query_patient->execute();
            $result_patient = $query_patient->fetch(PDO::FETCH_ASSOC);
            if ($result_patient) {
            $_SESSION['damsid'] = $result_patient['ID'];
            $_SESSION['damsemailid'] = $result_patient['Email'];

            header("Location: ../patient/profile.php");
            exit();
            }
        } elseif ($role == 2) {
            // Doctor login
            $sql_doctor = "SELECT ID, Email FROM tbldoctor WHERE Email=:email AND Status='Active' AND Approval_status='Approved'";
            $query_doctor = $dbh->prepare($sql_doctor);
            $query_doctor->bindParam(':email', $email, PDO::PARAM_STR);
            $query_doctor->execute();
            $result_doctor = $query_doctor->fetch(PDO::FETCH_ASSOC);

            if ($result_doctor) {
                $_SESSION['damsid'] = $result_doctor['ID'];
                $_SESSION['damsemailid'] = $result_doctor['Email'];

                header("Location: ../doctor/profile.php");
                exit();
            }
        } elseif ($role == 3) {
            // Staff login
            $sql_staff = "SELECT ID, Email FROM tblstaff WHERE Email=:email AND Status='Active' AND Approval_status='Approved'";
            $query_staff = $dbh->prepare($sql_staff);
            $query_staff->bindParam(':email', $email, PDO::PARAM_STR);
            $query_staff->execute();
            $result_staff = $query_staff->fetch(PDO::FETCH_ASSOC);

            if ($result_staff) {
                $_SESSION['damsid'] = $result_staff['ID'];
                $_SESSION['damsemailid'] = $result_staff['Email'];

                header("Location: ../staff/profile.php");
                exit();
            }
        }
    } 
}
?>

<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) 
  {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID,Email FROM tblstaff WHERE Email=:email and Password=:password and Status = 'Active'and Approval_status='Approved'";
    $query=$dbh->prepare($sql);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['damsid']=$result->ID;
$_SESSION['damsemailid']=$result->Email;

}
$_SESSION['login']=$_POST['email'];
echo "<script type='text/javascript'> document.location ='profile.php'; </script>";
} else{
echo "<script>alert('Email/Password incorrect or Account deactivated or Approval pending.');</script>";
}
}

?>
<!doctype html>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>DentCare - Login Page</title>
	

	<link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/core.css">
	<link rel="stylesheet" href="assets/css/misc-pages.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
</head>
<body class="simple-page">
	<div id="back-to-home">
		<a href="../index.html" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
	</div>
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			
				<span style="color: white"><i class="fa fa-gg"></i></span>
				<span style="color: white">DentCare</span>
			
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="login-form">
	<h4 class="form-title m-b-xl text-center">Sign In With Your DentCare Account</h4>
	<form method="post" name="login">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Enter Registered Email ID" required="true" name="email">
		</div>

		<div class="form-group">
			<input type="password" class="form-control" placeholder="Password" name="password" required="true">
		</div>

		
		<input type="submit" class="btn btn-primary" name="login" value="Sign IN">
	</form>
	<hr />
    <p style="text-align: center;">OR</p>
    <div class="form-group">
            <a href="google/index.php" class="btn btn-google">
                <img src="images/g-logo.png" alt="Google Logo" class="google-logo"style="width: 15px; height: 15px;">
                Sign In with Google
            </a>
        </div>
	<a href="signup.php">Signup/Registration</a>
</div><!-- #login-form -->

<div class="simple-page-footer">
	<p><a href="login-system-main/recover_psw.php">FORGOT YOUR PASSWORD ?</a></p>
	
</div><!-- .simple-page-footer -->


	</div><!-- .simple-page-wrap -->
</body>
</html>
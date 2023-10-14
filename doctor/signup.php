<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mobno = $_POST['mobno'];
    $email = $_POST['email'];
    $sid = $_POST['specid'];
    $password = md5($_POST['password']);

    // Check if email already exists
    $query = $dbh->prepare("SELECT Email FROM tbldoctor WHERE Email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() == 0) {
        // Email doesn't exist, insert into tbldoctor
        $sql_doctor = "INSERT INTO tbldoctor(FullName, MobileNumber, Email, Specialization, Password, Status, Approval_status) VALUES(:fname, :mobno, :email, :sid, :password,'Active','Pending')";
        $query_doctor = $dbh->prepare($sql_doctor);
        $query_doctor->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query_doctor->bindParam(':mobno', $mobno, PDO::PARAM_STR);
        $query_doctor->bindParam(':email', $email, PDO::PARAM_STR);
        $query_doctor->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query_doctor->bindParam(':password', $password, PDO::PARAM_STR);

        if ($query_doctor->execute()) {
            // Insert into tblrole
            $sql_role = "INSERT INTO tblrole(Email, Password, Role, Status) VALUES(:email, :password, 2, 1)";
            $query_role = $dbh->prepare($sql_role);
            $query_role->bindParam(':email', $email, PDO::PARAM_STR);
            $query_role->bindParam(':password', $password, PDO::PARAM_STR);

            if ($query_role->execute()) {
                echo "<script>alert('Registration successful. Pending for approval.');</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again');</script>";
            }
        } 
    else {
        echo "<script>alert('Email already exists');</script>";
    }
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
	<h4 class="form-title m-b-xl text-center">Sign Up With Your DentCare Account</h4>
	<form action="" method="post">
    <div class="row">
            <div class="col-md-6"><div class="form-group">
			<input id="fname" type="text" class="form-control" placeholder="Full Name" name="fname" required="true"onkeyup="validateName()">
			<div id="nameError" class="error"></div>
		</div>

		<div class="form-group">
			<input id="email" type="email" class="form-control" placeholder="Email" name="email" required="true"onkeyup="validateEmail()">
			<div id="emailError" class="error"></div>
		</div>
		<div class="form-group">
			<input id="password" type="password" class="form-control" placeholder="Password" name="password" required="true"onkeyup="validatePassword()">
			<div id="passwordError" class="error"></div>
		</div>
		</div>
        <div class="col-md-6">
        <div class="form-group">
			<select class="form-control" name="specid" id="specid" onkeyup="validateSpecialization()">
			<div id="specError" class="error"></div>
				<option value="">Choose Specialization</option>
				<?php
$sql1="SELECT * from tblspecialization";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);

if($query1->rowCount() > 0)
{
foreach($results1 as $row1)
{               ?>
				<option value="<?php  echo htmlentities($row1->Specialization);?>"><?php  echo htmlentities($row1->Specialization);?></option><?php }} ?> 
			</select>
        </div>
		<div class="form-group">
			<input id="mobno" type="text" class="form-control" placeholder="Mobile" name="mobno" maxlength="10" pattern="[0-9]+" required="true"onkeyup="validateMobile()">
			<div id="mobileError" class="error"></div>
		</div>
	    <div class="form-group">
		<input id="cpassword" type="password" class="form-control" placeholder="Confirm Password" name="cpassword" required="true"onkeyup="validateCPassword()">
			<div id="cpasswordError" class="error"></div>
		</div>
</div>
<input type="submit" class="btn btn-primary" value="Register" name="submit"onclick="validateForm()">
</div>
	</form>
</div><!-- #login-form -->

<div class="simple-page-footer">
	<p>
		<small>Do you have an account ?</small>
		<a href="../login.php">SIGN IN</a>
	</p>
</div>

	</div><!-- .simple-page-wrap -->
	<script>
    function validateForm() {
        if(validateName() && validateEmail() && validateMobile() &&  validateSpecialization() && validatePassword() &&  validateCPassword()){
     return true;
}
    else
   {
    return false;
   }
}

    function validateName() {
        const nameInput = document.getElementById("fname");
        const nameError = document.getElementById("nameError");
        nameError.style.color = "red";
        const name = nameInput.value.trim();
        const nameRegex = /^[A-Za-z]+$/;
        let hasConsecutiveSameChars = false;
        for (let i = 0; i < name.length - 1; i++) {
            if (name[i] === name[i + 1]) {
                hasConsecutiveSameChars = true;
                break;
            }
        }
        if (!nameRegex.test(name)) {
            nameError.textContent = "Name should only contain letters";
            return false;
        } else if (hasConsecutiveSameChars) {
            nameError.textContent = "Name should not have consecutive same characters";
            return false;
        } else {
            nameError.textContent = "";
            return true;
        }
    }

    function validateEmail() {
        const email = document.getElementById("email").value.trim();
            const emailError = document.getElementById("emailError");
            const emailRegex = /^[^\s@]+@gmail\.com$/;

            if (!emailRegex.test(email)) {
                emailError.textContent = "Invalid email format";
                emailError.style.color = "red";
                return false;
            }

            emailError.textContent = "";
            return true;
        }


    function validateMobile() {
        const mobile = document.getElementById("mobno").value.trim();
        const mobileError = document.getElementById("mobileError");
        mobileError.style.color = "red";
        const mobileRegex = /^[6789]\d{9}$/;
        const sameDigitRegex = /^(\d)\1+$/;

        if (!mobileRegex.test(mobile) || sameDigitRegex.test(mobile)) {
            mobileError.textContent = "Invalid mobile number";
            return false;
        }

        mobileError.textContent = "";
        return true;
    }

    function validateSpecialization() {
        const dropdown = document.getElementById("specid");
        const dropdownError = document.getElementById("specError");
        dropdownError.style.color = "red";

        if (!dropdown.value) {
            dropdownError.textContent = "Please select a specialization";
            return false;
        }

        dropdownError.textContent = "";
        return true;
    }

    function validatePassword() {
        const password = document.getElementById("password").value.trim();
        const passwordError = document.getElementById("passwordError");
        passwordError.style.color = "red";
        const upperCaseRegex = /[A-Z]/;
        const specialCharRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/;

        if (password.length > 10) {
            passwordError.textContent = "Password length cannot exceed 10 characters";
            return false;
        } else if (!upperCaseRegex.test(password)) {
            passwordError.textContent = "Password must contain at least one uppercase letter";
            return false;
        } else if (!specialCharRegex.test(password)) {
            passwordError.textContent = "Password must contain at least one special character";
            return false;
        } else {
            passwordError.textContent = "";
            return true;
        }
    }

    function validateCPassword() {
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("cpassword");
        const passwordError = document.getElementById("cpasswordError");
        passwordError.style.color = "red";
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (password !== confirmPassword) {
            passwordError.textContent = "Passwords do not match";
            return false;
        } else {
            passwordError.textContent = "";
            return true;
        }
    }
</script>
</body>
</html>
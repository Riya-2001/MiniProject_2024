<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $password=md5($_POST['password']);
    // Check if email already exists
    $query = $dbh->prepare("SELECT Email FROM tblpatient WHERE Email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() == 0) {
        $sql_patient = "INSERT INTO tblpatient(FullName, Email, MobileNo, Age, Address, Password) VALUES(:fname, :email, :mobile, :age, :address, :password)";
        $query_patient=$dbh->prepare($sql_patient);
        $query_patient->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query_patient->bindParam(':email', $email, PDO::PARAM_STR);
            $query_patient->bindParam(':mobile', $mobile, PDO::PARAM_STR);
            $query_patient->bindParam(':age', $age, PDO::PARAM_INT);
            $query_patient->bindParam(':address', $address, PDO::PARAM_STR);
            $query_patient->bindParam(':password', $password, PDO::PARAM_STR);
        if ($query_patient->execute()) {
        $sql_role="INSERT INTO tblrole(Email,Password,Role,Status) VALUES(:email, :password, 1, 1)";
        $query_role = $dbh->prepare($sql_role);
        $query_role->bindParam(':email', $email, PDO::PARAM_STR);
        $query_role->bindParam(':password', $password, PDO::PARAM_STR);
        if ($query_role->execute()) {
            echo "<script>alert('You have signed up successfully');</script>";
            
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
    } else {
        echo "<script>alert('Email already exists');</script>";
    }
}
}
?>
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
		<a href="../index
		.html" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
	</div>
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			
				<span style="color: white"><i class="fa fa-gg"></i></span>
				<span style="color: white">DentCare</span>
			
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="login-form">
	<h4 class="form-title m-b-xl text-center"> Patient Registration</h4>
	<form action="" method="post">
	<div class="row">
            <div class="col-md-6">
				<div class="form-group">
			<input id="fname" type="text" class="form-control" placeholder="Full Name" name="fname" required="true"onkeyup="validateName()">
      <div id="nameError" class="error"></div>
    </div>

		<div class="form-group">
			<input id="email" type="email" class="form-control" placeholder="Email" name="email" required="true"onkeyup="validateEmail()">
      <div id="emailError" class="error"></div>
    </div>
		<div class="form-group">
			<input id="mobile" type="text" class="form-control" placeholder="Mobile No" name="mobile" maxlength="10" pattern="[0-9]+" required="true"onkeyup="validateMobile()">
      <div id="mobileError" class="error"></div>
		</div>
    <div class="form-group">
		<input id="cpassword" type="password" class="form-control" placeholder="Confirm Password" name="cpassword" required="true"onkeyup="validateCPassword()">
			<div id="cpasswordError" class="error"></div>
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
			<input id="age" type="number" class="form-control" placeholder="Age" name="age" required="true"onkeyup="validateAge()">
      <div id="ageError" class="error"></div>
    </div>
		<div class="form-group">
			<input id="address" type="text" class="form-control" placeholder="Address" name="address" required="true"onkeyup="validateAddress()">
      <div id="addressError" class="error"></div>
    </div>
		<div class="form-group">
			<input id="password" type="password" class="form-control" placeholder="Password" name="password" required="true"onkeyup="validatePassword()">
      <div id="passwordError" class="error"></div>
    </div>
    
		</div>
    
</div>
		<input type="submit" class="btn btn-primary" value="Register" name="submit"onclick="return validateForm()">
	</form>
</div><!-- #login-form -->
<br>
<div class="simple-page-footer">
	<p>
		<small>Do you have an account ?</small>
		<a href="../login.php">SIGN IN</a>
	</p>
</div>
	</div><!-- .simple-page-wrap -->
  <script>
    function validateForm() {
    if(validateName() && validateEmail() && validateMobile() &&  validateAge() && validateAddress() &&   validatePassword() &&  validateCPassword()){
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
           const mobile = document.getElementById("mobile").value.trim();
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


        function validateAge() {
            const age = document.getElementById("age").value.trim();
            const ageError = document.getElementById("ageError");

            if (isNaN(age) || age < 5 || age > 100) {
                ageError.textContent = "Invalid age";
                ageError.style.color = "red";
                return false;
            }

            ageError.textContent = "";
            return true;
        }

        function validateAddress() {
            const address = document.getElementById("address").value.trim();
            const addressError = document.getElementById("addressError");
            const nameRegex = /^[A-Za-z]+$/;
            if (address.length < 5) {
                addressError.textContent = "Invalid address";
                addressError.style.color = "red";
                return false;
            }
            else if (!nameRegex.test(address)) {
                addressError.textContent = "Address should only contain letters";
                addressError.style.color = "red";
                return false;
            }   
            addressError.textContent = "";
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
        function validateCPassword(){
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("cpassword");
    const passwordError = document.getElementById("cpasswordError");
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if (password !== confirmPassword) {
        passwordError.textContent = "Passwords do not match";
        passwordError.style.color = "red";
        return false;
    } else {
        passwordError.textContent = "";
        return true;
    }
}
    </script>
</body>
</html>
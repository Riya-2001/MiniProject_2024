

<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['damsid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $did = $_SESSION['damsid'];
        $name = $_POST['fname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $age = $_POST['age'];
        $address = $_POST['address'];

        // TODO: Validate and sanitize user inputs here
        
        $sql = "UPDATE tblpatient SET FullName=:name, Email=:email, MobileNo=:mobile, Age=:age, Address=:address WHERE ID=:did";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_INT); // Add this line
        $query->bindParam(':age', $age, PDO::PARAM_INT); // Add this line
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        
        if ($query->execute()) {
            echo '<script>alert("Profile has been updated")</script>';
        } else {
            // Handle the case where the query fails
            echo '<script>alert("Error updating profile. Please try again later.")</script>';
        }
    }
  }
 

  if (strlen($_SESSION['damsid'] == 0)) {
    header('location:logout.php');
} else {
    $did = $_SESSION['damsid'];
    
    // Query to fetch the doctor's profile data
    $sql = "SELECT * FROM tblpatient WHERE ID = :did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':did', $did, PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_OBJ);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>DentCare - Patient Profile</title>
  
  <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
  <!-- build:css assets/css/app.min.css -->
  <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
  <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/core.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <!-- endbuild -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
  <script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
  
<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
  <div class="wrap">
  <section class="app-content">
    <div class="row">
     
      <div class="col-md-12">
        <div class="widget">
          <header class="widget-header">
            <h3 class="widget-title">Patient Profile</h3>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body">
            
          <form class="form-horizontal" method="post">
              <div class="form-group">
                <label for="exampleTextInput1" class="col-sm-3 control-label">Patient ID:</label>
                <div class="col-sm-9">
                  <input id="fname" type="text" class="form-control" placeholder="Full Name" name="fname" required="true" onkeyup="validateName()"value="<?php  echo $row->FullName;?>">
                  <div id="nameError" class="error"></div></div>
              </div>
              
              <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email:</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" id="email" name="email" required='true'onkeyup="validateEmail()"value="<?php echo $row->Email; ?>">
                  <div id="emailError" class="error"></div></div>
              </div>
              <div class="form-group">
               <label for="mobile" class="col-sm-3 control-label">Mobile No:</label>
              <div class="col-sm-9">
               <input type="text" class="form-control" id="mobile" name="mobile" required='true'onkeyup="validateMobile()"value="<?php  echo $row->MobileNo; ?>" >
               <div id="mobileError" class="error"></div> </div>
              </div>
              
              <div class="form-group">
                <label for="age" class="col-sm-3 control-label">Age:</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="age" name="age" required='true'onkeyup="validateAge()"value="<?php  echo $row->Age;?>">
                  <div id="ageError" class="error"></div></div>
              </div>
              <div class="form-group">
                <label for="address" class="col-sm-3 control-label">Address:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="address" name="address" required='true'onkeyup="validateAddress()"value="<?php  echo $row->Address;?>" >
                  <div id="addressError" class="error"></div></div>
              </div>
            
              <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                  <button type="submit" class="btn btn-success" name="submit">Update</button>
                </div>
              </div>
            </form>
          </div><!-- .widget-body -->
        </div><!-- .widget -->
      </div><!-- END column -->

    </div><!-- .row -->
  </section><!-- #dash-content -->
</div><!-- .wrap -->
  <!-- APP FOOTER -->
  <?php include_once('includes/footer.php');?>
  <!-- /#app-footer -->
</main>
<!--========== END app main -->

  
  <!-- SIDE PANEL -->
 
  <script>
    function validateForm() {
            const isNameValid = validateName();
            const isEmailValid = validateEmail();
            const isMobileValid = validateMobile();
            const isAgeValid = validateAge();
            const isAddressValid = validateAddress();
            const isPasswordValid = validatePassword();

            if (isNameValid && isEmailValid && isMobileValid && isAgeValid && isAddressValid && isPasswordValid) {
                return true;
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
            } else if (hasConsecutiveSameChars) {
                nameError.textContent = "Name should not have consecutive same characters";
            } else {
                nameError.textContent = "";
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
            const mobileRegex = /^[789]\d{9}$/;
            const sameDigitRegex = /^(\d)\1+$/;

            if (!mobileRegex.test(mobile) || sameDigitRegex.test(mobile)) {
                mobileError.textContent = "Invalid mobile number";
                mobileError.style.color = "red";
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

            if (address.length < 5) {
                addressError.textContent = "Invalid address";
                addressError.style.color = "red";
                return false;
            }

            addressError.textContent = "";
            return true;
        }
       
    </script>
  <!-- build:js assets/js/core.min.js -->
  <script src="libs/bower/jquery/dist/jquery.js"></script>
  <script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
  <script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
  <script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
  <script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
  <script src="libs/bower/PACE/pace.min.js"></script>
  <!-- endbuild -->

  <!-- build:js assets/js/app.min.js -->
  <script src="assets/js/library.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/app.js"></script>
  <!-- endbuild -->
  <script src="libs/bower/moment/moment.js"></script>
  <script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="assets/js/fullcalendar.js"></script>
</body>
</html>
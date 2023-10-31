<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

    if (isset($_POST['submit'])) {
    $fname=$_POST['fname'];
    $mobno=$_POST['mobno'];
    $email=$_POST['email'];
    $sid=$_POST['specid'];
    $password = md5($_POST['password']);
        // TODO: Validate and sanitize user inputs here

        $sql = "Insert Into tbldoctor(FullName,MobileNumber,Email,Specialization,Password,Status,Approval_status)Values(:fname,:mobno,:email,:sid,:password,'Active','Approved')";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':mobno',$mobno,PDO::PARAM_INT);
        $query->bindParam(':sid',$sid,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
        if ($query->execute()) {
          $sql_role = "INSERT INTO tblrole(Email, Password, Role, Status) VALUES(:email, :password, 2, 1)";
          $query_role = $dbh->prepare($sql_role);
          $query_role->bindParam(':email', $email, PDO::PARAM_STR);
          $query_role->bindParam(':password', $password, PDO::PARAM_STR);

          if ($query_role->execute()) {
            echo '<script>alert("Doctor has been added successfully.")</script>';
        } else {
            // Handle the case where the query fails
            echo '<script>alert("Error adding doctor. Please try again later.")</script>';
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>DentCare - Add Doctor Profile</title>
  
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
            <h3 class="widget-title">Add Doctor</h3>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body">
            
            <form class="form-horizontal" method="post"onsubmit="return checkAll()">
              <div class="form-group">
                <label for="exampleTextInput1" class="col-sm-3 control-label">Doctor Name:</label>
                <div class="col-sm-9">
                  <input id="fname" type="text" class="form-control" placeholder="Full Name" name="fname" required="true" onkeyup="firstName()">
                  <div id="nameError" class="error"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="email2" class="col-sm-3 control-label">Email:</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control"placeholder="Email" id="email" name="email" required='true'onkeyup="emailUser()">
                  <div id="emailError" class="error"></div>
                </div>
              </div>
               <div class="form-group">
                <label for="email2" class="col-sm-3 control-label">Mobile Number:</label>
                <div class="col-sm-9">
                <input type="text" class="form-control"placeholder="Mobile Number" id="mobno" name="mobno" required="true"onkeyup="phoneUser()">
                <div id="mobileError" class="error"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="email2" class="col-sm-3 control-label"placeholder="Specialization"onkeyup="specId()">Specialization:</label>
                <div class="col-sm-9">
                <select class="form-control" name="specid" id="specid">
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
              </div>
              <div class="form-group">
                <label for="email2" class="col-sm-3 control-label">Password:</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="password" name="password"value="123"required>
                </div>
              </div> 
             
              <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                  <button type="submit" class="btn btn-success" name="submit"onkeyup="checkAll()">Update</button>
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
    function checkAll() {
if(firstName() && specId() && emailUser() && phoneUser())
{
return true;
}
else
   {
    return false;
   }
}
  function firstName() {
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
function emailUser() {
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

function specId(){
    const dropdown = document.getElementById("specid"); 
    		const specError = document.getElementById("specError"); 
    	if (dropdown.value === "") {
        specError.textContent = "Please select an option";
        specError.style.color = "red";
        return false;
    	} else {
        specError.textContent = "";
        return true; 
    	}
		}

function phoneUser() {
    const mobile = document.getElementById("mobno").value.trim();
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

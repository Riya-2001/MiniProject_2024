<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('../class/Appointment.php');

include('header.php');

if (strlen($_SESSION['damsid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $did = $_SESSION['damsid'];
        $name = $_POST['fname'];
        $mobno = $_POST['mobno'];
        $email = $_POST['email'];
        $sid = $_POST['specid'];

        $sql = "UPDATE tbldoctor SET FullName=:name, Email=:email, MobileNumber=:mobno, Specialization=:sid WHERE ID=:did";
        $query = $dbh->prepare($sql);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobno', $mobno, PDO::PARAM_STR);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
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
    $sql = "SELECT * FROM tbldoctor WHERE ID = :did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':did', $did, PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_OBJ);
}


?>
<head>
    <style>
        .error {
        color: red; /* Define the text color for error messages */
        font-size: 12px; /* Define the font size for error messages */
    }
    </style>
    </head>
    
<h1 class="h3 mb-4 text-gray-800">Profile</h1>

<a href="javascript:void(0)" "form-control"><?php echo $fname; ?></a>
<form method="post" id="profile_form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8">
            <span id="message"></span>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-danger">Profile</h6>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success" name="submit">Update</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="fname">Doctor Name</label>
                        <input type="text" name="fname" id="fname" class="form-control"
                            value="<?php echo $row->FullName; ?>" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/"
                            data-parsley-maxlength="175" data-parsley-trigger="keyup" onkeyup="validateName()" />
                        <div id="nameError" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" id="email" class="form-control"
                            value="<?php echo $row->Email; ?>" required data-parsley-type="email"
                            data-parsley-trigger="keyup" onkeyup="validateEmail()" />
                        <div id="emailError" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label for="mobno">Contact No.</label>
                        <input type="text" name="mobno" id="mobno" class="form-control"
                            value="<?php echo $row->MobileNumber; ?>" required
                            data-parsley-trigger="keyup" onkeyup="validateMobile()" />
                        <div id="mobileError" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label for="specid">Specialization</label>
                        <select class="form-control" name="specid" id="specid" required>
                            <?php
                            $sql1 = "SELECT * FROM tblspecialization";
                            $query1 = $dbh->prepare($sql1);
                            $query1->execute();
                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

                            foreach ($results1 as $row1) {
                            ?>
                            <option value="<?php echo htmlentities($row1->Specialization); ?>"><?php echo htmlentities($row1->Specialization); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include('footer.php');
?>

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
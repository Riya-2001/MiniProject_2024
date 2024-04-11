<?php
    session_start();
    if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
    { 
       include 'adminheader.php'; ?>

<script type="text/javascript">
  function firstName() {
    var f1 = document.getElementById("f3");
    var fname = document.getElementById('name').value;

    if(!/^[A-Z ]{1}[A-Za-z. ]{3,30}$/.test(fname))
       {
         f1.textContent = "**Invalid Full Name (First letter should be capital)";
         var x = document.getElementById("name");
         x.focus();
         return false;
       }
       else
       {
        f1.textContent = "";
        return true;
       }
  }

  function emailUser() {
    var f3 = document.getElementById("f8");
    var email = document.getElementById('email').value;

    if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/.test(email))
       {
         f3.textContent = "**Invalid Email Format";
         document.getElementById("email").focus();
         return false;
       }
       else
       {
        f3.textContent = "";
        return true;
       }
  }
  

  function phoneUser() {
    var f5 = document.getElementById("f9");
    var phone = document.getElementById('phno').value;

    // Check if the phone number is in the correct format and not all digits are the same
    if (!/^[6-9]{1}[0-9]{9}$/.test(phone) || /^(.)\1{9}$/.test(phone)) {
        f5.textContent = "**Invalid Phone # Format";
        document.getElementById("phno").focus();
        return false;
    } else {
        f5.textContent = "";
        return true;
    }
}


  function checkAll() {

    if(firstName()&&emailUser()&&phoneUser())
       {
         return true;
       }
       else
       {
        return false;
       }
  }


</script> 

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Staff Registration </h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registration Form</h6>
                        </div>
                        <div class="card-body" >
						

                          <form role="form" action="addstaffreg.php" method="post" enctype="multipart/form-data" name="myform">
              			    

										 <!--  <div class="form-group">
              			    				<textarea rows="2" name="address" class="form-control input-sm" placeholder="Address" id="address" onkeyup="addrUser()"></textarea>
              <span style="color: red;font-size: 14px" id="f4"></span>
              			    			</div> -->
              			    			<div class="form-group">
              			    				<input type="text" name="name"  class="form-control input-sm" placeholder="Name" id="name" onkeyup="firstName()">
              <span style="color: red;font-size: 14px" id="f3"></span>
              			    			</div>
              			    			
<div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-group">
                                          <div class="form-group">
                  <input type="email" name="email" class="form-control input-sm" placeholder="Email" id="email" onkeyup="emailUser()">
                  <span style="color: red;font-size: 14px" id="f8"></span>
                                          
                                  </div>

                                  </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-group">
                  <div class="form-group">
                  <input type="text" name="phno" class="form-control input-sm" placeholder="Phone Number" id="phno" onkeyup="phoneUser()">
                  <span style="color: red;font-size: 14px" id="f9"></span>
                                          
                                  </div>
                                  </div>
                                </div>
                              </div>
              			    			

                              


                               <br>
  			    			<input type="submit" value="Register" class="btn btn-info btn-block" onclick="return checkAll()" >
              			    		</form>




                        </div>
                    </div>

                </div>
                <?php include 'adminfooter.php'; }

    else
    {
        Header("location:../index.php");
    }
?>

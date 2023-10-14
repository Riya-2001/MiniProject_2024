<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('../class/Appointment.php');
$object = new Appointment;
include('header.php');

if (strlen($_SESSION['damsid'] == 0)) {
    header('location:logout.php');
} else {
    $did = $_SESSION['damsid'];
    
    // Query to fetch the doctor's profile data
    $sql="select * from tbldoctor inner join tblrole on tbldoctor.LoginId=tbrole.Id where tb_doctor.LoginId='".$did."'";
    $query = $dbh->prepare($sql);
   

}

?>
     <head>
<style>
  .container-fluid {
    margin: 20px;
  }

  h2 {
    font-family: 'Open Sans', sans-serif;
  }

  .form-group {
    margin-top: 20px;
  }

  input[type="date"] {
    width: 100%;
  }

  label {
    font-weight: normal;
  }

  input[type="checkbox"] {
    margin-right: 10px;
  }

  .text-center {
    text-align: center;
  }

  .btn {
    margin-top: 20px;
  }
</style>
</head><!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <script type="text/javascript">
   function startDate() {

    var s1 = document.getElementById("s1");
    var sdate = document.getElementById('sdate').value;

    if(sdate=="")
       {
         s1.textContent = "**Select Any Date for Scheduling Slots.";
         document.getElementById("sdate").focus();
         return false;
       }
       else
       {
        s1.textContent = "";
        return true;
       }
  }

  function checkSlots()
  {
    var a1 = document.getElementById('a1').checked;
    var a2 = document.getElementById('a2').checked;
    var a3 = document.getElementById('a3').checked;
    var a4 = document.getElementById('a4').checked;
    var a5 = document.getElementById('a5').checked;
    var a6 = document.getElementById('a6').checked;
    var a7 = document.getElementById('a7').checked;


    if(a1||a2||a3||a4||a5||a6||a7)
    {
      return true;
    }
    else
    {
      var s1 = document.getElementById("s2");
      s1.textContent = "**Select Any 1 Slot";
      return false;
    }
  }

  function checkAll() {

    if(startDate()&&checkSlots())
       {
         return true;
       }
       else
       {
        return false;
       }
  }
    
</script>

        <!-- Small boxes (Stat box) --><br><br>
        <h2 style="font-family: 'Open Sans', sans-serif;"><center><b>Set Your Schedule for next day</b></center></h2><br>
        <form role="form" method="POST" action="registerdrschedule.php" name="myform" enctype="multipart/form-data">
           

                                  <div class="form-group">
                                  <input type="text" onfocus="(this.type='date')" name="availdate" class="form-control input-sm" placeholder="Available Date" value=""  min="<?php $curdate=date('Y-m-d'); echo date('Y-m-d'); ?>" id="sdate" onfocusout="startDate()" > 
                                  <span style="color: red;font-size: 12px" id="s1"></span>   <br>             
                                  
<center>
                                  <input type="checkbox" name="color[]" value="s1" id='a1'/>
                                  <label for="color_red">9am-9.30am</label>&nbsp;&nbsp;&nbsp;&nbsp;

                                  <input type="checkbox" name="color[]" value="s2" id='a2'/>
                                  <label for="color_red">9.30am-10am</label>&nbsp;&nbsp;&nbsp;&nbsp;

                                  <input type="checkbox" name="color[]" value="s3" id='a3'/>
                                  <label for="color_red">10am-10.30am</label><br>

                                  <input type="checkbox" name="color[]" value="s4" id='a4'/>
                                  <label for="color_red">11am-11.30am</label>&nbsp;&nbsp;&nbsp;&nbsp;

                                  <input type="checkbox" name="color[]" value="s5" id='a5'/>
                                  <label for="color_red">12.30pm-1pm</label>&nbsp;&nbsp;&nbsp;&nbsp;

                                  <input type="checkbox" name="color[]" value="s6" id='a6' />
                                  <label for="color_red">2pm-2.30pm</label><br>

                                  <input type="checkbox" name="color[]" value="s7"  id='a7'/>
                                  <label for="color_red">3pm-3.30pm</label><br>
                                  <span style="color: red;font-size: 12px" id="s2"></span>
</center>
                                  </div>

    
                            <input type="submit" value="Update" class="btn btn-info btn-block" onclick="return checkAll()">

                
                       
                        </form>
                        
</section>
<?php
include('footer.php');
?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



</div>
<!-- ./wrapper -->

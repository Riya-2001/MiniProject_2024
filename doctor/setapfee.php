<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('header.php');
include('../class/Appointment.php');
$object = new Appointment;

    
if (strlen($_SESSION['damsid'] == 0)) {
    header('location:logout.php');
} else {
    $did = $_SESSION['damsid'];
}
?>

     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



        <!-- Small boxes (Stat box) --><br><br><br>
        <h2 style="font-family: 'Open Sans', sans-serif;"><center><b>Appointment Fee</b></center></h2><br>


<form role="form" method="POST" action="apfeereg.php" name="myform" enctype="multipart/form-data">

  <input type="hidden" name="stid" value="<?php echo $staffid; ?>">
        <table class="table table-bordered" id="table"  data-toggle="table" data-height="460"  data-pagination="true"   data-search="true"> 
        
      <tbody>  

        <tr style="text-align: center;" >
          <th>Appointment Fee</th>
          <td colspan='5'><input class="form-control input-sm" placeholder="Enter New Appointment Fee"  type="text" name="apfee"
            id='apfee' onkeyup="pdCheck()"><span style="color: red;font-size: 12px" id="reason"></span></td>
        </tr> 
      
      </tbody>
</table>
<div class="form-group"> <br>
            <a href="apfeereg.php"><button class="btn btn-outline-success btn-block" type="submit" onclick="return checkAll()"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Update</button></a>
      </div>
</form>
      
      <div class="form-group"> 
            <a href="apfee.php"><button class="btn btn-outline-danger btn-block"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Back To Home</button></a>
      </div>

</div>
<?php
include('footer.php');
?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

</div>
<!-- ./wrapper -->



<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('../class/Appointment.php');
$object = new Appointment;
include('header.php');
?>

     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



        <!-- Small boxes (Stat box) --><br><br><br>
        <h2 style="font-family: 'Open Sans', sans-serif;"><center><b>Appointment Fee - Actions</b></center></h2><br><br><br><br>


      
      <div class="form-group"> 
            <a href="setapfee.php"><button class="btn btn-success btn-block"><i class=" fas fa-rupee-sign" aria-hidden="true"></i>&nbsp;&nbsp;Set Amount</button></a>
      </div>

      <div class="form-group"> 
            <a href="viewlatestfee.php"><button class="btn btn-info btn-block"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Amount Details</button></a>
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


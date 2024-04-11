

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">DentCare Dental Clinic Web Application</h1><br><br><hr>

<!-- //--------------------------------------BOX Starts-----------------------------------// -->
<?php
  include 'connection.php';

  $sql = "select count(*) as count from tb_doctor";
  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
    $dr=$row['count'];
  }

  $sql = "select count(*) as count from tb_patient";
  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
    $pt=$row['count'];
  }

  $sql = "select count(*) as count from tb_staff";
  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
    $st=$row['count'];
  }


  $sql = "select count(*) as count from tb_booking where txnid != ''";
  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
    $paid=$row['count'];
  }

  $sql = "select count(*) as count from tb_booking where rfndid != ''";
  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
    $refund=$row['count'];
  }

 




?>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="card text-white bg-info mb-3">
                      <div class="card-body ">
                        <h5 class="card-title">Doctors</h5>
                        <p class="card-text">Total number of doctors.</p>
                        <center><a  class="btn btn-dark"><?php echo $dr; ?></a></center>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="card text-white bg-success mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Staffs</h5>
                        <p class="card-text">Total number of staffs.</p>
                        <center><a  class="btn btn-dark"><?php echo $st; ?></a></center>
                      </div>
                    </div>
                  </div>
                </div>

                <br><br>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="card text-white bg-success mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Patients</h5>
                        <p class="card-text">Headcount of total patients visited.</p>
                        <center><a  class="btn btn-dark"><?php echo $pt; ?></a></center>
                      </div>
                    </div>
                  </div>
                  
                    <div class="col-sm-6">
                    <div class="card text-white bg-success mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Payments</h5>
                        <p class="card-text">Total payments done using Razorpay Gateway.</p>
                        <center><a  class="btn btn-dark">Payments : <?php echo $paid; ?></a>&nbsp;<a  class="btn btn-dark">Refunds : <?php echo $refund; ?></a>&nbsp;<a  class="btn btn-dark">Total Successfull Transactions : <?php echo $paid+$refund; ?></a></center>
                      </div>
                    </div>
                  </div>
                </div>

<!-- //--------------------------------------BOX Ends-----------------------------------// -->
                   
                <br><br><br>     
                    </h1>

                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">


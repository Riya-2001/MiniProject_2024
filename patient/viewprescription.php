<?php
    session_start();
    setcookie('logined',1);
    if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
    {
      include 'connection.php';
      include 'patientheader.php';
      $ptid = $_COOKIE['lkey'];
    
      //echo $ap_date;exit;
      $sql="select * from tb_prescription p inner join tb_doctor d on p.drid=d.loginid where ptid='".$ptid."' order by pid desc";

      $result = mysqli_query($conn,$sql);
      

?>
  
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



        <!-- Small boxes (Stat box) --><br><br><br>
        <h2 style="font-family: 'Open Sans', sans-serif;"><center><b>Prescription History</b></center></h2><br>



        <table class="table table-bordered" id="table"  data-toggle="table" data-height="460"  data-pagination="true"   data-search="true"> 
        <thead>
    <tr style="text-align: center;">
      <th>#</th>
      <th>Date</th>
      <th>Doctor</th>
      <!-- <th>Description</th> -->
      <th>File</th>
    </tr>
  </thead>
  <tbody>
  <?php $c=1;
  while ($row=mysqli_fetch_array($result))
  { ?>
    <tr style="text-align: center;">
      <td><?php echo $c; $c=$c+1; ?></td>
      <td><?php echo $row['pdate']; ?></td>
      <td>Dr. <?php echo $row['name']; ?></td>
      <!-- <td><?php //echo $row['pdesc']; ?></td> -->
      <td>
    <a href="../admin/fpdf/medicine.php?t=<?php echo $row['pid']; ?>" target="_blank">
        <i class="fas fa-edit text-blue"></i>
    </a>
    
</td>
    </tr> 
  <?php } ?> 
  </tbody>
</table>
<div class="form-group"> <br>
          <a href="index.php"><button class="btn btn-outline-success btn-block"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Back To Home</button></a>
      </div>

          

</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="position:relative; z-index:99; ">
   <small><center>Designed and developed by Riya Robin | DentCare Dental Clinic 2023</center></small>
    
  </footer>


</div>
<!-- ./wrapper -->
<?php
}
  else
  {
    Header("location:../index.php");
  }
?>

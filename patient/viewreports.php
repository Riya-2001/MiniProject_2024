<?php
    session_start();
    setcookie('logined',1);
    if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
    {
      include 'connection.php';
      include 'patientheader.php';
      $ptid = $_COOKIE['lkey'];
      //echo $ptid;exit;
      $sql="select * from tb_ptrecords where ptid='".$ptid."' order by rid desc limit 1";
      //echo $sql;exit;
      $result = mysqli_query($conn,$sql);
      $rdate=0;
      while ($row=mysqli_fetch_array($result))
	    { 
        $rdate = $row['rdate'];
      }
      if($rdate==0)
      {
        echo "<SCRIPT type='text/javascript'>alert('No Latest Report Found..!!');window.location.replace(\"index.php\"); </SCRIPT>";
      }
      $result = mysqli_query($conn,$sql);

?>

  
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



        <!-- Small boxes (Stat box) --><br><br><br>
        <h2 style="font-family: 'Open Sans', sans-serif;"><center><b>Latest Report as on <?php echo $rdate; ?></b></center></h2><br>
        

        <table class="table table-bordered" id="table"  data-toggle="table" data-height="460"  data-pagination="true"   data-search="true"> 
        <thead>
          <tr style="text-align: center;">
            <th></th>
            <th>SpH</th>
            <th>Cyl</th>
            <th>Axis</th>
            <th>Prism</th>
            <th>Add</th>
          </tr>
      </thead>
      <tbody>
      <?php
						while ($row=mysqli_fetch_array($result))
					    {  ?>
        <tr style="text-align: center;">
          <th>Right</th>
          <td><input class="form-control input-sm" placeholder="Right SpH"  type="text" name="rsph" 
            id='rsph' readonly value='<?php echo $row['rsph']; ?>' value='<?php echo $row['rsph']; ?>'><span style="color: red;font-size: 12px" id="rsph1"></span></td>
          <td><input class="form-control input-sm" placeholder="Right CyL"  type="text" name="rcyl"
            id='rcyl'  readonly value='<?php echo $row['rcyl']; ?>'><span style="color: red;font-size: 12px" id="rcyl1"></span></td>
          <td><input class="form-control input-sm" placeholder="Right Axis"  type="text" name="raxis"
            id='raxis'  readonly value='<?php echo $row['raxis']; ?>'><span style="color: red;font-size: 12px" id="raxis1"></span></td>
          <td><input class="form-control input-sm" placeholder="Right Prism"  type="text" name="rprism"
            id='rprism'  readonly value='<?php echo $row['rprism']; ?>'><span style="color: red;font-size: 12px" id="rprism1"></span></td>
          <td><input class="form-control input-sm" placeholder="Right Add"  type="text" name="radd"
            id='radd' readonly value='<?php echo $row['radd']; ?>'><span style="color: red;font-size: 12px" id="radd1"></span></td>
        </tr> 

        <tr style="text-align: center;">
          <th>Left</th>
          <td><input class="form-control input-sm" placeholder="Left SpH"  type="text" name="lsph"
            id='lsph' readonly value='<?php echo $row['lsph']; ?>'><span style="color: red;font-size: 12px" id="lsph1"></span></td>
          <td><input class="form-control input-sm" placeholder="Left Cyl"  type="text" name="lcyl"
            id='lcyl'  readonly value='<?php echo $row['lcyl']; ?>'><span style="color: red;font-size: 12px" id="lcyl1"></span></td>
          <td><input class="form-control input-sm" placeholder="Left Axis"  type="text" name="laxis"
            id='laxis' readonly value='<?php echo $row['laxis']; ?>'><span style="color: red;font-size: 12px" id="laxis1"></span></td>
          <td><input class="form-control input-sm" placeholder="Left Prism"  type="text" name="lprism"
            id='lprism'  readonly value='<?php echo $row['lprism']; ?>'><span style="color: red;font-size: 12px" id="lprism1"></span></td>
          <td><input class="form-control input-sm" placeholder="Left Add"  type="text" name="ladd"
            id='ladd' readonly value='<?php echo $row['ladd']; ?>'><span style="color: red;font-size: 12px" id="ladd1"></span></td>
        </tr> 

        <tr style="text-align: center;" >
          <th>PD</th>
          <td colspan='7'><input class="form-control input-sm" placeholder="Pupillary Distance"  type="text" name="pd"
            id='pd' readonly value='<?php echo $row['pd']; ?>'><span style="color: red;font-size: 12px" id="pd1"></span></td>
        </tr> 
    <?php } ?>
      
      </tbody>
</table>

<!-- <center><button  class="btn btn-success">Print Report</button></center>  -->


          <!--// min="<?php $curdate//=date('Y-m-d'); echo date('Y-m-d'); ?>" 
                max="<?php $date //= new DateTime($curdate); echo $date->format('Y-m-t'); ?>"  -->

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

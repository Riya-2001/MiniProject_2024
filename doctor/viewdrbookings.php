<?php
   session_start();
   error_reporting(0);
   include('includes/dbconnection.php');
   include('header.php');
   
   if (isset($_SESSION['damsid']) && !empty($_SESSION['damsid'])) {
       $did = $_SESSION['damsid'];
      $sql="select * from tbldoctor inner join tblbooking on tbldoctor.LoginId=tblbooking.did where tblbooking.did='".$did."' order by tblbooking.bkdate desc";
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
   }

?>
<script type="text/javascript">
  function endDate() {

    var e1 = document.getElementById("e1");
    var edate = document.getElementById('ap_date').value;

    if(edate=="")
       {
         e1.textContent = "**Select Any Date for Searching";
         document.getElementById("ap_date").focus();
         return false;
       }
       else
       {
        e1.textContent = "";
        return true;
       }
  }

  function checkaAll() {

    if(endDate())
       {
         return true;
       }
       else
       {
        return false;
       }
  }
</script>
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



        <!-- Small boxes (Stat box) --><br><br><br>
        <h2 style="font-family: 'Open Sans', sans-serif;"><center><b>View Appointments</b></center></h2><br>
        

        <form role="form" action="viewdatewisebooking.php" method="post" enctype="multipart/form-data" name="myform">
                        
              <div class="form-group">
                
                <input placeholder="Select Appoinment Date" class="textbox-n form-control input-sm" type="text" onfocus="(this.type='date')" id="ap_date" name="ap_date" >
                  <span style="color: red;font-size: 12px" id="e1"></span>
                              </div> 
                  <input type="submit" value="View Bookings" class="btn btn-info btn-block" onclick="return checkaAll()" >
                            </form>


          <!--// min="<?php $curdate//=date('Y-m-d'); echo date('Y-m-d'); ?>" 
                max="<?php $date //= new DateTime($curdate); echo $date->format('Y-m-t'); ?>"  -->

</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
<?php
include('footer.php');
?>
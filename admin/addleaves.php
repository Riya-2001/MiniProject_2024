<?php
    session_start();
    if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
    { 
      include 'adminheader.php'; 
      include 'connection.php';

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add Quarterly Leave</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Leave Details for Doctor(s) and Staff(s)</h6>
                        </div>
                        <div class="card-body" >
						

                          <form role="form" action="updateleavecount.php" method="post" enctype="multipart/form-data" name="myform">          			    
<div class="row">
	<input type="hidden" name="bid" value="<?php echo $row['bid']; ?>">
                                
      <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="form-group">
                  <div class="form-group">
                   <input type="text" name="newlvbal" class="form-control input-sm" placeholder="Total Count" id="newlvbal" >
                  <span style="color: red;font-size: 14px" id="f8"></span>
                                          
                                  </div>
                                  </div>
                                </div>
                              </div>


                            


  			    			<input type="submit" value="Update" class="btn btn-info btn-block" onclick="return checkAll()" >
  
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

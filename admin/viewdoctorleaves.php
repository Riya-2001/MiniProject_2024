<?php
    session_start();
    if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
    { 
       
  include 'connection.php';
  include 'adminheader.php';

  

  $sql="update tb_leaves set status=3 where status=0 and utype='doctor'";
  $result = mysqli_query($conn,$sql);
  
  $sql = "select * from tb_doctor inner join tb_leaves on tb_leaves.uid=tb_doctor.loginid where delstatus=0 order by tb_leaves.id desc";
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Leave Details</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Doctor Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="table"  data-toggle="table"  data-height="460" data-pagination="true"
  data-search="true">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Total Days</th>
                                            <th>Type</th>
                                            <th>Reason</th>
                                            <th>Comments</th>
                                            <th>Approve / Reject</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Reason</th>
                                            <th>Comments</th>
                                            <th>Approve / Reject</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>

<div class="modal fade" id="modal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle"><center><?php echo $row['name']." - ".$row['sdate']." TO ".$row['edate']." - ".$row['type']; ?></center></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         
        </button>
      </div>
      <div class="modal-body">

         <form role="form" method="POST" action="rejectleaves.php" >
            <input type="text" name="comments" class="form-control input-sm" >
            <input type="hidden" name="lid" value="<?php echo $row['id']; ?>">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
     </form>
      </div>
    </div>
  </div>
</div>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['sdate']; ?></td>
                                            <td><?php echo $row['edate']; ?></td>
                                            <td><?php echo $row['totdays']." Day(s)"; ?></td>
                                            <td><?php echo $row['type']; ?></td>
                                            <td><?php echo $row['reason']; ?></td>
                                            <td><?php 

                                                $comments=$row['comments'];
                                                if($comments=='')
                                                    echo "<font color='purple'>NO COMMENTS</font>";
                                                else
                                                    echo "<font color='purple'>$comments</font>";
                                            ?></td>
                                            <td><?php $status = $row['status'];
                                            if($status==3)
                                            { ?>


                                               <a href="approveleavedr.php?t=<?php echo $row['id']; ?>"><button class="btn btn-success" ><i class="fa fa-check" aria-hidden="true"></i></button></a>


                                               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal<?php echo $row['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>


                                 <?php      }
                                            if($status==1)
                                            {   ?>
                                                <font color="green"><b>Approved</b></font>
                                 <?php      }    ?>

                                 <?php      
                                            if($status==2)
                                            {   ?>
                                                <font color="red"><b>Rejected</b></font>
                                 <?php      }    ?>


                                          </td>
                                        </tr>
                      <?php } ?>
                                    </tbody>
                                </table>
                    <!-- Modal -->

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            <?php include 'adminfooter.php'; }

    else
    {
        Header("location:../index.php");
    }
?>

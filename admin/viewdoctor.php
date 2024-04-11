<?php
    session_start();
    if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
    { 
       
  include 'connection.php';
  include 'adminheader.php';

  $sql="update tb_doctor set feestatus=4 where id!='0' and feestatus='0'";
  $result = mysqli_query($conn,$sql);

  $sql = "select * from tb_doctor inner join tb_login on tb_login.id=tb_doctor.loginid";
  //echo $sql;exit;
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Doctor Details</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Personal Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="table"  data-toggle="table"  data-height="460" data-pagination="true"
  data-search="true">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>DOB</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Pincode</th>
                                            <th>Phone #</th>
                                            <th>UG</th>
                                            <th>PG</th>
                                            <th>Licene #</th>
                                            <th>Experince</th>
                                            <th>Fee</th>
                                            <th>Activate / Deactivate</th>
                                        </tr>
                                    </thead>
                                    <!--<tfoot>
                                        <tr>
                                           <th>Name</th>
                                           <th>DOB</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Pincode</th>
                                            <th>Phone #</th>
                                            <th>UG</th>
                                            <th>PG</th>
                                            <th>Licene #</th>
                                            <th>Experince</th>
                                            <th>Fee</th>
                                            <th>Activate / Deactivate</th>
                                        </tr>
                                    </tfoot>-->
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['dob']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['pincode']; ?></td>
                                            <td><?php echo $row['phno']; ?></td>
                                            <td><?php echo $row['ug']." ".$row['ugyear'] ?></td>
                                            <td><?php echo $row['pg']." ".$row['pgyear'] ?></td>
                                            <td><?php echo $row['lno']; ?></td>
                                            <td><?php echo $row['exp']; ?></td>
                                            <td>

                                                <?php $status = $row['feestatus'];
                                            if($status==1 or $status==2)
                                            {

                                                echo $row['orgfee'];
                                               
                                            }
                                            if($status==0 or $status==4)
                                            {   echo "Old : ".$row['orgfee']."<br>New : ".$row['apfee']; ?><sup><span class="badge badge-pill badge-danger">New</span></sup><hr><center>

                                               <a href="approvefee.php?t=<?php echo $row['id']; ?>&fee=<?php echo $row['apfee'] ?>"><button class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button></a>
                                               <a href="rejectfee.php?t=<?php echo $row['id']; ?>"><button class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></a></center>
                                 <?php      }    ?>


                                            </td>
                                            <td><?php $status = $row['status'];
                                            if($status==1)
                                            { ?>
                                               <font color="green"><b>Active</b></font>&nbsp;&nbsp;<a href="deactivatedoctor.php?t=<?php echo $row['id']; ?>"><button class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></a>
                                 <?php      }
                                            if($status==0)
                                            {   ?>
                                               <font color="red"><b>Inactive</b></font>&nbsp;&nbsp;<a href="activatedoctor.php?t=<?php echo $row['id']; ?>"><button class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button></a>
                                 <?php      }    ?>


                                          </td>
                                        </tr>
                      <?php } ?>
                                    </tbody>
                                </table>
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

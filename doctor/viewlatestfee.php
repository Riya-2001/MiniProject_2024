<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('header.php');

if (isset($_SESSION['damsid']) && !empty($_SESSION['damsid'])) {
    $did = $_SESSION['damsid'];
    $sql = "SELECT * FROM tbldoctor WHERE LoginId = $did";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

?>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) --><br><br><br>
                    <h2 style="font-family: 'Open Sans', sans-serif;"><center><b>Appointment Fee Details</b></center></h2><br>

                    <table class="table table-bordered" id="table" data-toggle="table" data-height="460" data-pagination="true" data-search="true">
                        <thead>
                            <tr style="text-align: center;">
                                <th>Last Modified</th>
                                <th>Old Fee</th>
                                <th>New Fee</th>
                                <th>Comments/Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $c=1;
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr style="text-align: center;">
                                <td><?php echo $row['apfeeupdatetime']; ?></td>
                                <td><font color="green"><?php echo $row['orgfee']; ?></font></td>
                                <td><font color="red"><?php echo $row['apfee']; ?></font></td>
                                <td><?php
                                    $status = $row['feestatus'];
                                    if ($status == 0)
                                        echo "<b><font color='grey'>Not Viewed</font></b>";
                                    else if ($status == 1)
                                        echo "<b><font color='green'>Approved [ " . $row['comments'] . " ]</font></b>";
                                    else if ($status == 2)
                                        echo "<b><font color='red'>Rejected [ " . $row['comments'] . " ]</font></b>";
                                    else if ($status == 3)
                                        echo "<b><font color='red'>Admin Default</font></b>";
                                    else if ($status == 4)
                                        echo "<b><font color='violet'>Viewed By Admin</font></b>";
                                    ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="form-group"> <br>
                        <a href="apfee.php"><button class="btn btn-outline-success btn-block"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Back To Home</button></a>
                    </div>
                </div>
            </section>
            <!-- /.content -->
<?php

include('footer.php');
?>

</section>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->


</div>
<?php
}
  else
  {
    Header("location:../index.html  ");
  }
?>
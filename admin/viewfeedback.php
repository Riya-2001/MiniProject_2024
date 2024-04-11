<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<?php
    session_start();
    if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
    { 
       
  include 'connection.php';
  include 'adminheader.php';
  
  $sql = "select * from tb_feedback order by fid desc";
  $count=0;
  $result = mysqli_query($conn,$sql);
?>
<?php
/*
$sql1 = "SELECT * FROM `tb_feedback`";
$result1 = mysqli_query($conn,$sql1);
if ($result1->num_rows > 0) {
   $texts = array();
   while ($row = $result1->fetch_assoc()) {
       $texts[] = $row["feed"];
   }
   $url = 'http://127.0.0.1:5000/sentiment';
   $data = json_encode(array('texts' => $texts));
   $options = array(
       'http' => array(
           'header'  => "Content-type: application/json\r\n",
           'method'  => 'POST',
           'content' => $data,
       ),
   );
   $context  = stream_context_create($options);
   $result1 = file_get_contents($url, false, $context);
   $result1 = json_decode($result1, true);

   $positive = $result1['positive'];
   $negative = $result1['negative'];
   $neutral = $result1['neutral'];
   $total = $positive + $negative + $neutral;

   $pos_percent = ($positive / $total) * 100;
   $neg_percent = ($negative / $total) * 100;
   $neu_percent = ($neutral / $total) * 100;
   $pos_accuracy = ($pos_percent > $neg_percent) ? $pos_percent : (100 - $neg_percent);
   $neg_accuracy = ($neg_percent > $pos_percent) ? $neg_percent : (100 - $pos_percent);
   $neutral_accuracy = ($neu_percent > ($pos_percent + $neg_percent)) ? $neu_percent : (100 - ($pos_percent + $neg_percent));

  } else {
   echo "No feedback data found in the database.";
   $pos_percent = 0;
   $neg_percent = 0;
   $neu_percent=0;
   $neu_percent = 0;
   $pos_accuracy = 0;
   $neg_accuracy = 0;
   $neu_accuracy = 0;
   $neutral_accuracy=0;
}
  */
?>
<!--<div class="container-fluid" style ="position:relative; left:150px;">        
   
   <h3 class="text-danger">Sentiment Analysis </h3>
   <div class="chart-container" style="height:400px;">
       <canvas id="sentiment-chart"></canvas>
   </div>
   <div>
   <p>Positive Accuracy: <?php echo $pos_accuracy; ?>%</p>
   <p>Negative Accuracy: <?php echo $neg_accuracy; ?>%</p>
   <p>Neutral Accuracy: <?php echo $neutral_accuracy; ?>%</p>
</div>
</div>

   <script>
       var ctx = document.getElementById('sentiment-chart').getContext('2d');
       var chart = new Chart(ctx, {
           type: 'bar',
           data: {
               labels: ['Positive', 'Negative', 'Neutral'],
               datasets: [{
                   label: 'Sentiment Analysis percentage',
                   data: [<?php echo $pos_percent; ?>, <?php echo $neg_percent; ?>, <?php echo $neu_percent; ?>],
                   backgroundColor: [
                       'rgba(59, 245, 42, 0.2)',
                       'rgba(255, 99, 132, 0.2)',
                       'rgba(250, 246, 37, 0.2)'
                   ],
                   borderColor: [
                       'rgba(55, 176, 86, 1)',
                       'rgba(255, 99, 132, 1)',
                       'rgba(227, 214, 34, 1)'
                   ],
                   borderWidth: 1
               }]
           },
           options: {
               scales: {
                   y: {
                       beginAtZero: true,
                       ticks: {
                           stepSize: 10,
                           max: 100
                       }
                   }
               }
           }
       })
   </script>-->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Feedback Details</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Feedback Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="table"  data-toggle="table"  data-height="460" data-pagination="true"
  data-search="true">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Feedback</th>
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
                                            <th><?php echo $count+1; ?></th>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['feed']; ?></td>
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

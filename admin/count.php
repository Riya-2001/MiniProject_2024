<?php
    include 'connection.php';

    $count1=0; //doctor count
    $count2=0; //staff count

    $sql="select count(*) as count from tb_leaves where status=0 and utype='doctor'";
    $result = mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($result))
    { 
        $count1=$row['count'];
    }

    $sql="select count(*) as count from tb_leaves where status=0 and utype='staff'";
    $result = mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($result))
    { 
        $count2=$row['count'];
    }

    $sql="select count(*) as count from tb_doctor where feestatus=0";
    $result = mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($result))
    { 
        $count3=$row['count'];
    }

   
?>
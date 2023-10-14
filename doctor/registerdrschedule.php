<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

	$slot = $_POST['color'];
	$availdate = $_POST['availdate'];
    $did = $_SESSION['damsid'];

	$s1=0;
	$s2=0;
	$s3=0;
	$s4=0;
	$s5=0;
	$s6=0;
	$s7=0;

	if(isset($slot[0]))
	{
		if($slot[0]=='s1')
		{
			$s1=1;
		}
		if($slot[0]=='s2')
		{
			$s2=1;
		}
		if($slot[0]=='s3')
		{
			$s3=1;
		}
		if($slot[0]=='s4')
		{
			$s4=1;
		}
		if($slot[0]=='s5')
		{
			$s5=1;
		}
		if($slot[0]=='s6')
		{
			$s6=1;
		}
		if($slot[0]=='s7')
		{
			$s7=1;
		}
	}

	if(isset($slot[1]))
	{
		if($slot[1]=='s1')
		{
			$s1=1;
		}
		if($slot[1]=='s2')
		{
			$s2=1;
		}
		if($slot[1]=='s3')
		{
			$s3=1;
		}
		if($slot[1]=='s4')
		{
			$s4=1;
		}
		if($slot[1]=='s5')
		{
			$s5=1;
		}
		if($slot[1]=='s6')
		{
			$s6=1;
		}
		if($slot[1]=='s7')
		{
			$s7=1;
		}
	}

	if(isset($slot[2]))
	{
		if($slot[2]=='s1')
		{
			$s1=1;
		}
		if($slot[2]=='s2')
		{
			$s2=1;
		}
		if($slot[2]=='s3')
		{
			$s3=1;
		}
		if($slot[2]=='s4')
		{
			$s4=1;
		}
		if($slot[2]=='s5')
		{
			$s5=1;
		}
		if($slot[2]=='s6')
		{
			$s6=1;
		}
		if($slot[2]=='s7')
		{
			$s7=1;
		}
	}

	if(isset($slot[3]))
	{
		if($slot[3]=='s1')
		{
			$s1=1;
		}
		if($slot[3]=='s2')
		{
			$s2=1;
		}
		if($slot[3]=='s3')
		{
			$s3=1;
		}
		if($slot[3]=='s4')
		{
			$s4=1;
		}
		if($slot[3]=='s5')
		{
			$s5=1;
		}
		if($slot[3]=='s6')
		{
			$s6=1;
		}
		if($slot[3]=='s7')
		{
			$s7=1;
		}	
	}

	if(isset($slot[4]))
	{
		if($slot[4]=='s1')
		{
			$s1=1;
		}
		if($slot[4]=='s2')
		{
			$s2=1;
		}
		if($slot[4]=='s3')
		{
			$s3=1;
		}
		if($slot[4]=='s4')
		{
			$s4=1;
		}
		if($slot[4]=='s5')
		{
			$s5=1;
		}
		if($slot[4]=='s6')
		{
			$s6=1;
		}
		if($slot[4]=='s7')
		{
			$s7=1;
		}	
	}

	if(isset($slot[5]))
	{
		if($slot[5]=='s1')
		{
			$s1=1;
		}
		if($slot[5]=='s2')
		{
			$s2=1;
		}
		if($slot[5]=='s3')
		{
			$s3=1;
		}
		if($slot[5]=='s4')
		{
			$s4=1;
		}
		if($slot[5]=='s5')
		{
			$s5=1;
		}
		if($slot[5]=='s6')
		{
			$s6=1;
		}
		if($slot[5]=='s7')
		{
			$s7=1;
		}
	}

	if(isset($slot[6]))
	{
		if($slot[6]=='s1')
		{
			$s1=1;
		}
		if($slot[6]=='s2')
		{
			$s2=1;
		}
		if($slot[6]=='s3')
		{
			$s3=1;
		}
		if($slot[6]=='s4')
		{
			$s4=1;
		}
		if($slot[6]=='s5')
		{
			$s5=1;
		}
		if($slot[6]=='s6')
		{
			$s6=1;
		}
		if($slot[6]=='s7')
		{
			$s7=1;
		}	
	}

    $sql_check = "SELECT * FROM tblschedule WHERE availdate = ? AND LoginId = ?";
    $stmt_check = $dbh->prepare($sql_check);
    $stmt_check->execute([$availdate, $did]);
    $existing_slots = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
    if ($existing_slots) {
        // Slots already exist, show an error message
        echo "<SCRIPT type='text/javascript'>alert('Selected slots already exist for this date.');
        window.location.replace(\"doctor_schedule.php\");
        </SCRIPT>";
    } else {
        // Slots do not exist, insert them
        $slotParams = [];
        foreach ($slot as $s) {
            $slotParams[$s] = 1;
        }
    
        $sql_insert = "INSERT INTO tblschedule (availdate, slot1, slot2, slot3, slot4, slot5, slot6, slot7, LoginId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $dbh->prepare($sql_insert);
        $stmt_insert->execute([$availdate, $slotParams['s1'] ?? 0, $slotParams['s2'] ?? 0, $slotParams['s3'] ?? 0, $slotParams['s4'] ?? 0, $slotParams['s5'] ?? 0, $slotParams['s6'] ?? 0, $slotParams['s7'] ?? 0, $did]);
    
        if ($stmt_insert) {
            echo "<SCRIPT type='text/javascript'>alert('Slots Added Successfully');
            window.location.replace(\"doctor_schedule.php\");
            </SCRIPT>";
        } else {
            echo "<SCRIPT type='text/javascript'>alert('Slots Adding Failed');
            window.location.replace(\"doctor_schedule.php\");
            </SCRIPT>";
        }
    }
    ?>
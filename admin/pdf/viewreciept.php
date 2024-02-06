<?php
/*call the FPDF library*/

require('rotation.php');
class PDF extends PDF_Rotate
{
	function Header()
	{
		/* Put the watermark */
		$this->SetFont('Arial','B',30); //text style,bold/italics/size
		$this->SetTextColor(224,224,224); //rgb
		$this->RotatedText(69,170,'Eyelet - Eye Care',45); //x,y,degree

	}

	function RotatedText($x, $y, $txt, $angle)
	{
		/* Text rotated around its origin */
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
}
include '../includes/dbconnection.php';
$id=$_GET['t'];
$sql="select bkdate,bktimeslot,paymentdate,amount,pt.name as ptname,dr.name as drname,specialization from tblbooking bk inner join tbldoctor dr on dr.loginid=bk.drid inner join tb_patient pt on bk.loginid=pt.loginid where bk.id = '".$id."'";
 $result = mysqli_query($conn,$sql);
//echo $sql;exit;
while ($row=mysqli_fetch_array($result))
{
	$bkdate=$row['bkdate'];
	$bktimeslot=$row['bktimeslot'];
	$paymentdate=$row['paymentdate'];
	$amount=$row['amount'];
	$ptname=$row['ptname'];
	$drname=$row['drname'];
	$specialization=$row['specialization'];
}

$bk=$bktimeslot;
if($bk=='s1')
{
	$bktimeslot='9am-9.30am';
}

if($bk=='s2')
{
	$bktimeslot='9.30am-10am';
}

if($bk=='s3')
{
	$bktimeslot='10am-10.30am';
}

if($bk=='s4')
{
	$bktimeslot='11am-11.30am';
}

if($bk=='s5')
{
	$bktimeslot='12.30pm-1pm';
}

if($bk=='s6')
{
	$bktimeslot='2pm-2.30pm';
}

if($bk=='s6')
{
	$bktimeslot='3pm-3.30pm';
}

$flag="";

$result = mysqli_query($conn,$sql);


$pdf=new PDF();
$pdf->AddPage();


$pdf->SetDrawColor(50,60,100);
$pdf->Image('eyelet.png',65,7,100);

$pdf->SetXY(72,23);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "DentCare Dental Hospital, Pala, Kerala");

$pdf->SetXY(72,22);
$pdf->SetFont('Arial','B',25);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "______________________________________");

$pdf->SetXY(80,38);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Payment Reciept");

$pdf->SetXY(30,50);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Bill Number "); 

$pdf->SetXY(30,60);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Patient Name "); 

$pdf->SetXY(30,70);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Date "); 

$pdf->SetXY(30,80);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Doctor Name "); 

$pdf->SetXY(30,90);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Appointment Date-Time "); 

$pdf->SetXY(30,100);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Amount Paid "); 

$pdf->SetXY(30,110);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Payment Date-Time "); 

	
$pdf->SetXY(145,50);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "EyeLetBill#".$id);

$pdf->SetXY(145,60);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, $ptname); 

$pdf->SetXY(145,70);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, $bkdate); 

$pdf->SetXY(145,80);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, $drname." [ ".$specialization." ]"); 

$pdf->SetXY(145,90);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, $bktimeslot); 

$pdf->SetXY(145,100);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, $amount." INR"); 

$pdf->SetXY(145,110);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, $paymentdate); 


$pdf->SetXY(100,50);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, ":");

$pdf->SetXY(100,60);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, ":");

$pdf->SetXY(100,70);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, ":");

$pdf->SetXY(100,80);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, ":");

$pdf->SetXY(100,90);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, ":");

$pdf->SetXY(100,100);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, ":");

$pdf->SetXY(100,110);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, ":");

$pdf->Image('success.png',70,120,33);

$pdf->SetXY(105,134);
$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(0,200,0);
$pdf->Write (5, "P A I D");

$pdf->SetXY(25,-32);
$pdf->SetFont('Arial','B',25);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "______________________________________");


$pdf->Output('I',date('y-m-d').'Bill.pdf');

?>
        
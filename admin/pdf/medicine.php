<?php
/*call the FPDF library*/
$today=date('Y-m-d');

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
$sql="select p.pdate as pdate,p.pdesc as pdesc,pt.name as pname,d.name as dname, pt.dob as pdob from tblprescription p inner join tb_doctor d on p.drid=d.loginid inner join tb_patient pt on pt.loginid=p.ptid where pid='".$_GET['t']."'";
//echo $sql;exit;

$flag="";

$result = mysqli_query($conn,$sql);
while ($row=mysqli_fetch_array($result))
{

	$dob=$row['pdob'];

	@$age=$today-$dob;

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

	$pdf->SetXY(73,38);
	$pdf->SetFont('Arial','B',18);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Medicine Prescription");

	$pdf->SetXY(10,50);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Date : "); 

	$pdf->SetXY(23,50);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['pdate']); 


	$pdf->SetXY(145,50);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Doctor : ");

	$pdf->SetXY(163,50);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Dr. ".$row['dname']);


	$pdf->SetXY(70,50);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Patient : ");


	$pdf->SetXY(90,50);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['pname']." [".$age." Yrs]");


	$pdf->SetXY(10,80);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Medicines Details and Timings ");


	$pdf->SetXY(10,90);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['pdesc']);


	$pdf->SetXY(90,150);
	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Doctor Signature");

	$pdf->SetXY(120,130);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Signature Valid");

	$pdf->SetXY(120,134);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Digitally Signed by : Dr. ".$row['dname']);

	$pdf->SetXY(120,138);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "on ".$row['pdate']);

	$pdf->Image('sign.png',95,125,20);


}


$pdf->SetXY(25,-32);
$pdf->SetFont('Arial','B',25);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "______________________________________");


$pdf->Output('I',date('ymdHms').'.pdf');

?>
        
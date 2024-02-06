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
$sql="select * from tblstaff inner join tblrole on tblrole.id=tblstaff.loginid where status = '1'";

$flag="";
$query = $dbh->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);


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

$pdf->SetXY(85,38);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Staff Details");

$pdf->SetXY(10,50);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "#"); 

$pdf->SetXY(25,50);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Name");

$pdf->SetXY(58,50);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Email");

$pdf->SetXY(100,50);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Phone #");

$pdf->SetXY(130,50);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "Address");

$x=10;
$y=60;
$count=1;
while ($row=mysqli_fetch_array($result))
{
		
	$pdf->SetXY($x,$y);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $count); 

	$pdf->SetXY(25,$y);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['name']);

	$pdf->SetXY(50,$y);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['username']);

	$pdf->SetXY(100,$y);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['phno']);

	$pdf->SetXY(130,$y);
	$pdf->SetFont('Arial','B',8); //8 text size for address
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['address']);

	$count=$count+1;
	$y=$y+10;

}


$pdf->SetXY(25,-32);
$pdf->SetFont('Arial','B',25);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "______________________________________");


$pdf->Output('I',date('y-m-d').'staffDetails.pdf');

?>
        
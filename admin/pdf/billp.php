<?php
/*call the FPDF library*/
$today=date('Y-m-d');
$ptid = $_COOKIE['lkey'];

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

$sql="select * from tb_beds where btype='t1'";
$result = mysqli_query($conn,$sql);
while ($row=mysqli_fetch_array($result))
{
  $ratenonac=$row['brate'];
  //echo $ratenonac;exit;
}


$sql="select * from tb_beds where btype='t2'";
$result = mysqli_query($conn,$sql);
while ($row=mysqli_fetch_array($result))
{
  $rateac=$row['brate'];
}


$sql="select b.bkid as bkid,b.bkstartdate as stdate, b.bkenddate as bkenddate,totdays,rate,paydate,txnid,p.name as pname,st.name as stname,pmode,
p.phno as phno,rmno,txnid from tb_bedbooking b inner join tb_patient p on b.ptid=p.id inner join tb_staff st on st.loginid=b.staffid where bkid='".$_GET['t']."'";
//echo $sql;exit;

$flag="";
$pdf=new PDF();
$pdf->AddPage();

$result = mysqli_query($conn,$sql);
while ($row=mysqli_fetch_array($result))
{

	$rmno=$row['rmno'];
	$mode=$row['pmode'];

	if($rmno=='rm1' or $rmno=='rm2' or $rmno=='rm3' or $rmno=='rm4')
    {
        $type="Non - AC";
        $rate=$ratenonac;
    }
    else
    {
        $type="AC";
        $rate=$rateac;
    }

    if($mode==0)
    {
    	$smode="None";
    }
    else if($mode==1)
    {
    	$smode="Online";
    }
    else
    {
    	$smode="Cash";
    }


	$pdf->SetDrawColor(50,60,100);
	$pdf->Image('eyelet.png',65,7,100);

	$pdf->SetXY(72,23);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Eye Care Hospital, Thrissur, Kerala");

	$pdf->SetXY(72,22);
	$pdf->SetFont('Arial','B',25);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "______________________________________");

	$pdf->SetXY(73,38);
	$pdf->SetFont('Arial','B',18);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Discharge Bill");

	$pdf->SetXY(10,50);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Date : ");

	$pdf->SetXY(10,60);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Admit Date");

	$pdf->SetXY(110,60);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['stdate']); 

	$pdf->SetXY(75,60);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, ":"); 

	$pdf->SetXY(10,70);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Discharge Date"); 

	$pdf->SetXY(110,70);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['bkenddate']); 

	$pdf->SetXY(75,70);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, ":"); 

	$pdf->SetXY(10,80);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Total Days");



	$pdf->SetXY(75,80);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, ":"); 


	$tot=$row['totdays'];
	$pdf->SetXY(110,80);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $tot."Day(s)"); 


	$pdf->SetXY(23,50);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['bkenddate']); 


	$pdf->SetXY(145,50);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Patient : ");

	$pdf->SetXY(163,50);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['pname']);


	$pdf->SetXY(75,50);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Bill # : ");


	$pdf->SetXY(90,50);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "EyeLet00".$row['bkid']);

	$pdf->SetXY(10,90);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Room Type");

	$pdf->SetXY(75,90);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, ":"); 


	$pdf->SetXY(110,90);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $type); 


	$pdf->SetXY(10,100);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Rate/Day");

	$pdf->SetXY(75,100);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, ":"); 


	$pdf->SetXY(110,100);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $rate." INR"); 


	$pdf->SetXY(10,110);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Payment Mode");

	$pdf->SetXY(75,110);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, ":"); 


	$pdf->SetXY(110,110);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $smode); 


	$pdf->SetXY(10,140);
	$pdf->SetFont('Arial','B',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Total Amount Paid");

	$pdf->SetXY(75,140);
	$pdf->SetFont('Arial','B',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, ":"); 

	$pdf->SetXY(110,140);
	$pdf->SetFont('Arial','',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, $row['rate']." INR"); 



	$pdf->SetXY(70,180);
	$pdf->SetFont('Arial','B',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Payment Status");

	$pdf->SetXY(78,190);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Transaction ID : ".$row['txnid']);

	$pdf->Image('paid.png',115,177,20);


	$pdf->SetXY(150,250);
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Staff Signature");

	$pdf->SetXY(157,230);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Signature Valid");

	$pdf->SetXY(157,235);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "Digitally Signed by : ".$row['stname']);

	$pdf->SetXY(157,240);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Write (5, "on ".$row['bkenddate']);

	$pdf->Image('sign.png',135,225,20);


}


$pdf->SetXY(25,-32);
$pdf->SetFont('Arial','B',25);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "______________________________________");


$pdf->Output('I',date('ymdHms').'.pdf');

?>
        
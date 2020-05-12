<?php
//call the FPDF library
require('fpdf182/fpdf.php');


$con=mysqli_connect("localhost","root","") or die("unable to connect");
mysqli_select_db($con,"inventorymanagement");
session_start();
$c=$_SESSION['custid'];
$p=$_SESSION['proid'];
$q="select * from sales where custid='$c'";
$q1="select * from products where productid='$p'";
$r1=mysqli_query($con,$q1);
if($r1)
{
	$row1=mysqli_fetch_array($r1);
}
else
	echo'<script>alert("Internal error occured. Please try again");</script>';
$r=mysqli_query($con,$q);
if($r)
{
	$row=mysqli_fetch_array($r);
}
else
	echo'<script>alert("Internal error occured. Please try again");</script>';
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//create pdf object
//$pdf = new FPDF('P','mm','A4');
//add new page

class PDF extends FPDF {

    const DPI = 96;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 210;
    const A4_WIDTH = 425;
    // tweak these values (in pixels)
    const MAX_WIDTH = 500;
    const MAX_HEIGHT = 450;

    function pixelsToMM($val) {
        return $val * self::MM_IN_INCH / self::DPI;
    }

    function resizeToFit($imgFilename) {
        list($width, $height) = getimagesize($imgFilename);

        $widthScale = self::MAX_WIDTH / $width;
        $heightScale = self::MAX_HEIGHT / $height;

        $scale = min($widthScale, $heightScale);

        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }

    function centreImage($img) {
        list($width, $height) = $this->resizeToFit($img);

        // you will probably want to swap the width/height
        // around depending on the page's orientation
        $this->Image(
            $img, (self::A4_HEIGHT - $width) / 2,
            (self::A4_WIDTH - $height) / 2,
            $width,
            $height
        );
    }
}

// usage:
$pdf = new PDF();
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )
$pdf->Image("logo.png");
$pdf->Cell(140 ,-40,'CASH AND CARRY STORES',0,1,'R');
$pdf->Cell(189 ,40,'',0,1);//end of line
$pdf->Cell(190 ,10,'INVOICE',0,1,'C');//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,7,'To,',0,0);
$pdf->Cell(25 ,7,'Date : ',0,0);
$pdf->Cell(34 ,7,$row['date'],0,1);//end of line

$pdf->Cell(130 ,7,$row['custname'].',',0,0);
$pdf->Cell(25 ,7,'Invoice No : ',0,0);
$pdf->Cell(34 ,7,$row['invoice'],0,1);//end of line

$pdf->Cell(130 ,7,$row['custaddr'].'.',0,0);
$pdf->Cell(25 ,7,'Customer ID:',0,0);
$pdf->Cell(34 ,7,$row['custid'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line


//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(60 ,10,'Product Name',1,0);
$pdf->Cell(40 ,10,'Product ID',1,0);
$pdf->Cell(25 ,10,'Quantity',1,0);
$pdf->Cell(34 ,10,'Price',1,0);//end of line
$pdf->Cell(34 ,10,'Total Price',1,1);//end of line

$pdf->SetFont('Arial','',12);


$pdf->Cell(60 ,7,$row1['productname'],1,0);
$pdf->Cell(40 ,7,$row['productid'],1,0);
$pdf->Cell(25 ,7,$row['quantity'],1,0);
$pdf->Cell(34 ,7,$row['price'],1,0);//end of line
$pdf->Cell(34 ,7,$row['totalprice'],1,1);//end of line


$pdf->Cell(60 ,7,'',0,0);
$pdf->Cell(40 ,7,'',0,0);
$pdf->Cell(30 ,7,'',0,0);
$pdf->Cell(29 ,7,'Subtotal : ',0,0);//end of line
$pdf->Cell(34 ,7,$row['totalprice'],1,1);//end of line

$pdf->Cell(60 ,7,'',0,0);
$pdf->Cell(40 ,7,'',0,0);
$pdf->Cell(30 ,7,'',0,0);
$pdf->Cell(29 ,7,'Tax : ',0,0);//end of line
$pdf->Cell(34 ,7,'0',1,1);

$pdf->Cell(60 ,7,'',0,0);
$pdf->Cell(40 ,7,'',0,0);
$pdf->Cell(30 ,7,'',0,0);
$pdf->Cell(29 ,7,'Total : ',0,0);//end of line
$pdf->Cell(34 ,7,$row['totalprice'],1,1);

$pdf->Cell(189 ,10,'',0,1);//end of line

$pdf->Cell(150 ,7,'',0,1);
$pdf->Cell(40 ,7,'Signature : ',0,1);

$pdf->Cell(189 ,5,'',0,1);
//$pdf->Image("thankyou.png");

$pdf->centreImage("tq.jpeg");


$pdf->Output();
?>
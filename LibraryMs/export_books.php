<?php

require('fpdf/fpdf.php');

include 'db.php';

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Cell(190,10,'Books Report',1,1,'C');

$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(60,10,'Title',1);

$pdf->Cell(50,10,'Author',1);

$pdf->Cell(40,10,'Genre',1);

$pdf->Cell(30,10,'Available',1);

$pdf->Ln();

$pdf->SetFont('Arial','',11);

$result = mysqli_query($conn,

"SELECT * FROM books");

while($row=mysqli_fetch_assoc($result)){

$pdf->Cell(60,10,$row['title'],1);

$pdf->Cell(50,10,$row['author'],1);

$pdf->Cell(40,10,$row['genre'],1);

$pdf->Cell(30,10,$row['available_copies'],1);

$pdf->Ln();

}

$pdf->Output();

?>
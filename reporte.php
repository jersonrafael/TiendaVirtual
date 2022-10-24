<?php

require('pdf/fpdf.php');

class PDF extends FPDF{
	//CABECERA DE LA PAGINA

	function Header(){

		//logo
		$this->Cell(-200);
		$this->Image('assets/img/2FB.JPG',0,0,220);

		//LETRAS DEL PDF
		$this->Ln(10);
		$this->SetFont('Arial','B','10');

		$this->Cell(-200);
	}

	function Footer(){

		$this->SetFillColor(20.05,19);

		$this->Rect(0,270,220,30,'F');

		$this->SetY(-20); //SUBE LAS LETRAS

		$this->SetFont('Arial','',10);

		$this->SetTextColor(255,255,255);

		//SI SE QUIERE MAS TEXTO USAR ESTA TRES PROPIEDADES
		
		$this->SetX(35);

		$this->Write(5, '       Dirigete con esta factura a tu sede de SUPLYMAX mas cercana y finaliza tu compra         ');

		$this->Ln();
	}
	}	
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial', '', 10);


	$pdf->SetY(120);
	$pdf->SetX(40);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFillColor(79,59,120);

	$pdf->Cell(20,9,'id', 0,0,'C',1 );
	$pdf->Cell(45,9,'Nombre del producto', 0,0,'C',1 );
	$pdf->Cell(50,9,'Precio del producto', 0,1,'C',1 );

	// $pdf->Cell(30,9,'Cantidad', 0,1,'C',1 );
	
	include('admin_control/login/db.php');
	require('admin_control/login/db.php');

	$consulta = "SELECT * FROM productos";
	$resultado = mysqli_query($conexion, $consulta);

	$pdf->SetTextColor(0,0,0);
	$pdf->SetFillColor(240,245,255);

	while($row = $resultado->fetch_assoc()){

		$pdf->SetX(40);

		$pdf->Cell(20,9, $row['id'], 0,0,'C',1);

		$pdf->Cell(35,9, $row['nombre'], 0,0,'C',1 );

		$pdf->Cell(60,9, $row['precio_rebajado'], 0,1,'C',1 );

		// $pdf->Cell(30,9, $row['cantidad'], 0,1,'C',1 );
	}

	$pdf->Output();

?>
<?php
	require('fpdf.php');
	
	class PDF extends FPDF
	{
		function Header()
		{
			$this->Ln(8);
			
			$this->SetFont('Times','B',14);
			$this->Cell(0,5,'UNIVERSIDAD NACIONAL DEL ALTIPLANO', 0, 0, 'C');
			$this->Ln();
			$this->SetFont('Arial','B',12);
			$this->Cell(0,5,'OFICINA DE TECNOLOGÍA INFORMÁTICA', 0, 0, 'C');
			$this->Ln();
			$this->SetFont('arialn','B',12);
			$this->Cell(0,5,'UN@P.NET2 STUDENT', 0, 0, 'C');
			$this->Ln();
			
			$this->Ln(4);
			
		}
		function Subhnota()
		{
			$this->SetFont('arialn','B',10);
			$this->Cell(10);
			$this->Cell(120,4,'FACULTAD: ', 0);
			$this->SetFont('arial','B',12);
			$this->Cell(50,4,'HISTORIAL DE NOTAS', 0, 0, 0,'R');
			$this->SetFont('arialn','B',10);
			$this->Ln();
			
			$this->Cell(10);
			$this->Cell(120,4,'CARRERA: ', 0);
			$this->Cell(50,4,'N° de Matrícula: ', 0, 0, 0,'R');
			$this->Ln();
			
			$this->Cell(10);
			$this->Cell(170,4,'APELLIDOS Y NOMBRES: ', 0);
			$this->Ln();
			
			$this->Ln(4);
		}
		
		function Footer()
		{
			$this->SetFont('arialn','',10);
			$this->Line(20, 277, 190, 277);
			$this->SetY(-20);			
			$this->Cell(10);
			$this->Cell(120, 4,'Fecha: ', 0);
			$this->Cell(50, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
		}
		function Body()
		{
			$this->Line(20, 52, 190, 52);
			
			$this->Cell(10);
			$this->Cell(15,4,'Periodo', 1, 0, 'C');
			$this->Cell(8,4,'Niv', 1, 0, 'C');
			$this->Cell(8,4,'Sem', 1, 0, 'C');
			$this->Cell(15,4,'Código', 1, 0, 'C');
			$this->Cell(85,4,'Curso', 1, 0, 'C');
			$this->Cell(19,4,'Modalidad', 1, 0, 'C');
			$this->Cell(10,4,'Créd', 1, 0, 'C');
			$this->Cell(10,4,'Nota', 1, 0, 'C');
			$this->Ln();
			
			$this->Line(20, 58, 190, 58);		
		}
	}


/*	$pdf=new PDF('P', 'mm', 'A4');
	$pdf->AliasNbPages();
	$pdf->AddFont('arialn','','arialn.php');
	$pdf->AddFont('arialn','B','arialnb.php');
	$pdf->AddPage();
	$pdf->Subhnota();
	$pdf->Body();
	$pdf->AddPage();
	
	$pdf->Output();*/
?> 
<?php

	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	require "../include/fpdf.php";

	if(fsafetyselcar2())
	{
		class PDF extends FPDF
		{
			function Header()
			{
				$this->Ln(8);
				
				$this->SetFont('Times','B',14);
				$this->Cell(0,5,'UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO', 0, 0, 'C');
				$this->Ln();
				$this->SetFont('Arial','B',12);
				$this->Cell(0,5,'OFICINA DE TECNOLOGÍA INFORMÁTICA', 0, 0, 'C');
				$this->Ln();
				$this->SetFont('arialn','B',12);
				$this->Cell(0,5,'UN@P.NET2', 0, 0, 'C');
				$this->Ln();
				
				$this->Ln(4);
				$this->Subhnota();
				$this->Subhnota2();
				
			}
			function Subhnota()
			{
				global $sUsercoo, $sCarrera, $sFacultad, $sEstudia;
				$this->SetFont('arialn','B',10);
				$this->Cell(10);
				$this->Cell(120,4,"FACULTAD: {$sFacultad[$sUsercoo['cod_fac']]}", 0);
				$this->SetFont('arial','B',12);
				$this->Cell(50,4,'HISTORIAL DE NOTAS', 0, 0, 0,'R');
				$this->SetFont('arialn','B',10);
				$this->Ln();
				
				$this->Cell(10);
				$this->Cell(120,4, "ESCUELA PROFESIONAL: {$sCarrera[$sUsercoo['cod_car']]}", 0);
				$this->SetFont('arial','B',12);
				$this->Cell(50,4, "N° de Matrícula: {$sEstudia['num_mat']}", 0, 0, 0,'R');
				$this->SetFont('arialn','B',10);
				$this->Ln();
				
				$vNombre = strtoupper("{$sEstudia['paterno']} {$sEstudia['materno']}, {$sEstudia['nombres']}");
				$this->Cell(10);
				$this->Cell(170,4, "APELLIDOS Y NOMBRES: $vNombre", 0);
				$this->Ln();
				
				$this->Ln(2);
			}
			
			function Subhnota2()
			{
				$this->SetFont('arialn','B',9);
	//			$this->Line(20, 52, 190, 52);
							
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
				$this->Ln(2);
			}
			
			function Footer()
			{
				global $sUsercoo, $sMes;
				$vFecha = getdate(time());
				$vFechan = "{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} - Hora: {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']} hrs.";
				$this->SetFont('arialn','',10);
				$this->Line(20, 277, 190, 277);
				$this->SetY(-20);			
				$this->Cell(10);
				$this->Cell(120, 4,"Fecha: $vFechan - IP: {$sUsercoo['ip']}", 0);
				$this->Cell(50, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
			}
			function Body()
			{			
				global $sNotapdf;
				$this->SetFont('arialn','',9);
				if(!empty($sNotapdf))
				foreach($sNotapdf as $sNota)
				{
					$this->Cell(10);
					$this->Cell(15,5, $sNota['ano_per'], 0, 0, 'L');
					if($sNota['header'])
					{
						$this->SetFont('arialn','B',9);
						$this->Cell(8,5, $sNota['niv_est'], 0, 0, 'L');
						$this->SetFont('arialn','',9);
					}
					else
						$this->Cell(8,5, $sNota['niv_est'], 0, 0, 'C');
					$this->Cell(8,5, $sNota['sem_anu'], 0, 0, 'C');
					$this->Cell(15,5, $sNota['cod_cat'], 0, 0, 'C');
					$this->Cell(85,5, $sNota['nom_cur'], 0, 0, 'L');
					$this->Cell(19,5, $sNota['mod_not'], 0, 0, 'L');
					$this->Cell(10,5, $sNota['crd_cur'], 0, 0, 'R');
					if($sNota['not_cur'] < 11)
					{
						$this->SetFont('arialn','B',11);
						$this->Cell(10,5, $sNota['not_cur'], 0, 0, 'R');
						$this->SetFont('arialn','',9);
					}
					else
					{
						$this->SetFont('arialn','',11);
						$this->Cell(10,5, $sNota['not_cur'], 0, 0, 'R');
						$this->SetFont('arialn','',9);
					}
					$this->Ln();
					//$this->Ln(10);
				}
				$this->Cell(10);
				$this->Cell(85,1, '___________________________________________________________', 0, 0, 'L');
				$this->Cell(85,1, '___________________________________________________________', 0, 0, 'L');
				$this->Ln();
				
	//			$this->Line(20, 58, 190, 58);		
			}
		}
	
		$pdf=new PDF('P', 'mm', 'A4');
		$pdf->AliasNbPages();
		$pdf->AddFont('arialn','','arialn.php');
		$pdf->AddFont('arialn','B','arialnb.php');
		$pdf->AddPage();
		$pdf->Body();
		
		$pdf->Output();
	}
	else
	{		
		header("Location:index.php");
	}
?> 
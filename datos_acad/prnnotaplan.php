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
				$this->Cell(0,5,'OFICINA DE TECNOLOG�A INFORM�TICA', 0, 0, 'C');
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
				$this->Cell(130,4,"FACULTAD: {$sFacultad[$sUsercoo['cod_fac']]}", 0);
				$this->SetFont('arial','B',12);
				$this->Cell(60,4,'PLAN DE ESTUDIOS', 0, 0, 0,'R');
				$this->SetFont('arialn','B',10);
				$this->Ln();
				
				$this->Cell(130,4, "ESCUELA PROFESIONAL: {$sCarrera[$sUsercoo['cod_car']]}", 0);				
				$this->Ln();

				$this->Cell(130,4, "APELLIDOS Y NOMBRES: {$sEstudia['paterno']} {$sEstudia['materno']}, {$sEstudia['nombres']}", 0);
				$this->SetFont('arial','B',12);
				$this->Cell(60,4, "N� de Matr�cula: {$sEstudia['num_mat']}", 0, 0, 0,'R');
				$this->SetFont('arialn','B',10);
				$this->Ln();				
								
				$this->Ln(2);
			}
			
			function Subhnota2()
			{
				$this->SetFont('arialn','B',8);
	//			$this->Line(20, 52, 190, 52);
							
				$this->Cell(10,4,'C�d', 1, 0, 'C');
				$this->Cell(90,4,'Curso', 1, 0, 'C');
				$this->Cell(8,4,'Crd', 1, 0, 'C');
				$this->Cell(6,4,'Nota', 1, 0, 'C');
				$this->Cell(25,4,'Modalidad', 1, 0, 'C');
				$this->Cell(12,4,'Acta', 1, 0, 'C');
				$this->Cell(15,4,'Per.', 1, 0, 'C');
				$this->Cell(19,4,'Obs', 1, 0, 'C');
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
				global $sPDF, $sModnot, $sPeriodo;
				$this->SetFont('arialn','',9);
				if(!empty($sPDF))
				foreach($sPDF as $sPlan)
				{
					$this->Cell(10,5, $sPlan['cur_pln'], 0, 0, 'L');
					if($sPlan['header'])
					{
						$this->SetFont('arialn','B',9);
						$this->Cell(90,5, $sPlan['nom_cur'], 0, 0, 'L');
						$this->SetFont('arialn','',9);
					}
					else
					{
						$this->SetFont('arialn','',8);
						$this->Cell(90,5, $sPlan['nom_cur'], 0, 0, 'L');
						$this->SetFont('arialn','',9);
					}
					$this->Cell(8,5, $sPlan['crd_cur'], 0, 0, 'C');
					$this->Cell(6,5, $sPlan['not_cur'], 0, 0, 'R');
					$this->Cell(25,5, $sModnot[$sPlan['mod_not']], 0, 0, 'L');
					$this->Cell(12,5, $sPlan['cod_act'], 0, 0, 'C');
					$this->Cell(15,5, "{$sPlan['ano_aca']}-{$sPeriodo[$sPlan['per_aca']]['abr_per']}", 0, 0, 'L');
					$this->Cell(19,5, $sPlan['obs_not'], 0, 0, 'L');
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
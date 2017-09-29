<?php

	session_start();
	include "../include/function.php";
	require "../include/fpdf.php";
	require "../include/funcsql.php";

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
				$this->Cell(0,5,'UN@P.NET2 ', 0, 0, 'C');
				$this->Ln();
				$this->Ln(5);
				$this->SetFont('arialn','B',12);
				$this->Cell(0,5,'RESUMEN DE CURSOS POR GRUPO', 0, 0, 'C');
				$this->Ln();
				
				$this->Ln(4);
				$this->Subhnota();
				$this->Subhnota2();
				
			}
			function Subhnota()
			{
				global $sUsercoo, $sCarrera, $sFacultad, $sPeriodo, $sModmat, $sSemestre, $sGrupo, $sEspecial;
				$this->SetFont('arial','B',8);
				$this->Cell(5);
				$this->Cell(130,4,"FACULTAD: {$sFacultad[$sUsercoo['cod_fac']]}", 0);
				$this->Cell(50,4,"[{$sUsercoo['ano_aca']}-{$sPeriodo[$sUsercoo['per_aca']]['per_des']}]", 0, 0, 0,'R');
				$this->Ln();
				
				$this->Cell(5);
				$this->Cell(180,4, "CARRERA PROFESIONAL: {$sCarrera[$sUsercoo['cod_car']]}", 0);
				$this->Ln();

				$this->Ln(3);
			}
			
			function Subhnota2()
			{
				$this->SetFont('arialn','',10);
				$this->Line(15, 57, 195, 57);
							

			}
			
			function Footer()
			{
				global $sUsercoo, $sMes;
				$vFecha = getdate(time());
				$vFechan = "{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} - Hora: {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']} hrs.";
				$this->SetFont('arialn','',10);
				$this->Line(15, 277, 195, 277);
				$this->SetY(-20);			
				$this->Cell(5);
				$this->Cell(130, 4,"Fecha: $vFechan - IP: {$sUsercoo['ip']}", 0);
				$this->Cell(50, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
			}
			function Body()
			{			
				global $sPDF;
				$vCod_cur = "";
				$vSubtotal = 0;
				$vTotal = 0;
				$this->SetFont('arialn','',10);
				if(!empty($sPDF))
				foreach($sPDF as $vCur_gru => $aPDF)
				{
					if(!($vCod_cur == $aPDF['cod_cur']))
					{
						if(!empty($vCod_cur))
						{
							$this->Cell(15);
							$this->Cell(35,1, "__________________________________", 0, 0, 'L');
							$this->Ln();
							$this->Ln(2);
							$this->Cell(15);
							$this->Cell(25,5, "SUBTOTAL", 0, 0, 'L');
							$this->Cell(5,5, ":", 0, 0, 'L');
							$this->Cell(21,5, $vSubtotal, 0, 0, 'R');
							$this->Ln();
						}
						$vCod_cur = $aPDF['cod_cur'];
						$vSubtotal = 0;						
						$this->SetFont('arialn','B',10);
						$this->Ln(3);
						$this->Cell(10);
						$this->Cell(100,5, "CURSO : {$aPDF['nom_cur']}", 0, 0, 'L');
						$this->Ln();
						$this->SetFont('arialn','',10);
					}
					$this->Cell(15);
					$this->Cell(25,5, $aPDF['sec_gru'], 0, 0, 'L');
					$this->Cell(5,5, ":", 0, 0, 'L');
					$this->Cell(7,5, $aPDF['canti'], 0, 0, 'R');
					$this->Cell(7,5, $aPDF['icanti'], 0, 0, 'R');
					$vSuma = $aPDF['canti'] + $aPDF['icanti'];
					$this->Cell(7,5, $vSuma, 0, 0, 'R');
					$this->Ln();
					$vSubtotal += $aPDF['canti'] + $aPDF['icanti'];
					$vTotal += $aPDF['canti'];
				}
				
				$this->Cell(15);
				$this->Cell(35,1, "__________________________", 0, 0, 'L');
				$this->Ln();
				$this->Ln(2);
				$this->Cell(15);
				$this->Cell(25,5, "SUBTOTAL", 0, 0, 'L');
				$this->Cell(5,5, ":", 0, 0, 'L');
				$this->Cell(5,5, $vSubtotal, 0, 0, 'R');
				$this->Ln();
				
				$this->Cell(5);
				$this->Cell(90,1, '________________________________________________________', 0, 0, 'L');
				$this->Cell(90,1, '________________________________________________________', 0, 0, 'L');
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
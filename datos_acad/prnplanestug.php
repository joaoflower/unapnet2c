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
				global $sUsercoo, $sCarrera, $sFacultad, $sEstudia;					
				
				$this->SetFont('Times','B',14);
				$this->Cell(0,6,'UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO', 0, 0, 'C');
				$this->Ln();
				$this->SetFont('arialn','B',11);
				$this->Cell(0,5,"FACULTAD DE {$sFacultad[$sUsercoo['cod_fac']]}", 0, 0, 'C');
				$this->Ln();
				$this->Cell(0,5,"ESCUELA PROFESIONAL DE {$sCarrera[$sUsercoo['cod_car']]}", 0, 0, 'C');
				$this->Ln();
				
				$this->Ln(3);
				
				$this->SetFont('arial','B',14);
				$this->Cell(0,6,"PLAN DE ESTUDIOS", 0, 0, 'C');
				$this->Ln();

				$this->Ln(3);
				
				$this->Line(20, 35, 190, 35);

			}

			function Body()
			{			
				global $sPDF, $sModnot, $sPeriodo, $sUsercoo, $sCarrera, $sFacultad, $sEstudia, $sEspecial, $sMes, $sGradocar;
				$aNumero = "";
				
				$aNumero[11] = "ONCE";
				$aNumero[12] = "DOCE";
				$aNumero[13] = "TRECE";
				$aNumero[14] = "CATORCE";
				$aNumero[15] = "QUINCE";
				$aNumero[16] = "DIECISEIS";
				$aNumero[17] = "DIECISIETE";
				$aNumero[18] = "DIECIOCHO";
				$aNumero[19] = "DIECINUEVE";
				$aNumero[20] = "VEINTE";

				$this->SetFont('arialn','B',10);
				$this->Cell(10);
				$this->Cell(180,4,"INFORME ACADÉMICO DEL(LA) ALUMNO(A) : [{$sEstudia['num_mat']}] - {$sEstudia['paterno']} {$sEstudia['materno']}, {$sEstudia['nombres']}", 0);
				$this->Ln();
				
				$this->Cell(10);
				if($sUsercoo['cod_car'] == '07')
				{
					if($sEstudia['pln_est'] == '02')
						$this->Cell(180,4, "PARA OPTAR EL GRADO ACADÉMICO DE BACHILLER EN : {$sGradocar[$sUsercoo['cod_car']]}", 0);	
					else
						$this->Cell(180,4, "PARA OPTAR EL GRADO ACADÉMICO DE BACHILLER EN : ADMINISTRACIÓN", 0);					
				}
				else
				{
					$this->Cell(180,4, "PARA OPTAR EL GRADO ACADÉMICO DE BACHILLER EN : {$sGradocar[$sUsercoo['cod_car']]}", 0);				
				}				
				$this->Ln();

				$this->Cell(10);
				$this->Cell(180,4, "DE LA MENCIÓN : {$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']}", 0);
				$this->Ln();

				$this->Cell(10);
				$this->Cell(180,4, "PROMOCIÓN:     PROMEDIO PONDERADO ACUMULATIVO: ", 0);
				$this->Ln();
				
				$this->Ln(2);
				
				$this->SetFont('arialn','B',8);
				$this->Cell(12);
				$this->Cell(10,4, 'N°', 1, 0, 'C');
				$this->Cell(93,4, 'ASIGNATURAS', 1, 0, 'C');
				$this->Cell(29,4, 'NOTA', 1, 0, 'C');
				$this->Cell(13,4, 'CRÉDITO', 1, 0, 'C');
				$this->Cell(11,4, 'FECHA', 1, 0, 'C');
				$this->Cell(15,4, 'OBSERV.', 1, 0, 'C');	
				$this->Ln();
				$this->Ln(2);

				$this->SetFont('arialn','',8);
		
				$vCont = 1;
				if(!empty($sPDF))
				foreach($sPDF as $sPlan)
				{					
					if($sPlan['semestre'])
					{
						$this->Cell(25);
						$this->SetFont('arialn','B',9);
						$this->Cell(165,4, $sPlan['nom_cur'], 0, 0, 'L');
						$this->SetFont('arialn','',8);
						$this->Ln();
					}
					else
					{
						if(!empty($sPlan['not_cur']))
						{
							$vNom_cur2 = "";
							$i = 0;
							$this->Cell(12);
							$this->Cell(10,4, $vCont, 0, 0, 'C');
							
							if(strlen($sPlan['nom_cur']) <= 65)
							{				
								$this->Cell(93,4, $sPlan['nom_cur'], 0, 0, 'L');
							}
							else
							{
								for($i = 64; $i > 0; $i--)
								{
									if(substr($sPlan['nom_cur'], $i, 1) == ' ')
									{										
										break;
									}
								}																
								$this->Cell(93,4, substr($sPlan['nom_cur'], 0, $i+1), 0, 0, 'L');
								$vNom_cur2 = substr($sPlan['nom_cur'], $i, strlen($sPlan['nom_cur']) - ($i));
							}
							
							$this->Cell(7,4, $sPlan['not_cur'], 0, 0, 'C');
							$this->Cell(22,4, $aNumero[$sPlan['not_cur']], 0, 0, 'L');
							$this->Cell(13,4, $sPlan['crd_cur'], 0, 0, 'C');
							
							if($sPlan['per_aca'] == '00')
							{
								$this->Cell(11,4, "{$sPlan['ano_aca']}", 0, 0, 'C');	
							}
							else
							{
								$this->Cell(11,4, "{$sPlan['ano_aca']}-{$sPeriodo[$sPlan['per_aca']]['abr_per']}", 0, 0, 'C');
							}
							
							$this->Cell(22,4, $sPlan['obs_not'], 0, 0, 'L');						
							$this->Ln();
							
							if($i > 0)
							{
								$this->Cell(22,4, "", 0, 0, 'C');
								$this->Cell(93,4, $vNom_cur2 , 0, 0, 'L');
								$this->Cell(7,4, "--", 0, 0, 'C');
								$this->Cell(22,4, "----------", 0, 0, 'L');
								$this->Cell(13,4, "--", 0, 0, 'C');
								$this->Cell(11,4, "--------", 0, 0, 'C');
								$this->Cell(22,4, "", 0, 0, 'L');						
								$this->Ln();
							}
							
							$vCont++;
						}
					}					
					
					//$this->Ln(10);
				}
				$this->Cell(10);
				$this->Cell(85,1, '___________________________________________________________', 0, 0, 'L');
				$this->Cell(85,1, '___________________________________________________________', 0, 0, 'L');
				$this->Ln();
				
				$this->Ln(2);
				
				$vFecha = getdate(time());
				$vFechan = "Puno C.U.,{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} ";
				$this->Cell(168,4, $vFechan, 0, 0, 'R');
				
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
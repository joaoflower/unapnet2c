<?php

	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	require "../include/fpdf.php";

	if(fsafetyselcar2())
	{
		class PDF extends FPDF
		{
			function Header2()
			{
			
				$this->SetFont('Times','B',12);
				$this->Cell(0,4,'UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO', 0, 0, 'C');
				$this->Ln();
				$this->SetFont('Arial','B',10);
				$this->Cell(0,4,'OFICINA DE TECNOLOGÍA INFORMÁTICA', 0, 0, 'C');
				$this->Ln();
				$this->SetFont('arialn','B',10);
				$this->Cell(0,4,'UN@P.NET2', 0, 0, 'C');
				$this->Ln();
				
				$this->Ln(2);
				$this->Subhnota();
				$this->Subhnota2();
				
			}
			function Subhnota()
			{
				global $sUsercoo, $sCarrera, $sFacultad, $sEstudia;
				$this->SetFont('arialn','B',10);
				$this->Cell(120,4,"FACULTAD: {$sFacultad[$sUsercoo['cod_fac']]}", 0);
				$this->SetFont('arial','B',14);
				$this->Cell(70,4,'HISTORIAL ACADEMICO', 0, 0, 0,'R');
				$this->SetFont('arialn','B',10);
				$this->Ln();
				
				$this->Cell(120,4, "ESCUELA PROFESIONAL: {$sCarrera[$sUsercoo['cod_car']]}", 0);
				$this->SetFont('arial','B',12);
				$this->Ln();
				
				$this->Ln(1);
			}
			
			function Subhnota2()
			{
				global $sEstudia, $sEspecial;
				$this->SetFont('arialn','',5);
				$this->Cell(35,3,'NUMERO DE MATRICULA', 1, 0, 'C');	
				$this->Cell(125,3,'APELLIDOS Y NOMBRES', 1, 0, 'C');
				$this->Cell(30,3,'', 'RLT', 0, 'C');				
				$this->Ln();
				$this->SetFont('arialn','B',10);
				$this->Cell(35,5,$sEstudia['num_mat'], 1, 0, 'C');	
				$vNombre = "{$sEstudia['paterno']} {$sEstudia['materno']}, {$sEstudia['nombres']}";
				$this->Cell(125,5,$vNombre, 1, 0, 'C');
				$this->Cell(30,5,'', 'RL', 0, 'C');
				$this->Ln();
				
				$this->SetFont('arialn','',5);
				$this->Cell(160,3,'ESPECIALIDAD / MENSION', 1, 0, 'C');	
				$this->Cell(30,3,'', 'RL', 0, 'C');
				$this->Ln();
				$this->SetFont('arialn','B',10);
				$this->Cell(160,5,$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom'], 1, 0, 'C');	
				$this->Cell(30,5,'', 'RL', 0, 'C');
				$this->Ln();
				
				$this->SetFont('arialn','',5);
				$this->Cell(35,3,'AÑO DE INGRESO', 1, 0, 'C');	
				$this->Cell(45,3,'MODALIDAD DE INGRESO', 1, 0, 'C');
				$this->Cell(20,3,'NRO DE INSCRIPCIÓN', 1, 0, 'C');
				$this->Cell(30,3,'PUNTAJE  / SOBRE', 1, 0, 'C');
				$this->Cell(30,3,'ORDEN / SOBRE', 1, 0, 'C');				
				$this->Cell(30,3,'', 'RL', 0, 'C');
				$this->Ln();
				$this->SetFont('arialn','B',10);
				$this->Cell(35,5,'', 1, 0, 'C');	
				$this->Cell(45,5,'', 1, 0, 'C');
				$this->Cell(20,5,'', 1, 0, 'C');
				$this->Cell(30,5,'', 1, 0, 'C');
				$this->Cell(30,5,'', 1, 0, 'C');				
				$this->Cell(30,5,'F O T O', 'RL', 0, 'C');
				$this->Ln();
								
				$this->SetFont('arialn','',5);
				$this->Cell(40,3,'INGRESADO POR', 1, 0, 'C');	
				$this->Cell(40,3,'REVISADO POR', 1, 0, 'C');
				$this->Cell(40,3,'FIRMA DEL ESTUDIANTE', 1, 0, 'C');
				$this->Cell(40,3,'OBSERVACIONES', 1, 0, 'C');				
				$this->Cell(30,3,'', 'RL', 0, 'C');
				$this->Ln();
				$this->SetFont('arialn','B',10);
				$this->Cell(40,5,'', 'RL', 0, 'C');	
				$this->Cell(40,5,'', 'RL', 0, 'C');
				$this->Cell(40,5,'', 'RL', 0, 'C');
				$this->Cell(40,5,'', 1, 0, 'C');
				$this->Cell(30,5,'', 'RL', 0, 'C');				
				$this->Ln();
				$this->Cell(40,5,'', 'RL', 0, 'C');	
				$this->Cell(40,5,'', 'RL', 0, 'C');
				$this->Cell(40,5,'', 'RL', 0, 'C');
				$this->Cell(40,5,'', 1, 0, 'C');
				$this->Cell(30,5,'', 'RL', 0, 'C');				
				$this->Ln();
				$this->Cell(40,5,'', 'RLB', 0, 'C');	
				$this->Cell(40,5,'', 'RLB', 0, 'C');
				$this->Cell(40,5,'', 'RLB', 0, 'C');
				$this->Cell(40,5,'', 1, 0, 'C');
				$this->Cell(30,5,'', 'RLB', 0, 'C');					
				$this->Ln();				
							
				$this->Ln(1);
							
				$this->SetFont('arialn','B',5);
				if($sEstudia['tip_sist'] == '1')
				{
					$this->Cell(5,4,'N°', 1, 0, 'C');
					$this->Cell(73,4,'NOMBRE DE LA ASIGNATURA', 1, 0, 'C');
					$this->Cell(7,4,'NOTA 1', 1, 0, 'C');
					$this->Cell(15,4,'AÑO', 1, 0, 'C');
					$this->Cell(7,4,'NOTA 2', 1, 0, 'C');
					$this->Cell(15,4,'AÑO', 1, 0, 'C');				
					$this->Cell(7,4,'NOTA 3', 1, 0, 'C');
					$this->Cell(15,4,'AÑO', 1, 0, 'C');
					$this->Cell(7,4,'NOTA 4', 1, 0, 'C');
					$this->Cell(15,4,'AÑO', 1, 0, 'C');
					$this->Cell(15,4,'ACTA', 1, 0, 'C');
					$this->Cell(9,4,'FIRMA', 1, 0, 'C');
				}
				else
				{
					$this->Cell(2,4,'', 1, 0, 'C');
					$this->Cell(67,4,'NOMBRE DE LA ASIGNATURA', 1, 0, 'C');
					$this->Cell(6,4,'CRED', 1, 0, 'C');
					$this->Cell(5,4,'Nota', 1, 0, 'C');
					$this->Cell(11,4,'AÑO-PER', 1, 0, 'C');
					$this->Cell(5,4,'Nota', 1, 0, 'C');
					$this->Cell(11,4,'AÑO-PER', 1, 0, 'C');
					$this->Cell(5,4,'Nota', 1, 0, 'C');
					$this->Cell(11,4,'AÑO-PER', 1, 0, 'C');
					$this->Cell(5,4,'Nota', 1, 0, 'C');
					$this->Cell(11,4,'AÑO-PER', 1, 0, 'C');
					$this->Cell(5,4,'Nota', 1, 0, 'C');
					$this->Cell(11,4,'AÑO-PER', 1, 0, 'C');
					$this->Cell(5,4,'Nota', 1, 0, 'C');
					$this->Cell(11,4,'AÑO-PER', 1, 0, 'C');					
					$this->Cell(9,4,'ACTA', 1, 0, 'C');
					$this->Cell(10,4,'FIRMA', 1, 0, 'C');
				}				
				$this->Ln();
			}
			
			function Footer()
			{
				global $sUsercoo, $sMes;
				$vFecha = getdate(time());
				$vFechan = "{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} - Hora: {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']} hrs.";
				$this->SetFont('arialn','',9);
				$this->Line(10, 277, 200, 277);
				$this->SetY(-20);			
				$this->Cell(120, 4,"Fecha: $vFechan - IP: {$sUsercoo['ip']}", 0);
				$this->Cell(70, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
			}
			function Body()
			{			
				global $sPDF, $sEstudia;
				$vCont = 0;
				$this->SetFont('arialn','',7);
				if(!empty($sPDF))
				foreach($sPDF as $vContador => $sPlan)
				{					
					if($sPlan['header'])
					{
						if($sPlan['sem_anu'])
						{
							$this->SetFont('arialn','B',10);						
							$this->Cell(5,5, '', 'LTB', 0, 'L');
							$this->Cell(185,5, $sPlan['nom_cur'], 'RBT', 0, 'L');
							$this->SetFont('arialn','',7);
						}
						else
						{
							$this->SetFont('arialn','B',8);						
							$this->Cell(5,5, '', 'LTB', 0, 'L');
							$this->Cell(185,5, $sPlan['nom_cur'], 1, 0, 'L');
							$this->SetFont('arialn','',7);
						}
					}
					else
					{
						$this->Cell(2,4, '', 1, 0, 'L');
						if($sEstudia['tip_sist'] == '1')
						{
							$this->Cell(73,4, $sPlan['nom_cur'], 1, 0, 'L');
							$this->Cell(7,4,'', 1, 0, 'C');
							$this->Cell(15,4,'', 1, 0, 'C');
							$this->Cell(7,4,'', 1, 0, 'C');
							$this->Cell(15,4,'', 1, 0, 'C');				
							$this->Cell(7,4,'', 1, 0, 'C');
							$this->Cell(15,4,'', 1, 0, 'C');
							$this->Cell(7,4,'', 1, 0, 'C');
							$this->Cell(15,4,'', 1, 0, 'C');
							$this->Cell(15,4,'', 1, 0, 'C');
						}
						else
						{
							$this->Cell(67,4, $sPlan['nom_cur'], 1, 0, 'L');
							$this->Cell(6,4, $sPlan['crd_cur'], 1, 0, 'L');
				
							if($sPlan['not_cur1'] > 10) $this->SetFont('arialn','B',8);
							$this->Cell(5,4, $sPlan['not_cur1'], 1, 0, 'C');
														
							$this->SetFont('arialn','',7);							
							$this->Cell(11,4, $sPlan['ano_per1'], 1, 0, 'C');
							
							if($sPlan['not_cur2'] > 10) $this->SetFont('arialn','B',8);
							$this->Cell(5,4, $sPlan['not_cur2'], 1, 0, 'C');
							
							$this->SetFont('arialn','',7);
							$this->Cell(11,4, $sPlan['ano_per2'], 1, 0, 'C');
							
							if($sPlan['not_cur3'] > 10) $this->SetFont('arialn','B',8);
							$this->Cell(5,4, $sPlan['not_cur3'], 1, 0, 'C');
							
							$this->SetFont('arialn','',7);
							$this->Cell(11,4, $sPlan['ano_per3'], 1, 0, 'C');
							
							if($sPlan['not_cur4'] > 10) $this->SetFont('arialn','B',8);
							$this->Cell(5,4, $sPlan['not_cur4'], 1, 0, 'C');
							
							$this->SetFont('arialn','',7);
							$this->Cell(11,4, $sPlan['ano_per4'], 1, 0, 'C');
							
							if($sPlan['not_cur5'] > 10) $this->SetFont('arialn','B',8);
							$this->Cell(5,4, $sPlan['not_cur5'], 1, 0, 'C');
							
							$this->SetFont('arialn','',7);
							$this->Cell(11,4, $sPlan['ano_per5'], 1, 0, 'C');
							
							if($sPlan['not_cur6'] > 10) $this->SetFont('arialn','B',8);
							$this->Cell(5,4, $sPlan['not_cur6'], 1, 0, 'C');
							
							$this->SetFont('arialn','',7);
							$this->Cell(11,4, $sPlan['ano_per6'], 1, 0, 'C');
							$this->Cell(9,4, $sPlan['cod_act'], 1, 0, 'C');
						}						
						$this->Cell(10,4,'', 1, 0, 'C');
					}
					$this->Ln();
				}
				$this->Ln(2);
				if($sEstudia['tip_sist'] == '1')
				{
					if((($vCont - 39) % 53) > 44)
						$this->AddPage();
				}
				else
				{
					if((($vCont - 39) % 53) > 41)
						$this->AddPage();
				}
				
			}
			function Resumen()
			{
				$this->SetFont('arialn','B',8);
				$this->Cell(46,5,'AÑOS ACADÉMICOS', 1, 0, 'L');
				$this->Cell(24,5,'', 1, 0, 'L');
				$this->Cell(24,5,'', 1, 0, 'L');
				$this->Cell(24,5,'', 1, 0, 'L');
				$this->Cell(24,5,'', 1, 0, 'L');
				$this->Cell(24,5,'', 1, 0, 'L');
				$this->Cell(24,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'DATOS PARCIALES', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->SetFont('arialn','',8);
				$this->Cell(46,5,'CRÉDITOS CURSADOS', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'CRÉDITOS APROBADOS', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'PUNTAJE SEMESTRAL', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();

				$this->Cell(46,5,'PROMEDIO PONDERADO SEMESTRAL', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->SetFont('arialn','B',8);
				$this->Cell(46,5,'DATOS ACUMULATIVOS', 1, 0, 'L');
				$this->Cell(144,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->SetFont('arialn','',8);
				$this->Cell(46,5,'CRÉDITOS CURSADOS', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'CRÉDITOS APROBADOS', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'PUNTAJE ACUMULATIVO', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'PROM. PONDERADO ACUMULATIVO', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();				
			}
			function Resumenr()
			{
				$this->SetFont('arialn','B',8);
				$this->Cell(46,5,'DATOS PARCIALES', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->SetFont('arialn','',8);
				$this->Cell(46,5,'CURSOS LLEVADOS', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'CURSOS DESAPROBADOS', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'CURSOS DE CARGOS', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'NIVELES DE ESTUDIOS', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'PROMEDIO', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'ORDEN DE MERITO', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->Cell(46,5,'TOTAL ALUMNOS', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Cell(8,5,'', 1, 0, 'L');
				$this->Ln();
			}
		}
	
		$pdf=new PDF('P', 'mm', 'A4');
		$pdf->AliasNbPages();
		$pdf->AddFont('arialn','','arialn.php');
		$pdf->AddFont('arialn','B','arialnb.php');
		$pdf->AddPage();
		$pdf->Header2();
		$pdf->Body();
		if($sEstudia['tip_sist'] == '1')
		{
			$pdf->Resumenr();
		}
		else
		{
			$pdf->Resumen();
		}
		
		$pdf->Output();
	}
	else
	{		
		header("Location:index.php");
	}
?> 
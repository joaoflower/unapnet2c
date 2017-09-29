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
				global $sUsercoo, $sCarrera, $sFacultad;
				$this->SetFont('Times','B',12);
				$this->Cell(0,4,'UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO', 0, 0, 'C');
				$this->Ln();
				$this->SetFont('Arial','B',10);
				//$this->Cell(0,4,'OFICINA DE TECNOLOGÍA INFORMÁTICA', 0, 0, 'C');
				$this->Cell(0,4,"FACULTAD DE {$sFacultad[$sUsercoo['cod_fac']]}", 0, 0, 'C');
				$this->Ln();
				$this->SetFont('arialn','B',10);
				//$this->Cell(0,4,'UN@P.NET2', 0, 0, 'C');
				$this->Cell(0,4,"ESCUELA PROFESIONAL DE {$sCarrera[$sUsercoo['cod_car']]}", 0, 0, 'C');
				$this->Ln();
				
				$this->Ln(2);
				$this->Subhnota();
				$this->Subhnota2();
				
			}
			function Subhnota()
			{
				global $sUsercoo, $sCarrera, $sFacultad, $sEstudia;
				$this->SetFont('arialn','B',10);
//				$this->Cell(120,4,"FACULTAD: {$sFacultad[$sUsercoo['cod_fac']]}", 0);
				$this->SetFont('arial','B',14);
				$this->Cell(190,4,'HISTORIAL ACADEMICO', 0, 0,'C');
				$this->SetFont('arialn','B',10);
				$this->Ln();
				
/*				$this->Cell(120,4, "ESCUELA PROFESIONAL: {$sCarrera[$sUsercoo['cod_car']]}", 0);
				$this->SetFont('arial','B',12);
				$this->Ln();*/
				
				$this->Ln(1);
			}
			
			function Subhnota2()
			{
				global $sEstudia, $sEspecial, $sModing;
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
				$this->Cell(35,5,$sEstudia['ano_ing'], 1, 0, 'C');	
				$this->Cell(45,5,$sModing[$sEstudia['mod_ing']], 1, 0, 'C');
				$this->Cell(20,5,$sEstudia['nro_ins'], 1, 0, 'C');
				$this->Cell(30,5,($sEstudia['pun_ing'].' / '.$sEstudia['pun_sob']), 1, 0, 'C');
				$this->Cell(30,5,($sEstudia['ord_ing'].' / '.$sEstudia['ord_sob']), 1, 0, 'C');				
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
					$this->Cell(70,4,'NOMBRE DE LA ASIGNATURA', 1, 0, 'C');
					$this->Cell(6,4,'NOTA', 1, 0, 'C');
					$this->Cell(12,4,'AÑO', 1, 0, 'C');
					$this->Cell(6,4,'NOTA', 1, 0, 'C');
					$this->Cell(12,4,'AÑO', 1, 0, 'C');
					$this->Cell(6,4,'NOTA', 1, 0, 'C');
					$this->Cell(12,4,'AÑO', 1, 0, 'C');
					$this->Cell(6,4,'NOTA', 1, 0, 'C');
					$this->Cell(12,4,'AÑO', 1, 0, 'C');
					$this->Cell(6,4,'NOTA', 1, 0, 'C');
					$this->Cell(12,4,'AÑO', 1, 0, 'C');
					$this->Cell(10,4,'ACTA', 1, 0, 'C');
					$this->Cell(15,4,'FECHA', 1, 0, 'C');
				}
				else
				{
					$this->Cell(5,4,'', 1, 0, 'C');
					$this->Cell(67,4,'NOMBRE DE LA ASIGNATURA', 1, 0, 'C');
					$this->Cell(7,4,'CRED', 1, 0, 'C');
					$this->Cell(6,4,'Nota', 1, 0, 'C');
					$this->Cell(12,4,'AÑO-PER', 1, 0, 'C');
					$this->Cell(6,4,'Nota', 1, 0, 'C');
					$this->Cell(12,4,'AÑO-PER', 1, 0, 'C');
					$this->Cell(6,4,'Nota', 1, 0, 'C');
					$this->Cell(12,4,'AÑO-PER', 1, 0, 'C');
					$this->Cell(5,4,'Nota', 1, 0, 'C');
					$this->Cell(12,4,'AÑO-PER', 1, 0, 'C');
					$this->Cell(5,4,'Nota', 1, 0, 'C');
					$this->Cell(12,4,'AÑO-PER', 1, 0, 'C');										
					$this->Cell(10,4,'ACTA', 1, 0, 'C');
					$this->Cell(13,4,'FECHA', 1, 0, 'C');
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
				$this->SetFont('arialn','',8);
				if(!empty($sPDF))
				foreach($sPDF as $vContador => $sPlan)
				{					
					$this->SetFont('arialn','',8);
					if($sPlan['header'])
					{
						if($sPlan['sem_anu'])
						{
							$this->SetFont('arialn','B',10);						
							$this->Cell(5,4, '', 'LTB', 0, 'L');
							$this->Cell(185,4, $sPlan['nom_cur'], 'RBT', 0, 'L');
							$this->SetFont('arialn','',8);
						}
						else
						{
							$this->SetFont('arialn','B',8);						
							$this->Cell(5,4, '', 'LTB', 0, 'L');
							$this->Cell(185,4, $sPlan['nom_cur'], 1, 0, 'L');
							$this->SetFont('arialn','',8);
						}
					}
					else
					{
						// Rigido
						if($sEstudia['tip_sist'] == '1')
						{
							if($sPlan['exede'])
							{
								$this->Cell(5,3, '', 'LRB', 0, 'L');
								$this->SetFont('arialn','',7);
								$this->Cell(70,3, $sPlan['nom_cur'], 'LBR', 0, 'L');
								$this->Cell(6,3, '', 'LRB', 0, 'C');
								$this->Cell(12,3, '', 'LRB', 0, 'C');
								$this->Cell(6,3, '', 'LRB', 0, 'C');
								$this->Cell(12,3, '', 'LRB', 0, 'C');
								$this->Cell(6,3, '', 'LRB', 0, 'C');
								$this->Cell(12,3, '', 'LRB', 0, 'C');
								$this->Cell(6,3, '', 'LRB', 0, 'C');
								$this->Cell(12,3, '', 'LRB', 0, 'C');
								$this->Cell(6,3, '', 'LRB', 0, 'C');
								$this->Cell(12,3, '', 'LRB', 0, 'C');								
								$this->Cell(10,3, '', 'LRB', 0, 'C');
								$this->Cell(15,3,'', 'LRB', 0, 'C');								
							}
							elseif($sPlan['new_row'])
							{
								$this->Cell(5,5, '', 1, 0, 'L');
								$this->Cell(70,5, '----------', 1, 0, 'L');
								
								if($sPlan['not_cur6'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur6'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per6'], 1, 0, 'C');
								
								if($sPlan['not_cur7'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur7'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per7'], 1, 0, 'C');
								
								if($sPlan['not_cur8'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur8'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per8'], 1, 0, 'C');
								
								if($sPlan['not_cur9'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur9'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per9'], 1, 0, 'C');
								
								if($sPlan['not_cur10'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur10'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per10'], 1, 0, 'C');
								
								$this->Cell(10,5,'', 1, 0, 'C');
								$this->Cell(15,5,'', 1, 0, 'C');
							}
							elseif($sPlan['new_row2'])
							{
								$this->Cell(5,5, '', 1, 0, 'L');
								$this->Cell(70,5, '----------', 1, 0, 'L');
								
								if($sPlan['not_cur11'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur11'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per11'], 1, 0, 'C');
								
								if($sPlan['not_cur12'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur12'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per12'], 1, 0, 'C');
								
								if($sPlan['not_cur13'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur13'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per13'], 1, 0, 'C');
								
								if($sPlan['not_cur14'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur14'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per14'], 1, 0, 'C');
								
								if($sPlan['not_cur15'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur15'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per15'], 1, 0, 'C');
								
								$this->Cell(10,5,'', 1, 0, 'C');
								$this->Cell(15,5,'', 1, 0, 'C');
								
								
							}
							else
							{
								if($sPlan['next'])	
								{						
									$this->Cell(5,5, $sPlan['cod_cur'], 'LRT', 0, 'C');
									$this->Cell(70,4, $sPlan['nom_cur'], 'LTR', 0, 'L');
								}
								else
								{
									$this->Cell(5,5, $sPlan['cod_cur'], 1, 0, 'C');
									$this->Cell(70,5, $sPlan['nom_cur'], 1, 0, 'L');
								}
								
								if($sPlan['not_cur1'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur1'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per1'], 1, 0, 'C');
								
								if($sPlan['not_cur2'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur2'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per2'], 1, 0, 'C');
								
								if($sPlan['not_cur3'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur3'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per3'], 1, 0, 'C');
								
								if($sPlan['not_cur4'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur4'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per4'], 1, 0, 'C');
								
								if($sPlan['not_cur5'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5,$sPlan['not_cur5'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5,$sPlan['ano_per5'], 1, 0, 'C');
								
								$this->Cell(10,5,$sPlan['cod_act'], 1, 0, 'C');
								if($sPlan['next'])	
									$this->Cell(15,3,$sPlan['fch_reg'], 'LRT', 0, 'C');
								else
									$this->Cell(15,5, $sPlan['fch_reg'], 1, 0, 'C');
							}
						}
						// Flesible
						else
						{
							if($sPlan['exede'])
							{
								$this->Cell(5,3, '', 'LRB', 0, 'L');
								$this->SetFont('arialn','',7);
								$this->Cell(67,3, $sPlan['nom_cur'], 'LBR', 0, 'L');
								$this->Cell(7,3, '', 'LRB', 0, 'R');
								$this->Cell(6,3, '', 'LRB', 0, 'C');
								$this->Cell(12,3, '', 'LRB', 0, 'C');
								$this->Cell(6,3, '', 'LRB', 0, 'C');
								$this->Cell(12,3, '', 'LRB', 0, 'C');
								$this->Cell(6,3, '', 'LRB', 0, 'C');
								$this->Cell(12,3, '', 'LRB', 0, 'C');
								$this->Cell(5,3, '', 'LRB', 0, 'C');
								$this->Cell(12,3, '', 'LRB', 0, 'C');
								$this->Cell(5,3, '', 'LRB', 0, 'C');
								$this->Cell(12,3, '', 'LRB', 0, 'C');								
								$this->Cell(10,3, '', 'LRB', 0, 'C');
								$this->Cell(13,3,'', 'LRB', 0, 'C');								
							}
							elseif($sPlan['new_row'])
							{
								$this->Cell(5,5, '', 1, 0, 'L');
								$this->Cell(67,5, '----------', 1, 0, 'L');
								$this->Cell(7,5, '--.-', 1, 0, 'R');
					
								if($sPlan['not_cur6'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5, $sPlan['not_cur6'], 1, 0, 'C');
								$this->SetFont('arialn','',8);							
								$this->Cell(12,5, $sPlan['ano_per6'], 1, 0, 'C');
								
								if($sPlan['not_cur7'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5, $sPlan['not_cur7'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5, $sPlan['ano_per7'], 1, 0, 'C');
								
								if($sPlan['not_cur8'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5, $sPlan['not_cur8'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5, $sPlan['ano_per8'], 1, 0, 'C');
								
								if($sPlan['not_cur9'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(5,5, $sPlan['not_cur9'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5, $sPlan['ano_per9'], 1, 0, 'C');
								
								if($sPlan['not_cur10'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(5,5, $sPlan['not_cur10'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5, $sPlan['ano_per10'], 1, 0, 'C');
								
								$this->Cell(10,5, '', 1, 0, 'C');
								$this->Cell(13,5, '', 1, 0, 'C');
							}
							else
							{
								if($sPlan['next'])	
								{						
									$this->Cell(5,5, $sPlan['cod_cur'], 'LRT', 0, 'C');
									$this->Cell(67,4, $sPlan['nom_cur'], 'LTR', 0, 'L');
								}
								else
								{
									$this->Cell(5,5, $sPlan['cod_cur'], 1, 0, 'C');
									$this->Cell(67,5, $sPlan['nom_cur'], 1, 0, 'L');
								}
								$this->Cell(7,5, $sPlan['crd_cur'], 1, 0, 'R');
					
								if($sPlan['not_cur1'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5, $sPlan['not_cur1'], 1, 0, 'C');
								$this->SetFont('arialn','',8);							
								$this->Cell(12,5, $sPlan['ano_per1'], 1, 0, 'C');
								
								if($sPlan['not_cur2'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5, $sPlan['not_cur2'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5, $sPlan['ano_per2'], 1, 0, 'C');
								
								if($sPlan['not_cur3'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(6,5, $sPlan['not_cur3'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5, $sPlan['ano_per3'], 1, 0, 'C');
								
								if($sPlan['not_cur4'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(5,5, $sPlan['not_cur4'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5, $sPlan['ano_per4'], 1, 0, 'C');
								
								if($sPlan['not_cur5'] > 10) $this->SetFont('arialn','B',10);
								$this->Cell(5,5, $sPlan['not_cur5'], 1, 0, 'C');
								$this->SetFont('arialn','',8);
								$this->Cell(12,5, $sPlan['ano_per5'], 1, 0, 'C');
								
								$this->Cell(10,5, $sPlan['cod_act'], 1, 0, 'C');
								if($sPlan['next'])	
									$this->Cell(13,3, $sPlan['fch_reg'], 'LRT', 0, 'C');
								else
									$this->Cell(13,5, $sPlan['fch_reg'], 1, 0, 'C');
							}							
						}						
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
				global $sPDF, $sEstudia, $sUsercoo;
				
				$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
				$sResnota = "";
				$sResano = "";
				
				$vCont = 1;
				$vCont2 = 0;
				
				$vCrd_cur = 0;
				$vCrd_Apr = 0;
				$vCrd_Des = 0;
				$vPuntaje = 0;
				$vPro_acu = 0;
				
				$vQuery = "select no.ano_aca, no.per_aca, sum(cu.crd_cur) as crd_cur, sum(cu.crd_cur*no.not_cur) as puntaje, ";
				$vQuery .= "sum(if(no.not_cur > 10, cu.crd_cur, 0)) as crd_apr, ";
				$vQuery .= "sum(if(no.not_cur <= 10, cu.crd_cur, 0)) as crd_des, ";
				$vQuery .= "(sum(cu.crd_cur*no.not_cur)/sum(cu.crd_cur)) as pro_sem ";
				$vQuery .= "from (select ano_aca, per_aca, cod_car, pln_est, cod_cur, num_mat, not_cur ";
				$vQuery .= "   from $tNota where num_mat = '{$sEstudia['num_mat']}' and pln_est = '{$sEstudia['pln_est']}' "; //) no ";
				$vQuery .= "   and not_cur > 0) no ";
				$vQuery .= "left join unapnet.curso cu on no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and ";
				$vQuery .= "no.cod_cur = cu.cod_cur group by ano_aca, per_aca ";
			
				$cResnota = fQuery($vQuery);
				while($aResnota = $cResnota->fetch_array())
				{
					if($sResano[$vCont2] != $aResnota['ano_aca'])
					{
						$vCont2++;
						$sResano[$vCont2] = $aResnota['ano_aca'];
					}
					$vCrd_cur += $aResnota['crd_cur'];
					$vCrd_Apr += $aResnota['crd_apr'];
					$vCrd_Des += $aResnota['crd_des'];
					$vPuntaje += $aResnota['puntaje'];
					$vPro_acu = $vPuntaje / $vCrd_cur;
					
					$sResnota[$vCont2.$aResnota['per_aca']]['pcc'] = round($aResnota['crd_cur'], 2);
					$sResnota[$vCont2.$aResnota['per_aca']]['pca'] = round($aResnota['crd_apr'], 2);
					$sResnota[$vCont2.$aResnota['per_aca']]['ppu'] = round($aResnota['puntaje'], 2);
					$sResnota[$vCont2.$aResnota['per_aca']]['ppp'] = round($aResnota['pro_sem'], 2);
					
					$sResnota[$vCont2.$aResnota['per_aca']]['acc'] = $vCrd_cur;
					$sResnota[$vCont2.$aResnota['per_aca']]['aca'] = $vCrd_Apr;
					$sResnota[$vCont2.$aResnota['per_aca']]['apu'] = $vPuntaje;
					$sResnota[$vCont2.$aResnota['per_aca']]['app'] = round($vPro_acu, 2);					
				}
			
				$this->SetFont('arialn','B',8);
				$this->Cell(46,4,'AÑOS ACADÉMICOS', 1, 0, 'L');
				$this->Cell(24,4,$sResano[1], 1, 0, 'C');
				$this->Cell(24,4,$sResano[2], 1, 0, 'C');
				$this->Cell(24,4,$sResano[3], 1, 0, 'C');
				$this->Cell(24,4,$sResano[4], 1, 0, 'C');
				$this->Cell(24,4,$sResano[5], 1, 0, 'C');
				$this->Cell(24,4,$sResano[6], 1, 0, 'C');
				$this->Ln();
				
				$this->Cell(46,4,'DATOS PARCIALES', 1, 0, 'L');
				$this->Cell(8,4,'I', 1, 0, 'C');
				$this->Cell(8,4,'II', 1, 0, 'C');
				$this->Cell(8,4,'VAC', 1, 0, 'C');
				$this->Cell(8,4,'I', 1, 0, 'C');
				$this->Cell(8,4,'II', 1, 0, 'C');
				$this->Cell(8,4,'VAC', 1, 0, 'C');
				$this->Cell(8,4,'I', 1, 0, 'C');
				$this->Cell(8,4,'II', 1, 0, 'C');
				$this->Cell(8,4,'VAC', 1, 0, 'C');
				$this->Cell(8,4,'I', 1, 0, 'C');
				$this->Cell(8,4,'II', 1, 0, 'C');
				$this->Cell(8,4,'VAC', 1, 0, 'C');
				$this->Cell(8,4,'I', 1, 0, 'C');
				$this->Cell(8,4,'II', 1, 0, 'C');
				$this->Cell(8,4,'VAC', 1, 0, 'C');
				$this->Cell(8,4,'I', 1, 0, 'C');
				$this->Cell(8,4,'II', 1, 0, 'C');
				$this->Cell(8,4,'VAC', 1, 0, 'C');
				$this->Ln();
				
				$this->SetFont('arialn','',8);
				$this->Cell(46,4,'CRÉDITOS CURSADOS', 1, 0, 'L');
				$this->Cell(8,4, $sResnota['101']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['102']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['103']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['201']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['202']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['203']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['301']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['302']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['303']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['401']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['402']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['403']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['501']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['502']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['503']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['601']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['602']['pcc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['603']['pcc'], 1, 0, 'C');
				$this->Ln();
				
				$this->Cell(46,4,'CRÉDITOS APROBADOS', 1, 0, 'L');
				$this->Cell(8,4, $sResnota['101']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['102']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['103']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['201']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['202']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['203']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['301']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['302']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['303']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['401']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['402']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['403']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['501']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['502']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['503']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['601']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['602']['pca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['603']['pca'], 1, 0, 'C');
				$this->Ln();
				
				$this->Cell(46,4,'PUNTAJE SEMESTRAL', 1, 0, 'L');
				$this->Cell(8,4, $sResnota['101']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['102']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['103']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['201']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['202']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['203']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['301']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['302']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['303']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['401']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['402']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['403']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['501']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['502']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['503']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['601']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['602']['ppu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['603']['ppu'], 1, 0, 'C');
				$this->Ln();

				$this->Cell(46,4,'PROMEDIO PONDERADO SEMESTRAL', 1, 0, 'L');
				$this->Cell(8,4, $sResnota['101']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['102']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['103']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['201']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['202']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['203']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['301']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['302']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['303']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['401']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['402']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['403']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['501']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['502']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['503']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['601']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['602']['ppp'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['603']['ppp'], 1, 0, 'C');
				$this->Ln();
				
				$this->SetFont('arialn','B',8);
				$this->Cell(46,5,'DATOS ACUMULATIVOS', 1, 0, 'L');
				$this->Cell(144,5,'', 1, 0, 'L');
				$this->Ln();
				
				$this->SetFont('arialn','',8);
				$this->Cell(46,4,'CRÉDITOS CURSADOS', 1, 0, 'L');
				$this->Cell(8,4, $sResnota['101']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['102']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['103']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['201']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['202']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['203']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['301']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['302']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['303']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['401']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['402']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['403']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['501']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['502']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['503']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['601']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['602']['acc'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['603']['acc'], 1, 0, 'C');
				$this->Ln();
				
				$this->Cell(46,4,'CRÉDITOS APROBADOS', 1, 0, 'L');
				$this->Cell(8,4, $sResnota['101']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['102']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['103']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['201']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['202']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['203']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['301']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['302']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['303']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['401']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['402']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['403']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['501']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['502']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['503']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['601']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['602']['aca'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['603']['aca'], 1, 0, 'C');
				$this->Ln();
				
				$this->Cell(46,4,'PUNTAJE ACUMULATIVO', 1, 0, 'L');
				$this->Cell(8,4, $sResnota['101']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['102']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['103']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['201']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['202']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['203']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['301']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['302']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['303']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['401']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['402']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['403']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['501']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['502']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['503']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['601']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['602']['apu'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['603']['apu'], 1, 0, 'C');
				$this->Ln();
				
				$this->Cell(46,4,'PROM. PONDERADO ACUMULATIVO', 1, 0, 'L');
				$this->Cell(8,4, $sResnota['101']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['102']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['103']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['201']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['202']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['203']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['301']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['302']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['303']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['401']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['402']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['403']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['501']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['502']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['503']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['601']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['602']['app'], 1, 0, 'C');
				$this->Cell(8,4, $sResnota['603']['app'], 1, 0, 'C');
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
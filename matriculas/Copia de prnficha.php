<?php

	session_start();
	include "../include/function.php";
	require "../include/fpdf.php";

	if(fsafetyselcar2())
	{
		
		class PDF extends FPDF
		{
			function Header()
			{
				//$this->Ln(8);
				
				$this->SetFont('Arial','B',10);
				$this->Cell(0,4,'', 0, 0, 'C');
				$this->Ln();
				$this->Cell(0,4,'', 0, 0, 'C');
				$this->Ln();
				$this->SetFont('arialn','B',10);
				$this->Cell(0,4,'', 0, 0, 'C');
				$this->Ln();
				
				$this->Ln(4);
				//$this->Subhficha();
				//$this->Subhficha2();
				
			}
			function Subhficha()
			{
				global $sUsercoo, $sCarrera, $sFacultad, $sEstudia, $sPeriodo, $sModmat, $sTiposist, $sPlan, $sNivel, $sGrupo, $sTurno, $sEspecial;
				$this->SetFont('arial','B',7);
				$this->Cell(140,3,"FACULTAD: {$sFacultad[$sUsercoo['cod_fac']]}", 0);
				$this->SetFont('arial','B',12);
				$this->Cell(50,3,'FICHA DE MATRÍCULA', 0, 0, 0,'R');			
				$this->Ln();
				
				$this->SetFont('arial','B',7);
				$this->Cell(140,3, "ESCUELA PROFESIONAL: {$sCarrera[$sUsercoo['cod_car']]}, {$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']}", 0);			
				$this->Ln();
				
				$vNombre = strtoupper("{$sEstudia['paterno']} {$sEstudia['materno']}, {$sEstudia['nombres']}");
				$this->SetFont('arial','B',7);
				$this->Cell(140,3, "APELLIDOS Y NOMBRES: $vNombre", 0);
				$this->SetFont('arial','B',12);
				$this->Cell(50,3, "N° de Matrícula: {$sEstudia['num_mat']}", 0, 0, 0,'R');
				$this->Ln();
				
				$this->SetFont('arial','B',7);
				$this->Cell(140,3, "PERIODO ACADÉMICO: {$sUsercoo['ano_aca']}-{$sPeriodo[$sUsercoo['per_aca']]['per_des']}  SISTEMA CURRICULAR: {$sTiposist[$sPlan[$sEstudia['pln_est']]]}    CONDICIÓN: {$sModmat[$sEstudia['mod_mat']]['mod_des']} ", 0);
				$this->Ln();
							
				$this->SetFont('arial','B',7);
				$this->Cell(140,3, "NIVEL/SEMESTRE DE ESTUDIOS: {$sNivel[$sEstudia['niv_est']]}    GRUPO: {$sGrupo[$sEstudia['sec_gru']]} ", 0);
				//TURNO: {$sTurno[$sEstudia['tur_est']]}
				$this->SetFont('code39','',11);
				$this->Cell(50,3, "*{$sEstudia['num_mat']}{$sUsercoo['cod_car']}{$sEstudia['mod_mat']}{$sEstudia['pln_est']}*", 0, 0, 0,'R');
				$this->Ln();
				
				$this->Ln(1);
			}
			
			function Subhficha2()
			{
				$this->SetFont('arialn','B',7);
	//			$this->Line(20, 52, 190, 52);
							
				$this->Cell(6,5,'N°', 1, 0, 'C');
				$this->Cell(5,5,'NIV', 1, 0, 'C');
				$this->Cell(18,5,'SEMESTRE', 1, 0, 'C');
				$this->Cell(65,5,'CURSO', 1, 0, 'C');
				$this->Cell(15,5,'GRUPO', 1, 0, 'C');
				$this->Cell(20,5,'MODALIDAD', 1, 0, 'C');
				//$this->Cell(15,5,'TURNO', 1, 0, 'C');
				$this->Cell(8,5,'CRED', 1, 0, 'C');
				$this->Cell(40,5,'DOCENTE', 1, 0, 'C');
				$this->Cell(13,5,'AULA', 1, 0, 'C');
				$this->Ln();
				//$this->Ln(1);
			}
			
			function Footer1()
			{
				global $sUsercoo, $sMes;
				$vFecha = getdate(time());
				$vFechan = "{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} - Hora: {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']} hrs.";
				$this->SetFont('arialn','',8);
				//$this->Line(20, 277, 190, 277);
				$this->SetY(131);			
				$this->Cell(140, 4,"Fecha: $vFechan - IP: {$sUsercoo['ip']}", 0);
				$this->Cell(50, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
			}
			function Footer()
			{
				global $sUsercoo, $sMes;
				$vFecha = getdate(time());
				$vFechan = "{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} - Hora: {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']} hrs.";
				$this->SetFont('arialn','',8);
				//$this->Line(20, 277, 190, 277);
				$this->SetY(-8);			
				$this->Cell(140, 4,"Fecha: $vFechan - IP: {$sUsercoo['ip']}", 0);
				$this->Cell(50, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
			}
			function Body()
			{			
				global $sCursopdf, $sEstudia;
				$this->SetFont('arialn','',7);
				$vSum_crd = 0;
				if(!empty($sCursopdf))
				foreach($sCursopdf as $vCod_cur => $sCurso)
				{
					$this->Cell(6,4, $sCurso['num_cur'], 0, 0, 'C');
					$this->Cell(5,4, $sCurso['niv_est'], 0, 0, 'C');
					$this->Cell(18,4, $sCurso['sem_anu'], 0, 0, 'L');
					$this->Cell(65,4, $sCurso['nom_cur'], 0, 0, 'L');
					$this->Cell(15,4, $sCurso['sec_gru'], 0, 0, 'L');
					$this->Cell(20,4, $sCurso['mod_mat'], 0, 0, 'L');
					//$this->Cell(15,4, $sCurso['tur_est'], 0, 0, 'L');
					$this->Cell(8,4, $sCurso['crd_cur'], 0, 0, 'R');
					//$this->SetFont('code39','',9);
					//$this->Cell(40,4, "*$vCod_cur*", 0, 0, 'C');
					//$this->SetFont('arialn','',7);
					$this->Cell(13,4, $sCurso['aula'], 0, 0, 'R');
					$this->Ln();
					$vSum_crd += $sCurso['crd_cur'];
				}
				$this->SetFont('arialn','',8);
				$this->Cell(95,1, '__________________________________________________________________________', 0, 0, 'L');
				$this->Cell(95,1, '________________________________________________________________________', 0, 0, 'L');
				$this->Ln(2);
				$this->Cell(135,4, "Total de Créditos: $vSum_crd", 0, 0, 'R');
				$this->Ln(3);
				$this->Cell(5);
				$this->SetFont('arialn','',7);
				if(!empty($sEstudia['obs_est']))
					$this->Cell(100,4, "OBSERVACIÓN: {$sEstudia['obs_est']}", 0, 0, 'L');
			}
			function SubBody1()
			{
				global $sEstudia, $sUsercoo;
/*				$this->SetFont('code39','',12);
				$this->Text(25, 104, "*{$sEstudia['num_mat']}{$sUsercoo['cod_car']}{$sEstudia['mod_mat']}{$sEstudia['pln_est']}*");*/
				
				$this->SetFont('arialn','',7);
				
				$this->Rect(10, 42, 190, 93);
				
				//dos bloques
				$this->Rect(10, 42, 137, 63);
				$this->Rect(147, 42, 53, 63);
								
				$this->Rect(10, 105, 65, 25);
				$this->Line(15, 125, 70, 125);
				$this->Text(35, 128, "ESTUDIANTE");
	
				$this->Rect(75, 105, 72, 25);
				$this->Line(80, 125, 142, 125);
				$this->Text(95, 128, "COORDINADOR ACADÉMICO");
				
				//MENSJE
				$this->SetFont('arialn','',7);
				$this->Text(150, 123, "FECHA DE MATRICULA :");
				$this->SetFont('arialn','',10);
				$this->Text(174, 123, fFechad($sEstudia['fch_mat']));
				
								
				$this->Rect(147, 105, 53, 25);
				
				$this->Rect(10, 130, 190, 5);
				
			}			
			function SubBody2()
			{
				global $sEstudia, $sUsercoo;
/*				$this->SetFont('code39','',12);
				$this->Text(25, 262, "*{$sEstudia['num_mat']}{$sUsercoo['cod_car']}{$sEstudia['mod_mat']}{$sEstudia['pln_est']}*");*/
				
				$this->SetFont('arialn','',7);
				
				$this->Rect(10, 200, 190, 93);
				
				//dos bloques
				$this->Rect(10, 200, 137, 63);
				$this->Rect(147, 200, 53, 63);
				
				$this->Rect(10, 263, 65, 25);
				$this->Line(15, 283, 70, 283);
				$this->Text(35, 286, "ESTUDIANTE");
	
				$this->Rect(75, 263, 72, 25);
				$this->Line(80, 283, 142, 283);
				$this->Text(95, 286, "COORDINADOR ACADÉMICO");
				
				// Mensaje
				$this->SetFont('arialn','',7);
				$this->Text(150, 281, "FECHA DE MATRICULA :");
				$this->SetFont('arialn','',10);
				$this->Text(174, 281, fFechad($sEstudia['fch_mat']));
				
				$this->SetFont('arialn','',7);
				$this->Text(150, 286, "CONTRASEÑA DEL CTI :");
				$this->SetFont('arialn','',10);
				$this->Text(174, 286, $sEstudia['passwd']);
								
				$this->Rect(147, 263, 53, 25);
				
				$this->Rect(10, 288, 190, 5);
				
			}
			function ficha1()
			{
				$this->Subhficha();
				$this->Subhficha2();
				$this->Body();
				$this->SubBody1();
				$this->Footer1();				
			}
			function ficha2()
			{
				$this->SetY(184);
				$this->Subhficha();
				$this->Subhficha2();
				$this->Body();
				$this->SubBody2();				
			}
		}
	
		$pdf=new PDF('P', 'mm', 'A4');
		$pdf->AliasNbPages();
		$pdf->AddFont('arialn','','arialn.php');
		$pdf->AddFont('arialn','B','arialnb.php');
		$pdf->AddFont('code39','','code39.php');
		$pdf->AddPage();
		$pdf->ficha1();
		$pdf->ficha2();
		
		$pdf->Output();
		
	}
	else
	{		
		header("Location:index.php");
	}


?> 
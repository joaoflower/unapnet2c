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
				$this->Cell(0,5,'OFICINA DE TECNOLOGÍA INFORMÁTICA', 0, 0, 'C');
				$this->Ln();
				$this->SetFont('arialn','B',12);
				$this->Cell(0,5,'UN@P.NET2 ', 0, 0, 'C');
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
				$this->Cell(50,4,"RELACIÓN DE ESTUDIANTES [{$sUsercoo['ano_aca']}-{$sPeriodo[$sUsercoo['per_aca']]['per_des']}]", 0, 0, 0,'R');
				$this->Ln();
				
				$this->Cell(5);
				$this->Cell(180,4, "CARRERA PROFESIONAL: {$sCarrera[$sUsercoo['cod_car']]} - {$sEspecial[$sUsercoo['pln_est'].$sUsercoo['cod_esp']]['esp_nom']}", 0);
				$this->Ln();

				$this->Cell(5);
				$this->Cell(180,4, "NIVEL: {$sNivel[$sUsercoo['niv_est']]}     GRUPO: {$sGrupo[$sUsercoo['sec_gru']]}    CONDICIÓN(ES): {$sModmat[$sUsercoo['mod_mat']]['mod_des']}", 0);
				$this->Ln();
			
				$this->Ln(1);
			}
			
			function Subhnota2()
			{
				$this->SetFont('arialn','B',7);
	//			$this->Line(20, 52, 190, 52);
							
				$this->Cell(5);
				$this->Cell(7,5,'N°', 1, 0, 'C');
				$this->Cell(13,5,'CÓDIGO', 1, 0, 'C');
				$this->Cell(75,5,'APELLIDOS Y NOMBRES', 1, 0, 'C');
				$this->Cell(25,5,'MOD', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Ln();
				$this->Ln(1);
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
				global $sEstupdf;
				$this->SetFont('arialn','',10);
				if(!empty($sEstupdf))
				foreach($sEstupdf as $sEstu)
				{
					$this->Cell(5);
					$this->Cell(7,5, $sEstu['num_est'], 0, 0, 'C');
					$this->Cell(13,5, $sEstu['num_mat'], 0, 0, 'C');
					$this->Cell(75,5, $sEstu['nombre'], 0, 0, 'L');
					$this->Cell(25,5, $sEstu['mod_mat'], 0, 0, 'L');
					$this->Cell(10,5,'', 1, 0, 'C');
					$this->Cell(10,5,'', 1, 0, 'C');
					$this->Cell(10,5,'', 1, 0, 'C');
					$this->Cell(10,5,'', 1, 0, 'C');
					$this->Cell(10,5,'', 1, 0, 'C');
					$this->Cell(10,5,'', 1, 0, 'C');
					$this->Ln();
					//$this->Ln(10);
				}
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
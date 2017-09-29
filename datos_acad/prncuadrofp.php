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
				$this->Subcuadro();
				$this->Subcuadro2();
				
			}
			function Subcuadro()
			{
				global $sUsercoo, $sCarrera, $sFacultad, $sEstudia,  $sPeriodo, $sSemestre;
				$this->SetFont('arialn','B',10);
				
				$this->SetFont('arial','B',13);
				$this->Cell(0,8,"CUADRO PROMOCIONAL [{$sUsercoo['ano_aca']}-{$sPeriodo[$sUsercoo['per_aca']]['abr_per']}]", 0, 0, 'C');
				$this->Ln();
				$this->SetFont('arialn','B',10);
				$this->Cell(10);
				$this->Cell(140,4,"FACULTAD: {$sFacultad[$sUsercoo['cod_fac']]}", 0);

				$this->Ln();
				
				$this->Cell(10);
				$this->Cell(140,4, "ESCUELA PROFESIONAL: {$sCarrera[$sUsercoo['cod_car']]}", 0);
				$this->Ln();
				
				$this->Cell(10);
				$this->Cell(140,4, "ESTUDIANTES QUE APROBARON MAS O IGUAL A {$sUsercoo['crd_pro']}", 0);				
				$this->Ln();
				
				$this->Cell(10);
				$this->Cell(140,4, "CUADRO PROMOCIONAL EMITIDO SEGÚN: REGLAMENTO APROBADO EN C.U. DEL 04 y 06 DIC 2006", 0);				
				$this->Ln();		
				
				$this->Cell(10);
				$this->Cell(140,4, "ALCANCE: Para la elaboración del Ranking promocional se utilizo el Artículo 8 del Reglamento de Elaboración del cuadro de méritos ", 0);
				$this->Ln();
				
				$this->Cell(10);
				$this->Cell(140,4, "del Sistema curricular flexible por competencias ", 0);				
				$this->Ln();				
								
				$this->Ln(2);
			}
			
			function Subcuadro2()
			{
				$this->SetFont('arialn','B',9);
	//			$this->Line(20, 52, 190, 52);
							
				$this->Cell(10);
				$this->Cell(8,4,'Nro', 'LRT', 0, 'C');
				$this->Cell(15,4,'Num.Mat.', 'LRT', 0, 'C');
				$this->Cell(62,4,'Apellidos y Nombres', 'LRT', 0, 'C');
				$this->Cell(8,4,'Esp', 'LRT', 0, 'C');
				
				$this->Cell(10,4,'PPA', 'LRT', 0, 'C');
				$this->Cell(10,4,'CrA', 'LRT', 0, 'C');
				$this->Cell(10,4,'Cr.Obl', 'LRT', 0, 'C');
				$this->Cell(10,4,'Cr.Opt', 'LRT', 0, 'C');
				$this->Cell(10,4,'Cr.Ele', 'LRT', 0, 'C');
			
				$this->Ln();
				
				$this->Cell(10);
				
				$this->Cell(8,4,'', 'LRB', 0, 'C');
				$this->Cell(15,4,'', 'LRB', 0, 'C');
				$this->Cell(62,4,'', 'LRB', 0, 'C');
				$this->Cell(8,4,'', 'LRB', 0, 'C');
				
				$this->Cell(10,4,'', 'LRB', 0, 'C');
				$this->Cell(10,4,'', 'LRB', 0, 'C');
				$this->Cell(10,4,'', 'LRB', 0, 'C');
				$this->Cell(10,4,'', 'LRB', 0, 'C');
				$this->Cell(10,4,'', 'LRB', 0, 'C');
				
				$this->Ln();
//				$this->Ln(2);
			}
			
			function Footer()
			{
				global $sUsercoo, $sMes;
				$vFecha = getdate(time());
				$vFechan = "{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} - Hora: {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']} hrs.";
				$this->SetFont('arialn','',10);
				$this->Line(10, 277, 200, 277);
				$this->SetY(-20);			
				$this->Cell(120, 4,"Fecha: $vFechan - IP: {$sUsercoo['ip']}", 0);
				$this->Cell(70, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
			}
			function Body()
			{			
				global $sEstukey, $sEstucdo, $sModmat;
				$vCont = 1;
				$this->SetFont('arialn','',9);
				if(!empty($sEstukey))
				foreach($sEstukey as $vNum_mat => $vKey)
				{
					$this->Cell(10);
					$this->SetFont('arialn','',9);
					$this->Cell(8,5, $vCont, 'LR', 0, 'C');
					$this->Cell(15,5, $sEstucdo[$vNum_mat]['num_mat'], 0, 0, 'C');
					$this->Cell(62,5, $sEstucdo[$vNum_mat]['nombre'], 0, 0, 'L');
					$this->Cell(8,5, $sEstucdo[$vNum_mat]['cod_esp'], 'LR', 0, 'C');
					
					$this->SetFont('arialn','B',10);
					$this->Cell(10,5, $sEstucdo[$vNum_mat]['prd_acu'], 'L', 0, 'R');
					$this->Cell(10,5, $sEstucdo[$vNum_mat]['crd_apb'], 0, 0, 'R');
					$this->Cell(10,5, $sEstucdo[$vNum_mat]['crd_obl'], 0, 0, 'R');
					$this->Cell(10,5, $sEstucdo[$vNum_mat]['crd_opt'], 0, 0, 'R');
					$this->Cell(10,5, $sEstucdo[$vNum_mat]['crd_ele'], 'R', 0, 'R');

					$this->Ln();
					//$this->Ln(10);
					$vCont++;
				}
				$this->Cell(10);
				$this->Cell(140,1, '_______________________________________________________________________________________', 0, 0, 'L');
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
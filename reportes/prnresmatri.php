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
				$this->Ln(5);
				$this->SetFont('arialn','B',12);
				$this->Cell(0,5,'RESUMEN DE MATRICULADOS POR ESCUELA Y POR MODALIDAD', 0, 0, 'C');
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

				$this->Ln(3);
			}
			
			function Subhnota2()
			{
				$this->SetFont('arialn','B',7);
//				$this->Line(15, 57, 195, 57);	
				
				$this->Cell(5);
				$this->Cell(8,5,'COD', 1, 0, 'C');
				$this->Cell(70,5,'ESCUELA PROFESIONAL', 1, 0, 'C');
				$this->Cell(7,5,'REG', 1, 0, 'C');
				$this->Cell(7,5,'3RA', 1, 0, 'C');				
				$this->Cell(7,5,'4TA', 1, 0, 'C');
				$this->Cell(7,5,'5TA', 1, 0, 'C');
				$this->Cell(7,5,'6TA', 1, 0, 'C');
				$this->Cell(7,5,'7MA', 1, 0, 'C');
				$this->Cell(7,5,'8VA', 1, 0, 'C');
				$this->Cell(7,5,'OBS', 1, 0, 'C');
				$this->Cell(7,5,'DIR', 1, 0, 'C');
				$this->Cell(7,5,'ESP', 1, 0, 'C');
				$this->Cell(7,5,'RVA', 1, 0, 'C');
				$this->Cell(10,5,'TOTAL', 1, 0, 'C');
				$this->Ln();
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
				global $sPDF, $sEstupdf, $sCarrera, $sAcceso;

				$this->SetFont('arialn','',8);
				
				$vSem_anu = "";
				$vNiv_est = "";
				$vPln_est = "";
				$vCod_esp = "";
				$vSec_gru = "";
				
				if(!empty($sAcceso))
				foreach($sAcceso as $vCod_car => $aAcceso) 				
				{				
					if($vCod_car <= '66' and $vCod_car != '53')
					{				
						$this->Cell(5);
						$this->Cell(8,5,$vCod_car, 1, 0, 'C');
						$this->Cell(70,5,$sCarrera[$vCod_car], 1, 0, 'L');
						$this->Cell(7,5,$sPDF[$vCod_car]['01'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car]['18'], 1, 0, 'C');					
						$this->Cell(7,5,$sPDF[$vCod_car]['08'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car]['11'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car]['13'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car]['14'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car]['15'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car]['07'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car]['16'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car]['05'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car]['17'], 1, 0, 'C');
						$this->Cell(10,5,$sPDF[$vCod_car]['total'], 1, 0, 'C');
						$this->Ln();
					}
				}	
				
				$this->SetFont('arialn','B',7);
				$this->Cell(5);
				$this->Cell(78,5,'', 1, 0, 'C');
				$this->Cell(7,5,'REG', 1, 0, 'C');
				$this->Cell(7,5,'3RA', 1, 0, 'C');				
				$this->Cell(7,5,'4TA', 1, 0, 'C');
				$this->Cell(7,5,'5TA', 1, 0, 'C');
				$this->Cell(7,5,'6TA', 1, 0, 'C');
				$this->Cell(7,5,'7MA', 1, 0, 'C');
				$this->Cell(7,5,'8VA', 1, 0, 'C');
				$this->Cell(7,5,'OBS', 1, 0, 'C');
				$this->Cell(7,5,'DIR', 1, 0, 'C');
				$this->Cell(7,5,'ESP', 1, 0, 'C');
				$this->Cell(7,5,'RVA', 1, 0, 'C');
				$this->Cell(10,5,'TOTAL', 1, 0, 'C');
				$this->Ln();
				$this->Cell(5);
				$this->Cell(78,5,"TOTAL :", 1, 0, 'R');
				$this->Cell(7,5,$sEstupdf['01'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['18'], 1, 0, 'C');				
				$this->Cell(7,5,$sEstupdf['08'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['11'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['13'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['14'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['15'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['07'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['16'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['05'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['17'], 1, 0, 'C');
				$this->Cell(10,5,$sEstupdf['total'], 1, 0, 'C');
				$this->Ln();

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
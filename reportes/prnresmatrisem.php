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
				$this->Cell(0,5,'RESUMEN DE MATRICULADOS POR SEMESTRE', 0, 0, 'C');
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
				//$this->Cell(130,4,"FACULTAD: {$sFacultad[$sUsercoo['cod_fac']]}", 0);
				$this->Cell(130,4,"", 0);
				$this->Cell(50,4,"[{$sUsercoo['ano_aca']}-{$sPeriodo[$sUsercoo['per_aca']]['per_des']}]", 0, 0, 0,'R');
				$this->Ln();
				
				$this->Cell(5);
				$this->Cell(130,4,"SISTEMA CURRICULAR: FLEXIBLE", 0);
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
				$this->Cell(7,5,'SS', 1, 0, 'C');
				$this->Cell(7,5,'S-01', 1, 0, 'C');				
				$this->Cell(7,5,'S-02', 1, 0, 'C');
				$this->Cell(7,5,'S-03', 1, 0, 'C');
				$this->Cell(7,5,'S-04', 1, 0, 'C');
				$this->Cell(7,5,'S-05', 1, 0, 'C');
				$this->Cell(7,5,'S-06', 1, 0, 'C');
				$this->Cell(7,5,'S-07', 1, 0, 'C');
				$this->Cell(7,5,'S-08', 1, 0, 'C');
				$this->Cell(7,5,'S-09', 1, 0, 'C');
				$this->Cell(7,5,'S-10', 1, 0, 'C');
				$this->Cell(7,5,'S-11', 1, 0, 'C');
				$this->Cell(7,5,'S-12', 1, 0, 'C');
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
					if($vCod_car <= '66' and $vCod_car != '53' and $vCod_car != '51')
					{				
						$this->Cell(5);
						$this->Cell(8,5,$vCod_car, 1, 0, 'C');
						$this->Cell(70,5,$sCarrera[$vCod_car], 1, 0, 'L');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['ss'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['01'], 1, 0, 'C');					
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['02'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['03'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['04'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['05'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['06'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['07'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['08'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['09'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['10'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['11'], 1, 0, 'C');
						$this->Cell(7,5,$sPDF[$vCod_car.'2']['12'], 1, 0, 'C');
						$this->Cell(10,5,$sPDF[$vCod_car.'2']['total'], 1, 0, 'C');
						$this->Ln();
					}
				}	
				
				$this->SetFont('arialn','B',7);
				$this->Cell(5);
				$this->Cell(78,5,'', 1, 0, 'C');
				$this->Cell(7,5,'SS', 1, 0, 'C');
				$this->Cell(7,5,'S-01', 1, 0, 'C');				
				$this->Cell(7,5,'S-02', 1, 0, 'C');
				$this->Cell(7,5,'S-03', 1, 0, 'C');
				$this->Cell(7,5,'S-04', 1, 0, 'C');
				$this->Cell(7,5,'S-05', 1, 0, 'C');
				$this->Cell(7,5,'S-06', 1, 0, 'C');
				$this->Cell(7,5,'S-07', 1, 0, 'C');
				$this->Cell(7,5,'S-08', 1, 0, 'C');
				$this->Cell(7,5,'S-09', 1, 0, 'C');
				$this->Cell(7,5,'S-10', 1, 0, 'C');
				$this->Cell(7,5,'S-11', 1, 0, 'C');
				$this->Cell(7,5,'S-12', 1, 0, 'C');
				$this->Cell(10,5,'TOTAL', 1, 0, 'C');
				$this->Ln();
				$this->Cell(5);
				$this->Cell(78,5,"TOTAL :", 1, 0, 'R');
				$this->Cell(7,5,$sEstupdf['ss2'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['012'], 1, 0, 'C');				
				$this->Cell(7,5,$sEstupdf['022'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['032'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['042'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['052'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['062'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['072'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['082'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['092'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['102'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['112'], 1, 0, 'C');
				$this->Cell(7,5,$sEstupdf['122'], 1, 0, 'C');
				$this->Cell(10,5,$sEstupdf['total2'], 1, 0, 'C');
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
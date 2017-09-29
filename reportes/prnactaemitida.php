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
				$this->Cell(0,5,'ACTAS EMITIDAS ', 0, 0, 'C');
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
				$this->SetFont('arialn','B',7);
//				$this->Line(15, 57, 195, 57);	
				
				$this->Cell(5);
				$this->Cell(8,5,'COD', 1, 0, 'C');
				$this->Cell(85,5,'NOMBRE DE CURSO', 1, 0, 'C');
				$this->Cell(50,5,'DOCENTE', 1, 0, 'C');
				$this->Cell(20,5,'MODALIDAD', 1, 0, 'C');
				$this->Cell(10,5,'ACTA', 1, 0, 'C');
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
				global $sPDF, $sNivel, $sSemestre, $sTiposist, $sPlan, $sEspecial, $sEstupdf, $sGrupo, $sModnot;

				$this->SetFont('arialn','',8);
				
				$vSem_anu = "";
				$vNiv_est = "";
				$vPln_est = "";
				$vCod_esp = "";
				$vSec_gru = "";
				
				if(!empty($sPDF))
				foreach($sPDF as $vCod_cur => $aCurso)
				{					
					
					if($vPln_est != $aCurso['pln_est'])
					{
						if(!empty($vPln_est))
							$this->AddPage();
						$vPln_est = $aCurso['pln_est'];
						
						$vPln_des = "PLAN DE ESTUDIOS: {$aCurso['pln_est']} - SISTEMA: {$sTiposist[$sPlan[$aCurso['pln_est']]]}";
						
						$this->SetFont('arialn','B',9);
						$this->Cell(5);
						$this->Cell(8,5,"", 1, 0, 'C');
						$this->Cell(165,5,$vPln_des, 1, 0, 'L');	
						$this->Ln();
						$this->SetFont('arialn','',8);	
					}					
					
					if($vSem_anu != $aCurso['sem_anu'] or $vNiv_est != $aCurso['niv_est'] or $vSec_gru != $aCurso['sec_gru'])
					{
						$vSem_anu = $aCurso['sem_anu'];
						$vNiv_est = $aCurso['niv_est'];
						$vSec_gru = $aCurso['sec_gru'];
						
						$vNiv_sem = "NIVEL : {$sNivel[$aCurso['niv_est']]} - SEMESTRE : {$sSemestre[$aCurso['sem_anu']]} - GRUPO : {$sGrupo[$aCurso['sec_gru']]}";
						
						$this->SetFont('arialn','B',8);
						$this->Cell(5);
						$this->Cell(8,5,"", 1, 0, 'C');
						$this->Cell(165,5,$vNiv_sem, 1, 0, 'L');	
						$this->Ln();
						$this->SetFont('arialn','',8);						
					}					
					if($vCod_esp != $aCurso['cod_esp'])
					{
						$vCod_esp = $aCurso['cod_esp'];
						
						if($vCod_esp != '00')
						{
							$vNiv_sem = "     MENCI�N : {$sEspecial[$aCurso['pln_est'].$aCurso['cod_esp']]['esp_nom']}";							
							$this->SetFont('arialn','B',8);
							$this->Cell(5);
							$this->Cell(8,5,"", 1, 0, 'C');
							$this->Cell(165,5,$vNiv_sem, 1, 0, 'L');	
							$this->Ln();
							$this->SetFont('arialn','',8);						
						}
					}					
					
					$this->Cell(5);
					$this->Cell(8,5,$aCurso['cod_cur'], 1, 0, 'C');
					$this->Cell(85,5,$aCurso['nom_cur'], 1, 0, 'L');
					$this->Cell(50,5,$aCurso['nombre'], 1, 0, 'C');
					$this->Cell(20,5,$sModnot[$aCurso['mod_mat']], 1, 0, 'C');
					$this->Cell(10,5,$aCurso['cod_act'], 1, 0, 'C');
					$this->Ln();
				}	
				
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
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";

	if(fsafetyselcar())
	{
		$sEstudia = "";
		
		$sEstudia['num_mat'] = $_GET['rNum_mat'];
		$sEstudia['cod_car'] = $_GET['rCod_car'];
		
		
		$sCurso = "";
		$sCurmat = "";
		$sCurmat2 = "";
		$sCurapto = "";
		
		$bApeestu = FALSE;
		
		//--------------- ape_estu -----
		$vQuery = "Select num_mat ";
		$vQuery .= "from unapnet.apeestu where num_mat = '{$sEstudia['num_mat']}' and cod_car = '{$sEstudia['cod_car']}' and ";
		$vQuery .= "ano_aca = '{$sUsercoo['ano_aca']}' and per_aca = '{$sUsercoo['per_aca']}' ";
		
		$cApeestu = fQuery($vQuery);
		if($aApeestu = $cApeestu->fetch_array())
		{
			$bApeestu = TRUE;
		}
		$cApeestu->close();
		
		//------------------------------
		
		$vQuery = "Select num_mat, cod_car, paterno, materno, nombres, passwd, mod_ing ";
		$vQuery .= "from unapnet.estudiante where num_mat = '{$sEstudia['num_mat']}' and cod_car = '{$sEstudia['cod_car']}' and ";
		$vQuery .= "con_est = '5' ";
		
		$cEstudia = fQuery($vQuery);
		if($aEstudia = $cEstudia->fetch_array())
		{			
			$sEstudia['paterno'] = $aEstudia['paterno'];			
			$sEstudia['materno'] = $aEstudia['materno'];
			$sEstudia['nombres'] = $aEstudia['nombres'];
			$sEstudia['nombre'] = "{$aEstudia['paterno']} {$aEstudia['materno']}, {$aEstudia['nombres']}";
			$sEstudia['passwd'] = $aEstudia['passwd'];
			$sEstudia['mod_ing'] = $aEstudia['mod_ing'];
		}
		else
		{	$sEstudia = "";
			?>
		
		<table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >ERROR</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordi" align="center">EL ESTUDIANTE NO EXISTE</td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
		
			<?
			header("Location:../index.php");
		}	
		$bEstumat = FALSE;	
		$bPago = FALSE;
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tLogestumat = "unapnet.logestumat{$sUsercoo['ano_aca']}";
		$tPago = "unapnet.pago{$sUsercoo['ano_aca']}";
		$tLogestumat = "unapnet.logestumat{$sUsercoo['ano_aca']}";
			
		//----  Apertura de matricula ------------------
		if($sApemat[$sUsercoo['cod_car']] === 'False'  and $bApeestu == FALSE) // and false
		{	?>
			<table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Estudiante: <?=$sEstudia['nombre']?></th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordi" align="center">
				EL PERIODO DE MATRICULAS YA TERMINO, <br />
				POR DISPOSICI&Oacute;N DE RECTORADO Y VICERECTORADO ACAD&Eacute;MICO.<br />
				RECLAMOS A VICERECTORADO ACAD&Eacute;MICO. </td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
			
		<?
		}
		elseif($sApemat[$sUsercoo['cod_car']] === 'True'  or $bApeestu == TRUE) // or true
		{			
			$vQuery = "Select num_mat from $tEstumat where num_mat = '{$sEstudia['num_mat']}' and ano_aca = '{$sUsercoo['ano_aca']}' ";
			$vQuery .= "and per_aca = '{$sUsercoo['per_aca']}'";
			$cEstumat = fQuery($vQuery);
			if($aEstumat = $cEstumat->fetch_array())
			{	
				$bEstumat = TRUE;	
			?>
				<table border="0" cellpadding="0" cellspacing="0" id="ventana">
			  <tr>
				<th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
				<th align="center" background="../images/ventana_r1_c2.jpg" >Estudiante: <?=$sEstudia['nombre']?></th>
				<th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
			  </tr>
			  <tr>
				<td background="../images/ventana_r2_c1.jpg"></td>
				<td background="../images/ventana_r2_c2.jpg" class="wordi" align="center">
					EL ESTUDIANTE YA REALIZO SU MATRICULA EN ESTE PERIODO,<br>
					SELECCIONE OTRO ESTUDIANTE O<br />
					INGRESE A EDICI&Oacute;N DE MATRICULA </td>
				<td background="../images/ventana_r2_c4.jpg"></td>
			  </tr>
			  <tr>
				<td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
				<td background="../images/ventana_r4_c2.jpg"></td>
				<td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
			  </tr>
			</table>
				
			<?
			}
			else
			{				
				if($sAcceso[$sUsercoo['cod_car']]['pago'] === 'True')	
				{		
					
				
				?>
				
				<table border="0" cellpadding="0" cellspacing="0" id="ventana">
				  <tr>
					<th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
					<th align="center" background="../images/ventana_r1_c2.jpg" >Pago de Matr&iacute;culas</th>
					<th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
				  </tr>
				  <tr>
					<td background="../images/ventana_r2_c1.jpg"></td>
					<td background="../images/ventana_r2_c2.jpg" class="wordcen">EL ESTUDIANTE DEBE PAGAR: <br>
					<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
						<tr>
						  <th width="25" scope="col">C</th>
						  <th width="280" scope="col">Descripci&oacute;n</th>
						  <th width="30" scope="col">Can</th>
						  <th width="40" scope="col">P.U.</th>
						  <th width="40" scope="col">Total</th>
						</tr>
						<?
					$vTot_pag = 0;
					
					$bPagofecha = FALSE;
					$bMatrifecha = FALSE;
					$bExoestu = FALSE;
					
					$vQuery = "select num_mat from unapnet.exoestu where ano_aca = '{$sUsercoo['ano_aca']}' and ";
					$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and num_mat = '{$sEstudia['num_mat']}' and ";
					$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' ";
					
					$cExoestu = fQuery($vQuery);
					if($aExoestu = $cExoestu->fetch_array())
					{				
						$bExoestu = TRUE;									
					}
					$cExoestu->close();
					
					if(!$bExoestu)
					{
	/*					$vQuery = "select num_reb from $tPago where ano_aca = '{$sUsercoo['ano_aca']}' and ";
						$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and num_mat = '{$sEstudia['num_mat']}' and ";
						$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and con_reb = '1' and mon_pag > '0' and ";
						$vQuery .= "date(fch_pag) >= '2007-02-19' and date(fch_pag) <= '2007-02-28'";
						
						$cPagok = fQuery($vQuery);
						if($aPagok = $cPagok->fetch_array())
						{				
							$bPagofecha = TRUE;									
						}
						$cPagok->close();*/
						$vQuery = "select num_mat from $tLogestumat where ano_aca = '{$sUsercoo['ano_aca']}' and ";
						$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and num_mat = '{$sEstudia['num_mat']}' and ";
						$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' ";
						
						$cLogok = fQuery($vQuery);
						if($aLogok = $cLogok->fetch_array())
						{				
							$bMatrifecha = TRUE;									
						}
						$cLogok->close();
						
					}
					
					if($sExocar[$sUsercoo['cod_car']] === 'False')
					{
						if(!$bExoestu)
						if(!$bMatrifecha)
						{
							$vTot_pag += round($sTarifapago['26']['mon_pag'], 0);
					?>
					<tr class="celinpar">
					  <td class="wordcen" scope="col">26</td>
					  <td class="wordizq" scope="col">&nbsp;<?=$sTarifapago['26']['des_pag']?></td>
					  <td class="wordcen" scope="col">1</td>
					  <td class="wordder" scope="col"><?=$sTarifapago['26']['mon_pag']?>&nbsp;</td>
					  <td class="wordderb" scope="col"><?=$sTarifapago['26']['mon_pag']?>&nbsp;</td>
				  </tr>
					<?
						}
					}
					
						if($sEstudia['mod_ing'] == '5')
						{
							if($sTarifapago['23']['mon_pag'] > 0)
							{
								$vTot_pag += $sTarifapago['23']['mon_pag'];
							?>
							<tr class="celinpar">
							  <td class="wordcen" scope="col">23</td>
							  <td class="wordizq" scope="col">&nbsp;<?=$sTarifapago['23']['des_pag']?></td>
							  <td class="wordcen" scope="col">1</td>
							  <td class="wordder" scope="col"><?=$sTarifapago['23']['mon_pag']?>&nbsp;</td>
							  <td class="wordderb" scope="col"><?=$sTarifapago['23']['mon_pag']?>&nbsp;</td>
						  </tr>
							<?
							}
						}
						else
						{
							if($sTarifapago['14']['mon_pag'] > 0)
							{
								$vTot_pag += $sTarifapago['14']['mon_pag'];
							?>
							<tr class="celinpar">
							  <td class="wordcen" scope="col">14</td>
							  <td class="wordizq" scope="col">&nbsp;<?=$sTarifapago['14']['des_pag']?></td>
							  <td class="wordcen" scope="col">1</td>
							  <td class="wordder" scope="col"><?=$sTarifapago['14']['mon_pag']?>&nbsp;</td>
							  <td class="wordderb" scope="col"><?=$sTarifapago['14']['mon_pag']?>&nbsp;</td>
						  </tr>
							<?
							}
						}
						if($sTarifapago['15']['mon_pag'] > 0)
						{
							$vTot_pag += $sTarifapago['15']['mon_pag'];
						?>
						<tr class="celinpar">
						  <td class="wordcen" scope="col">15</td>
						  <td class="wordizq" scope="col">&nbsp;<?=$sTarifapago['15']['des_pag']?></td>
						  <td class="wordcen" scope="col">1</td>
						  <td class="wordder" scope="col"><?=$sTarifapago['15']['mon_pag']?>&nbsp;</td>
						  <td class="wordderb" scope="col"><?=$sTarifapago['15']['mon_pag']?>&nbsp;</td>
					  </tr>
						<?
						}
						if($sEstudia['mod_ing'] == '6')
						{
							if($sTarifapago['16']['mon_pag'] > 0)
							{
								$vTot_pag += $sTarifapago['16']['mon_pag'];
							?>
							<tr class="celinpar">
							  <td class="wordcen" scope="col">16</td>
							  <td class="wordizq" scope="col">&nbsp;<?=$sTarifapago['16']['des_pag']?></td>
							  <td class="wordcen" scope="col">1</td>
							  <td class="wordder" scope="col"><?=$sTarifapago['16']['mon_pag']?>&nbsp;</td>
							  <td class="wordderb" scope="col"><?=$sTarifapago['16']['mon_pag']?>&nbsp;</td>
						  </tr>
							<?
							}
						}
						if($sEstudia['mod_ing'] == '7')
						{
							if($sTarifapago['17']['mon_pag'] > 0)
							{
								$vTot_pag += $sTarifapago['17']['mon_pag'];
							?>
							<tr class="celinpar">
							  <td class="wordcen" scope="col">17</td>
							  <td class="wordizq" scope="col">&nbsp;<?=$sTarifapago['17']['des_pag']?></td>
							  <td class="wordcen" scope="col">1</td>
							  <td class="wordder" scope="col"><?=$sTarifapago['17']['mon_pag']?>&nbsp;</td>
							  <td class="wordderb" scope="col"><?=$sTarifapago['17']['mon_pag']?>&nbsp;</td>
						  </tr>
							<?
							}
						}
						
						if($sTarifapago['02']['mon_pag'] > 0)
						{
							$vTot_pag += $sTarifapago['02']['mon_pag'];
						?>
						<tr class="celinpar">
						  <td class="wordcen" scope="col">02</td>
						  <td class="wordizq" scope="col">&nbsp;<?=$sTarifapago['02']['des_pag']?></td>
						  <td class="wordcen" scope="col">1</td>
						  <td class="wordder" scope="col"><?=$sTarifapago['02']['mon_pag']?>&nbsp;</td>
						  <td class="wordderb" scope="col"><?=$sTarifapago['02']['mon_pag']?>&nbsp;</td>
						</tr>
						<?
						}
						?>
						<tr class="celinpar">
						  <td colspan="4" class="wordderb" scope="col">TOTAL:</td>
						  <td class="wordderb" scope="col"><?=$vTot_pag?>&nbsp;</td>
						</tr> 
					</table> <br>
					<span class="wordi">VERIFIQUE QUE EL MONTO QUE DEBE DE PAGAR EL ESTUDIANTE <br />
SEA EL MISMO QUE PAG&Oacute; EN CAJA O EN EL BANCO</span><br />
					EL ESTUDIANTE PAGO EN CAJA: <BR>
					<?
						$vPer_aca = '';
						$vPag_caja = 0;
						if($sUsercoo['per_aca'] == '00' or $sUsercoo['per_aca'] == '01')
							$vPer_aca = '01';
						elseif ($sUsercoo['per_aca'] == '02')
							$vPer_aca = '02';
		
						$tPago = "unapnet.pago{$sUsercoo['ano_aca']}";
						$vQuery = "select ifnull(sum(mon_pag), 0) as mon_pag from $tPago ";
						$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and cod_car = '{$sUsercoo['cod_car']}' and ";
						$vQuery .= "per_aca = '$vPer_aca' and con_reb = '1'";					
							
						$cPago = fQuery($vQuery);
						if($aPago = $cPago->fetch_array())
						{				
							$vPag_caja = $aPago['mon_pag'];										
						}
						$cPago->close();
						if($vPag_caja >= $vTot_pag)
							$bPago = TRUE;
						//$vPag_caja
					?>
					<span class="wordi">S/. (VERIFIQUE EL RECIBO)</span>
					</td>
					<td background="../images/ventana_r2_c4.jpg"></td>
				  </tr>
				  <tr>
					<td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
					<td background="../images/ventana_r4_c2.jpg"></td>
					<td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
				  </tr>
				</table>		
				<?
					}
					elseif($sAcceso[$sUsercoo['cod_car']]['pago'] === 'False')
					{
						$bPago = TRUE;
					}
					//if(!$bEstumat and $bPago)
					if(!$bEstumat)
					{
				
				?>	
				<table border="0" cellpadding="0" cellspacing="0" id="ventana">
				<tr>
				  <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
				  <th align="center" background="../images/ventana_r1_c2.jpg" >Estudiante: <?=$sEstudia['nombre']?></th>
				  <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
				</tr>
				<tr>
				  <td background="../images/ventana_r2_c1.jpg"></td>
				  <td background="../images/ventana_r2_c2.jpg" class="wordcen">
				  <table border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
					<tr>
					  <td width="75" class="wordcen"><img src="../imgsingr/<?=$sUsercoo['ano_aca']?>/<?=$sEstudia['num_mat']?>.jpg" width="190" height="240"></td>
					</tr>
					<tr>
					  <td class="wordcen"><a href="" title="Continuar" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bcontinue.png" width="100" height="24"></a></td>
					</tr>
				  </table>
				  </td><td background="../images/ventana_r2_c4.jpg"></td>
				</tr>
				<tr>
				  <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
				  <td background="../images/ventana_r4_c2.jpg"></td>
				  <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
				</tr>
			  </table>
					
					<?
				}
			}
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

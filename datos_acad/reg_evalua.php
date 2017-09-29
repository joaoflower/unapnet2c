<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vNum_mat = $_GET['rNum_mat'];
		$vCod_car = $_GET['rCod_car'];
		
		$sEstudia = "";
		$sCurso = "";
		$sCurmat = "";
		$sCurmat2 = "";
		$sCurapto = "";
		$bEstuape = true;
		
		$tEstumat = "unapnet.estumat$vCod_car{$sUsercoo['ano_aca']}";
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		$tPago = "unapnet.pago{$sUsercoo['ano_aca']}";
		$tLogestumat = "unapnet.logestumat{$sUsercoo['ano_aca']}";
		
		$vQuery = "Select num_mat, paterno, materno, nombres, passwd ";
		$vQuery .= "from unapnet.estudiante where num_mat = '$vNum_mat' and cod_car = '$vCod_car' and ";
		$vQuery .= "con_est = '1' ";
		
		$cEstudia = fQuery($vQuery);
		if($aEstudia = $cEstudia->fetch_array())
		{			
			$sEstudia['num_mat'] = $aEstudia['num_mat'];
			$sEstudia['paterno'] = $aEstudia['paterno'];			
			$sEstudia['materno'] = $aEstudia['materno'];
			$sEstudia['nombres'] = $aEstudia['nombres'];
			$sEstudia['passwd'] = $aEstudia['passwd'];
			$sEstudia['nombre'] = "{$aEstudia['paterno']} {$aEstudia['materno']}, {$aEstudia['nombres']}";
		}
		else
		{	?>
		
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
		
		$vTot_pag = 0;
					
		$bApeestu = FALSE;

		$vQuery = "select num_mat from unapnet.apeestu where ano_aca = '{$sUsercoo['ano_aca']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and num_mat = '{$sEstudia['num_mat']}' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' ";
echo $vQuery;
		$cApeestu = fQuery($vQuery);
		if($aApeestu = $cApeestu->fetch_array())
		{				
			$bApeestu = TRUE;									
		}
		$cApeestu->close();
		
		//----  Apertura de matricula ------------------
		if($sApemat[$sUsercoo['cod_car']] === 'False' and $bApeestu === 'False')
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
				EL PERIODO DE MATRICULAS YA TERMINO, jojo <br />
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
		elseif($sApemat[$sUsercoo['cod_car']] === 'True' or $bApeestu === 'True')
		{					
			$vQuery = "Select num_mat from $tEstumat where num_mat = '$vNum_mat' and ano_aca = '{$sUsercoo['ano_aca']}' ";
			$vQuery .= "and per_aca = '{$sUsercoo['per_aca']}'";
			$cEstumat = fQuery($vQuery);
			if($aEstumat = $cEstumat->fetch_array())
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
				//-------------------------------------------------
				$bDeuda = FALSE;
				$bPago = FALSE;
				$sEstudia['det_deu'] = "";
	/*			$sConedeu['host'] = "10.1.1.133";
				$sConedeu['user'] = "coordinador";
				$sConedeu['passwd'] = "master2005";*/
	/*			$sConedeu['user'] = "unapnet";
				$sConedeu['passwd'] = "academicobase";*/
	//			$xSerdatad = new mysqli($sConedeu['host'], $sConedeu['user'], $sConedeu['passwd']);
				$vQuery = "Select codigo as num_mat, det_deu from unap.deudor where codigo = '$vNum_mat' and est_deu = '0'";
				$cDeuda = fQuery($vQuery);;
				while($aDeuda = $cDeuda->fetch_array())
				{
					$bDeuda = TRUE;				
					$sEstudia['det_deu'] .= $aDeuda['det_deu']. " y ";
				}
				$cDeuda->close();
	//			$xSerdatad->close();
				//---------------------------------------------------
				if($bDeuda)
				{	?>
					
					<table border="0" cellpadding="0" cellspacing="0" id="ventana">
			  <tr>
				<th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
				<th align="center" background="../images/ventana_r1_c2.jpg" >Estudiante:
				<?=$sEstudia['nombre']?></th>
				<th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
			  </tr>
			  <tr>
				<td background="../images/ventana_r2_c1.jpg"></td>
				<td background="../images/ventana_r2_c2.jpg" class="wordcen">EL ESTUDIANTE TIENE LAS SIGUIENTES DEUDAS: <br> 
						<span class="wordi">
						<?=$sEstudia['det_deu']?>
					  </span></td>
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
				$sUsercoo['safetymatri'] = TRUE;
					$bUltmat = FALSE;
					$bPeumat = FALSE;
					$vAno_ini = substr($sEstudia['num_mat'], 0, 2);
					if($vAno_ini < '50') 
						$vAno_ini = "20$vAno_ini";
					else
						$vAno_ini = "1999";
						
					for($vAno_aca = $sUsercoo['ano_aca']; $vAno_aca >= $vAno_ini and !$bPeumat; $vAno_aca--)
					{
						$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}$vAno_aca";
						$vQuery = "Select pln_est, per_aca, cod_esp, mod_mat, tot_crd, niv_est from $tEstumat ";
						$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' ";
						$vQuery .= "and (per_aca = '00' or per_aca = '01' or per_aca = '02') order by per_aca desc";
						
						$cEstumat = fQuery($vQuery);
						while($aEstumat = $cEstumat->fetch_array())
						{
							if(!$bUltmat)
							{
								$sEstudia['pln_est'] = $aEstumat['pln_est'];
								$sEstudia['cod_esp'] = $aEstumat['cod_esp'];
								$sEstudia['ano_aca'] = $vAno_aca;
								$sEstudia['per_aca'] = $aEstumat['per_aca'];
								$sEstudia['mod_mat2'] = $aEstumat['mod_mat'];
								$sEstudia['tot_crd2'] = $aEstumat['tot_crd'];
								$sEstudia['niv_est2'] = $aEstumat['niv_est'];
								$bUltmat = TRUE;
							}
							else
							{
								$sEstudia['pln_estp'] = $aEstumat['pln_est'];
								$sEstudia['ano_acap'] = $vAno_aca;
								$sEstudia['per_acap'] = $aEstumat['per_aca'];
								$bPeumat = TRUE;
								break;
							}
						}
						if($bPeumat)
							break;
					}
				
				
				if($sAcceso[$sUsercoo['cod_car']]['pago'] === 'True' and ($sUsercoo['per_aca'] == '00' or $sUsercoo['per_aca'] == '01' or $sUsercoo['per_aca'] == '02'))	
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
					if($sTarifapago['01']['mon_pag'] > 0)
					{
						$vTot_pag += $sTarifapago['01']['mon_pag'];
					?>
					<tr class="celinpar">
					  <td class="wordcen" scope="col">01</td>
					  <td class="wordizq" scope="col">&nbsp;<?=$sTarifapago['01']['des_pag']?></td>
					  <td class="wordcen" scope="col">1</td>
					  <td class="wordder" scope="col"><?=$sTarifapago['01']['mon_pag']?>&nbsp;</td>
					  <td class="wordderb" scope="col"><?=$sTarifapago['01']['mon_pag']?>&nbsp;</td>
				  </tr>
					<?
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
					$sVeces = "";
					$sVeces[1] = 0;
					$sVeces[2] = 0;
					$sVeces[3] = 0;
					$sVeces[4] = 0;
					$sVeces[5] = 0;
					$sVeces[6] = 0;
					$sVeces[7] = 0;
					$sVeces[8] = 0;
					$sVeces[9] = 0;
					$sVeces[10] = 0;
					if($bUltmat)
					{
						$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sEstudia['ano_aca']}";
						
						$vQuery = "Select no.cod_cur, cu.crd_cur, count(*) as veces ";
						$vQuery .= "from $tNota no left join unapnet.curso cu on ";
						$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
						$vQuery .= "where no.pln_est = '{$sEstudia['pln_est']}' and ";
						$vQuery .= "no.num_mat = '{$sEstudia['num_mat']}' and no.not_cur < 11 and ";
						$vQuery .= "(no.mod_not != '13' and no.mod_not != '08') and ";
						$vQuery .= "no.cod_car = '{$sUsercoo['cod_car']}' and no.cod_cur not in ";
						$vQuery .= "(Select cod_cur from $tNota where pln_est = '{$sEstudia['pln_est']}' and ";
						$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and not_cur > 10) and no.cod_cur in ";
						$vQuery .= "(Select cod_cur from $tCurmat where pln_est = '{$sEstudia['pln_est']}' and ";
//						$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and (per_aca = '{$sEstudia['per_aca']}' or  per_aca = '03')) ";
						$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and (per_aca = '{$sEstudia['per_aca']}')) ";
						$vQuery .= "group by cod_cur order by cod_cur ";					
						
						$cCrddes = fQuery($vQuery);
						while($aCrddes = $cCrddes->fetch_array())
						{
							$sVeces[$aCrddes['veces']] += $aCrddes['crd_cur'];
						}
					}
					foreach($sVeces as $vVec_dsp => $vCrd_cur)
					{
						if($vCrd_cur > 0)
						{
							$vTot_pag += $vCrd_cur*$sTarifapago[$sVecesdes[$vVec_dsp]]['mon_pag'];
					?>
					<tr class="celinpar">
					  <td class="wordcen" scope="col"><?=$sVecesdes[$vVec_dsp]?></td>
					  <td class="wordizq" scope="col">&nbsp;<?=$sTarifapago[$sVecesdes[$vVec_dsp]]['des_pag']?></td>
					  <td class="wordcen" scope="col"><?=$vCrd_cur?></td>
					  <td class="wordder" scope="col"><?=$sTarifapago[$sVecesdes[$vVec_dsp]]['mon_pag']?>&nbsp;</td>
					  <td class="wordderb" scope="col"><?=$vCrd_cur*$sTarifapago[$sVecesdes[$vVec_dsp]]['mon_pag']?>&nbsp;</td>
					</tr>
					<?
						}
					}
					?>
					<tr class="celinpar">
					  <td colspan="4" class="wordderb" scope="col">TOTAL:</td>
					  <td class="wordderb" scope="col"><?=$vTot_pag?>&nbsp;</td>
					</tr> 
				</table> <br>
				EL ESTUDIANTE PAGO EN CAJA: <BR>
				<?
					$vPer_aca = '';
					$vPag_caja = 0;
					if($sUsercoo['per_aca'] == '00' or $sUsercoo['per_aca'] == '01')
						$vPer_aca = '01';
					elseif ($sUsercoo['per_aca'] == '02')
						$vPer_aca = '02';
					
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
					if($vTot_pag == 8)
					{
						$vPag_caja = 8.00;
						$bPago = TRUE;
					}
					
				?>
				<span class="wordi">S/. <?=$vPag_caja?></span><br />
				<?
				if($bPago) {
				?>
				<span class="wordi">VERIFIQUE QUE EL MONTO PAGADO DEL RECIBO SEA EL CORRECTO<br />
				PUEDE CONTINUAR CON LA MATR&Iacute;CULA</span>
				<?
					}
				?>
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
				else	//if($sAcceso[$sUsercoo['cod_car']]['pago'] === 'False')
				{
					$bPago = TRUE;
					$sUsercoo['safetymatri'] = TRUE;
				}
				if(!$bDeuda and $bPago)
				{
			
			?>	
						
			<table border="0" cellpadding="0" cellspacing="0" id="ventana">
			<tr>
			  <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
			  <th align="center" background="../images/ventana_r1_c2.jpg" >Estudiante:
			  <?=$sEstudia['nombre']?></th>
			  <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
			</tr>
			<tr>
			  <td background="../images/ventana_r2_c1.jpg"></td>
			  <td background="../images/ventana_r2_c2.jpg" class="wordcen"><iframe width="400"  name ="frameCambio"  height="50" id="frameCambio" src="ing_planesp.php"  scrolling="no" frameborder="0" >
					</iframe><input name="rPln_est" type="hidden" id="rPln_est" value="">
					<input name="rCod_esp" type="hidden" id="rCod_esp" value=""><br>
					<a href="" title="Continuar" class="linkboton" onClick = "if(verify()){ document.fData.submit();} return false"><img src="../images/bcontinue.png" width="100" height="24"></a>
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
			}	
		}	
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

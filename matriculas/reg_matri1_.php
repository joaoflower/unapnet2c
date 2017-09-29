<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri'])
		{
			$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
			$tCurso = "unapnet.curso";
			
			$vCrdapro = 0;
			$vCrddes = 0;
			$vCredito = 0;
			$vCreditop = 0;
			$vPuntaje = 0;
			$vPuntajep = 0;
			$vPromedio = 0;			
			$vPromediop = 0;
			$bPeumat = FALSE;
			
			//--------------------------------------------------------------------
			$vQuery = "Select $tNota.cod_cur, $tCurso.crd_cur, $tNota.not_cur, $tNota.mod_not ";
			$vQuery .= "from $tNota left join $tCurso on $tNota.pln_est = $tCurso.pln_est and $tNota.cod_cur = $tCurso.cod_cur ";
			$vQuery .= "and $tNota.cod_car = $tCurso.cod_car where $tNota.num_mat = '{$sEstudia['num_mat']}' and ";
			$vQuery .= "$tNota.ano_aca = '{$sEstudia['ano_aca']}' and $tNota.per_aca = '{$sEstudia['per_aca']}' ";
						
			$cNota = fQuery($vQuery);
			while($aNota = $cNota->fetch_array())
			{
				if($aNota['mod_not'] == '01' or $aNota['mod_not'] == '10' or $aNota['mod_not'] == '11'
					or $aNota['mod_not'] == '07' or $aNota['mod_not'] == '14' or $aNota['mod_not'] == '15'
					or $aNota['mod_not'] == '16')
				{
					if($aNota['not_cur'] >= 11)
						$vCrdapro += $aNota['crd_cur'];
/*					elseif($aNota['not_cur'] < 11)
						$vCrddes += $aNota['crd_cur'];*/
					
					$vCredito += $aNota['crd_cur'];
					$vPuntaje += $aNota['crd_cur'] * $aNota['not_cur'];
				}
			}
			
			$sEstudia['tot_apro'] = $vCrdapro;
			if ($vCredito)
				$vPromedio = $vPuntaje / $vCredito;
			
			//--------------------------------------------------------------------
			if(!empty($sEstudia['ano_acap']))
			{
				$vQuery = "Select $tNota.cod_cur, $tCurso.crd_cur, $tNota.not_cur, $tNota.mod_not ";
				$vQuery .= "from $tNota left join $tCurso on $tNota.pln_est = $tCurso.pln_est and $tNota.cod_cur = $tCurso.cod_cur ";
				$vQuery .= "and $tNota.cod_car = $tCurso.cod_car where $tNota.num_mat = '{$sEstudia['num_mat']}' and ";
				$vQuery .= "$tNota.ano_aca = '{$sEstudia['ano_acap']}' and $tNota.per_aca = '{$sEstudia['per_acap']}' ";
							
				$cNota = fQuery($vQuery);
				while($aNota = $cNota->fetch_array())
				{
					if($aNota['mod_not'] == '01' or $aNota['mod_not'] == '10' or $aNota['mod_not'] == '11'
						or $aNota['mod_not'] == '07' or $aNota['mod_not'] == '14' or $aNota['mod_not'] == '15'
						or $aNota['mod_not'] == '16' or $aNota['mod_not'] == '18' )
					{
						$vCreditop += $aNota['crd_cur'];
						$vPuntajep += $aNota['crd_cur'] * $aNota['not_cur'];
					}
				}
				if ($vCreditop)
				{
					//$vPromediop = ($vPuntaje + $vPuntajep) / ($vCredito + $vCreditop);
					$vPromediop = ($vPuntajep) / ($vCreditop);
					$bPeumat = TRUE;
				}
			}

			//--------------------------------------------------------------------

//			$vQuery = "Select no.cod_cur, cu.crd_cur, no.not_cur, no.mod_not ";
			$vQuery = "Select sum(cu.crd_cur) as crd_des ";
			$vQuery .= "from $tNota no left join unapnet.curso cu on no.pln_est = cu.pln_est and ";
			$vQuery .= "no.cod_cur = cu.cod_cur and no.cod_car = cu.cod_car ";
			$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.ano_aca = '{$sEstudia['ano_aca']}' and ";
			$vQuery .= "no.per_aca = '{$sEstudia['per_aca']}' and no.not_cur < 11 and no.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "no.mod_not != '13' and no.mod_not != '08' and ";
			$vQuery .= "no.cod_cur not in (Select cod_cur from $tNota where pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and  not_cur > 10)";
			$cNota = fQuery($vQuery);
			if($aNota = $cNota->fetch_array())
			{
				$vCrddes = $aNota['crd_des'];
			}
			
			//--------------------------------------------------------------------
			$vVeces = 0;
			
			if($sUsercoo['cod_car'] != '27')
			{
				$vQuery = "Select count(*) as veces ";
				$vQuery .= "from $tNota ";
				$vQuery .= "where $tNota.pln_est = '{$sEstudia['pln_est']}' and ";
				$vQuery .= "$tNota.num_mat = '{$sEstudia['num_mat']}' and $tNota.not_cur < 11 and ";
				$vQuery .= "($tNota.mod_not != '13' and $tNota.mod_not != '08')  and ";
				$vQuery .= "$tNota.cod_cur not in (Select cod_cur from $tNota where pln_est = '{$sEstudia['pln_est']}' and ";
				$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and not_cur > 10) group by cod_cur order by veces desc";
			}
			else
			{
				if($sUsercoo['per_aca'] == '01') 	$vMod = 1;
				if($sUsercoo['per_aca'] == '02') 	$vMod = 0;
				$vQuery = "Select no.cod_cur, cu.sem_anu, count(*) as veces from $tNota no left join unapnet.curso cu on ";
				$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
				$vQuery .= "where no.pln_est = '{$sEstudia['pln_est']}' and no.num_mat = '{$sEstudia['num_mat']}' and ";
				$vQuery .= "no.not_cur < 11 and (no.mod_not != '13' and no.mod_not != '08') and mod(cu.sem_anu,'2') = $vMod and ";
				$vQuery .= "no.cod_cur not in (Select cod_cur from $tNota where pln_est = '{$sEstudia['pln_est']}' and ";
				$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and not_cur > 10) group by cod_cur order by veces desc";
			}
			
			$cCurdes = fQuery($vQuery);	
			if($aCurdes = $cCurdes->fetch_array())
				$vVeces = $aCurdes['veces'];
				
			//--------------------------------------------------------------------			
			if($bPeumat and $vPromedio <= $sCredicar[$sEstudia['pln_est']]['prd_2sc'] and $vPromediop <= $sCredicar[$sEstudia['pln_est']]['prd_2sc'] and $vVeces >= 2 )
			{
				$sEstudia['mod_mat'] = '07';
				$sEstudia['max_crd'] = $sCredicar[$sEstudia['pln_est']]['crd_obs'];				
			}
			else
			{
				fModestudia($vVeces, $vPromedio, $vCrdapro, $vCrddes);	
			}		
			
			$sUsercoo['safetymatri'] = FALSE;
			$sUsercoo['safetymatri2'] = TRUE;
			
			//--------------------------------------------------------------------
			$vQuery = "select sum(cu.crd_cur) as all_crd from $tNota no left join unapnet.curso cu on ";
			$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
			$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "no.cod_car = '{$sUsercoo['cod_car']}' and no.not_cur > 10";
			$cNotall = fQuery($vQuery);	
			if($aNotall = $cNotall->fetch_array())
				$sEstudia['all_crd'] = $aNotall['all_crd'];			
			$sEstudia['sem_anu'] = fSemestudia($sEstudia['pln_est'], $sEstudia['all_crd'] + $sEstudia['max_crd']);
		}
		else
			header("Location:reg_getestu.php");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Un@p.Net2</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	

//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="reg_matri2.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Datos principales del Estudiante </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg"><table width="400" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <td width="130" class="wordder">Estudiante: </td>
                  <td class="wordizqb">&nbsp;<?=$sEstudia['num_mat']?> - <?=$sEstudia['paterno']?> <?=$sEstudia['materno']?>, <?=$sEstudia['nombres']?></td>
                </tr>
                <tr>
                  <td class="wordder">Plan de estudios:</td>
                  <td class="wordizqb">&nbsp;<?=$sEstudia['pln_est']?> - <?=$sTiposist[$sEstudia['tip_sist']]?></td>
                </tr>
                <tr>
                  <td class="wordder">Especialidad:</td>
                  <td class="wordizqb">&nbsp;<?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
                </tr>
                <tr>
                  <td class="wordder">Total de Cr&eacute;d. aprobados: </td>
                  <td class="wordizqb">&nbsp;<?=$sEstudia['all_crd']?> créditos aprobados hasta la fecha </td>
                </tr>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Condici&oacute;n de Matr&iacute;cula Anterior [<?=$sEstudia['ano_aca']?> - <?=$sPeriodo[$sEstudia['per_aca']]['per_des']?>]</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="220" border="0" cellpadding="1" cellspacing="0" class="tabled">
                <tr>
                  <td width="110" class="wordder">Modalidad : </td>
                  <td class="wordizqb"><?=$sModmat[$sEstudia['mod_mat2']]['mod_des']?></td>
                </tr>
                <tr>
                  <td class="wordder">Cr&eacute;dito matriculados : </td>
                  <td class="wordizqb"> <?=$sEstudia['tot_crd2']?> cr&eacute;ditos </td>
                </tr>
                <tr>
                  <td class="wordder">Cr&eacute;ditos aprobados : </td>
                  <td class="wordizqb"><?=$vCrdapro?> créditos</td>
                </tr>
                <tr>
                  <td class="wordder">Cr&eacute;ditos desaprob. : </td>
                  <td class="wordizqb"><?=$vCrddes?> cr&eacute;ditos</td>
                </tr>
                <tr>
                  <td class="wordder">Promedio Pon. Sem. : </td>
                  <td class="wordizqb"><?=round($vPromedio, 2)?></td>
                </tr>
                <tr>
                  <td class="wordder">PPS [<?=$sEstudia['ano_acap']?>-<?=$sPeriodo[$sEstudia['per_acap']]['abr_per']?>] .: </td>
                  <td class="wordizqb"><?=round($vPromediop, 2)?></td>
                </tr>
                <tr>
                  <td class="wordder">Promedio Acumulativo: </td>
                  <td class="wordizqb">&nbsp;</td>
                </tr>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Condici&oacute;n de Matr&iacute;cula Actual [<?=$sUsercoo['ano_aca']?> - <?=$sPeriodo[$sUsercoo['per_aca']]['per_des']?>]</th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="220" border="0" cellpadding="1" cellspacing="0" class="tabled">
              <tr>
                <td class="wordder">Posible Semestre : </td>
                <td class="wordizqb"><?=$sSemestre[$sEstudia['sem_anu']]?></td>
              </tr>
              <tr>
                <td width="110" class="wordder">Modalidad : </td>
                <td class="wordizqb"><select name="rMod_mat" id="rMod_mat">
				  <?
				  	if($sUsercoo['per_aca'] == '03')
					{
						$sEstudia['mod_mat'] = '09';
				  ?>
				  <option value="09">VACACIONAL</option>
				  <?
				  	}
					else
					{
				  ?>
				  <option value="<?=$sEstudia['mod_mat']?>" selected><?=$sModmat[$sEstudia['mod_mat']]['mod_des']?></option>
                  <option value="16">DIRIGIDO</option>
				  <?
				  	}
				  ?>
                </select>                  </td>
              </tr>
              <tr>
                <td class="wordder">Grupo : </td>
                <td class="wordizqb"><select name="rSec_gru" id="rSec_gru">
                      <?=fviewgrupo('01')?>
					  </select></td>
              </tr>
              <tr>
                <td class="wordder">M&aacute;ximo de cr&eacute;ditos  : </td>
                <td class="wordizqb"><?=$sEstudia['max_crd']?> cr&eacute;ditos </td>
              </tr>
              
          </table></td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
      </table>
	  </form>
	  <a href="" title="Continuar" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bcontinue.png" width="100" height="24"></a> 
	  <a href="reg_getestu.php" title="Cancelar" class="linkboton" ><img src="../images/bcancel.png" width="100" height="24"></a>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
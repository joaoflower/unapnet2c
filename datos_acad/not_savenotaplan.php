<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{		
		$vAno_aca = $_GET['rAno_aca'];
		$vPer_aca = $_GET['rPer_aca'];
		$vMod_not = $_GET['rMod_not'];
		$vNot_cur = $_GET['rNot_cur'];
		$vCod_act = $_GET['rCod_act'];
		$vObs_not = $_GET['rObs_not'];
		$vCur_con = $_GET['rCur_con'];
		$vFch_reg = fFechamy($_GET['rFch_reg']);

		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		
		if($sUsercoo['upin'] == 'u')
		{		
			//-------------LOG----------------------
			$tLognota = "unapnet.lognota{$sUsercoo['ano_aca']}";
			$vQuery = "Insert into $tLognota (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_cur, ";
			$vQuery .= "mod_not, not_cur, cod_usu, cod_log, fch_log, dir_ip) values " ;
			$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sEstudia['ano_aca']}', ";
			$vQuery .= "'{$sEstudia['per_aca']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', ";
			$vQuery .= "'{$sEstudia['mod_not']}', '{$sEstudia['not_cur']}',  ";
			$vQuery .= "'{$sUsercoo['cod_usu']}', '02', now(), '{$sUsercoo['ip']}' ) ";
			$bResult = fInupde($vQuery);
			//--------------------------------------
			
			$vQuery = "Update $tNota set ano_aca = '$vAno_aca', per_aca = '$vPer_aca', mod_not = '$vMod_not', ";
			$vQuery .= "not_cur = '$vNot_cur', cod_act = '$vCod_act', obs_not = '$vObs_not', cur_con = '$vCur_con', ";
			$vQuery .= "fch_reg = '$vFch_reg' where num_mat = '{$sEstudia['num_mat']}' and ";
			$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' and mod_not = '{$sEstudia['mod_not']}' and ";
			$vQuery .= "ano_aca = '{$sEstudia['ano_aca']}' and per_aca = '{$sEstudia['per_aca']}' ";			
		}
		elseif($sUsercoo['upin'] == 'i') 
		{
			//-------------LOG----------------------
			$tLognota = "unapnet.lognota{$sUsercoo['ano_aca']}";
			$vQuery = "Insert into $tLognota (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_cur, ";
			$vQuery .= "mod_not, not_cur, cod_usu, cod_log, fch_log, dir_ip) values " ;
			$vQuery .= "('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '$vAno_aca', ";
			$vQuery .= "'$vPer_aca', '{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', ";
			$vQuery .= "'$vMod_not', '$vNot_cur',  ";
			$vQuery .= "'{$sUsercoo['cod_usu']}', '01', now(), '{$sUsercoo['ip']}' ) ";
			$bResult = fInupde($vQuery);
			//--------------------------------------
			
			$vQuery = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, per_aca, ";
			$vQuery .= "not_cur, cod_act, fch_not, obs_not, cur_con, fch_reg) ";
			$vQuery .= "values ('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', ";
			$vQuery .= "'{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', '$vMod_not', ";
			$vQuery .= "'$vAno_aca', '$vPer_aca', '$vNot_cur', '$vCod_act', now(), '$vObs_not', '$vCur_con', '$vFch_reg')";
		}

		$cResult = fInupde($vQuery);

		if($cResult)
		{
			$sEstudia['ano_aca'] = $vAno_aca;
			$sEstudia['per_aca'] = $vPer_aca;
			$sEstudia['mod_not'] = $vMod_not;
			$sEstudia['not_cur'] = $vNot_cur;
			$sEstudia['cod_act'] = $vCod_act;
			$sEstudia['obs_not'] = $vObs_not;
			$sEstudia['cur_con'] = $vCur_con;
			$sEstudia['fch_reg'] = $vFch_reg;
			
			$vQuery = "Update $tNota set fch_reg = '$vFch_reg' where cod_act = '$vCod_act' and ano_aca = '$vAno_aca'";
			$cResult = fInupde($vQuery);
		}
		else
		{
			header("Location:../index.php");
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" > Nota Cambiada </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td width="130" class="wordder">C&oacute;digo:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$sEstudia['cod_cur']?></td>
              <td width="120" class="wordder">Plan:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$sEstudia['pln_est']?></td>
			</tr>
			<tr>
			  <td class="wordder">Nombre de Curso:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['nom_cur']?></td>
	        </tr>
			<tr>
			  <td class="wordder">Nivel:</td>
			  <td class="tdcampo">&nbsp;<?=$sNivel[$sEstudia['niv_est']]?></td>
			  <td class="wordder">Semestre:</td>
			  <td class="tdcampo">&nbsp;<?=$sSemestre[$sEstudia['sem_anu']]?></td>
			</tr>
			<tr>
			  <td class="wordder">Especialidad:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
	        </tr>
			<tr>
              <td class="wordder">A&ntilde;o: </td>
			  <td class="tdcampo">&nbsp;<?=$sEstudia['ano_aca']?></td>
			  <td class="wordder">Periodo:</td>
			  <td class="tdcampo">&nbsp;<?=$sPeriodo[$sEstudia['per_aca']]['per_des']?></td>
		    </tr>
			<tr>
			  <td class="wordder">Modalidad:</td>
			  <td class="tdcampo">&nbsp;<?=$sModnot[$sEstudia['mod_not']]?></td>
		      <td class="wordder">Nota: </td>
		      <td class="tdcampo">&nbsp;<span class ="<? if($sEstudia['not_cur'] < 11) echo "notades"; else echo "notapro" ?>"><?=$sEstudia['not_cur']?></span></td>
			</tr>
			<tr>
			  <td class="wordder">Acta:</td>
			  <td class="tdcampo">&nbsp;<?=$sEstudia['cod_act']?></td>
			  <td class="wordder">Fecha : </td>
			  <td class="tdcampo">&nbsp;<?=(empty($sEstudia['fch_reg'])?'':fFechad($sEstudia['fch_reg']))?></td>
		    </tr>
			<tr>
			  <td class="wordder">Resoluci&oacute;n u Observ.: </td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['obs_not']?></td>
		    </tr>
			<tr>
			  <td class="wordder">Convalidado por: </td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['cur_con']?></td>
		    </tr>
			<tr>
			  <td colspan="4" class="wordcen"></td>
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
    <a href="" onClick="viewnotaestplan('<?=$sEstudia['num_mat']?>'); return false;" title="Ver Historial de Notas" class="linkboton" ><img src="../images/bvhnota.png" width="100" height="24"></a>
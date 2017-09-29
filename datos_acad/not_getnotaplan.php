<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<script language="JavaScript">
	document.fData.rNot_cur.focus();
</script>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
//		if(!empty($_GET['rCod_cur']) && )
		
		$sEstudia['pln_est'] = $_GET['rPln_est'];
		$sEstudia['cod_cur'] = $_GET['rCod_cur'];
		$sEstudia['mod_not'] = $_GET['rMod_not'];
		$sEstudia['ano_aca'] = $_GET['rAno_aca'];
		$sEstudia['per_aca'] = $_GET['rPer_aca'];
		$sUsercoo['upin'] = $_GET['rUpin'];

		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		if($sUsercoo['upin'] == 'u')
		{
			$vQuery = "Select cu.nom_cur, cu.niv_est, cu.sem_anu, cu.cod_esp, no.not_cur, no.cod_act, ";
			$vQuery .= "no.obs_not, no.cur_con, no.fch_reg ";
			$vQuery .= "from unapnet.curso cu left join $tNota no on cu.cod_car = no.cod_car and ";
			$vQuery .= "cu.pln_est = no.pln_est and cu.cod_cur = no.cod_cur ";
			$vQuery .= "where cu.cod_car = '{$sUsercoo['cod_car']}' and cu.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "cu.cod_cur = '{$sEstudia['cod_cur']}' and no.mod_not = '{$sEstudia['mod_not']}' and ";
			$vQuery .= "no.ano_aca = '{$sEstudia['ano_aca']}' and no.per_aca = '{$sEstudia['per_aca']}' and ";
			$vQuery .= "no.num_mat = '{$sEstudia['num_mat']}' ";
	
			$cNota = fQuery($vQuery);
			if($aNota = $cNota->fetch_array())
			{			
				$sEstudia['nom_cur'] = $aNota['nom_cur'];
				$sEstudia['niv_est'] = $aNota['niv_est'];
				$sEstudia['sem_anu'] = $aNota['sem_anu'];
				$sEstudia['cod_esp'] = $aNota['cod_esp'];
				$sEstudia['not_cur'] = $aNota['not_cur'];
				$sEstudia['cod_act'] = $aNota['cod_act'];
				$sEstudia['obs_not'] = $aNota['obs_not'];
				$sEstudia['cur_con'] = $aNota['cur_con'];
				$sEstudia['fch_reg'] = $aNota['fch_reg'];
			}	
			else
			{
				header("Location:../index.php");
			}
		}
		elseif($sUsercoo['upin'] == 'i')
		{
			$vQuery = "Select curso.nom_cur, curso.niv_est, curso.sem_anu, curso.cod_esp ";
			$vQuery .= "from unapnet.curso ";
			$vQuery .= "where curso.cod_car = '{$sUsercoo['cod_car']}' and curso.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "curso.cod_cur = '{$sEstudia['cod_cur']}' ";
	
			$cNota = fQuery($vQuery);
			if($aNota = $cNota->fetch_array())
			{			
				$sEstudia['nom_cur'] = $aNota['nom_cur'];
				$sEstudia['niv_est'] = $aNota['niv_est'];
				$sEstudia['sem_anu'] = $aNota['sem_anu'];
				$sEstudia['cod_esp'] = $aNota['cod_esp'];
			}	
			else
			{
				header("Location:../index.php");
			}
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
          <th align="center" background="../images/ventana_r1_c2.jpg" >Modificar de Nota</th>
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
			  <td class="wordizq"><input name="rAno_aca" type="text" class="texto" id="rAno_aca" value="<?=$sEstudia['ano_aca']?>" size="4" maxlength="4"></td>
			  <td class="wordder">Periodo:</td>
			  <td class="wordizq"><select name="rPer_aca" id="rPer_aca">
				<?=fviewperiodo($sEstudia['per_aca'])?>
            </select></td>
		    </tr>
			<tr>
			  <td class="wordder">Modalidad:</td>
			  <td class="wordizq"><select name="rMod_not" id="rMod_not">
				<?=fviewmodnot($sEstudia['mod_not'])?>
            </select></td>
		      <td class="wordder">Nota: </td>
		      <td class="wordizq"><input name="rNot_cur" type="text" class="<?=($sEstudia['not_cur']>10?'textnotaap':'textnotade')?>" id="rNot_cur" value="<?=$sEstudia['not_cur']?>" size="2" maxlength="2" onKeyUp="checknota(this)"></td>
			</tr>
			<tr>
			  <td class="wordder">Acta:</td>
			  <td class="wordizq"><input name="rCod_act" type="text" class="texto" id="rCod_act" value="<?=$sEstudia['cod_act']?>" size="6" maxlength="6"></td>
			  <td class="wordder">Fecha: </td>
			  <td class="wordizq"><input name="rFch_reg" type="text" class="texto" id="rFch_reg" value="<?=(empty($sEstudia['fch_reg'])?'':fFechad($sEstudia['fch_reg']))?>" size="8" maxlength="10"> 
			  (99/99/999) </td>
		    </tr>
			<tr>
			  <td class="wordder">Resoluci&oacute;n u Observ.: </td>
			  <td colspan="3" class="wordizq"><input name="rObs_not" type="text" class="texto" id="rObs_not" value="<?=$sEstudia['obs_not']?>" size="50" maxlength="50" onBlur="fupper(this);">
			  (RD 999-9999)</td>
		    </tr>
			<tr>
			  <td class="wordder">Convalidado por: </td>
			  <td colspan="3" class="wordizq"><input name="rCur_con" type="text" class="texto" id="rCur_con" value="<?=$sEstudia['cur_con']?>" size="50" maxlength="50" onBlur="fupper(this);"></td>
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
	  <a href="" title="Guardar" class="linkboton" onClick = "savenotaestplan(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="" onClick="viewnotaestplan('<?=$sEstudia['num_mat']?>'); return false;" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>
	<a href="" onclick="not_viewactaesc('<?=$sEstudia['cod_act']?>', '<?=$sEstudia['ano_aca']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver Acta escaneada" width="16" height="16" /></a>

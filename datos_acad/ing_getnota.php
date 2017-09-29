<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>

<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Datos del Curso </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td width="120" class="wordder">Plan-C&oacute;digo:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$sEstudia['cod_cur']?>-<?=$sEstudia['pln_est']?></td>
              <td width="120" class="wordder">Acta y Registro:</td>
              <td width="110" class="tdcampo">&nbsp;<?=(!empty($sEstudia['cod_act']))?($sEstudia['cod_act']." - ".$sEstudia['cod_reg']):("NO EMITIDO")?></td>
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
              <td class="wordder">Grupo: </td>
			  <td class="tdcampo">&nbsp;<?=$sGrupo[$sEstudia['sec_gru']]?></td>
			  <td class="wordder">Modalidad:</td>
			  <td class="tdcampo">&nbsp;<?=$sModnot[$sEstudia['mod_act']]?></td>
		    </tr>
			<tr>
			  <td class="wordder">Docente:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['nom_doc']?></td>
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
	  
	  <table border="1" cellpadding="0" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
	  <tr>
		<th width="30" scope="col">Nro</th>
		<th width="55" scope="col">Num.mat</th>
		<th width="270" scope="col">Apellidos y Nombres </th>
		<th width="90" scope="col">Mod. Mat. </th>
		<th width="25" scope="col">Nota</th>
	  </tr>
		<?	$vCont = 1;
			$sNota = "";
			$sNotas = "";
			
			$vQuery = "Select no.num_mat, no.not_cur ";
			$vQuery .= "from $tNota no left join unapnet.modnot mn on no.mod_not = mn.mod_not ";
			$vQuery .= "where no.pln_est = '{$sEstudia['pln_est']}' and no.cod_cur = '{$sEstudia['cod_cur']}' and ";
			$vQuery .= "mn.mod_act = '{$sEstudia['mod_act']}' and no.ano_aca = '{$sUsercoo['ano_aca']}' and ";
			$vQuery .= "no.per_aca = '{$sUsercoo['per_aca']}' ";
			$cNota = fQuery($vQuery);
			while($aNota = $cNota->fetch_array())
			{
				$sNota[$aNota['num_mat']] = $aNota['not_cur'];
			}						
			
			$vQuery = "Select est.num_mat, est.paterno, est.materno, est.nombres, cm.mod_mat ";
			$vQuery .= "from $tCurmat cm left join unapnet.estudiante est on cm.num_mat = est.num_mat and ";
			$vQuery .= "cm.cod_car = est.cod_car ";
			$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
			$vQuery .= "where cm.pln_est = '{$sEstudia['pln_est']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "cm.cod_cur = '{$sEstudia['cod_cur']}' and cm.sec_gru = '{$sEstudia['sec_gru']}' and ";
			$vQuery .= "mm.mod_act = '{$sEstudia['mod_act']}' and ";
			$vQuery .= "(est.paterno = ' ' or est.paterno like 'A%' or est.paterno like 'B%' or est.paterno like 'C%') and ";
			$vQuery .= "not(est.paterno like 'CH%') ";
			$vQuery .= "order by paterno, materno, nombres";
			$cCurmat = fQuery($vQuery);
			while($aCurmat = $cCurmat->fetch_array())
			{
				
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><?=$vCont?></td>
		<td class="wordcen"><?=$aCurmat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
		<td class="wordizq">&nbsp;<?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
		<td class="wordizq"><input name="rNot_cur<?=$aCurmat['num_mat']?>" type="text" class="textnota<?	if($sNota[$aCurmat['num_mat']] < 11) echo "de"; else echo "ap" ?>" id="rNot_cur<?=$aCurmat['num_mat']?>" value="<?=$sNota[$aCurmat['num_mat']]?>" size="2" maxlength="2" onkeyup="checknota(this, '<?=$sIngnota[$aCurmat['num_mat']]?>')" onblur="regnotaing('<?=$aCurmat['num_mat']?>', this)" /></td>
	  </tr>
	  <?	$vCont++;	}  
	  
	  
			$vQuery = "Select est.num_mat, est.paterno, est.materno, est.nombres, cm.mod_mat ";
			$vQuery .= "from $tCurmat cm left join unapnet.estudiante est on cm.num_mat = est.num_mat and ";
			$vQuery .= "cm.cod_car = est.cod_car ";
			$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
			$vQuery .= "where cm.pln_est = '{$sEstudia['pln_est']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "cm.cod_cur = '{$sEstudia['cod_cur']}' and cm.sec_gru = '{$sEstudia['sec_gru']}' and ";
			$vQuery .= "mm.mod_act = '{$sEstudia['mod_act']}' and est.paterno like 'CH%' ";
			$vQuery .= "order by paterno, materno, nombres";
			$cCurmat = fQuery($vQuery);
			while($aCurmat = $cCurmat->fetch_array())
			{
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><?=$vCont?></td>
		<td class="wordcen"><?=$aCurmat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
		<td class="wordizq">&nbsp;<?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
		<td class="wordizq"><input name="rNot_cur<?=$aCurmat['num_mat']?>" type="text" class="textnota<?	if($sNota[$aCurmat['num_mat']] < 11) echo "de"; else echo "ap" ?>" id="rNot_cur<?=$aCurmat['num_mat']?>" value="<?=$sNota[$aCurmat['num_mat']]?>" size="2" maxlength="2" onkeyup="checknota(this, '<?=$sIngnota[$aCurmat['num_mat']]?>')" onblur="regnotaing('<?=$aCurmat['num_mat']?>', this)" /></td>
	  </tr>
	  <?	$vCont++;	}		
	  
	    	$vQuery = "Select est.num_mat, est.paterno, est.materno, est.nombres, cm.mod_mat ";
			$vQuery .= "from $tCurmat cm left join unapnet.estudiante est on cm.num_mat = est.num_mat and ";
			$vQuery .= "cm.cod_car = est.cod_car ";
			$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
			$vQuery .= "where cm.pln_est = '{$sEstudia['pln_est']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "cm.cod_cur = '{$sEstudia['cod_cur']}' and cm.sec_gru = '{$sEstudia['sec_gru']}' and ";
			$vQuery .= "mm.mod_act = '{$sEstudia['mod_act']}' and not(est.paterno like 'LL%') and  ";
			$vQuery .= "(est.paterno like 'D%' or est.paterno like 'E%' or est.paterno like 'F%' or ";
			$vQuery .= "est.paterno like 'G%' or est.paterno like 'H%' or est.paterno like 'I%' or ";
			$vQuery .= "est.paterno like 'J%' or est.paterno like 'K%' or est.paterno like 'L%')  ";
			$vQuery .= "order by paterno, materno, nombres";
			$cCurmat = fQuery($vQuery);
			while($aCurmat = $cCurmat->fetch_array())
			{
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><?=$vCont?></td>
		<td class="wordcen"><?=$aCurmat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
		<td class="wordizq">&nbsp;<?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
		<td class="wordizq"><input name="rNot_cur<?=$aCurmat['num_mat']?>" type="text" class="textnota<?	if($sNota[$aCurmat['num_mat']] < 11) echo "de"; else echo "ap" ?>" id="rNot_cur<?=$aCurmat['num_mat']?>" value="<?=$sNota[$aCurmat['num_mat']]?>" size="2" maxlength="2" onkeyup="checknota(this, '<?=$sIngnota[$aCurmat['num_mat']]?>')" onblur="regnotaing('<?=$aCurmat['num_mat']?>', this)" /></td>
	  </tr>
	  <?	$vCont++;	}	
	  
			$vQuery = "Select est.num_mat, est.paterno, est.materno, est.nombres, cm.mod_mat ";
			$vQuery .= "from $tCurmat cm left join unapnet.estudiante est on cm.num_mat = est.num_mat and ";
			$vQuery .= "cm.cod_car = est.cod_car ";
			$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
			$vQuery .= "where cm.pln_est = '{$sEstudia['pln_est']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "cm.cod_cur = '{$sEstudia['cod_cur']}' and cm.sec_gru = '{$sEstudia['sec_gru']}' and ";
			$vQuery .= "mm.mod_act = '{$sEstudia['mod_act']}' and est.paterno like 'LL%' ";
			$vQuery .= "order by paterno, materno, nombres";
			$cCurmat = fQuery($vQuery);
			while($aCurmat = $cCurmat->fetch_array())
			{
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><?=$vCont?></td>
		<td class="wordcen"><?=$aCurmat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
		<td class="wordizq">&nbsp;<?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
		<td class="wordizq"><input name="rNot_cur<?=$aCurmat['num_mat']?>" type="text" class="textnota<?	if($sNota[$aCurmat['num_mat']] < 11) echo "de"; else echo "ap" ?>" id="rNot_cur<?=$aCurmat['num_mat']?>" value="<?=$sNota[$aCurmat['num_mat']]?>" size="2" maxlength="2" onkeyup="checknota(this, '<?=$sIngnota[$aCurmat['num_mat']]?>')" onblur="regnotaing('<?=$aCurmat['num_mat']?>', this)" /></td>
	  </tr>
	  <?	$vCont++;	}	
	  
	  
			$vQuery = "Select est.num_mat, est.paterno, est.materno, est.nombres, cm.mod_mat ";
			$vQuery .= "from $tCurmat cm left join unapnet.estudiante est on cm.num_mat = est.num_mat and ";
			$vQuery .= "cm.cod_car = est.cod_car ";
			$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
			$vQuery .= "where cm.pln_est = '{$sEstudia['pln_est']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "cm.cod_cur = '{$sEstudia['cod_cur']}' and cm.sec_gru = '{$sEstudia['sec_gru']}' and ";
			$vQuery .= "mm.mod_act = '{$sEstudia['mod_act']}' and ";
			$vQuery .= "(est.paterno like 'M%' or est.paterno like 'N%' or est.paterno like 'Ñ%' or ";
			$vQuery .= "est.paterno like 'O%' or est.paterno like 'P%' or est.paterno like 'Q%' or ";
			$vQuery .= "est.paterno like 'R%' or est.paterno like 'S%' or est.paterno like 'T%' or ";
			$vQuery .= "est.paterno like 'U%' or est.paterno like 'V%' or est.paterno like 'W%' or ";
			$vQuery .= "est.paterno like 'X%' or est.paterno like 'Y%' or est.paterno like 'Z%') ";
			$vQuery .= "order by paterno, materno, nombres";
			$cCurmat = fQuery($vQuery);
			while($aCurmat = $cCurmat->fetch_array())
			{
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><?=$vCont?></td>
		<td class="wordcen"><?=$aCurmat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
		<td class="wordizq">&nbsp;<?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
		<td class="wordizq"><input name="rNot_cur<?=$aCurmat['num_mat']?>" type="text" class="textnota<?	if($sNota[$aCurmat['num_mat']] < 11) echo "de"; else echo "ap" ?>" id="rNot_cur<?=$aCurmat['num_mat']?>" value="<?=$sNota[$aCurmat['num_mat']]?>" size="2" maxlength="2" onkeyup="checknota(this, '<?=$sIngnota[$aCurmat['num_mat']]?>')" onblur="regnotaing('<?=$aCurmat['num_mat']?>', this)" /></td>
	  </tr>
	  <?	$vCont++;	}	?>	
	</table>
	<a href="" title="Guardar" class="linkboton" onClick = "savenotaing(); return false" name="bGuardar"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="" onClick="viewingcurso('<?=$sEstudia['pln_est']?>', '<?=$sEstudia['cod_cur']?>', '<?=$sEstudia['sec_gru']?>', '<?=$sEstudia['mod_act']?>'); return false;" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>
	  

<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$aModnot = "";
		$aNotcur = "";
		
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		
		$vQuery = "Select est.num_mat, mm.mod_not ";
		$vQuery .= "from $tCurmat cm left join unapnet.estudiante est on cm.num_mat = est.num_mat and ";
		$vQuery .= "cm.cod_car = est.cod_car ";
		$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
		$vQuery .= "where cm.pln_est = '{$sEstudia['pln_est']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "cm.cod_cur = '{$sEstudia['cod_cur']}' and cm.sec_gru = '{$sEstudia['sec_gru']}' and ";
		$vQuery .= "mm.mod_act = '{$sEstudia['mod_act']}' ";
		$cModnot = fQuery($vQuery);
		while($aModnot2 = $cModnot->fetch_array())
		{
			$aModnot[$aModnot2['num_mat']] = $aModnot2['mod_not'];
		}
		
		//------------------------------
		$vQuery = "Select est.num_mat, mm.mod_not, no.not_cur ";
		$vQuery .= "from $tCurmat cm left join unapnet.estudiante est on cm.num_mat = est.num_mat and ";
		$vQuery .= "cm.cod_car = est.cod_car ";
		$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
		$vQuery .= "left join $tNota no on cm.num_mat = no.num_mat and cm.cod_car = no.cod_car and ";
		$vQuery .= "cm.per_aca = no.per_aca and cm.cod_cur = no.cod_cur ";
		$vQuery .= "where cm.pln_est = '{$sEstudia['pln_est']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "cm.cod_cur = '{$sEstudia['cod_cur']}' and cm.sec_gru = '{$sEstudia['sec_gru']}' and ";
		$vQuery .= "mm.mod_act = '{$sEstudia['mod_act']}' and no.cod_act = '{$sEstudia['cod_act']}' ";
		$cModnot = fQuery($vQuery);
		while($aModnot2 = $cModnot->fetch_array())
		{
			$aNotcur[$aModnot2['num_mat']] = $aModnot2['not_cur'];
		}
		//------------------------------
		
		if($sUsercoo['upin'] == 'u')
		{		
			if(!empty($sNotas))
			foreach($sNotas as $vNum_mat => $vNot_cur)
			{
				if($vNot_cur != 'sn')
				{	
					$vQuery = "Update $tNota set not_cur = '$vNot_cur' where num_mat = '$vNum_mat' and ";
					$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' and ";
					$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' and mod_not = '{$aModnot[$vNum_mat]}' and ";
					$vQuery .= "ano_aca = '{$sUsercoo['ano_aca']}' and per_aca = '{$sUsercoo['per_aca']}' ";
					$cResult = fInupde($vQuery);
					if($cResult)
					{	
						$vQuery = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, per_aca, ";
						$vQuery .= "not_cur, cod_act, fch_not) values ('$vNum_mat', '{$sUsercoo['cod_car']}', ";
						$vQuery .= "'{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', '{$aModnot[$vNum_mat]}', ";
						$vQuery .= "'{$sUsercoo['ano_aca']}', '{$sUsercoo['per_aca']}', '$vNot_cur', ";
						$vQuery .= "'{$sEstudia['cod_act']}', now())";
						$cResult = fInupde($vQuery);
					}
					else
					{
						//-------------LOG----------------------
						$tLognota = "unapnet.lognota{$sUsercoo['ano_aca']}";
						$vQuery = "Insert into $tLognota (num_mat, cod_car, ano_aca, per_aca, pln_est, cod_cur, ";
						$vQuery .= "mod_not, not_cur, cod_usu, cod_log, fch_log, dir_ip) values " ;
						$vQuery .= "('$vNum_mat', '{$sUsercoo['cod_car']}', '{$sUsercoo['ano_aca']}', ";
						$vQuery .= "'{$sUsercoo['per_aca']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', ";
						$vQuery .= "'{$aModnot[$vNum_mat]}', '{$aNotcur[$vNum_mat]}',  ";
						$vQuery .= "'{$sUsercoo['cod_usu']}', '02', now(), '{$sUsercoo['ip']}' ) ";
						$bResult = fInupde($vQuery);
						//--------------------------------------
					}
				}				
			}
		}
		elseif($sUsercoo['upin'] == 'i') 
		{
			if(!empty($sNotas))
			foreach($sNotas as $vNum_mat => $vNot_cur)
			{
				if($vNot_cur != 'sn')
				{
					$vQuery = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, per_aca, ";
					$vQuery .= "not_cur, cod_act, fch_not) values ('$vNum_mat', '{$sUsercoo['cod_car']}', ";
					$vQuery .= "'{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', '{$aModnot[$vNum_mat]}', ";
					$vQuery .= "'{$sUsercoo['ano_aca']}', '{$sUsercoo['per_aca']}', '$vNot_cur', ";
					$vQuery .= "'{$sEstudia['cod_act']}', now())";
					$cResult = fInupde($vQuery);
				}				
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
	  
	  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
	  <tr>
		<th width="30" scope="col">Nro</th>
		<th width="55" scope="col">Num.mat</th>
		<th width="270" scope="col">Apellidos y Nombres </th>
		<th width="90" scope="col">Mod. Mat. </th>
		<th width="25" scope="col">Nota</th>
	  </tr>
		<?	$vCont = 1;
			$sNota = "";
			
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
		<td class="worizq">&nbsp;
		  <span class ="<?	if($sNota[$aCurmat['num_mat']] < 11) echo "notades"; else echo "notapro" ?>">				  
		  <?=$sNota[$aCurmat['num_mat']]?>
		  </span></td>
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
		<td class="worizq">&nbsp;
		  <span class ="<?	if($sNota[$aCurmat['num_mat']] < 11) echo "notades"; else echo "notapro" ?>">				  
		  <?=$sNota[$aCurmat['num_mat']]?>
		  </span></td>
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
		<td class="worizq">&nbsp;
		  <span class ="<?	if($sNota[$aCurmat['num_mat']] < 11) echo "notades"; else echo "notapro" ?>">				  
		  <?=$sNota[$aCurmat['num_mat']]?>
		  </span></td>
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
		<td class="worizq">&nbsp;
		  <span class ="<?	if($sNota[$aCurmat['num_mat']] < 11) echo "notades"; else echo "notapro" ?>">				  
		  <?=$sNota[$aCurmat['num_mat']]?>
		  </span></td>
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
		<td class="worizq">&nbsp;
		  <span class ="<?	if($sNota[$aCurmat['num_mat']] < 11) echo "notades"; else echo "notapro" ?>">				  
		  <?=$sNota[$aCurmat['num_mat']]?>
		  </span></td>
	  </tr>
	  <?	$vCont++;	} ?>
	</table>
	  
	  <?
	  	if(empty($sNota))
		{
			$sUsercoo['upin'] = 'i';
	  ?>
	  <a href="" title="Guardar" class="linkboton" onClick = "getnotaing(); return false"><img src="../images/bingnota.png" width="100" height="24"></a>
	  <?
	  	}
		else
		{
			$sUsercoo['upin'] = 'u';
	  ?>
    <a href="" onClick="getnotaing(); return false;" title="Cancelar" class="linkboton" ><img src="../images/beditnota.png" width="100" height="24"></a>
	<?
		}
	?>

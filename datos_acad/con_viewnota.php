<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if(!empty($_GET['rNum_mat']))
			$vNum_mat = $_GET['rNum_mat'];
		else
			$vNum_mat = $sEstudia['num_mat'];
		
		$sEstudia = "";
		$sCurso = "";
		$sCurmat = "";
		$sCurmat2 = "";
		$sCurapto = "";
		$sCurso = "";
		$sAnoper = "";
		$sNotapdf = "";
		$sPDF = "";
		
		$vQuery = "Select num_mat, paterno, materno, nombres from unapnet.estudiante where num_mat = '$vNum_mat' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' ";
		$cEstudia = fQuery($vQuery);
		if($aEstudia2 = $cEstudia->fetch_array())
		{
			$sEstudia['num_mat'] = $aEstudia2['num_mat'];
			$sEstudia['paterno'] = $aEstudia2['paterno'];
			$sEstudia['materno'] = $aEstudia2['materno'];
			$sEstudia['nombres'] = $aEstudia2['nombres'];
			
			$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
			$vQuery = "Select distinct ano_aca, per_aca, pln_est from $tNota where num_mat = '{$sEstudia['num_mat']}' and mod_not = '04' order by ano_aca, per_aca";
			$cAnoper = fQuery($vQuery);
			while($aAnoper = $cAnoper->fetch_array())
			{
				$sAnoper[$aAnoper['ano_aca'].$aAnoper['per_aca']]['ano_aca'] = $aAnoper['ano_aca'];
				$sAnoper[$aAnoper['ano_aca'].$aAnoper['per_aca']]['per_aca'] = $aAnoper['per_aca'];
			}			
		}
		else
		{
			header("Location:not_getestu.php");
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

	    <? $sNotapdf = "";	
			if(!empty($sAnoper)) foreach($sAnoper as $vAnoper => $aAnoper)	
			{
				$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca']]['niv_est'] = "AÑO ACADÉMICO: {$aAnoper['ano_aca']} - PERIODO: {$sPeriodo[$aAnoper['per_aca']]['per_des']}";
				$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca']]['header'] = TRUE;
		?>
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Notas - A&ntilde;o: <?=$aAnoper['ano_aca']?> - Periodo: <?=$sPeriodo[$aAnoper['per_aca']]['per_des']?> </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="40" scope="col">C&oacute;d.</th>
                  <th width="20" scope="col">N.</th>
                  <th width="20" scope="col">S.</th>
                  <th width="20" scope="col">Es</th>
                  <th width="270" scope="col">Curso</th>
                  <th width="25" scope="col">Nota</th>
                  <th width="80" scope="col">Mod.</th>
                  <th width="30" scope="col">Crd</th>
                  <th width="16" scope="col">&nbsp;</th>
                  <th width="16" scope="col">&nbsp;</th>
                </tr>
                <? 	$vCont = 1; 
					$vQuery = "Select curso.pln_est, curso.cod_cur, curso.nom_cur, curso.niv_est, curso.sem_anu, ";
					$vQuery .= "$tNota.not_cur, $tNota.mod_not, curso.crd_cur, curso.cod_esp ";
					$vQuery .= "from $tNota left join unapnet.curso on $tNota.pln_est = curso.pln_est and ";
					$vQuery .= "$tNota.cod_cur = curso.cod_cur ";
					$vQuery .= "where $tNota.num_mat = '{$sEstudia['num_mat']}' and $tNota.ano_aca = '{$aAnoper['ano_aca']}' and ";
					$vQuery .= "$tNota.per_aca = '{$aAnoper['per_aca']}' and curso.cod_car = '{$sUsercoo['cod_car']}' and ";
					$vQuery .= "$tNota.mod_not = '04' order by pln_est, niv_est, sem_anu, cod_esp, cod_cur ";
					$cNotas = fQuery($vQuery);
					while($aNotas = $cNotas->fetch_array())
					{ 
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur']]['ano_per'] = "{$aAnoper['ano_aca']}-{$sPeriodo[$aAnoper['per_aca']]['abr_per']}";
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur']]['niv_est'] = $aNotas['niv_est'];
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur']]['sem_anu'] = $aNotas['sem_anu'];
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur']]['cod_cat'] = "{$aNotas['pln_est']}-{$aNotas['cod_cur']}";
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur']]['nom_cur'] = $aNotas['nom_cur'];						
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur']]['mod_not'] = $sModnot[$aNotas['mod_not']];
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur']]['crd_cur'] = $aNotas['crd_cur'];
						$sNotapdf[$aAnoper['ano_aca'].$aAnoper['per_aca'].$aNotas['cod_cur']]['not_cur'] = $aNotas['not_cur'];
				
				?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td class="wordizq">&nbsp;<?=$aNotas['pln_est']?>-<?=$aNotas['cod_cur']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=$aNotas['niv_est']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=$aNotas['sem_anu']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=$aNotas['cod_esp']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($aNotas['nom_cur']))?>&nbsp;</td>
                  <td class="wordizq">&nbsp;
				  <span class ="<?	if($aNotas['not_cur'] < 11) echo "notades"; else echo "notapro" ?>">				  
				  <?=$aNotas['not_cur']?>				  
				  </span></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aNotas['mod_not']]))?>&nbsp;</td>
                  <td class="wordder"><?=$aNotas['crd_cur']?>&nbsp;</td>
                  <td class="wordcen"><a href="" onclick="editnotaest('<?=$aNotas['pln_est']?>', '<?=$aNotas['cod_cur']?>', '<?=$aNotas['mod_not']?>', '<?=$aAnoper['ano_aca']?>', '<?=$aAnoper['per_aca']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Mostrar informaci&oacute;n" width="16" height="16" /></a></td>
                  <td class="wordcen"><a href="" onclick="del_nota('<?=$aNotas['pln_est']?>', '<?=$aNotas['cod_cur']?>', '<?=$aNotas['mod_not']?>', '<?=$aAnoper['ano_aca']?>', '<?=$aAnoper['per_aca']?>'); return false;" class="enlaceb"><img src="../images/drop.png" alt="Eliminar" width="16" height="16" /></a></td>
                </tr>
                <? $vCont++; 	} ?>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
<? } ?>		 
		<a href="" onclick="selectplancon(); return false;" title="Nueva Notas" class="linkboton" ><img src="../images/bnuevanota.png" width="100" height="24"></a>
		<a href="prnnota.php" title="Imprimir Historial de Notas" class="linkboton"  target="frPdf"><img src="../images/bphnota.png" width="100" height="24"></a>
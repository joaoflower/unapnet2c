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

        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Notas por curso </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="40" scope="col">C&oacute;d.</th>
                  <th width="20" scope="col">N.</th>
                  <th width="20" scope="col">S.</th>
                  <th width="270" scope="col">Curso</th>
                  <th width="25" scope="col">Nota</th>
                  <th width="80" scope="col">Mod.</th>
                  <th width="30" scope="col">Crd</th>
                  <th width="60" scope="col">Periodo</th>
                </tr>
                <? 	$vCont = TRUE;
					$vPlncur = ''; 
					$vQuery = "Select cu.pln_est, cu.cod_cur, cu.nom_cur, cu.niv_est, cu.sem_anu, ";
					$vQuery .= "no.not_cur, no.mod_not, cu.crd_cur, no.ano_aca, no.per_aca ";
					$vQuery .= "from $tNota no left join unapnet.curso cu on no.pln_est = cu.pln_est and ";
					$vQuery .= "no.cod_cur = cu.cod_cur ";
					$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and cu.cod_car = '{$sUsercoo['cod_car']}' ";
					$vQuery .= "order by pln_est, niv_est, sem_anu, cod_esp, cod_cur, ano_aca, per_aca, mod_not ";
					$cNotas = fQuery($vQuery);
					while($aNotas = $cNotas->fetch_array())
					{ 
						$sNotapdf[$aNotas['pln_est'].$aNotas['niv_est'].$aNotas['sem_anu']]['niv_est'] = "PLAN: {$aNotas['pln_est']} - NIVEL: {$sNivel[$aNotas['niv_est']]} - SEMESTRE: {$sSemestre[$aNotas['sem_anu']]}";
						$sNotapdf[$aNotas['pln_est'].$aNotas['niv_est'].$aNotas['sem_anu']]['header'] = TRUE;
												
						$sNotapdf[$aNotas['ano_aca'].$aNotas['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['ano_per'] = "{$aNotas['ano_aca']}-{$sPeriodo[$aNotas['per_aca']]['abr_per']}";
						$sNotapdf[$aNotas['ano_aca'].$aNotas['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['niv_est'] = $aNotas['niv_est'];
						$sNotapdf[$aNotas['ano_aca'].$aNotas['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['sem_anu'] = $aNotas['sem_anu'];
						$sNotapdf[$aNotas['ano_aca'].$aNotas['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['cod_cat'] = "{$aNotas['pln_est']}-{$aNotas['cod_cur']}";
						$sNotapdf[$aNotas['ano_aca'].$aNotas['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['nom_cur'] = $aNotas['nom_cur'];						
						$sNotapdf[$aNotas['ano_aca'].$aNotas['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['mod_not'] = $sModnot[$aNotas['mod_not']];
						$sNotapdf[$aNotas['ano_aca'].$aNotas['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['crd_cur'] = $aNotas['crd_cur'];
						$sNotapdf[$aNotas['ano_aca'].$aNotas['per_aca'].$aNotas['cod_cur'].$aNotas['mod_not']]['not_cur'] = $aNotas['not_cur'];
				
				?>
                <tr <? 
					if($vPlncur != ($aNotas['pln_est'].$aNotas['cod_cur']))
					{
						$vPlncur = ($aNotas['pln_est'].$aNotas['cod_cur']);
						$vCont = !$vCont;
					}
					if($vCont) echo "class=\"celpar\" id=\"p\"";	
					else  echo "class=\"celinpar\" id=\"i\""; 
					?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td class="wordizq">&nbsp;<?=$aNotas['pln_est']?>-<?=$aNotas['cod_cur']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=$aNotas['niv_est']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=$aNotas['sem_anu']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($aNotas['nom_cur']))?>&nbsp;</td>
                  <td class="wordizq">&nbsp;
				  <span class ="<?	if($aNotas['not_cur'] < 11) echo "notades"; else echo "notapro" ?>">				  
				  <?=$aNotas['not_cur']?>				  
				  </span></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aNotas['mod_not']]))?>&nbsp;</td>
                  <td class="wordder"><?=$aNotas['crd_cur']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=$aNotas['ano_aca']?>-<?=$sPeriodo[$aNotas['per_aca']]['abr_per']?>&nbsp;</td>
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
		<a href="prnnota.php" title="Imprimir Historial de Notas" class="linkboton" target="frPdf"><img src="../images/bphnota.png" width="100" height="24"></a>
		
<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
		  



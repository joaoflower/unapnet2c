<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		if(!empty($sNotas))
		foreach($sNotas as $vCod_cur => $vNot_cur)
		{
			if($vNot_cur != 'sn')
			{
				$vQuery = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, per_aca, not_cur, obs_not) ";
				$vQuery .= "values ('{$sEstudia['num_mat']}', '{$sUsercoo['cod_car']}', '{$sEstudia['pln_est']}', '$vCod_cur', ";
				$vQuery .= "'04',  '0000', '00', $vNot_cur, '{$sUsercoo['obs_not']}')";
				$cResult = fInupde($vQuery);
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
            <th align="center" background="../images/ventana_r1_c2.jpg" >Notas ingresadas   </th>
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
                  <th width="30" scope="col">Crd</th>
                </tr>
                <? 	$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
					$vCont = 1; 
					$vQuery = "Select curso.pln_est, curso.cod_cur, curso.nom_cur, curso.niv_est, curso.sem_anu, ";
					$vQuery .= "$tNota.not_cur, $tNota.mod_not, curso.crd_cur, curso.cod_esp ";
					$vQuery .= "from $tNota left join unapnet.curso on $tNota.pln_est = curso.pln_est and ";
					$vQuery .= "$tNota.cod_cur = curso.cod_cur ";
					$vQuery .= "where $tNota.num_mat = '{$sEstudia['num_mat']}' and $tNota.ano_aca = '0000' and ";
					$vQuery .= "$tNota.per_aca = '00' and curso.cod_car = '{$sUsercoo['cod_car']}' and ";
					$vQuery .= "$tNota.mod_not = '04' order by pln_est, niv_est, sem_anu, cod_esp, cod_cur ";
					
					$cNotas = fQuery($vQuery);
					while($aNotas = $cNotas->fetch_array())
					{ 
						if(!empty($sNotas[$aNotas['cod_cur']]))
						{

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
                  <td class="wordder"><?=$aNotas['crd_cur']?>&nbsp;</td>
                </tr>
                <? $vCont++; 	}	} ?>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
		<a href="" onClick="viewnotacon('<?=$sEstudia['num_mat']?>'); return false;" title="Ver Historial de Notas" class="linkboton" ><img src="../images/bvhnota.png" width="100" height="24"></a>

<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$tHabicurso = "unapnet.habicurso{$sUsercoo['ano_aca']}";
		if(!empty($sNotas))
		foreach($sNotas as $vCod_cur => $vNot_cur)
		{
			if($vNot_cur != 'sn')
			{
				$vQuery = "Insert into $tHabicurso (cod_car, pln_est, cod_cur, sec_gru, per_aca, can_vac) ";
				$vQuery .= "values ('{$sUsercoo['cod_car']}', '{$sUsercoo['pln_est']}', '$vCod_cur', ";
				$vQuery .= "'{$sUsercoo['sec_gru']}', '{$sUsercoo['per_aca']}',  '$vNot_cur')";
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
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos ingresadas   </th>
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
                  <th width="300" scope="col">Curso</th>
                  <th width="40" scope="col">Vacan.</th>
                  <th width="30" scope="col">Crd</th>
                </tr>
                <? 	$tHabicurso = "unapnet.habicurso{$sUsercoo['ano_aca']}";
				
					$vCont = 1; 
					
					$vQuery = "Select cu.pln_est, cu.cod_cur, cu.nom_cur, cu.niv_est, cu.sem_anu, ";
					$vQuery .= "ha.can_vac, cu.crd_cur, cu.cod_esp ";
					$vQuery .= "from $tHabicurso ha left join unapnet.curso cu on ha.cod_car = cu.cod_car and ";
					$vQuery .= "ha.pln_est = cu.pln_est and ha.cod_cur = cu.cod_cur ";
					$vQuery .= "where ha.cod_car = '{$sUsercoo['cod_car']}' and ha.pln_est = '{$sUsercoo['pln_est']}' and ";
					$vQuery .= "ha.sec_gru = '{$sUsercoo['sec_gru']}' and ha.per_aca = '{$sUsercoo['per_aca']}' and ";
					$vQuery .= "cu.sem_anu = '{$sUsercoo['sem_anu']}' ";
					
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
                  <td class="wordizq">&nbsp;<?=$aNotas['can_vac']?></td>
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
		<a href="hac_viewcurso.php" onClick="" title="Ver Cursos Habilitados" class="linkboton" ><img src="../images/bclose.png" width="100" height="24"></a>

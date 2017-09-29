<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	$sNotas = "";
	
	if(fsafetyselcar())
	{
		$sUsercoo['sem_anu'] = $_GET['rSem_anu'];
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
		<table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="0" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="40" scope="col">C&oacute;d.</th>
                  <th width="20" scope="col">N.</th>
                  <th width="20" scope="col">S.</th>
                  <th width="20" scope="col">Es</th>
                  <th width="300" scope="col">Curso</th>
                  <th width="45" scope="col">Vacan.</th>
                  <th width="30" scope="col">Crd</th>
                </tr>
                <? 	$tHabicurso = "unapnet.habicurso{$sUsercoo['ano_aca']}";
				
					$vCont = 1; 
					
					$vQuery = "Select cu.pln_est, cu.cod_cur, cu.nom_cur, cu.niv_est, cu.sem_anu, ";
					$vQuery .= "cu.crd_cur, cu.cod_esp ";
					$vQuery .= "from unapnet.curso cu ";
					$vQuery .= "where cu.cod_car = '{$sUsercoo['cod_car']}' and cu.pln_est = '{$sUsercoo['pln_est']}' and ";
					$vQuery .= "cu.sem_anu = '{$sUsercoo['sem_anu']}' and ";
					$vQuery .= "cu.cod_cur not in (select cod_cur from $tHabicurso where cod_car = '{$sUsercoo['cod_car']}' and ";
					$vQuery .= "pln_est = '{$sUsercoo['pln_est']}' and  sec_gru = '{$sUsercoo['sec_gru']}' and per_aca = '{$sUsercoo['per_aca']}') ";
					$vQuery .= "order by pln_est, niv_est, sem_anu, cod_esp, cod_cur ";
					
					$cNotas = fQuery($vQuery);
					while($aNotas = $cNotas->fetch_array())
					{ 

				?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td class="wordizq">&nbsp;<?=$aNotas['pln_est']?>-<?=$aNotas['cod_cur']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=$aNotas['niv_est']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=$aNotas['sem_anu']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=$aNotas['cod_esp']?>&nbsp;</td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($aNotas['nom_cur']))?>&nbsp;</td>
                  <td class="wordizq"><input name="rCan_vac<?=$aNotas['cod_cur']?>" type="text" class="texto" id="rCan_vac<?=$aNotas['cod_cur']?>" value="" size="3" maxlength="3" onblur="hac_regcanvac('<?=$aNotas['cod_cur']?>', this); return false"></td>
                  <td class="wordder"><?=$aNotas['crd_cur']?>&nbsp;</td>
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
		<a href="" title="Guardar" class="linkboton" onClick = "hac_savecurso(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="hac_viewcurso.php" onClick="" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>

		
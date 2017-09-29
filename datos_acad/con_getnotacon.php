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
		$sEstudia['cod_esp'] = $_GET['rCod_esp'];
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
		<table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Documento</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen">
			<table border="0" cellpadding="0" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                <td width="105" align="right">Resoluci&oacute;n Decanal: </td>
                <td width="230" class="wordizqb"><input name="rObs_not" type="text" class="texto" id="rObs_not" value="" size="20" maxlength="20" onBlur="fupper(this); regnotaobs(this)"> Ejm: RD 123-2006</td>
              </tr>
            </table>
			</td>
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
            <th align="center" background="../images/ventana_r1_c2.jpg" >Ingreso de Notas de convalidaci&oacute;n  </th>
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
                  <th width="270" scope="col">Curso</th>
                  <th width="45" scope="col">Nota</th>
                  <th width="30" scope="col">Crd</th>
                </tr>
                <? 	$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
					$vCont = 1; 
					$vQuery = "Select curso.pln_est, curso.cod_cur, curso.nom_cur, curso.niv_est, curso.sem_anu, ";
					$vQuery .= "curso.crd_cur, curso.cod_esp ";
					$vQuery .= "from unapnet.curso ";
					$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' and ";
					$vQuery .= "cod_cur not in (select distinct cod_cur from $tNota where num_mat = '{$sEstudia['num_mat']}' and ";
					$vQuery .= "pln_est = '{$sEstudia['pln_est']}' and not_cur > 10 ) and ";
					$vQuery .= "(cod_esp = '00' or cod_esp = '{$sEstudia['cod_esp']}') ";
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
                  <td class="wordizq"><input name="rNot_cur<?=$aNotas['cod_cur']?>" type="text" class="textnotade" id="rNot_cur<?=$aNotas['cod_cur']?>" value="" size="2" maxlength="2" onKeyUp="checknota(this)" onblur="regnotacon('<?=$aNotas['cod_cur']?>', this)"></td>
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
		<a href="" title="Guardar" class="linkboton" onClick = "savenotacon(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="" onClick="viewnota<?=(($sUsercoo['hiscon'] == 'h')?'est':'con')?>('<?=$sEstudia['num_mat']?>'); return false;" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>

		
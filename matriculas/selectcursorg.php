<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri3'])
		{
			$tNota = "unapnet.nota".$sUsercoo['cod_car'];
			
			$aCurdes = "";
			$aCurapro = "";

			$sCurmat = "";
			$sCurmat2 = "";
			$sCurapto = "";
			
			$vQuery = "Select distinct no.cod_cur, cu.niv_est, cu.sem_anu ";
			$vQuery .= "from $tNota no left join unapnet.curso cu on ";
			$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
			$vQuery .= "where cu.niv_est != '{$sEstudia['niv_est']}' and no.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "no.num_mat = '{$sEstudia['num_mat']}' and no.not_cur < 11 and ";
			$vQuery .= "no.mod_not != '02' and no.cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "no.cod_cur not in ";
			$vQuery .= "(Select cod_cur from $tNota where pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and not_cur > 10) ";
			$vQuery .= "order by niv_est, sem_anu, cod_cur ";
			
			$cCurdes2 = fQuery($vQuery);	
			
			while($aCurdes2 = $cCurdes2->fetch_array())
			{
				$sCurapto[$aCurdes2['cod_cur']] = TRUE;
				if($sEstudia['mod_mat'] == '01' or $sEstudia['mod_mat'] == '02')
					$aCurdes[$aCurdes2['cod_cur']] = '03';
				else
					$aCurdes[$aCurdes2['cod_cur']] = $sEstudia['mod_mat'];
			}
			$cCurdes2->close();
			
			
			$vQuery = "Select cod_cur, niv_est, sem_anu ";
			$vQuery .= "from unapnet.curso ";
			$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "niv_est = '{$sEstudia['niv_est']}' and cod_cur not in ";
			$vQuery .= "(Select cod_cur from $tNota where pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and not_cur > 10) ";
			$vQuery .= "order by niv_est, sem_anu, cod_cur ";
			
			$cCurobli2 = fQuery($vQuery);	
			
			while($aCurobli2 = $cCurobli2->fetch_array())
			{
				$sCurapto[$aCurobli2['cod_cur']] = TRUE;
				$aCurobli[$aCurobli2['cod_cur']] = $sEstudia['mod_mat'];
			}
			$cCurobli2->close();
			
		}
		else
			header("Location:ing_getestu.php");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Un@p.Net2</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<script language="JavaScript" src="../script/function.js"></script>
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	

	function aumentar(cont, vCanti)
	{ 
		if(cont.checked)
		{
			document.fData.txtCantidad.value = parseFloat(document.fData.txtCantidad.value) + parseFloat(vCanti);
			sombrear(cont);
		}
		else
		{
			document.fData.txtCantidad.value = parseFloat(document.fData.txtCantidad.value) - parseFloat(vCanti);
			desombrear(cont);
		}
	}


//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
<div class="wordcen" id="body1">
	  <form action="savematrirg.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Matricula de estudiantes </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg"><table width="400" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <td width="75" class="wordder">Estudiante : </td>
                  <td colspan="3" class="wordizqb"><?=$sEstudia['num_mat']?>
            -
              <?=$sEstudia['paterno']?>
              <?=$sEstudia['materno']?>
              ,
              <?=$sEstudia['nombres']?></td>
                </tr>
                <tr>
                  <td class="wordder">Plan : </td>
                  <td colspan="3" class="wordizqb"><?=$sEstudia['pln_est']?> - <?=$sTiposist[$sEstudia['tip_sist']]?></td>
                </tr>
                <tr>
                  <td class="wordder">Especialidad : </td>
                  <td colspan="3" class="wordizqb"><?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
                </tr>
                <tr>
                  <td class="wordder">Nivel : </td>
                  <td width="125" class="wordizqb"><?=$sNivel[$sEstudia['niv_est']]?></td>
                  <td width="80" class="wordder">&nbsp;</td>
                  <td class="wordizqb">&nbsp;</td>
                </tr>
                <tr>
                  <td class="wordder">Modalidad : </td>
                  <td class="wordizqb"><?=$sModmat[$sEstudia['mod_mat']]['mod_des']?></td>
                  <td class="wordder">Escogidos : </td>
                  <td class="wordizqb"><input name="txtCantidad" type="text" class="texto" id="txtCantidad" value="0" size="2" maxlength="2" disabled="disabled"> 
                    cursos </td>
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
		<? if(!empty($aCurdes)) {?>
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos Desaprobados de niveles inferiores </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="20" scope="col">&nbsp;</th>
                  <th width="45" scope="col">C&oacute;d.</th>
                  <th width="280" scope="col">Curso</th>
                  <th width="20" scope="col">N.</th>
                  <th width="20" scope="col">S.</th>
                  <th width="100" scope="col">Mod.</th>
                  <th width="70" scope="col">Grupo</th>
                </tr>
                <? 	$vCont = 1;	foreach($aCurdes as $vCod_cur => $vMod_mat) { ?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?> title="<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?>" onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td><input name="rCurdes[<?=$vCod_cur?>]" type="checkbox" class="check" value="<?=$vCod_cur?>" onClick="aumentar(this, 1)"></td>
                  <td class="wordizq">&nbsp;<?=$sCurso[$vCod_cur]['cod_cat']?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
                  <td class="wordcen">&nbsp;<?=$sCurso[$vCod_cur]['niv_est']?></td>
                  <td class="wordcen">&nbsp;<?=$sCurso[$vCod_cur]['sem_anu']?></td>
                  <td class="wordizq"><select name="rModmat<?=$vCod_cur?>" id="rModmat<?=$vCod_cur?>">
                      <?=fviewmodmatcur($vMod_mat)?>
                  </select></td>
                  <td class="wordizq"><select name="rGrupo<?=$vCod_cur?>" id="rGrupo<?=$vCod_cur?>">
                      <?=fviewgrupocur($sEstudia['sec_gru'])?>
                  </select></td>
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
        <? if(!empty($aCurobli)) {?>
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos del <?=$sNivel[$sEstudia['niv_est']]?> nivel</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="20" scope="col">&nbsp;</th>
                  <th width="45" scope="col">C&oacute;d.</th>
                  <th width="280" scope="col">Curso</th>
                  <th width="20" scope="col">N.</th>
                  <th width="20" scope="col">S.</th>
                  <th width="100" scope="col">Mod.</th>
                  <th width="70" scope="col">Grupo</th>
                </tr>
                <? 	$vCont = 1;	foreach($aCurobli as $vCod_cur => $vMod_mat) { ?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?> title="<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?>" onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td><input name="rCurobli[<?=$vCod_cur?>]" type="checkbox" class="check" value="<?=$vCod_cur?>" onClick="aumentar(this, 1)" <? if(!empty($sCurtut[$vCod_cur])) echo "checked"; ?>>
                  </td>
                  <td class="wordizq">&nbsp;<?=$sCurso[$vCod_cur]['cod_cat']?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
                  <td class="wordcen">&nbsp;<?=$sCurso[$vCod_cur]['niv_est']?></td>
                  <td class="wordcen">&nbsp;<?=$sCurso[$vCod_cur]['sem_anu']?></td>
                  <td class="wordizq"><select name="rModmat<?=$vCod_cur?>" id="rModmat<?=$vCod_cur?>">
                      <?=fviewmodmatcur($vMod_mat)?>
                  </select></td>
                  <td class="wordizq"><select name="rGrupo<?=$vCod_cur?>" id="rGrupo<?=$vCod_cur?>">
                      <?=fviewgrupocur($sEstudia['sec_gru'])?>
                  </select></td>
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
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Observaciones</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><textarea name="rObs_est" cols="115" rows="2" id="rObs_est" onBlur="fupper(this)"></textarea></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
  </form>
  <a href="" title="Matricular" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bmatricular.png" width="100" height="24"></a> 
  <a href="<?=($sEstudia['ingreg'] == 'i'?"ing_getestu.php":"reg_getestu.php")?>" title="Cancelar" class="linkboton" ><img src="../images/bcancel.png" width="100" height="24"></a>  </div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
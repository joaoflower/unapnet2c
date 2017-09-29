<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
				
		if(!empty($_GET['rCod_prf'])) $sUsercoo['cod_prf'] = $_GET['rCod_prf'];
/*		if(!empty($_GET['rPln_est'])) $sUsercoo['pln_est'] = $_GET['rPln_est'];
		if(!empty($_GET['rSec_gru'])) $sUsercoo['sec_gru'] = $_GET['rSec_gru'];
		if(!empty($_GET['rMod_mat'])) $sUsercoo['mod_mat'] = $_GET['rMod_mat'];*/
		
		if($sUsercoo['mod_mat'] == '99')
		{
			$vMod_mat = " (mod_mat = '01' or mod_mat = '07' or mod_mat = '08' ) ";
		}
		else
		{
			$vMod_mat = "mod_mat = '{$sUsercoo['mod_mat']}' ";
		}
		
		$vQuery = "Select concat(paterno, ' ', materno, ', ', nombres) as nombre from unapnet.docente ";
		$vQuery .= "where cod_prf = '{$sUsercoo['cod_prf']}' ";
		$cDocente = fQuery($vQuery);
		if($aDocente = $cDocente->fetch_array())
		{
			$vNom_doc = $aDocente['nombre'];
		}
		else
		{
			header("Location:../index.php");
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

<?

	$vQuery = "select distinct pln_est from $tCurmat where per_aca = '{$sUsercoo['per_aca']}' order by pln_est ";
	$cPlnesp = fQuery($vQuery);
	while($aPlnesp = $cPlnesp->fetch_array())
	{
		$aCarga = "";
		$vQuery = "select concat(cod_cur, sec_gru, mod_mat) as csm from $tCarga where cod_car = '{$sUsercoo['cod_car']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and pln_est = '{$aPlnesp['pln_est']}'";
		$cCarga = fQuery($vQuery);
		while($aCarga2 = $cCarga->fetch_array())
		{
			$aCarga[$aCarga2['csm']] = 1;
		}
?>

<table border="0" cellpadding="0" cellspacing="0" id="ventana">
  <tr>
    <th><img src="../images/ventana_r1_c1.jpg" alt="" name="ventana_r1_c1" width="12" height="29" border="0" id="ventana_r1_c1" /></th>
    <th align="center" background="../images/ventana_r1_c2.jpg" >Carga del docente:
      <?=$vNom_doc?> - Plan: <?=$aPlnesp['pln_est']?></th>
    <th><img src="../images/ventana_r1_c4.jpg" alt="" name="ventana_r1_c4" width="11" height="29" border="0" id="ventana_r1_c4" /></th>
  </tr>
  <tr>
    <td background="../images/ventana_r2_c1.jpg"></td>
    <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="0" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
      <tr>
        <th width="20" class="wordcen"></th>
        <th width="20" class="wordizqb">Pln</th>
        <th width="30" class="wordizqb">&nbsp;Cod&nbsp;</th>
        <th width="30" class="wordizqb">Niv</th>
        <th width="20" class="wordizqb">Sm</th>
        <th width="20" class="wordizqb">Esp</th>
        <th width="280" class="wordizqb">&nbsp;Nombre del Curso&nbsp;</th>
        <th width="60" class="wordizqb">&nbsp;Grupo&nbsp;</th>
        <th width="80" class="wordizqb">&nbsp;Modalidad&nbsp;</th>
      </tr>
      <?
		$vQuery = "Select distinct cu.pln_est, cu.cod_cur, cu.niv_est, cu.sem_anu, cu.cod_esp, cu.nom_cur, cm.sec_gru, ";
		$vQuery .= "mm.mod_act from $tCurmat cm left join unapnet.curso cu on ";
		$vQuery .= "cm.cod_car = cu.cod_car and cm.pln_est = cu.pln_est and cm.cod_cur = cu.cod_cur ";
		$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
		$vQuery .= "where cm.per_aca = '{$sUsercoo['per_aca']}' and cm.pln_est = '{$aPlnesp['pln_est']}' ";
/*		$vQuery .= "concat(cu.cod_cur, cm.sec_gru, mm.mod_act) not in ";
		$vQuery .= "(select concat(cod_cur, sec_gru, mod_act) from $tCarga where cod_car = '{$sUsercoo['cod_car']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and pln_est = '{$aPlnesp['pln_est']}')";*/
		$vQuery .= "order by cu.niv_est, sem_anu, cod_esp, cod_cur, sec_gru ";
		$cCurso = fQuery($vQuery);
		while($aCurso = $cCurso->fetch_array())
		{		
			if(empty($aCarga[$aCurso['cod_cur'].$aCurso['sec_gru'].$aCurso['mod_act']]))
			{
	?>
      <tr <? if($aCurso['sem_anu'] % 2 == 0)  echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
        <td class="wordcen"><input name="rCurcarga[<?=$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru'].$aCurso['mod_act']?>]" type="checkbox" id="rCurcarga[<?=$aCurso['cod_cur']?>]" value="checkbox" onClick="pintar(this)" /></td>
        <td class="wordcen">&nbsp;<?=$aCurso['pln_est']?>&nbsp;</td>
        <td class="wordcen">&nbsp;<?=$aCurso['cod_cur']?>&nbsp;</td>
        <td class="wordcen">&nbsp;<?=$aCurso['niv_est']?>&nbsp;</td>
        <td class="wordcen">&nbsp;<?=$aCurso['sem_anu']?>&nbsp;</td>
        <td class="wordcen">&nbsp;<?=$aCurso['cod_esp']?>&nbsp;</td>
        <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?>&nbsp;</td>
        <td class="wordizq">&nbsp;<?=ucwords(strtolower($sGrupo[$aCurso['sec_gru']]))?></td>
        <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aCurso['mod_act']]))?></td>
      </tr>
      <?
		}	}
			?>
      <tr>
        <td colspan="9" class="wordcen"></td>
      </tr>
    </table></td>
    <td background="../images/ventana_r2_c4.jpg"></td>
  </tr>
  <tr>
    <td><img src="../images/ventana_r4_c1.jpg" alt="" name="ventana_r4_c1" width="12" height="10" border="0" id="ventana_r4_c1" /></td>
    <td background="../images/ventana_r4_c2.jpg"></td>
    <td><img src="../images/ventana_r4_c4.jpg" alt="" name="ventana_r4_c4" width="11" height="10" border="0" id="ventana_r4_c4" /></td>
  </tr>
</table>
<?
	}
?>

		<a href="" title="Guardar " class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
		<a href="cga_selectsem.php" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>
		
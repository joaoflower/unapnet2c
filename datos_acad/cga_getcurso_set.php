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
		
		if(!empty($_GET['rCod_prf'])) $sUsercoo['cod_prf'] = $_GET['rCod_prf'];
		if(!empty($_GET['rPln_est'])) $sUsercoo['pln_est'] = $_GET['rPln_est'];
		if(!empty($_GET['rSec_gru'])) $sUsercoo['sec_gru'] = $_GET['rSec_gru'];
		if(!empty($_GET['rMod_mat'])) $sUsercoo['mod_mat'] = $_GET['rMod_mat'];
		
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
<table border="0" cellpadding="0" cellspacing="0" id="ventana">
  <tr>
    <th><img src="../images/ventana_r1_c1.jpg" alt="" name="ventana_r1_c1" width="12" height="29" border="0" id="ventana_r1_c1" /></th>
    <th align="center" background="../images/ventana_r1_c2.jpg" >Carga del docente:
      <?=$vNom_doc?> - Plan: <?=$sUsercoo['pln_est']?> - Grupo: <?=$sGrupo[$sUsercoo['sec_gru']]?></th>
    <th><img src="../images/ventana_r1_c4.jpg" alt="" name="ventana_r1_c4" width="11" height="29" border="0" id="ventana_r1_c4" /></th>
  </tr>
  <tr>
    <td background="../images/ventana_r2_c1.jpg"></td>
    <td background="../images/ventana_r2_c2.jpg" class="wordcen">
	
	<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td width="90" class="wordder">&nbsp;Plan de Estudios: </td>
              <td class="wordizq">&nbsp;
                <select name="rPln_est" id="rPln_est" onchange="getcargacurso('<?=$sUsercoo['cod_prf']?>', this.value, '<?=$sUsercoo['sec_gru']?>', '<?=$sUsercoo['mod_mat']?>'); return false;">
                  <?=fviewplan($sUsercoo['pln_est'])?>
                </select>                &nbsp;</td>
              <td width="40" class="wordder">&nbsp;Grupo:</td>
              <td class="wordizq"><select name="rSec_gru" id="rSec_gru" onchange="getcargacurso('<?=$sUsercoo['cod_prf']?>', '<?=$sUsercoo['pln_est']?>', this.value, '<?=$sUsercoo['mod_mat']?>'); return false;">
				  	<?=fviewgruposel($sUsercoo['sec_gru'])?>
                  </select></td>
			  <td width="60" class="wordder">Modalidad:</td>
			  <td class="wordizq"><select name="rMod_mat" id="rMod_mat" onchange="getcargacurso('<?=$sUsercoo['cod_prf']?>', '<?=$sUsercoo['pln_est']?>', '<?=$sUsercoo['sec_gru']?>', this.value); return false;">
				  	<?=fviewmodmatcarga($sUsercoo['mod_mat'])?>
                  </select></td>
			</tr>					
          </table>
	<table border="1" cellpadding="0" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
      <tr>
        <th class="wordcen"></th>
        <th width="30" class="wordizqb">&nbsp;Cod&nbsp;</th>
        <th width="30" class="wordizqb">&nbsp;Niv&nbsp;</th>
        <th width="70" class="wordizqb">&nbsp;Sem&nbsp;</th>
        <th width="30" class="wordizqb">&nbsp;Esp&nbsp;</th>
        <th width="280" class="wordizqb">&nbsp;Nombre del Curso&nbsp;</th>
      </tr>
      <?
		if(!empty($sUsercoo['cod_prf']) && !empty($sUsercoo['pln_est']) && !empty($sUsercoo['sec_gru']) && !empty($sUsercoo['mod_mat']))
		{
			$vQuery = "Select cod_cur, nom_cur, cod_esp, niv_est, sem_anu from unapnet.curso where ";
			$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sUsercoo['pln_est']}' and ";
			$vQuery .= "cod_cur not in (select cod_cur from $tCarga where ";
			$vQuery .= "pln_est = '{$sUsercoo['pln_est']}' and sec_gru = '{$sUsercoo['sec_gru']}' and ";
			$vQuery .= "$vMod_mat and cod_car = '{$sUsercoo['cod_car']}' and ";
			$vQuery .= "per_aca = '{$sUsercoo['per_aca']}') ";
			$vQuery .= "order by sem_anu, cod_cur";
			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
	?>
      <tr <? if($aCurso['sem_anu'] % 2 == 0)  echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
        <td width="30" class="wordcen"><input name="rCurcarga[<?=$aCurso['cod_cur']?>]" type="checkbox" id="rCurcarga[<?=$aCurso['cod_cur']?>]" value="checkbox" onClick="pintar(this)" /></td>
        <td class="wordcen">&nbsp;
              <?=$aCurso['cod_cur']?>
          &nbsp;</td>
        <td class="wordcen">&nbsp;<?=$aCurso['niv_est']?>&nbsp;</td>
        <td class="wordizq">&nbsp;<?=ucwords(strtolower($sSemestre[$aCurso['sem_anu']]))?>&nbsp;</td>
        <td class="wordcen">&nbsp;<?=$aCurso['cod_esp']?>&nbsp;</td>
        <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?>&nbsp;</td>
      </tr>
      <?
			}	}
			?>
      <tr>
        <td colspan="6" class="wordcen"></td>
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

		<a href="" title="Guardar " class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
		<a href="cga_selectsem.php" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>
		
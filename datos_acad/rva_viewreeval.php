<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$sSemgru = "";
		
		$sUsercoo['psge'] = $_GET['rPSGE'];
		$sSemgru['1']['pln_est'] = substr($_GET['rPSGE'], 0, 2);
		$sSemgru['1']['sem_anu'] = substr($_GET['rPSGE'], 2, 2);
		$sSemgru['1']['sec_gru'] = substr($_GET['rPSGE'], 4, 2);
		$sSemgru['1']['cod_esp'] = substr($_GET['rPSGE'], 6, 2);
		
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		$sCurso = "";
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>

	 <?
		if(!empty($sSemgru)) 
		foreach($sSemgru as $vPSG => $aSemgru) 
		{ 
			if(!empty($aSemgru['pln_est']) && !empty($aSemgru['sem_anu']) and !empty($aSemgru['sec_gru']) and !empty($aSemgru['cod_esp']))
			{
	?>
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Sem. : 
          <?=$sSemestre[$aSemgru['sem_anu']]?> - Esp.: <?=$sEspecial[$aSemgru['pln_est'].$aSemgru['cod_esp']]['esp_nom']?> - Grupo : <?=$sGrupo[$aSemgru['sec_gru']]?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="25" scope="col">C&oacute;d</th>
              <th width="280" scope="col">Curso</th>
              <th width="80" scope="col">Modalidad</th>
              <th width="16" scope="col">&nbsp;</th>
            </tr>
            <? 	$sCarga = "";
				$vCont = 1;	 

				$vQuery = "select distinct cu.cod_cur, cu.nom_cur, mm.mod_not, ap.mod_mat ";
				$vQuery .= "from $tApla ap left join unapnet.curso cu on ap.cod_car = cu.cod_car and ";
				$vQuery .= "ap.pln_est = cu.pln_est and ap.cod_cur = cu.cod_cur ";
				$vQuery .= "left join unapnet.modmat mm on ap.mod_mat = mm.mod_mat ";
				$vQuery .= "where ap.cod_car = '{$sUsercoo['cod_car']}' and ap.pln_est = '{$aSemgru['pln_est']}' and ";
				$vQuery .= "cu.sem_anu = '{$aSemgru['sem_anu']}' and cu.cod_esp = '{$aSemgru['cod_esp']}' and ";
				$vQuery .= "ap.sec_gru = '{$aSemgru['sec_gru']}' and ap.per_aca = '{$sUsercoo['per_aca']}'";
				
				$cReeval = fQuery($vQuery);
				while($aReeval = $cReeval->fetch_array())
				{

			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
              <td class="wordcenb"><?=$aReeval['cod_cur']?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aReeval['nom_cur']))?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aReeval['mod_not']]))?></td>
			  <td class="wordizq"><a href="rva_viewcursodata.php?rPln_est=<?=$aSemgru['pln_est']?>&rCod_cur=<?=$aReeval['cod_cur']?>&rSec_gru=<?=$aSemgru['sec_gru']?>&rMod_not=<?=$aReeval['mod_not']?>&rMod_mat=<?=$aReeval['mod_mat']?>" class="enlaceb"><img src="../images/browse.png" alt="Mostrar informaci&oacute;n" width="16" height="16" /></a></td>
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
	  <? 	}	} ?>

<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$sSemgru = "";
		
		$sUsercoo['psge'] = $_GET['rPSGE'];
		$sSemgru['1']['pln_est'] = substr($_GET['rPSGE'], 0, 2);
		$sSemgru['1']['sem_anu'] = substr($_GET['rPSGE'], 2, 2);
		$sSemgru['1']['sec_gru'] = substr($_GET['rPSGE'], 4, 2);
		$sSemgru['1']['cod_esp'] = substr($_GET['rPSGE'], 6, 2);
		
//		$sEstudia['cod_esp'] = substr($_GET['rPSGE'], 6, 2);
		
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
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
              <th width="16" scope="col">&nbsp;</th>
              <th width="190" scope="col">Docente</th>
              <th width="80" scope="col">Mod.Mat</th>
            </tr>
            <? 	$sCarga = "";
				$vCont = 1;	 

				$vQuery = "select cu.cod_cur, cu.nom_cur, do.cod_prf, concat(do.paterno, ' ', do.materno, ', ', do.nombres) as nombre, ";
				$vQuery .= "ca.mod_mat from $tCarga ca left join unapnet.curso cu on ca.cod_car = cu.cod_car and ";
				$vQuery .= "ca.pln_est = cu.pln_est and ca.cod_cur = cu.cod_cur ";
				$vQuery .= "left join unapnet.docente do on ca.cod_prf = do.cod_prf ";
				$vQuery .= "where ca.cod_car = '{$sUsercoo['cod_car']}' and ca.pln_est = '{$aSemgru['pln_est']}' and ";
				$vQuery .= "cu.sem_anu = '{$aSemgru['sem_anu']}' and cu.cod_esp = '{$aSemgru['cod_esp']}' and ";
				$vQuery .= "ca.sec_gru = '{$aSemgru['sec_gru']}' and ca.per_aca = '{$sUsercoo['per_aca']}'";
				
				$cCarga = fQuery($vQuery);
				while($aCarga = $cCarga->fetch_array())
				{

			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)">
              <td class="wordcenb"><?=$aCarga['cod_cur']?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCarga['nom_cur']))?></td>
              <td class="wordizq"><a href="" onclick="del_carga('<?=$aSemgru['pln_est']?>', '<?=$aCarga['cod_cur']?>', '<?=$aSemgru['sec_gru']?>', '<?=$aCarga['mod_mat']?>', '<?=$aCarga['cod_prf']?>'); return false;" class="enlaceb"><img src="../images/drop.png" alt="Eliminar" width="16" height="16" /></a></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCarga['nombre']))?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aCarga['mod_mat']]))?></td>
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

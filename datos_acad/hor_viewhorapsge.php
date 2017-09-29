<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{		
		$aSemgru = "";
		$sUsercoo['psge'] = $_GET['rPSGE'];
		$sSemgru['1']['pln_est'] = substr($_GET['rPSGE'], 0, 2);
		$sSemgru['1']['sem_anu'] = substr($_GET['rPSGE'], 2, 2);
		$sSemgru['1']['sec_gru'] = substr($_GET['rPSGE'], 4, 2);
		$sSemgru['1']['cod_esp'] = substr($_GET['rPSGE'], 6, 2);
		
		$tHorario = "unapnet.hora{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
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
          <th align="center" background="../images/ventana_r1_c2.jpg" >HORARIO: Sem. : <?=$sSemestre[$aSemgru['sem_anu']]?> - Esp.: <?=$sEspecial[$aSemgru['pln_est'].$aSemgru['cod_esp']]['esp_nom']?> - Grupo : <?=$sGrupo[$aSemgru['sec_gru']]?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="60" scope="col">Hora</th>
              <th width="50" scope="col">Lunes</th>
              <th width="50" scope="col">Martes</th>
              <th width="50" scope="col">Mi&eacute;rc.</th>
              <th width="50" scope="col">Jueves</th>
              <th width="50" scope="col">Viernes</th>
              <th width="50" scope="col">S&aacute;bado</th>
              <th width="50" scope="col">Dom.</th>
            </tr>
            <? 	$vCont = 1;	 
				$sHorario = "";
				$sCursem = "";
				$vQuery = "Select cu.cod_cur, ho.cod_dia, ho.cod_hor ";
				$vQuery .= "from $tHorario ho left join unapnet.curso cu on cu.pln_est = ho.pln_est and ";
				$vQuery .= "cu.cod_cur = ho.cod_cur and cu.cod_car = ho.cod_car ";
				$vQuery .= "where ho.per_aca ='{$sUsercoo['per_aca']}' and ho.sec_gru = '{$aSemgru['sec_gru']}' and ";
				$vQuery .= "cu.sem_anu = '{$aSemgru['sem_anu']}' and cu.pln_est = '{$aSemgru['pln_est']}' and ";
				$vQuery .= "cu.cod_esp = '{$aSemgru['cod_esp']}' order by cod_hor";
				$cHorasem = fQuery($vQuery);
				while($aHorasem = $cHorasem->fetch_array())
				{
					$sHorario[$aHorasem['cod_hor']][$aHorasem['cod_dia']] = $aHorasem['cod_cur'];
//					$sCursem[$aHorasem['cod_cur']] = $aHorasem['nom_cur'];
				}
				if(!empty($sHorario))
				foreach($sHorario as $vCod_hor => $aHorario)
				{
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordcenb"><?=$sCodhora[$vCod_hor]['hrs_ini']?> - <?=$sCodhora[$vCod_hor]['hrs_fin']?></td>
              <td class="wordcen">&nbsp;<?=$aHorario['1']?></td>
              <td class="wordcen">&nbsp;<?=$aHorario['2']?></td>
              <td class="wordcen">&nbsp;<?=$aHorario['3']?></td>
              <td class="wordcen">&nbsp;<?=$aHorario['4']?></td>
              <td class="wordcen">&nbsp;<?=$aHorario['5']?></td>
              <td class="wordcen">&nbsp;<?=$aHorario['6']?></td>
              <td class="wordcen">&nbsp;<?=$aHorario['7']?></td>
            </tr>
            <? $vCont++; 	} ?>
          </table><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="40" scope="col">C&oacute;digo</th>
              <th width="280" scope="col">Curso</th>
              <th width="16" scope="col">&nbsp;</th>
              <th width="200" scope="col">Docente</th>
            </tr>
            <? 	$sCarga = "";
				$vCont = 1;	 

				$vQuery = "select cu.cod_cur, concat(do.paterno, ' ', do.materno, ', ', do.nombres) as nombre ";
				$vQuery .= "from unapnet.curso cu left join $tCarga ca on cu.cod_car = ca.cod_car and ";
				$vQuery .= "cu.pln_est = ca.pln_est and cu.cod_cur = ca.cod_cur ";
				$vQuery .= "left join unapnet.docente do on ca.cod_prf = do.cod_prf ";
				$vQuery .= "where cu.cod_car = '{$sUsercoo['cod_car']}' and cu.pln_est = '{$aSemgru['pln_est']}' and ";
				$vQuery .= "cu.sem_anu = '{$aSemgru['sem_anu']}' and cu.cod_esp = '{$aSemgru['cod_esp']}' and ";
				$vQuery .= "ca.sec_gru = '{$aSemgru['sec_gru']}' and ca.per_aca = '{$sUsercoo['per_aca']}'";
				
				$cCarga = fQuery($vQuery);
				while($aCarga = $cCarga->fetch_array())
				{
					$sCarga[$aCarga['cod_cur']] = $aCarga['nombre'];
				}
				
				$vQuery = "select distinct cu.cod_cur, cu.nom_cur from unapnet.curso cu left join $tHorario ho on ";
				$vQuery .= "cu.cod_car = ho.cod_car and cu.pln_est = ho.pln_est and cu.cod_cur = ho.cod_cur ";
				$vQuery .= "where cu.cod_car = '{$sUsercoo['cod_car']}' and cu.pln_est = '{$aSemgru['pln_est']}' and ";
				$vQuery .= "cu.sem_anu = '{$aSemgru['sem_anu']}' and cu.cod_esp = '{$aSemgru['cod_esp']}' and ";
				$vQuery .= "ho.sec_gru = '{$aSemgru['sec_gru']}' and ho.per_aca = '{$sUsercoo['per_aca']}' order by cod_cur";
				
				$cCursem = fQuery($vQuery);
				while($aCursem = $cCursem->fetch_array())
				{
			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordcenb">&nbsp;<?=$aCursem['cod_cur']?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCursem['nom_cur']))?></td>
              <td class="wordizq"><a href="" onclick="del_horario('<?=$aSemgru['pln_est']?>', '<?=$aCursem['cod_cur']?>', '<?=$aSemgru['sec_gru']?>', '<?=$aSemgru['cod_esp']?>'); return false;" class="enlaceb"><img src="../images/drop.png" alt="Eliminar" width="16" height="16" /></a></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCarga[$aCursem['cod_cur']]))?></td>
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

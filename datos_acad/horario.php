<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$tHorario = "unapnet.hora{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		$sCurso = "";
		
/*		$vQuery = "select distinct pln_est from $tHorario where per_aca = '{$sUsercoo['per_aca']}'";
		$cPlanes = fQuery($vQuery);
		while($aPlanes = $cPlanes->fetch_array()) 
		{
			$vQuery = "select pln_est, cod_cur, cod_cat, nom_cur, sem_anu, cod_esp  ";
			$vQuery .= "from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$aPlanes['pln_est']}' ";
			$vQuery .= "order by sem_anu, cod_cur";
			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
				$sCurso[$aCurso['pln_est'].$aCurso['cod_cur']]['pln_est'] = $aCurso['pln_est'];
				$sCurso[$aCurso['pln_est'].$aCurso['cod_cur']]['cod_cur'] = $aCurso['cod_cur'];
				$sCurso[$aCurso['pln_est'].$aCurso['cod_cur']]['cod_cat'] = $aCurso['cod_cat'];
				$sCurso[$aCurso['pln_est'].$aCurso['cod_cur']]['nom_cur'] = $aCurso['nom_cur'];
				$sCurso[$aCurso['pln_est'].$aCurso['cod_cur']]['sem_anu'] = $aCurso['sem_anu'];
				$sCurso[$aCurso['pln_est'].$aCurso['cod_cur']]['cod_esp'] = $aCurso['cod_esp'];
			}
		}*/
		
		$vQuery = "Select distinct curso.pln_est, curso.sem_anu, curso.cod_esp, $tHorario.sec_gru ";
		$vQuery .= "from $tHorario left join unapnet.curso on curso.pln_est = $tHorario.pln_est and ";
		$vQuery .= "curso.cod_cur = $tHorario.cod_cur and curso.cod_car = $tHorario.cod_car ";
		$vQuery .= "where $tHorario.per_aca = '{$sUsercoo['per_aca']}' order by pln_est, sem_anu, cod_esp, sec_gru";
		$cSemgru = fQuery($vQuery);
		while($aSemgru = $cSemgru->fetch_array())
		{
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['pln_est'] = $aSemgru['pln_est'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['sem_anu'] = $aSemgru['sem_anu'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['sec_gru'] = $aSemgru['sec_gru'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['cod_esp'] = $aSemgru['cod_esp'];
		}
		
		$sDocente = "";
		$vQuery = "Select distinct docente.cod_prf, docente.paterno, docente.materno, docente.nombres ";
		$vQuery .= "from unapnet.docente left join $tCarga on docente.cod_prf = $tCarga.cod_prf ";
		$vQuery .= "where $tCarga.cod_car = '{$sUsercoo['cod_car']}' and $tCarga.per_aca = '{$sUsercoo['per_aca']}'";
		$cDocente = fQuery($vQuery);
		while($aDocente = $cDocente->fetch_array())
			$sDocente[$aDocente['cod_prf']] = "{$aDocente['paterno']} {$aDocente['materno']}, {$aDocente['nombres']}";
				
/*		$sUsercoo['safetymatri'] = FALSE;
		$sUsercoo['safetymatri2'] = FALSE;
		$sUsercoo['safetymatri3'] = FALSE;
		$sUsercoo['safetymatri4'] = FALSE;*/
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
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	
	function enfocar()
	{
		document.fData.rNum_mat.focus();
		//document.fdata.rLogin.select();
	}
//-->
</script>
</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="hora_add.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	 <?
		if(!empty($sSemgru)) 
		foreach($sSemgru as $vPSG => $aSemgru) 
		{ 
	?>
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Horario Semestre : <?=$sSemestre[$aSemgru['sem_anu']]?> -Especialidad: 
            <?=$sEspecial[$aSemgru['pln_est'].$aSemgru['cod_esp']]['esp_nom']?> 
          - Grupo : <?=$sGrupo[$aSemgru['sec_gru']]?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="60" scope="col">Hora</th>
              <th width="70" scope="col">Lunes</th>
              <th width="70" scope="col">Martes</th>
              <th width="70" scope="col">Mi&eacute;rcoles</th>
              <th width="70" scope="col">Jueves</th>
              <th width="70" scope="col">Viernes</th>
              <th width="60" scope="col">S&aacute;bado</th>
              <th width="60" scope="col">Domingo</th>
            </tr>
            <? 	$vCont = 1;	 
				$sHorario = "";
				$sCursem = "";
				$vQuery = "Select curso.cod_cur, curso.nom_cur, $tHorario.cod_dia, $tHorario.cod_hor ";
				$vQuery .= "from $tHorario left join unapnet.curso on curso.pln_est = $tHorario.pln_est and ";
				$vQuery .= "curso.cod_cur = $tHorario.cod_cur and curso.cod_car = $tHorario.cod_car ";
				$vQuery .= "where $tHorario.per_aca = '{$sUsercoo['per_aca']}' and $tHorario.sec_gru = '{$aSemgru['sec_gru']}' and ";
				$vQuery .= "curso.sem_anu = '{$aSemgru['sem_anu']}' and curso.pln_est = '{$aSemgru['pln_est']}' and ";
				$vQuery .= "curso.cod_esp = '{$aSemgru['cod_esp']}' order by cod_hor";
				$cHorasem = fQuery($vQuery);
				while($aHorasem = $cHorasem->fetch_array())
				{
					$sHorario[$aHorasem['cod_hor']][$aHorasem['cod_dia']] = $aHorasem['cod_cur'];
					$sCursem[$aHorasem['cod_cur']] = $aHorasem['nom_cur'];
				}
				if(!empty($sHorario))
				foreach($sHorario as $vCod_hor => $aHorario)
				{
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordcen"><?=$sCodhora[$vCod_hor]['hrs_ini']?> - <?=$sCodhora[$vCod_hor]['hrs_fin']?></td>
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
              <th width="60" scope="col">C&oacute;digo</th>
              <th width="200" scope="col">Curso</th>
              <th width="200" scope="col">Docente</th>
            </tr>
            <? 	$sCarga = "";
				$vCont = 1;	 
				$vQuery = "select curso.cod_cur, $tCarga.cod_prf ";
				$vQuery .= "from unapnet.curso left join $tCarga on curso.cod_car = $tCarga.cod_car and curso.pln_est = $tCarga.pln_est and ";
				$vQuery .= "curso.cod_cur = $tCarga.cod_cur ";
				$vQuery .= "where curso.cod_car = '{$sUsercoo['cod_car']}' and curso.pln_est = '{$aSemgru['pln_est']}' and ";
				$vQuery .= "curso.sem_anu = {$aSemgru['sem_anu']} and $tCarga.sec_gru = '{$aSemgru['sec_gru']}'";
				$cCarga = fQuery($vQuery);
				while($aCarga = $cCarga->fetch_array())
					$sCarga[$aCarga['cod_cur']] = $aCarga['cod_prf'];
				if(!empty($sCursem))
				foreach($sCursem as $vCod_cur => $vNom_cur)
				{
			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordcen">&nbsp;<?=$vCod_cur?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCursem[$vCod_cur]))?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sDocente[$sCarga[$vCod_cur]]))?></td>
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
      <input name="Submit" type="submit" class="boton" value="Agregar">
      </form>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
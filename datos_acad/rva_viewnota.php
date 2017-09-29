<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

	<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
	  <tr>
		<th width="30" scope="col">Nro</th>
		<th width="55" scope="col">Num.mat</th>
		<th width="270" scope="col">Apellidos y Nombres </th>
		<th width="90" scope="col">Mod. Mat. </th>
		<th width="25" scope="col">Nota</th>
	    <th width="16" scope="col">&nbsp;</th>
	  </tr>
		<?	$vCont = 1;
			$sNota = "";
			
			$vQuery = "Select num_mat, not_cur ";
			$vQuery .= "from $tNota ";
			$vQuery .= "where $tNota.pln_est = '{$sEstudia['pln_est']}' and $tNota.cod_cur = '{$sEstudia['cod_cur']}' and ";
			$vQuery .= "$tNota.mod_not = '{$sEstudia['mod_not']}' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
//			$vQuery .= "$tNota.mod_not = '13' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
			$vQuery .= "$tNota.per_aca = '{$sUsercoo['per_aca']}' ";
			$cNota = fQuery($vQuery);
			while($aNota = $cNota->fetch_array())
			{
				$sNota[$aNota['num_mat']] = $aNota['not_cur'];
			}						
			
			$sEstupdf = "";
			
			$sIngnota = "";
			$vNum_matback = "";
			
			$vQuery = "Select est.num_mat, est.paterno, est.materno, est.nombres, ap.mod_mat ";
			$vQuery .= "from $tApla ap left join unapnet.estudiante est on ap.num_mat = est.num_mat and ";
			$vQuery .= "ap.cod_car = est.cod_car ";
			$vQuery .= "where ap.pln_est = '{$sEstudia['pln_est']}' and ap.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "ap.cod_cur = '{$sEstudia['cod_cur']}' and ap.sec_gru = '{$sEstudia['sec_gru']}' and ";
			$vQuery .= "ap.mod_mat = '{$sEstudia['mod_not']}' and ap.cod_car = '{$sUsercoo['cod_car']}' ";
			$vQuery .= "order by paterno, materno, nombres";
			$cCurmat = fQuery($vQuery);
			while($aCurmat = $cCurmat->fetch_array())
			{
				if(!empty($vNum_matback))
				{
					$sIngnota[$vNum_matback] = $aCurmat['num_mat'];
				}
				$vNum_matback = $aCurmat['num_mat'];
				
				$sEstupdf[$aCurmat['num_mat']]['num_est'] = $vCont;
				$sEstupdf[$aCurmat['num_mat']]['num_mat'] = $aCurmat['num_mat'];
				$sEstupdf[$aCurmat['num_mat']]['nombre'] = "{$aCurmat['paterno']} {$aCurmat['materno']}, {$aCurmat['nombres']}"; 		
				$sEstupdf[$aCurmat['num_mat']]['mod_mat'] = $sModnot[$aCurmat['mod_mat']];
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><?=$vCont?></td>
		<td class="wordcen"><?=$aCurmat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
		<td class="wordizq">&nbsp;<?=$sModnot[$aCurmat['mod_mat']]?></td>
		<td class="worizq">&nbsp;
		  <span class ="<?	if($sNota[$aCurmat['num_mat']] < 11) echo "notades"; else echo "notapro" ?>">				  
		  <?=$sNota[$aCurmat['num_mat']]?>
		  </span></td>
	    <td class="worizq"><a href="" onclick="del_estureeval('<?=$aCurmat['num_mat']?>'); return false;" class="enlaceb"><img src="../images/drop.png" alt="Eliminar" width="16" height="16" /></a></td>
	  </tr>
	  <?	$vCont++;	}	?>
	</table>
	  <a href="" onclick="getreevalestu(); return false;" title="Agregar estudiantes" class="linkboton" ><img src="../images/bnuevoest.png" width="100" height="24"></a>
	  
	  <?
		if(!empty($sEstudia['cod_act']))
		{
			if(empty($sNota))
			{
				$sUsercoo['upin'] = 'i';
	  ?>
	  <a href="" title="Guardar" class="linkboton" onClick = "getnotareeval(); return false"><img src="../images/bingnota.png" width="100" height="24"></a>
	  <?
			}
			else
			{
				$sUsercoo['upin'] = 'u';
	  ?>
    <a href="" onClick="getnotareeval(); return false;" title="Modificar" class="linkboton" ><img src="../images/beditnota.png" width="100" height="24"></a>
	<?
		}	}
	?>
	<a href="rva_selectsem.php" title="Ver reevaluaciones" class="linkboton"><img src="../images/bviewreeval.png" width="100" height="24"></a>
	<a href="rva_selectcurso.php" title="Nueva Notas" class="linkboton" ><img src="../images/bnuevoreeval.png" width="100" height="24"></a>
	<a href="prnrelaree.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
	<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>

		
		
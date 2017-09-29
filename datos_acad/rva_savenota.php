<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		
		if($sUsercoo['upin'] == 'u')
		{		
			if(!empty($sNotas))
			foreach($sNotas as $vNum_mat => $vNot_cur)
			{
				if($vNot_cur != 'sn')
				{	
					$vQuery = "Update $tNota set not_cur = '$vNot_cur' where num_mat = '$vNum_mat' and ";
					$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' and ";
					$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' and mod_not = '{$sEstudia['mod_not']}' and ";
					$vQuery .= "ano_aca = '{$sUsercoo['ano_aca']}' and per_aca = '{$sUsercoo['per_aca']}' ";
					$cResult = fInupde($vQuery);
					if($cResult)
					{	
						$vQuery = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, per_aca, not_cur, ";
						$vQuery .= " cod_act, fch_not) values ";
						$vQuery .= "('$vNum_mat', '{$sUsercoo['cod_car']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', ";
						$vQuery .= "'{$sEstudia['mod_not']}', '{$sUsercoo['ano_aca']}', '{$sUsercoo['per_aca']}', '$vNot_cur', ";
						$vQuery .= "'{$sEstudia['cod_act']}', now()) ";
						$cResult = fInupde($vQuery);
					}
				}
				
			}
		}
		elseif($sUsercoo['upin'] == 'i') 
		{
			if(!empty($sNotas))
			foreach($sNotas as $vNum_mat => $vNot_cur)
			{
				if($vNot_cur != 'sn')
				{
					$vQuery = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, per_aca, not_cur, ";
					$vQuery .= " cod_act, fch_not) values ";
					$vQuery .= "('$vNum_mat', '{$sUsercoo['cod_car']}', '{$sEstudia['pln_est']}', '{$sEstudia['cod_cur']}', ";
					$vQuery .= "'{$sEstudia['mod_not']}', '{$sUsercoo['ano_aca']}', '{$sUsercoo['per_aca']}', '$vNot_cur', ";
					$vQuery .= "'{$sEstudia['cod_act']}', now()) ";
					$cResult = fInupde($vQuery);
				}				
			}	
		}
	
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
			$vQuery .= "$tNota.per_aca = '{$sUsercoo['per_aca']}' ";
			$cNota = fQuery($vQuery);
			while($aNota = $cNota->fetch_array())
			{
				$sNota[$aNota['num_mat']] = $aNota['not_cur'];
			}						
			
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
		}
	?>
	<a href="rva_selectsem.php" title="Ver reevaluaciones" class="linkboton"><img src="../images/bviewreeval.png" width="100" height="24"></a>
	<a href="rva_selectcurso.php" title="Nueva Notas" class="linkboton" ><img src="../images/bnuevoreeval.png" width="100" height="24"></a>


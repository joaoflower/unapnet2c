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
      </tr>
		<?	$vCont = 1;
			$sNota = "";
			$sNotas = "";
			
			$vQuery = "Select num_mat, not_cur ";
			$vQuery .= "from $tNota ";
			$vQuery .= "where $tNota.pln_est = '{$sEstudia['pln_est']}' and $tNota.cod_cur = '{$sEstudia['cod_cur']}' and ";
			$vQuery .= "$tNota.mod_not = '{$sEstudia['mod_not']}' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
			//$vQuery .= "$tNota.mod_not = '13' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
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
		<td class="worizq"><input name="rNot_cur<?=$aCurmat['num_mat']?>" type="text" class="textnota<?	if($sNota[$aCurmat['num_mat']] < 11) echo "de"; else echo "ap" ?>" id="rNot_cur<?=$aCurmat['num_mat']?>" value="<?=$sNota[$aCurmat['num_mat']]?>" size="2" maxlength="2" onKeyUp="checknota(this, '<?=$sIngnota[$aCurmat['num_mat']]?>')" onblur="regnotaing('<?=$aCurmat['num_mat']?>', this)"></td>
      </tr>
	  <?	$vCont++;	}	?>
	</table>
	
	<a href="" title="Guardar" class="linkboton" onClick = "savenotareeval(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="" onClick="viewreevalnota(); return false;" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>
	  
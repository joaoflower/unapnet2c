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
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

	<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
	  <tr>
		<th width="30" scope="col">&nbsp;</th>
		<th width="55" scope="col">Num.mat</th>
		<th width="270" scope="col">Apellidos y Nombres </th>
		<th width="90" scope="col">Mod. Mat. </th>
		<th width="25" scope="col">Nota</th>
	  </tr>
		<?	$vCont = 1;
			$sNota = "";
			
			$vQuery = "Select est.num_mat, est.paterno, est.materno, est.nombres, cm.mod_mat, no.not_cur ";
			$vQuery .= "from $tCurmat cm left join unapnet.estudiante est on cm.num_mat = est.num_mat and ";
			$vQuery .= "cm.cod_car = est.cod_car ";
			$vQuery .= "left join $tNota no on cm.num_mat = no.num_mat and cm.pln_est = no.pln_est and ";
			$vQuery .= "cm.cod_cur = no.cod_cur and cm.ano_aca = no.ano_aca and cm.per_aca = no.per_aca ";
			$vQuery .= "where cm.pln_est = '{$sEstudia['pln_est']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "cm.cod_cur = '{$sEstudia['cod_cur']}' and cm.sec_gru = '{$sEstudia['sec_gru']}' and ";
			if($sPlan[$sEstudia['pln_est']]=='2')
				$vQuery .= "no.not_cur >= 8 and no.not_cur <= 10 and "; 
			else if($sPlan[$sEstudia['pln_est']]=='1')
				$vQuery .= "no.not_cur >= 6 and no.not_cur <= 10 and "; 
			$vQuery .= "cm.num_mat not in  (select num_mat from $tApla where ";
			$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "pln_est = '{$sEstudia['pln_est']}' and cod_cur = '{$sEstudia['cod_cur']}' and ";
			$vQuery .= "sec_gru = '{$sEstudia['sec_gru']}' ) ";
			$vQuery .= "order by paterno, materno, nombres";
			$cCurmat = fQuery($vQuery);
			while($aCurmat = $cCurmat->fetch_array())
			{
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><input name="rEstureeval[<?=$aCurmat['num_mat']?>]" type="checkbox" id="rEstureeval[<?=$aCurmat['num_mat']?>]" value="checkbox" onClick="pintar(this)" /></td>
		<td class="wordcen"><?=$aCurmat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
		<td class="wordizq">&nbsp;<?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
		<td class="worizq">&nbsp;
		  <span class ="<?	if($aCurmat['not_cur'] < 11) echo "notades"; else echo "notapro" ?>">				  
		  <?=$aCurmat['not_cur']?>
		  </span></td>
	  </tr>
	  <?	$vCont++;	}	?>
	</table>
	<a href="" title="Guardar" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="" onClick="viewreevalnota(); return false;" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vCod_act = $_GET['rCod_act'];
		
		$bDatos = FALSE;
		
		$tActa = "unapnet.acta{$sUsercoo['ano_aca']}";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		
		$vQuery = "select * from $tActa where cod_act = '$vCod_act' and cod_car = '{$sUsercoo['cod_car']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}'";
		if(!empty($vCod_act))
		{
			$bDatos = TRUE;
			$cActa = fQuery($vQuery);
			if($aActa = $cActa->fetch_array())
			{
				$vQuery = "select distinct c.pln_est, c.cod_cur,c.nom_cur,c.niv_est,c.sem_anu,cm.sec_gru,c.cod_esp,mm.mod_act ";
				$vQuery .= "from $tCurmat cm left join unapnet.curso c on cm.cod_car = c.cod_car and ";
				$vQuery .= "cm.pln_est = c.pln_est and cm.cod_cur = c.cod_cur ";
				$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
				$vQuery .= "where cm.ano_aca = '{$sUsercoo['ano_aca']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
				$vQuery .= "cm.pln_est = '{$aActa['pln_est']}' and cm.cod_cur = '{$aActa['cod_cur']}' and  ";
				$vQuery .= "mm.mod_act = '{$aActa['mod_mat']}' and cm.sec_gru = '{$aActa['sec_gru']}' ";
			}
		}						
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
  
  	<? 	
  	$vCont = 1;
	if($bDatos == TRUE)
	{
		$cCurmat = fQuery($vQuery);
		
		$sUsercoo['can_est'] = $cCurmat->num_rows;
		
		while($aCurmat = $cCurmat->fetch_array())
		{
  	?>
  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
    <td width="13" class="wordder"><?=$vCont?></td>
    <td width="33">&nbsp;<?=$aCurmat['pln_est']?></td>
    <td width="33">&nbsp;<?=$aCurmat['cod_cur']?></td>
    <td width="258" class="wordizq">&nbsp;<?=ucwords(strtolower($aCurmat['nom_cur']))?></td>
    <td width="33">&nbsp;<?=$aCurmat['niv_est']?></td>
    <td width="33">&nbsp;<?=$aCurmat['sem_anu']?></td>
    <td width="18">&nbsp;<?=$aCurmat['cod_esp']?></td>
    <td width="45" class="wordizq">&nbsp;<?=ucwords(strtolower($sGrupo[$aCurmat['sec_gru']]))?></td>
    <td width="78" class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aCurmat['mod_act']]))?></td>
    <td width="16"><a href="" onClick="viewingcurso('<?=$aCurmat['pln_est']?>', '<?=$aCurmat['cod_cur']?>', '<?=$aCurmat['sec_gru']?>', '<?=$aCurmat['mod_act']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver detalles" width="16" height="16" /></a></td>
  </tr>
  	<? 
		$vCont++; 	
		} 
		$cCurmat->close();
	}
	?>
</table>


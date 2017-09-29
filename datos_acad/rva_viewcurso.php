<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vPln_est = $_GET['rPln_est'];
		$vCod_cur = $_GET['rCod_cur'];
		$vNom_cur = $_GET['rNom_cur'];
		$vNiv_est = $_GET['rNiv_est'];
		$vSem_anu = $_GET['rSem_anu'];
		
		$bDatos = FALSE;
		
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		
		$aApla = "";
		$vQuery = "select concat(pln_est, cod_cur, sec_gru) as pcs from $tApla where cod_car = '{$sUsercoo['cod_car']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' ";
		$cApla = fQuery($vQuery);
		while($aApla2 = $cApla->fetch_array())
		{
			$aApla[$aApla2['pcs']] = 1;
		}
		
		$vQuery = "select distinct c.pln_est, c.cod_cur, c.nom_cur, c.niv_est, c.sem_anu, cm.sec_gru, c.cod_esp ";
		$vQuery .= "from $tCurmat cm left join unapnet.curso c on cm.cod_car = c.cod_car and ";
		$vQuery .= "cm.pln_est = c.pln_est and cm.cod_cur = c.cod_cur ";
		$vQuery .= "where cm.ano_aca = '{$sUsercoo['ano_aca']}' and cm.per_aca = '{$sUsercoo['per_aca']}' ";
/*		$vQuery .= "concat(cm.pln_est, cm.cod_cur, cm.sec_gru) not in (select distinct concat(pln_est, cod_cur, sec_gru) ";
		$vQuery .= "as pln_cur from  $tApla where per_aca = '{$sUsercoo['per_aca']}' and cod_car = '{$sUsercoo['cod_car']}') ";*/
		
		if((!empty($vPln_est) or !empty($vCod_cur) or !empty($vNom_cur) or !empty($vNiv_est) or !empty($vSem_anu)))
		{
			if(!empty($vPln_est))
				$vQuery .= "and cm.pln_est = '$vPln_est' ";
			if(!empty($vCod_cur))
				$vQuery .= "and cm.cod_cur = '$vCod_cur' ";			
			if(!empty($vNom_cur))
				$vQuery .= "and c.nom_cur like '$vNom_cur%' ";
			if(!empty($vNiv_est))
				$vQuery .= "and c.niv_est = '$vNiv_est' ";
			if(!empty($vSem_anu))
				$vQuery .= "and c.sem_anu = '$vSem_anu' ";
				
			$vQuery .= " order by pln_est, niv_est, sem_anu, cod_esp, cod_cur, sec_gru limit 10 ";
			$bDatos = TRUE;
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
		
//		$sUsercoo['can_est'] = $cCurmat->num_rows;
		
		while($aCurmat = $cCurmat->fetch_array())
		{
			if(empty($aApla[$aCurmat['pln_est'].$aCurmat['cod_cur'].$aCurmat['sec_gru']]))
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
    <td width="16"><a href="" onClick="viewreevalcurso('<?=$aCurmat['pln_est']?>', '<?=$aCurmat['cod_cur']?>', '<?=$aCurmat['sec_gru']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver detalles" width="16" height="16" /></a></td>
  </tr>
  	<? 
		$vCont++; 	
			} 	
		}
		$cCurmat->close();
	}
	?>
</table>


<?php
	$sConedb['host'] = '10.1.1.138';
	$sConedb['user'] = 'todos';
	$sConedb['passwd'] = 'master2005';
	
	$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
	$vTotal = 0;
	
	for($vCont = '4'; $vCont <= '4';$vCont++)
	{
		if(strlen($vCont) == 1)
			$cCont = '0'.$vCont;
		else
			$cCont = $vCont;
			
		
		$tCurmat = "unapnet.curtut".$cCont."2005";
		$tMatri = "unapnet.estutut".$cCont."2005";
		$tPlan = "unapnet.curso";
		
		$sGrupo['01'] = "Unico";
		$sGrupo['02'] = "Grupo A";
		$sGrupo['03'] = "Grupo B";
		$sGrupo['04'] = "Grupo C";
		$sGrupo['05'] = "Grupo D";
		$sGrupo['06'] = "Grupo E";
		
//		$vQuery = "Select cod_cur, nom_cur from $tPlan where cod_car";
		
		
		$vQuery = "Select $tCurmat.cod_cur, $tPlan.nom_cur, sec_gru, count(*) as canti ";
		$vQuery .= "from $tCurmat left join $tPlan on $tCurmat.pln_est = $tPlan.pln_est and $tCurmat.cod_cur = $tPlan.cod_cur and ";
		$vQuery .= "$tCurmat.cod_car = $tPlan.cod_car ";
		$vQuery .= "group by $tCurmat.cod_cur, $tCurmat.sec_gru";
		
/*		$vQuery = "Select num_mat from $tMatri";
		$cMatri = $xSerdata->query($vQuery);
		$vCanti = $cMatri->num_rows;
		$vTotal +=$vCanti;*/
		$cCurmat = $xSerdata->query($vQuery);
		
		while($aCurmat = $cCurmat->fetch_array())
		{
			echo $aCurmat['canti']. " - " .$aCurmat['cod_cur']. " - " .$aCurmat['nom_cur']. "- " .$sGrupo[$aCurmat['sec_gru']]. "<br>";
		}
	}

?>
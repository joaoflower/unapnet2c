<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
			
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
<script language="JavaScript" src="../script/function.js"></script>
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	
	function enfocar()
	{
		document.fData.rNum_mat.focus();
		//document.fdata.rLogin.select();
	}
	function del_nota(pln_est, cod_cur, mod_not, ano_aca, per_aca)
	{
		var vReturn;
		var vAtributo;
		vAtributo = "center=yes; dialogHeight=220px; dialogWidth=530px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=no; resizable=no; font-family=Arial; font-size=11px";

		vReturn = window.showModalDialog("msn_delnota.php?rPln_est="+pln_est+"&rCod_cur="+cod_cur+"&rMod_not="+mod_not+"&rAno_aca="+ano_aca+"&rPer_aca="+per_aca, "mensaje", vAtributo);
		if(vReturn == '1')
		{
			delnotaest();
		}
	}
	
	
//-->
</script>
<script type="text/javascript" src="../script/ggw3.js"></script>
</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
<div class="wordcen" id="body1">
<?
	$vCar_ini = '10';
	$vCar_fin = '10';
	
	for($vCar = $vCar_ini; $vCar <= $vCar_fin; $vCar++)
	{
		$vCod_car = '';
		if(strlen($vCar)==1)
			$vCod_car = '0';
		echo $vCod_car .= $vCar;
		
		$vAno_aca = "2006";
		$vPer_aca = "02";
//		$vCod_car = "23";
		$vMod_not = "";
		
		$tNotaca = "unapnet.notaca".$vCod_car.$vAno_aca;
		$tCurmat = "unapnet.curmat".$vCod_car.$vAno_aca;
		$tNota = "unapnet.nota".$vCod_car;
		
/*		$vQuery = "Select distinct ano_aca, per_aca, cod_car, pln_est, cod_cur ";
		$vQuery .= "from $tNotaca ";
		$vQuery .= "where ano_aca = '$vAno_aca' and per_aca = '$vPer_aca' ";
		if(!empty($vMod_not))
			$vQuery .= "and mod_not = '$vMod_not' ";
		$vQuery .= "order by ano_aca, per_aca, cod_car, pln_est, cod_cur ";*/
		
		//--------------------------- REGULARES ----------------------------------------------------
		// cursos existentes
		$vQuery = "Select distinct ano_aca, per_aca, cod_car, pln_est, cod_cur, sec_gru ";
		$vQuery .= "from $tCurmat ";
		$vQuery .= "where ano_aca = '$vAno_aca' and per_aca = '$vPer_aca' ";
/*		if(!empty($vMod_not))
			$vQuery .= "and mod_not = '$vMod_not' ";*/
		$vQuery .= "order by ano_aca, per_aca, cod_car, pln_est, cod_cur ";		
		
		$cCurso = fQuery($vQuery);	
		
		$aNotacap = "";
		$aNotaact = "";
		$aEstu = "";
			
		while($aCurso = $cCurso->fetch_array())
		{
			$bNotacap = FALSE;
			$bNotaact = FALSE;
			
			$vQuery = "Select distinct no.num_mat from $tNotaca no ";
			$vQuery .= "where no.ano_aca = '{$aCurso['ano_aca']}' and no.per_aca = '{$aCurso['per_aca']}' and ";
			$vQuery .= "no.cod_car = '{$aCurso['cod_car']}' and no.pln_est = '{$aCurso['pln_est']}' and ";
			$vQuery .= "no.cod_cur = '{$aCurso['cod_cur']}' and no.tip_not = 'C' and no.mod_not <> '08' and no.num_mat in ";
			$vQuery .= "(Select num_mat from $tCurmat where per_aca = '{$aCurso['per_aca']}' and ";
			$vQuery .= "pln_est = '{$aCurso['pln_est']}' and cod_cur = '{$aCurso['cod_cur']}' and ";
			$vQuery .= "sec_gru = '{$aCurso['sec_gru']}') limit 0, 1 ";
			
			$cEstu = fQuery($vQuery);		
			if($aEstu = $cEstu->fetch_array())
			{				
				$vQuery = "Select no.num_mat, no.mod_not, round(sum(no.not_cur)/count(*)) as not_cap ";
				$vQuery .= "from $tNotaca no ";
				$vQuery .= "where no.ano_aca = '{$aCurso['ano_aca']}' and no.per_aca = '{$aCurso['per_aca']}' and ";
				$vQuery .= "no.cod_car = '{$aCurso['cod_car']}' and no.pln_est = '{$aCurso['pln_est']}' and ";
				$vQuery .= "no.cod_cur = '{$aCurso['cod_cur']}' and no.tip_not = 'C' and no.mod_not <> '08' and no.num_mat in ";
				$vQuery .= "(Select num_mat from $tCurmat where per_aca = '{$aCurso['per_aca']}' and ";
				$vQuery .= "pln_est = '{$aCurso['pln_est']}' and cod_cur = '{$aCurso['cod_cur']}' and ";
				$vQuery .= "sec_gru = '{$aCurso['sec_gru']}')  ";
				if(!empty($vMod_not))
					$vQuery .= "and no.mod_not = '$vMod_not' ";
				$vQuery .= "group by num_mat, mod_not";
				
				$cNotacap = fQuery($vQuery);		
				while($aNotacap2 = $cNotacap->fetch_array())
				{
					$bNotacap = TRUE;
					$aNotacap[$aNotacap2['num_mat'].$aNotacap2['mod_not']] = $aNotacap2['not_cap'];
				}
					
				$vQuery = "Select no.num_mat, no.mod_not, round(sum(no.not_cur)/count(*)) as not_act ";
				$vQuery .= "from $tNotaca no ";
				$vQuery .= "where no.ano_aca = '{$aCurso['ano_aca']}' and no.per_aca = '{$aCurso['per_aca']}' and ";
				$vQuery .= "no.cod_car = '{$aCurso['cod_car']}' and no.pln_est = '{$aCurso['pln_est']}' and ";
				$vQuery .= "no.cod_cur = '{$aCurso['cod_cur']}' and no.tip_not = 'A' and no.mod_not <> '08' and no.num_mat in ";
				$vQuery .= "(Select num_mat from $tCurmat where per_aca = '{$aCurso['per_aca']}' and ";
				$vQuery .= "pln_est = '{$aCurso['pln_est']}' and cod_cur = '{$aCurso['cod_cur']}' and ";
				$vQuery .= "sec_gru = '{$aCurso['sec_gru']}')  ";
				if(!empty($vMod_not))
					$vQuery .= "and no.mod_not = '$vMod_not' ";
				$vQuery .= "group by num_mat, mod_not";
				
				$cNotaact = fQuery($vQuery);		
				while($aNotaact2 = $cNotaact->fetch_array())
				{
					$bNotaact = TRUE;
					$aNotaact[$aNotaact2['num_mat'].$aNotaact2['mod_not']] = $aNotaact2['not_act'];
				}
				
				if($bNotacap)
				{
					$vQuery = "Select distinct no.num_mat, no.mod_not ";
					$vQuery .= "from $tNotaca no ";
					$vQuery .= "where no.ano_aca = '{$aCurso['ano_aca']}' and no.per_aca = '{$aCurso['per_aca']}' and ";
					$vQuery .= "no.cod_car = '{$aCurso['cod_car']}' and no.pln_est = '{$aCurso['pln_est']}' and ";
					$vQuery .= "no.cod_cur = '{$aCurso['cod_cur']}' and no.mod_not <> '08' and no.num_mat in ";
					$vQuery .= "(Select num_mat from $tCurmat where per_aca = '{$aCurso['per_aca']}' and ";
					$vQuery .= "pln_est = '{$aCurso['pln_est']}' and cod_cur = '{$aCurso['cod_cur']}' and ";
					$vQuery .= "sec_gru = '{$aCurso['sec_gru']}') ";
					if(!empty($vMod_not))
						$vQuery .= "and no.mod_not = '$vMod_not' ";
					
					$cEstu = fQuery($vQuery);		
					while($aEstu2 = $cEstu->fetch_array())
					{
						$vPC = 0;
						$vPA = 0;
						$vPF = 0;
	
						$vPC = $aNotacap[$aEstu2['num_mat'].$aEstu2['mod_not']];
						if($bNotaact)
						{
							$vPA = $aNotaact[$aEstu2['num_mat'].$aEstu2['mod_not']];
							$vPF = round(($vPC*0.9)+$vPA);
							
							$vQuery = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, ";
							$vQuery .= "per_aca, not_cap, not_act, not_cur, cod_act, fch_not, mod_ing) values ";
							$vQuery .= "('{$aEstu2['num_mat']}', '{$aCurso['cod_car']}', '{$aCurso['pln_est']}', ";
							$vQuery .= "'{$aCurso['cod_cur']}', '{$aEstu2['mod_not']}', '{$aCurso['ano_aca']}', ";
							$vQuery .= "'{$aCurso['per_aca']}', '$vPC', '$vPA', '$vPF', '', now(), '02')";					
						}
						else
						{
							$vPF = round($vPC);
							$vQuery = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, ";
							$vQuery .= "per_aca, not_cap, not_cur, cod_act, fch_not, mod_ing) values ";
							$vQuery .= "('{$aEstu2['num_mat']}', '{$aCurso['cod_car']}', '{$aCurso['pln_est']}', ";
							$vQuery .= "'{$aCurso['cod_cur']}', '{$aEstu2['mod_not']}', '{$aCurso['ano_aca']}', ";
							$vQuery .= "'{$aCurso['per_aca']}', '$vPC', '$vPF', '', now(), '02')";		
						}
						$cResult = fInupde($vQuery);				
					}
				}
			}
//			$cEstu->close();
		}
	}	
	
	
?>

</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>

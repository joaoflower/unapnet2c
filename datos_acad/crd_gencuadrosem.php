<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{		
		$sEstudia = "";
		$sUsercoo['sem_anu'] = $_GET['rSem_anu'];
		$vCont = 1;
		$vTercio = 0;
		$vQuinto = 0;
		
		//--------- Modalidad del cuadro de méritos --------------
		$sMod_cdo = "";
		$sMod_cdo['01'] = 0;
		$sMod_cdo['06'] = 1;
		$sMod_cdo['18'] = 2;
		$sMod_cdo['07'] = 3;
		$sMod_cdo['08'] = 4;
		$sMod_cdo['11'] = 5;
		$sMod_cdo['13'] = 6;
		$sMod_cdo['14'] = 7;
		$sMod_cdo['15'] = 8;
		$sMod_cdo['16'] = 9;
			
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
<script type="text/javascript" src="../script/ggw3.js"></script>
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>		
	function start()
	{
//		document.fData.rPln_est.focus();
	}
	function cerrar(pReturn)
	{
		document.fData.rReturn.value = pReturn;
		window.close();
	}
//-->
</script>
</head>

<body onLoad="start();" onUnload="window.returnValue = document.fData.rReturn.value">
	<div class="headerow">
		<div class="headercol"><img src="../images/cabe_r1_c1.jpg" width="565" height="21"></div>
		<div class="headercol"><a href="http://www.unap.edu.pe" target="home" onMouseOver="MM_swapImage('cabe_r1_c6','','../images/cabe_r1_c6_f2.jpg',1);" onMouseOut="MM_swapImgRestore();"><img name="cabe_r1_c6" src="../images/cabe_r1_c6.jpg" width="60" height="21" border="0" alt=""></a></div>
		<div class="headercol"><a href="http://webmail.unap.edu.pe" target="webmail" onMouseOver="MM_swapImage('cabe_r1_c8','','../images/cabe_r1_c8_f2.jpg',1);" onMouseOut="MM_swapImgRestore();"><img name="cabe_r1_c8" src="../images/cabe_r1_c8.jpg" width="65" height="21" border="0" alt=""></a></div>
		<div class="headercol"><img name="cabe_r1_c10" src="../images/cabe_r1_c10.jpg" width="80" height="21" border="0" alt=""></div>
	</div>
	<div class="headerow">
		<div class="headercol"><img name="cabe_r2_c1" src="../images/cabe_r2_c1.jpg" width="770" height="3" border="0" alt=""></div>
	</div>
	<div class="headerow">
		<div class="headercol"><img name="cabe_r3_c1" src="../images/cabe_r3_c1.jpg" width="203" height="18" border="0" alt=""></div>
		<div class="headermsn"><span class="wordizqb">[<?=$sCarrera[$sUsercoo['cod_car']]?> - CUADRO DE M&Eacute;RITOS DEL SEMESTRE : <?=$sSemestre[$sUsercoo['sem_anu']]?>]</span></div>
		<div class="headercol"><img name="cabe_r3_c10" src="../images/cabe_r3_c10.jpg" width="80" height="18" border="0" alt=""></div>
	</div>
	<div class="headerow">
		<div class="headercol"><img name="cabe_r4_c1" src="../images/cabe_r4_c1.jpg" width="770" height="4" border="0" alt=""></div>
	</div>
<div class="headerow">
		<div class="headercol"><img name="cabe_r5_c1" src="../images/cabe_r5_c1.jpg" width="203" height="17" border="0" alt=""></div>
		<div class="headercol"><img name="cabe_r5_c10" src="../images/cabe_msn2.jpg" width="487" height="17" border="0" alt=""></div>
		<div class="headercol"><img name="cabe_r5_c10" src="../images/cabe_r5_c10.jpg" width="80" height="17" border="0" alt=""></div>
	</div>
	<div class="headerow">
		<div class="headercol"><img name="cabe_r6_c1" src="../images/cabe_r6_c1.jpg" width="770" height="7" border="0" alt=""></div>
	</div>

<form action="" method="get" name="fData" id="fData">
	<input name="rReturn" type="hidden" id="rReturn" value="1">
  <div align="center" class="wordcen" id="body2">
  <?
  	$vCrd_ini = 0;
	$vCrd_fin = 0;
	$vCrd_sem = 0;
	
	$sEstucdo = "";
	$sEstukey = "";
	$sEstunota = "";
	$vCan_mat = 0;
	$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
	$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
	$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
  	
//	$vQuery = "Select distinct pln_est from $tEstumat where (per_aca = '01' or per_aca = '02') order by pln_est";
	$vQuery = "Select distinct em.pln_est ";
	$vQuery .= "from $tEstumat em left join unapnet.plan pl on em.cod_car = pl.cod_car and em.pln_est = pl.pln_est ";
	$vQuery .= "where em.per_aca = '{$sUsercoo['per_aca']}' and pl.tip_sist = '2' order by pln_est";
	$cPlan = fQuery($vQuery);	
	while($aPlan = $cPlan->fetch_array())
	{
		$vCrd_ini = $sCredisem[$aPlan['pln_est'].$sUsercoo['sem_anu']]['crd_ini'];
		$vCrd_fin = $sCredisem[$aPlan['pln_est'].$sUsercoo['sem_anu']]['crd_fin'];
		$vCrd_sem = ($sCredisem[$aPlan['pln_est'].$sUsercoo['sem_anu']]['crd_sem'] * 0.75);
		
		$sUsercoo['crd_ini'] = $vCrd_ini;
		$sUsercoo['crd_fin'] = $vCrd_fin;
		$sUsercoo['crd_sem'.$aPlan['pln_est']] = $vCrd_sem;

		if(!empty($vCrd_ini) and !empty($vCrd_fin))		
		{
			//-----------------------------------
			if($sUsercoo['per_aca'] == '01')
			{
				$vQuery = "select no.num_mat, no.pln_est, sum(cu.crd_cur) as all_crd, ";
				$vQuery .= "concat(es.paterno, ' ', es.materno, ', ', es.nombres) as nombre ";
				$vQuery .= "from $tNota no left join unapnet.curso cu on no.cod_car = cu.cod_car and ";
				$vQuery .= "no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
				$vQuery .= "left join unapnet.estudiante es on no.cod_car = es.cod_car and no.num_mat = es.num_mat ";
				
				$vQuery .= "where no.not_cur > 10 and ( no.ano_aca < '{$sUsercoo['ano_aca']}' or ";
				
				$vQuery .= "(no.ano_aca = '{$sUsercoo['ano_aca']}' and no.per_aca = '{$sUsercoo['per_aca']}') ) and ";
				
				$vQuery .= "no.pln_est = '{$aPlan['pln_est']}' and no.num_mat in (select distinct num_mat from $tEstumat ";
				$vQuery .= "where per_aca = '{$sUsercoo['per_aca']}' and pln_est = '{$aPlan['pln_est']}' and mod_mat != '17') ";
				$vQuery .= "group by num_mat, pln_est ";
				$vQuery .= "having all_crd >= '$vCrd_ini' and all_crd <= '$vCrd_fin'";
			}
			elseif($sUsercoo['per_aca'] == '02')
			{
				$vQuery = "select no.num_mat, no.pln_est, sum(cu.crd_cur) as all_crd, ";
				$vQuery .= "concat(es.paterno, ' ', es.materno, ', ', es.nombres) as nombre ";
				$vQuery .= "from $tNota no left join unapnet.curso cu on no.cod_car = cu.cod_car and ";
				$vQuery .= "no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
				$vQuery .= "left join unapnet.estudiante es on no.cod_car = es.cod_car and no.num_mat = es.num_mat ";
				$vQuery .= "where no.not_cur > 10 and ( no.ano_aca < '{$sUsercoo['ano_aca']}' or ";
				
				if($sUsercoo['cod_car'] == '25' or $sUsercoo['cod_car'] == '16')
				{
					$vQuery .= "(no.ano_aca = '{$sUsercoo['ano_aca']}' and (no.per_aca = '01' or no.per_aca = '02' or no.per_aca = '03') ) ) and "; // or no.per_aca = '03')
				}
				else
				{
					$vQuery .= "(no.ano_aca = '{$sUsercoo['ano_aca']}' and (no.per_aca = '01' or no.per_aca = '02') ) ) and "; // or no.per_aca = '03')
				}
				
				$vQuery .= "no.pln_est = '{$aPlan['pln_est']}' and no.num_mat in (select distinct num_mat from $tEstumat ";
				$vQuery .= "where per_aca = '{$sUsercoo['per_aca']}' and pln_est = '{$aPlan['pln_est']}' and mod_mat != '17') ";
				$vQuery .= "group by num_mat, pln_est ";
				$vQuery .= "having all_crd >= '$vCrd_ini' and all_crd <= '$vCrd_fin'";
			}
			//--------------------------------------
			$cEstuplan = fQuery($vQuery);
			while($aEstuplan = $cEstuplan->fetch_array())
			{
				$sEstucdo[$aEstuplan['num_mat']]['num_mat'] = $aEstuplan['num_mat'];
				$sEstucdo[$aEstuplan['num_mat']]['nombre'] = $aEstuplan['nombre'];
				$sEstucdo[$aEstuplan['num_mat']]['pln_est'] = $aEstuplan['pln_est'];
				$sEstucdo[$aEstuplan['num_mat']]['cod_esp'] = '';
				$sEstucdo[$aEstuplan['num_mat']]['prd_acu'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_mat'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_apb'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_des'] = 0;
				
				$sEstucdo[$aEstuplan['num_mat']]['prd_sem1'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_mat1'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_apb1'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_des1'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['mod_mat1'] = "";
				$sEstucdo[$aEstuplan['num_mat']]['ord_mat1'] = "";
				$sEstucdo[$aEstuplan['num_mat']]['crd_con1'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_not1'] = 0;
				
				$sEstucdo[$aEstuplan['num_mat']]['prd_sem2'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_mat2'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_apb2'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_des2'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['mod_mat2'] = "";
				$sEstucdo[$aEstuplan['num_mat']]['ord_mat2'] = "";
				$sEstucdo[$aEstuplan['num_mat']]['crd_con2'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_not2'] = 0;
				
				$sEstucdo[$aEstuplan['num_mat']]['mod_mat'] = "";
				
				$sEstukey[$aEstuplan['num_mat']] = "";
				$sEstunota[$aEstuplan['num_mat']] = 0;
			}
			$cEstuplan->close();
		}
	}
	$cPlan->close();
	
	if(!empty($sEstucdo))
	foreach($sEstucdo as $vNum_mat => $aEstucdo)
	{
		$vPer_aca = 2;
		// --------------------- Modalidad de Matricula del semestre actual --------------
		$vQuery = "select em.per_aca, em.mod_mat, em.cod_esp, em.tot_crd, mm.ord_mat ";
		$vQuery .= "from $tEstumat em left join unapnet.modmat mm on em.mod_mat = mm.mod_mat where em.num_mat = '$vNum_mat' and ";
		$vQuery .= "em.per_aca = '{$sUsercoo['per_aca']}' order by per_aca"	;
		$cEstumat = fQuery($vQuery);
		while($aEstumat = $cEstumat->fetch_array())
		{
			$sEstucdo[$vNum_mat]['mod_mat1'] = $aEstumat['mod_mat'];
			$sEstucdo[$vNum_mat]['ord_mat1'] = $aEstumat['ord_mat'];
			$vPer_aca -= 1;
			$sEstucdo[$vNum_mat]['cod_esp'] = $aEstumat['cod_esp'];
		}
		$cEstumat->close();
		
		$sEstukey[$vNum_mat] .= (string)$vPer_aca;		
		
		// ----------------------- Créditos matriculados en el semestre actual ---------------------
		$vQuery = "select cm.per_aca, sum(cu.crd_cur) as tot_crd, count(*) as tot_cur ";
		$vQuery .= "from $tCurmat cm left join unapnet.curso cu on cm.cod_car = cu.cod_car and cm.pln_est = cu.pln_est and ";
		$vQuery .= "cm.cod_cur = cu.cod_cur where cm.num_mat = '$vNum_mat' and cm.per_aca = '{$sUsercoo['per_aca']}' ";
		$vQuery .= "group by per_aca";
		$cCurmat = fQuery($vQuery);
		while($aCurmat = $cCurmat->fetch_array())
		{
			$sEstucdo[$vNum_mat]['crd_mat1'] = round($aCurmat['tot_crd'], 1);
		}
		$cCurmat->close();		
		$sEstucdo[$vNum_mat]['crd_mat'] = round($sEstucdo[$vNum_mat]['crd_mat1'] + $sEstucdo[$vNum_mat]['crd_mat2'], 1);
		
		// ------------------------------Creditos semestrales y Promedio semestral ---------------------
		$vQuery = "select no.per_aca, sum(cu.crd_cur) as tot_crd, sum(if(no.not_cur > 10, cu.crd_cur, 0)) as crd_apb, ";
		$vQuery .= "sum(if(no.not_cur <= 10, cu.crd_cur, 0)) as crd_des, sum(cu.crd_cur*no.not_cur) as crd_not ";
		$vQuery .= "from $tNota no left join unapnet.curso cu on no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and ";
		$vQuery .= "no.cod_cur = cu.cod_cur ";
		$vQuery .= "where no.num_mat = '$vNum_mat' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
		$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "(no.mod_not = '01' or no.mod_not = '07' or no.mod_not = '10' or ";
		$vQuery .= "no.mod_not = '11' or no.mod_not = '14' or no.mod_not = '15' or no.mod_not = '16' or no.mod_not = '17' or no.mod_not = '12' or no.mod_not = '13' or ";
		$vQuery .= "no.mod_not = '18' or no.mod_not = '19' or no.mod_not = '20' or no.mod_not = '21' or no.mod_not = '22' or ";
		$vQuery .= "no.mod_not = '23' or no.mod_not = '24' or no.mod_not = '25' or no.mod_not = '26' or no.mod_not = '27' or ";
		$vQuery .= "no.mod_not = '28' or no.mod_not = '29' or no.mod_not = '30' or no.mod_not = '31' or no.mod_not = '32' or no.mod_not = '33' ) group by per_aca";
		$cNota = fQuery($vQuery);
		while($aNota = $cNota->fetch_array())
		{
			$sEstucdo[$vNum_mat]['crd_apb1'] = round($aNota['crd_apb'], 1);
			$sEstucdo[$vNum_mat]['crd_des1'] = round($aNota['crd_des'], 1);
			$sEstucdo[$vNum_mat]['crd_con1'] = $aNota['tot_crd'];
			$sEstucdo[$vNum_mat]['crd_not1'] = $aNota['crd_not'];
			if($aNota['tot_crd'] > 0)
				$sEstucdo[$vNum_mat]['prd_sem1'] = (float)round($aNota['crd_not']/$aNota['tot_crd'], 2);
		}
		$cNota->close();
		
		//------------------------------ Promedio acumulativo ------------------------------------
		$sEstucdo[$vNum_mat]['crd_apb'] = round($sEstucdo[$vNum_mat]['crd_apb1'] + $sEstucdo[$vNum_mat]['crd_apb2'], 1);
		$sEstucdo[$vNum_mat]['crd_des'] = round($sEstucdo[$vNum_mat]['crd_des1'] + $sEstucdo[$vNum_mat]['crd_des2'], 1);
		if(($sEstucdo[$vNum_mat]['crd_con1'] + $sEstucdo[$vNum_mat]['crd_con2']) > 0)
			$sEstucdo[$vNum_mat]['prd_acu'] = (float)round(($sEstucdo[$vNum_mat]['crd_not1'] + $sEstucdo[$vNum_mat]['crd_not2']) / ($sEstucdo[$vNum_mat]['crd_con1'] + $sEstucdo[$vNum_mat]['crd_con2']), 2);
		
		
				//-------------------------NEW aprobados > 0 y promedio > 0----------------------
		if($sEstucdo[$vNum_mat]['crd_apb'] > 0)
			$sEstukey[$vNum_mat] .= '0';
		else
			$sEstukey[$vNum_mat] .= '1';
			
		if($sEstucdo[$vNum_mat]['prd_acu'] > 0)
			$sEstukey[$vNum_mat] .= '0';
		else
			$sEstukey[$vNum_mat] .= '1';
		//----------------------------------------------
		
		// ---------------------------------------------------
		$sEstunota[$vNum_mat] = $sEstucdo[$vNum_mat]['prd_acu'];
		
		if(($sEstucdo[$vNum_mat]['crd_apb'] >= $sUsercoo['crd_sem'.$sEstucdo[$vNum_mat]['pln_est']]) or $sEstucdo[$vNum_mat]['mod_mat1'] == '19')
		{
			$sEstukey[$vNum_mat] .= '0';
		}
		else
		{
			$sEstukey[$vNum_mat] .= '1';
		}

		// ---------------------------------Crd des = Crd. Mat - Crd. Aprb------------------
		$vCrd_des = 0;
		$vCrd_des = round($sEstucdo[$vNum_mat]['crd_mat'] - $sEstucdo[$vNum_mat]['crd_apb'], 0);
		if(strlen((string)$vCrd_des) == 1)
			$sEstukey[$vNum_mat] .= '0';
		$sEstukey[$vNum_mat] .= (string)$vCrd_des;

		// -------------------------------Modalidad de matricula por Semestre --------------------
/*		$vCan_mat = 99;
		if(!empty($sEstucdo[$vNum_mat]['mod_mat1']) && !empty($sEstucdo[$vNum_mat]['mod_mat2']))
			$vCan_mat = $sMod_cdo[$sEstucdo[$vNum_mat]['mod_mat1']] + $sMod_cdo[$sEstucdo[$vNum_mat]['mod_mat2']];
		elseif(empty($sEstucdo[$vNum_mat]['mod_mat1']))
			$vCan_mat = 10 + $sMod_cdo[$sEstucdo[$vNum_mat]['mod_mat2']];
		elseif(empty($sEstucdo[$vNum_mat]['mod_mat2']))
			$vCan_mat = 10 + $sMod_cdo[$sEstucdo[$vNum_mat]['mod_mat1']];
		if(strlen((string)$vCan_mat) == 1)
			$sEstukey[$vNum_mat] .= '0';
		$sEstukey[$vNum_mat] .= (string)$vCan_mat;		*/
		$vCan_mat = 99;
		if(!empty($sEstucdo[$vNum_mat]['ord_mat1']) && !empty($sEstucdo[$vNum_mat]['ord_mat2']))
			$vCan_mat = $sEstucdo[$vNum_mat]['ord_mat1'] + $sEstucdo[$vNum_mat]['ord_mat2'];
		elseif(empty($sEstucdo[$vNum_mat]['ord_mat1']))
			$vCan_mat = 10 + $sEstucdo[$vNum_mat]['ord_mat2'];
		elseif(empty($sEstucdo[$vNum_mat]['ord_mat2']))
			$vCan_mat = 10 + $sEstucdo[$vNum_mat]['ord_mat1'];
		if(strlen((string)$vCan_mat) == 1)
			$sEstukey[$vNum_mat] .= '0';
		$sEstukey[$vNum_mat] .= (string)$vCan_mat;	
						
		
		
		
		
		// --------------------------------End Conditional-------------------
		$vCrd_inv = $sEstucdo[$vNum_mat]['crd_mat'] - $sEstucdo[$vNum_mat]['crd_apb'];
		$vCrd_des = $sEstucdo[$vNum_mat]['crd_des'];
		$vCrd_sno = $sEstucdo[$vNum_mat]['crd_mat'] - ($sEstucdo[$vNum_mat]['crd_apb'] + $sEstucdo[$vNum_mat]['crd_des']);
		if($vCrd_inv == 0)
			$sEstucdo[$vNum_mat]['mod_mat'] = "INVICTO";
		else
		{
			if($vCrd_des > 0)
			{
				$sEstucdo[$vNum_mat]['mod_mat'] = $vCrd_des." CRD. DESAP.";
			}
			if($vCrd_sno > 0)
			{
				if(empty($sEstucdo[$vNum_mat]['mod_mat']))
					$sEstucdo[$vNum_mat]['mod_mat'] = $vCrd_sno." CRD. SIN NOTA";
				else
					$sEstucdo[$vNum_mat]['mod_mat'] .= ", ".$vCrd_sno." CRD. SIN NOTA";
			}
		}
					
	}	
	arsort($sEstunota);
	reset($sEstunota);
	
	$vOrd_not = 1;
	if(!empty($sEstunota))
	foreach($sEstunota as $vNum_mat => $aPrd_acu)
	{
		if(strlen((string)$vOrd_not) == 1)
			$sEstukey[$vNum_mat] .= '00';
		if(strlen((string)$vOrd_not) == 2)
			$sEstukey[$vNum_mat] .= '0';
		$sEstukey[$vNum_mat] .= (string)$vOrd_not;
		$vOrd_not++;
	}
		
	asort($sEstukey);
	reset($sEstukey);
	
  ?>
  
  
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Cuadro de M&eacute;ritos </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  
		 <table width="868" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="25" rowspan="2">Nro</th>
              <th width="45" rowspan="2">N.Mat.</th>
              <th width="250" rowspan="2">Apellidos y Nombres </th>
              <th width="20" rowspan="2">Esp</th>
              <th width="35" rowspan="2">PPA</th>
              <th width="30" rowspan="2">CrM</th>
              <th width="30" rowspan="2">CrA</th>
              <th width="30" rowspan="2">CrD</th>
              <th colspan="5">SEMESTRE </th>
              <th colspan="5">VACACIONAL</th>
              <th>&nbsp;</th>
            </tr>
            <tr>
              <th width="35">PPS</th>
              <th width="30">CrM</th>
              <th width="30">CrA</th>
              <th width="30">CrD</th>
              <th width="20">Md</th>
              <th width="35">PPS</th>
              <th width="30">CrM</th>
              <th width="30">CrA</th>
              <th width="30">CrD</th>
              <th width="20">Md</th>
              <th width="20">Md</th>
            </tr>	
			<?
				if(!empty($sEstukey))
				foreach($sEstukey as $vNum_mat => $vKey)
				{				
//					if($sEstucdo[$vNum_mat]['crd_apb'] > 24)
					{
						$vTercio++;
					}
				
			?>	

            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)"> 
              <td class="wordcen"><?=$vCont?></td>
              <td class="wordcen">&nbsp;<?=$sEstucdo[$vNum_mat]['num_mat']?>&nbsp;</td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sEstucdo[$vNum_mat]['nombre']))?>&nbsp;</td>
              <td class="wordcen">&nbsp;<?=$sEstucdo[$vNum_mat]['cod_esp']?>&nbsp;</td>
              <td class="wordderb">&nbsp;<?=$sEstucdo[$vNum_mat]['prd_acu']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_mat']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_apb']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_des']?>&nbsp;</td>
              <td class="wordderb">&nbsp;<?=$sEstucdo[$vNum_mat]['prd_sem1']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_mat1']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_apb1']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_des1']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['mod_mat1']?>&nbsp;</td>
              <td class="wordderb">&nbsp;<?=$sEstucdo[$vNum_mat]['prd_sem2']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_mat2']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_apb2']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_des2']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['mod_mat2']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=ucwords(strtolower($sEstucdo[$vNum_mat]['']))?>&nbsp;</td>
            </tr>
			<?
				$vCont++;	}
				$sUsercoo['tercio'] = round($vTercio/3);
				$sUsercoo['quinto'] = round($vTercio/5);
			?>
          </table>
			  
		  </td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
    </table>
	  
	  <a href="prncuadrofs.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
	  <a href="prnterciofs.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/btercio.png" width="100" height="24" /></a>
	  <a href="prnquintofs.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bquinto.png" width="100" height="24" /></a>	  
    <a href="" title="Cerrar el Cuadro de Méritos" class="linkboton" onClick = "cerrar('2'); return false"><img src="../images/bclose.png" width="100" height="24"></a>	
	<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	  
  </div>
</form>

</body>
</html>
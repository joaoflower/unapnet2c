<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{		
		$sEstudia = "";

		$vCont = 1;
		$vTercio = 0;
		$vQuinto = 0;
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
  	
	$vQuery = "Select distinct em.pln_est ";
	$vQuery .= "from $tEstumat em left join unapnet.plan pl on em.cod_car = pl.cod_car and em.pln_est = pl.pln_est ";
//	$vQuery .= "where em.per_aca = '{$sUsercoo['per_aca']}' and pl.tip_sist = '2' and em.niv_est = '10' order by pln_est";
	$vQuery .= "where em.per_aca = '{$sUsercoo['per_aca']}' and pl.tip_sist = '2' order by pln_est";
	$cPlan = fQuery($vQuery);	
	while($aPlan = $cPlan->fetch_array())
	{
		$vCrd_pro = $sCuadropro[$aPlan['pln_est']];
		$sUsercoo['crd_pro'] = $vCrd_pro;

		if(!empty($vCrd_pro))
		{
			/*$vQuery = "select no.num_mat, no.pln_est, sum(cu.crd_cur) as all_crd, ";
			$vQuery .= "concat(es.paterno, ' ', es.materno, ', ', es.nombres) as nombre ";
			$vQuery .= "from $tNota no left join unapnet.curso cu on no.cod_car = cu.cod_car and ";
			$vQuery .= "no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
			$vQuery .= "left join unapnet.estudiante es on no.cod_car = es.cod_car and no.num_mat = es.num_mat ";
			$vQuery .= "where no.not_cur > 10 and no.pln_est = '{$aPlan['pln_est']}' and ";
			$vQuery .= "no.num_mat in (select distinct num_mat from $tEstumat ";
			$vQuery .= "where per_aca = '{$sUsercoo['per_aca']}' and pln_est = '{$aPlan['pln_est']}' and niv_est = '10') ";
			$vQuery .= "group by num_mat, pln_est ";
			$vQuery .= "having all_crd >= '$vCrd_pro'";*/
			
			$vQuery = "select no.num_mat, no.pln_est, sum(cu.crd_cur) as all_crd, ";
			$vQuery .= "concat(es.paterno, ' ', es.materno, ', ', es.nombres) as nombre ";
			$vQuery .= "from $tNota no left join unapnet.curso cu on no.cod_car = cu.cod_car and ";
			$vQuery .= "no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
			$vQuery .= "left join unapnet.estudiante es on no.cod_car = es.cod_car and no.num_mat = es.num_mat ";
			$vQuery .= "where no.not_cur > 10 and no.pln_est = '{$aPlan['pln_est']}' and ";
			$vQuery .= "no.num_mat in (select distinct num_mat from unapnet.estudiante ";
			$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' and ult_mat = '{$sUsercoo['ano_aca']}' and ";
			$vQuery .= "ult_per = '{$sUsercoo['per_aca']}' and con_est = '2') ";
			$vQuery .= "group by num_mat, pln_est ";
			$vQuery .= "having all_crd >= '$vCrd_pro'";

			//--------------------------------------
			$cEstuplan = fQuery($vQuery);
			while($aEstuplan = $cEstuplan->fetch_array())
			{
				$sEstucdo[$aEstuplan['num_mat']]['num_mat'] = $aEstuplan['num_mat'];
				$sEstucdo[$aEstuplan['num_mat']]['nombre'] = $aEstuplan['nombre'];
				$sEstucdo[$aEstuplan['num_mat']]['pln_est'] = $aEstuplan['pln_est'];
				$sEstucdo[$aEstuplan['num_mat']]['cod_esp'] = '';
				$sEstucdo[$aEstuplan['num_mat']]['tot_crd'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_apb'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_des'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_obl'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_opt'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_ele'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_notd'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['crd_nota'] = 0;
				$sEstucdo[$aEstuplan['num_mat']]['prd_acu'] = 0;
				
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
		
		// ------------------------------Creditos semestrales y Promedio semestral ---------------------
		$vQuery = "select sum(cu.crd_cur) as tot_crd, sum(if(no.not_cur > 10, cu.crd_cur, 0)) as crd_apb, ";
		$vQuery .= "sum(if(no.not_cur <= 10, cu.crd_cur, 0)) as crd_des, sum(cu.crd_cur*no.not_cur) as crd_notd, ";
		$vQuery .= "sum(if(no.not_cur > 10, cu.crd_cur*no.not_cur, 0)) as crd_nota,  ";
		$vQuery .= "sum(if((no.not_cur > 10 and cu.tip_cur = '01'), cu.crd_cur, 0)) as crd_obl, ";
		$vQuery .= "sum(if((no.not_cur > 10 and cu.tip_cur = '02'), cu.crd_cur, 0)) as crd_ele, ";
		$vQuery .= "sum(if((no.not_cur > 10 and cu.tip_cur = '03'), cu.crd_cur, 0)) as crd_opt ";
		$vQuery .= "from $tNota no left join unapnet.curso cu on no.cod_car = cu.cod_car and ";
		$vQuery .= "no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
		$vQuery .= "where no.num_mat = '$vNum_mat' and no.pln_est = '{$sEstucdo[$vNum_mat]['pln_est']}'";

		$cNota = fQuery($vQuery);
		while($aNota = $cNota->fetch_array())
		{
			$sEstucdo[$vNum_mat]['tot_crd'] = round($aNota['tot_crd'], 1);
			$sEstucdo[$vNum_mat]['crd_apb'] = round($aNota['crd_apb'], 1);
			$sEstucdo[$vNum_mat]['crd_des'] = round($aNota['crd_des'], 1);
			$sEstucdo[$vNum_mat]['crd_obl'] = round($aNota['crd_obl'], 1);
			$sEstucdo[$vNum_mat]['crd_opt'] = round($aNota['crd_opt'], 1);
			$sEstucdo[$vNum_mat]['crd_ele'] = round($aNota['crd_ele'], 1);
			$sEstucdo[$vNum_mat]['crd_notd'] = $aNota['crd_notd'];
			$sEstucdo[$vNum_mat]['crd_nota'] = $aNota['crd_nota'];
				
			if($aNota['crd_apb'] > 0)
				$sEstucdo[$vNum_mat]['prd_acu'] = (float)round($aNota['crd_nota']/$aNota['crd_apb'], 2);
		}
		$cNota->close();
		
		$sEstunota[$vNum_mat] = $sEstucdo[$vNum_mat]['prd_acu'];

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
		  
		 <table width="" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="25">Nro</th>
              <th width="45">N.Mat.</th>
              <th width="250">Apellidos y Nombres </th>
              <th width="35">PPA</th>
              <th width="30">CrA</th>
              <th width="30">Obl</th>
              <th width="30">Opt</th>
              <th width="30">Ele</th>
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
              <td class="wordderb">&nbsp;<?=$sEstucdo[$vNum_mat]['prd_acu']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_apb']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_obl']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_opt']?>&nbsp;</td>
              <td class="wordder">&nbsp;<?=$sEstucdo[$vNum_mat]['crd_ele']?>&nbsp;</td>
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
	  
	  <a href="prncuadrofp.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
    <a href="" title="Cerrar el Cuadro de Méritos" class="linkboton" onClick = "cerrar('2'); return false"><img src="../images/bclose.png" width="100" height="24"></a>	
	<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	  
  </div>
</form>

</body>
</html>
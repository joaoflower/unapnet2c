<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$aSem_anu = $_POST['rSem_anu'];	
		$vCont2 = 1;
		$sUsercoo['sem_anu'] = "";
		
		if(empty($aSem_anu))
			header("Location:sem_selectsem.php");

		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";	
		if(!empty($aSem_anu)) foreach($aSem_anu as $vPln_sem => $vPln_sem2)
		{
			$vSem_anu = substr($vPln_sem, 2, 2);
			if($vCont2 > 1)
				$sUsercoo['sem_anu'] .= ", ";
			$sUsercoo['sem_anu'] .= $sSemestre[$vSem_anu];
			$vCont2++;
		}		
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
//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mreportes.php"; ?>
	
	<div class="wordcen" id="body1">
	
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Estudiantes del [<?=$sUsercoo['sem_anu']?>]
          </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  
		  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
	  <tr>
		<th width="30" scope="col">Nro</th>
		<th width="55" scope="col">Num.mat</th>
		<th width="270" scope="col">Apellidos y Nombres </th>
		<th width="90" scope="col">Mod. Mat. </th>
		</tr>
		<?	$vCont = 1;
			$sEstupdf = "";
			$vPln_est = "";
			$vSem_anu = "";
			
			$vQuery = "Select est.num_mat, est.paterno, est.materno, est.nombres, em.mod_mat ";
			$vQuery .= "from $tEstumat em left join unapnet.estudiante est on em.num_mat = est.num_mat and ";
			$vQuery .= "em.cod_car = est.cod_car ";
			$vQuery .= "left join unapnet.modmat mm on em.mod_mat = mm.mod_mat ";
			$vQuery .= "where em.per_aca = '{$sUsercoo['per_aca']}' and ( ";
			
			$vCont2 = 1;
			if(!empty($aSem_anu)) foreach($aSem_anu as $vPln_sem => $vPln_sem2)
			{
				$vPln_est = substr($vPln_sem, 0, 2);
				$vSem_anu = substr($vPln_sem, 2, 2);
				$vCod_esp = substr($vPln_sem, 4, 2);				
				if($vCont2 > 1)
					$vQuery .= "or ";	
				$vQuery .= " (em.pln_est = '$vPln_est' and em.niv_est = '$vSem_anu' and em.cod_esp = '$vCod_esp') ";
				$vCont2++;
			}
/*			$vQuery .= " ) and ( ";
			$vCont2 = 1;
			if(!empty($aSem_anu)) foreach($aSem_anu as $vPln_sem => $vPln_sem2)
			{
				$vSem_anu = substr($vPln_sem, 2, 2);
				if($vCont2 > 1)
					$vQuery .= "or ";	
				$vQuery .= "em.niv_est = '$vSem_anu' ";
				$vCont2++;
			}*/

			$vQuery .= ") order by paterno, materno, nombres";
			$cCurmat = fQuery($vQuery);
			while($aCurmat = $cCurmat->fetch_array())
			{		
				$sEstupdf[$aCurmat['num_mat']]['num_est'] = $vCont;
				$sEstupdf[$aCurmat['num_mat']]['num_mat'] = $aCurmat['num_mat'];
				$sEstupdf[$aCurmat['num_mat']]['nombre'] = "{$aCurmat['paterno']} {$aCurmat['materno']}, {$aCurmat['nombres']}"; 		
				$sEstupdf[$aCurmat['num_mat']]['mod_mat'] = $sModmat[$aCurmat['mod_mat']]['mod_des'];
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><?=$vCont?></td>
		<td class="wordcen"><?=$aCurmat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
		<td class="wordizq">&nbsp;<?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
		</tr>
	  <?	$vCont++;	
	  		}	  ?>	  
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
	  
	  <a href="prnrelasem.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" border="0" /></a>
	  <a href="prnrelasemx.php" class="enlace1"><img src="../images/bexport.png" width="100" height="24" border="0" /></a>
	  <a href="sem_selectsem.php" class="enlace1"><img src="../images/bviewsem.png" width="100" height="24" /></a>
	<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	

	if(fsafetyselcar2())
	{
		$vTot_mat = 0;
		$sPDF = "";
		$sEstupdf = "";
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
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	

//-->
</script>
</head>

<body >
	<? include "../include/header1.php"; ?>
	<? include "../include/mreportes.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="" method="post" enctype="multipart/form-data" name="fCambio" id="fCambio"> 

	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Resumen de matriculados por Carrera y por Modalidad</th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
	  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="20">C</th>
              <th width="235">Escuela Profesional </th>
              <th width="30">Re</th>
              <th width="30">3r</th>
              <th width="25">4t</th>
              <th width="25">5t</th>
              <th width="20">6t</th>
              <th width="20">7m</th>
              <th width="20">8v</th>
              <th width="30">Ob</th>
              <th width="20">Dr</th>
              <th width="20">Es</th>
              <th width="20">Rs</th>
              <th width="35">Tot</th>
            </tr>
			<?				
				$vCont = 1;
				
				$vCantimod = "";
				$vCantimod['01'] = 0;
				$vCantimod['18'] = 0;
				$vCantimod['08'] = 0;
				$vCantimod['11'] = 0;
				$vCantimod['13'] = 0;
				$vCantimod['14'] = 0;
				$vCantimod['15'] = 0;
				$vCantimod['07'] = 0;
				$vCantimod['16'] = 0;
				$vCantimod['05'] = 0;
				$vCantimod['17'] = 0;
				
				if(!empty($sAcceso))
				foreach($sAcceso as $vCod_car => $aAcceso) 				
				{				
					if($vCod_car <= '66' and $vCod_car != '53')
					{
						$sCanestu = "";
						
						$tEstumat = "unapnet.estumat".$vCod_car.$sUsercoo['ano_aca'];
	
						$vQuery = "select mod_mat, count(*) as canti from $tEstumat ";
						$vQuery .= "where per_aca = '{$sUsercoo['per_aca']}' ";
						$vQuery .= "group by mod_mat ";
			
						$cModcan = fQuery($vQuery);
						while($aModcan = $cModcan->fetch_array())
						{
							$sCanestu[$aModcan['mod_mat']] = $aModcan['canti'];
						}
						$vTot_mat += $sCanestu['01']+$sCanestu['18']+$sCanestu['08']+$sCanestu['11']+$sCanestu['13']+$sCanestu['14']+$sCanestu['15']+$sCanestu['07']+$sCanestu['16']+$sCanestu['05']+$sCanestu['17'];
						
						$vCantimod['01'] += $sCanestu['01'];
						$vCantimod['18'] += $sCanestu['18'];						
						$vCantimod['08'] += $sCanestu['08'];
						$vCantimod['11'] += $sCanestu['11'];
						$vCantimod['13'] += $sCanestu['13'];
						$vCantimod['14'] += $sCanestu['14'];
						$vCantimod['15'] += $sCanestu['15'];
						$vCantimod['07'] += $sCanestu['07'];
						$vCantimod['16'] += $sCanestu['16'];						
						$vCantimod['05'] += $sCanestu['05'];
						$vCantimod['17'] += $sCanestu['17'];
	
						$sPDF[$vCod_car]['cod_car'] = $vCod_car;
						$sPDF[$vCod_car]['01'] = $sCanestu['01'];
						$sPDF[$vCod_car]['18'] = $sCanestu['18'];						
						$sPDF[$vCod_car]['08'] = $sCanestu['08'];
						$sPDF[$vCod_car]['11'] = $sCanestu['11'];
						$sPDF[$vCod_car]['13'] = $sCanestu['13'];
						$sPDF[$vCod_car]['14'] = $sCanestu['14'];
						$sPDF[$vCod_car]['15'] = $sCanestu['15'];
						$sPDF[$vCod_car]['07'] = $sCanestu['07'];
						$sPDF[$vCod_car]['16'] = $sCanestu['16'];
						$sPDF[$vCod_car]['05'] = $sCanestu['05'];
						$sPDF[$vCod_car]['17'] = $sCanestu['17'];
						$sPDF[$vCod_car]['total'] = $sCanestu['01']+$sCanestu['18']+$sCanestu['08']+$sCanestu['11']+$sCanestu['13']+$sCanestu['14']+$sCanestu['15']+$sCanestu['07']+$sCanestu['16']+$sCanestu['05']+$sCanestu['17'];
				?>						
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordcen"><?=$vCod_car?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCarrera[$vCod_car]))?></td>
              <td class="wordder"><?=$sCanestu['01']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['18']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['08']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['11']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['13']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['14']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['15']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['07']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['16']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['05']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['17']?>&nbsp;</td>
              <td class="wordder"><?=$sCanestu['01']+$sCanestu['18']+$sCanestu['08']+$sCanestu['11']+$sCanestu['13']+$sCanestu['14']+$sCanestu['15']+$sCanestu['07']+$sCanestu['16']+$sCanestu['05']+$sCanestu['17']?>&nbsp;</td>
            </tr>
			<?	$vCont++;	}	}	?>	
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td class="wordizq">&nbsp;</td>
              <th>Re</th>
              <th>3r</th>
              <th>4t</th>
              <th>5t</th>
              <th>6t</th>
              <th>7m</th>
              <th>8v</th>
              <th>Ob</th>
              <th>Dr</th>
              <th>Es</th>
              <th>Rs</th>
              <th>Tot</th>
            </tr>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td class="wordderb">TOTAL : </td>
              <td class="wordder"><?=$vCantimod['01']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['18']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['08']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['11']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['13']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['14']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['15']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['07']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['16']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['05']?>&nbsp;</td>
              <td class="wordder"><?=$vCantimod['17']?>&nbsp;</td>
              <td class="wordder"><?=$vTot_mat?>&nbsp;</td>
            </tr>
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
	    <?	
			$sEstupdf['01'] = $vCantimod['01'];
			$sEstupdf['18'] = $vCantimod['18'];			
			$sEstupdf['08'] = $vCantimod['08'];
			$sEstupdf['11'] = $vCantimod['11'];
			$sEstupdf['13'] = $vCantimod['13'];
			$sEstupdf['14'] = $vCantimod['14'];
			$sEstupdf['15'] = $vCantimod['15'];
			$sEstupdf['07'] = $vCantimod['07'];
			$sEstupdf['16'] = $vCantimod['16'];
			$sEstupdf['05'] = $vCantimod['05'];
			$sEstupdf['17'] = $vCantimod['17'];
			$sEstupdf['total'] = $vCantimod['01']+$vCantimod['18']+$vCantimod['08']+$vCantimod['11']+$vCantimod['13']+$vCantimod['14']+$vCantimod['15']+$vCantimod['07']+$vCantimod['16']+$vCantimod['05']+$vCantimod['17'];
		
			?>			
	  </form>
	  <a href="prnresmatri.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	</div>
	
	<? include "../include/pie1.php"; ?>

</body>
</html>
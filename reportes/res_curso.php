<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	

	if(fsafetyselcar2())
	{
		$sPDF = "";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "select distinct pln_est from $tCurmat where per_aca = '{$sUsercoo['per_aca']}' order by pln_est ";
		$cPlnesp = fQuery($vQuery);
		while($aPlnesp = $cPlnesp->fetch_array())
		{
			$sPlnesp[$aPlnesp['pln_est']]['pln_est'] = $aPlnesp['pln_est'];
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
	  <form action="niv_select.php" method="post" enctype="multipart/form-data" name="fCambio" id="fCambio"> 
	  <?
	  	if(!empty($sPlnesp))
		foreach($sPlnesp as $vPlnesp => $aPlnesp)
		{
			
	  ?>
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Matriculados del Plan: <?=$vPlnesp." - ".$sTiposist[$sPlan[$vPlnesp]]?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  <?			  	
			$sCancurso = "";

			$vQuery = "select distinct cu.niv_est, cu.sem_anu, cu.pln_est, cu.cod_esp, cu.cod_cur, cu.nom_cur, ";
			$vQuery .= "cm.sec_gru, count(*) as canti ";
			$vQuery .= "from $tCurmat cm left join unapnet.curso cu on cm.cod_car = cu.cod_car and ";
			$vQuery .= "cm.pln_est = cu.pln_est and cm.cod_cur = cu.cod_cur ";
			$vQuery .= "where cm.per_aca = '{$sUsercoo['per_aca']}' and cm.pln_est = '$vPlnesp' ";
			$vQuery .= "group by pln_est, cod_cur, sec_gru ";
			$vQuery .= "order by cu.niv_est, sem_anu, cod_esp, cod_cur, sec_gru ";

			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
				$sCancurso[$aCurso['cod_cur']]['pln_est'] = $aCurso['pln_est'];
				$sCancurso[$aCurso['cod_cur']]['niv_est'] = $aCurso['niv_est'];
				$sCancurso[$aCurso['cod_cur']]['sem_anu'] = $aCurso['sem_anu'];
				$sCancurso[$aCurso['cod_cur']]['cod_esp'] = $aCurso['cod_esp'];
				$sCancurso[$aCurso['cod_cur']]['nom_cur'] = $aCurso['nom_cur'];
				$sCancurso[$aCurso['cod_cur']][$aCurso['sec_gru']] = $aCurso['canti'];
				
				
			}
		  ?>		  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="25">C</th>
              <th width="280">Nombre de Curso </th>
              <th width="20">Es</th>
              <th width="30">Uni</th>
              <th width="30">Gr-A</th>
              <th width="30">Gr-B</th>
              <th width="30">Gr-C</th>
              <th width="30">Gr-D</th>
              <th width="30">Gr-E</th>
              <th width="35">Total</th>
            </tr>
			<?
				$vSem_anu = "";
				$vNiv_est = "";
				$vCod_esp = "00";
				$vCont = 1;
				if(!empty($sCancurso))
				foreach($sCancurso as $vCod_cur => $aCurso)
				{				
					if($vSem_anu != $aCurso['sem_anu'] or $vNiv_est != $aCurso['niv_est'])
					{
						$vSem_anu = $aCurso['sem_anu'];
						$vNiv_est = $aCurso['niv_est'];
						
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordder">&nbsp;</td>
              <td colspan="9" class="wordizqb">&nbsp;NIVEL : <?=$sNivel[$aCurso['niv_est']]?> - SEMESTRE : <?=$sSemestre[$aCurso['sem_anu']]?></td>
            </tr>
			<?		
					} 	
					$sPDF[$aCurso['pln_est'].$vCod_cur]['pln_est'] = $aCurso['pln_est'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['cod_cur'] = $vCod_cur;
					$sPDF[$aCurso['pln_est'].$vCod_cur]['niv_est'] = $aCurso['niv_est'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['sem_anu'] = $aCurso['sem_anu'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['cod_esp'] = $aCurso['cod_esp'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['nom_cur'] = $aCurso['nom_cur'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['01'] = $aCurso['01'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['02'] = $aCurso['02'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['03'] = $aCurso['03'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['04'] = $aCurso['04'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['05'] = $aCurso['05'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['06'] = $aCurso['06'];
					$sPDF[$aCurso['pln_est'].$vCod_cur]['total'] = $aCurso['01']+$aCurso['02']+$aCurso['03']+$aCurso['04']+$aCurso['05']+$aCurso['06'];
					
					if($vCod_esp != $aCurso['cod_esp'])
					{
						$vCod_esp = $aCurso['cod_esp'];
						if($vCod_esp != '00')
						{
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td colspan="9" class="wordizqb">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mensi&oacute;n: <?=$sEspecial[$aCurso['pln_est'].$aCurso['cod_esp']]['esp_nom']?></td>
            </tr>
			<?		}	}	?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;<?=$vCod_cur?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?> </td>
              <td class="wordcen"><?=$aCurso['cod_esp']?></td>
              <td class="wordder"><?=$aCurso['01']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['02']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['03']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['04']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['05']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['06']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['01']+$aCurso['02']+$aCurso['03']+$aCurso['04']+$aCurso['05']?>&nbsp;</td>
            </tr>
			<?	$vCont++;	}	?>
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
	    <?	}	?>			
	  </form>
	  <a href="prnrescurso.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
	  <a href="prnrelarescursox.php" class="enlace1"><img src="../images/bexport.png" width="100" height="24" /></a>
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	</div>
	
	<? include "../include/pie1.php"; ?>

</body>
</html>
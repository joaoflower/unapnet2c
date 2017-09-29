<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	

	if(fsafetyselcar2())
	{
		$sPDF = "";
		$sEstupdf = "";
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
	function cambio(){
		document.fCambio.submit();	
	}
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
			$vQuery .= "cm.sec_gru, cm.mod_mat, count(*) as canti ";
			$vQuery .= "from $tCurmat cm left join unapnet.curso cu on cm.cod_car = cu.cod_car and ";
			$vQuery .= "cm.pln_est = cu.pln_est and cm.cod_cur = cu.cod_cur ";
			$vQuery .= "where cm.per_aca = '{$sUsercoo['per_aca']}' and cm.pln_est = '$vPlnesp' ";
			$vQuery .= "group by pln_est, cod_cur, sec_gru, mod_mat ";
			$vQuery .= "order by cu.niv_est, sem_anu, sec_gru, cod_esp, cod_cur, mod_mat ";

			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['cod_cur'] = $aCurso['cod_cur'];
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['pln_est'] = $aCurso['pln_est'];
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['niv_est'] = $aCurso['niv_est'];
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['sem_anu'] = $aCurso['sem_anu'];
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['cod_esp'] = $aCurso['cod_esp'];
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['nom_cur'] = $aCurso['nom_cur'];
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['sec_gru'] = $aCurso['sec_gru'];
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']][$aCurso['mod_mat']] = $aCurso['canti'];
			}
		  ?>		  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="25">C</th>
              <th width="280">Nombre de Curso </th>
              <th width="30">Re</th>
              <th width="20">3r</th>
              <th width="20">4t</th>
              <th width="20">5t</th>
              <th width="20">6t</th>
              <th width="20">7m</th>
              <th width="20">8v</th>
              <th width="20">Ob</th>
              <th width="20">Dr</th>
              <th width="20">Es</th>
              <th width="25">Tot</th>
            </tr>
			<?
				$vSem_anu = "";
				$vNiv_est = "";
				$vSec_gru = "";
				$vCod_esp = "00";
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
				$vCont = 1;
				if(!empty($sCancurso))
				foreach($sCancurso as $vCod_cur => $aCurso)
				{				
					$vCantimod['01'] += $aCurso['01'];
					$vCantimod['18'] += $aCurso['18'];					
					$vCantimod['08'] += $aCurso['08'];
					$vCantimod['11'] += $aCurso['11'];
					$vCantimod['13'] += $aCurso['13'];
					$vCantimod['14'] += $aCurso['14'];
					$vCantimod['15'] += $aCurso['15'];
					$vCantimod['07'] += $aCurso['07'];
					$vCantimod['16'] += $aCurso['16'];
					$vCantimod['05'] += $aCurso['05'];
					
					if($vSem_anu != $aCurso['sem_anu'] or $vNiv_est != $aCurso['niv_est'] or $vSec_gru != $aCurso['sec_gru'])
					{
						$vSem_anu = $aCurso['sem_anu'];
						$vNiv_est = $aCurso['niv_est'];
						$vSec_gru = $aCurso['sec_gru'];
						
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordder">&nbsp;</td>
              <td colspan="12" class="wordizqb">&nbsp;NIVEL : <?=$sNivel[$aCurso['niv_est']]?> - SEMESTRE : <?=$sSemestre[$aCurso['sem_anu']]?> - GRUPO : <?=$sGrupo[$aCurso['sec_gru']]?> </td>
            </tr>
			<?		
					} 	
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['pln_est'] = $aCurso['pln_est'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['cod_cur'] = $aCurso['cod_cur'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['niv_est'] = $aCurso['niv_est'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['sem_anu'] = $aCurso['sem_anu'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['cod_esp'] = $aCurso['cod_esp'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['nom_cur'] = $aCurso['nom_cur'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['sec_gru'] = $aCurso['sec_gru'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['01'] = $aCurso['01'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['18'] = $aCurso['18'];					
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['08'] = $aCurso['08'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['11'] = $aCurso['11'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['13'] = $aCurso['13'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['14'] = $aCurso['14'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['15'] = $aCurso['15'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['07'] = $aCurso['07'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['16'] = $aCurso['16'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['05'] = $aCurso['05'];
					$sPDF[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]['total'] = $aCurso['01']+$aCurso['18']+$aCurso['08']+$aCurso['11']+$aCurso['13']+$aCurso['14']+$aCurso['15']+$aCurso['07']+$aCurso['16']+$aCurso['05'];
					
					if($vCod_esp != $aCurso['cod_esp'])
					{
						$vCod_esp = $aCurso['cod_esp'];
						if($vCod_esp != '00')
						{
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td colspan="12" class="wordizqb">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mensi&oacute;n: <?=$sEspecial[$aCurso['pln_est'].$aCurso['cod_esp']]['esp_nom']?></td>
            </tr>
			<?		}	}	?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;<?=$aCurso['cod_cur'];?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?> </td>
              <td class="wordder"><?=$aCurso['01']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['18']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['08']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['11']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['13']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['14']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['15']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['07']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['16']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['05']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['01']+$aCurso['18']+$aCurso['08']+$aCurso['11']+$aCurso['13']+$aCurso['14']+$aCurso['15']+$aCurso['07']+$aCurso['16']+$aCurso['05']?>&nbsp;</td>
            </tr>
			<?	$vCont++;	}	?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td class="wordizq">&nbsp;</td>
              <th class="wordcenb">Re</th>
              <th class="wordcenb">3r</th>
              <th class="wordcenb">4t</th>
              <th class="wordcenb">5t</th>
              <th class="wordcenb">6t</th>
              <th class="wordcenb">7m</th>
              <th class="wordcenb">8v</th>
              <th class="wordcenb">Ob</th>
              <th class="wordcenb">Dr</th>
              <th class="wordcenb">Es</th>
              <td class="wordder">&nbsp;</td>
            </tr>			
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td class="wordderb">TOTAL:</td>
              <td class="wordcen"><?=$vCantimod['01']?></td>
              <td class="wordder"><?=$vCantimod['18']?></td>
              <td class="wordder"><?=$vCantimod['08']?></td>
              <td class="wordder"><?=$vCantimod['11']?></td>
              <td class="wordder"><?=$vCantimod['13']?></td>
              <td class="wordder"><?=$vCantimod['14']?></td>
              <td class="wordder"><?=$vCantimod['15']?></td>
              <td class="wordder"><?=$vCantimod['07']?></td>
              <td class="wordder"><?=$vCantimod['16']?></td>
              <td class="wordder"><?=$vCantimod['05']?></td>
              <td class="wordder">&nbsp;</td>
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
			$sEstupdf[$vPlnesp]['01'] = $vCantimod['01'];
			$sEstupdf[$vPlnesp]['18'] = $vCantimod['18'];			
			$sEstupdf[$vPlnesp]['08'] = $vCantimod['08'];
			$sEstupdf[$vPlnesp]['11'] = $vCantimod['11'];
			$sEstupdf[$vPlnesp]['13'] = $vCantimod['13'];
			$sEstupdf[$vPlnesp]['14'] = $vCantimod['14'];
			$sEstupdf[$vPlnesp]['15'] = $vCantimod['15'];
			$sEstupdf[$vPlnesp]['07'] = $vCantimod['07'];
			$sEstupdf[$vPlnesp]['16'] = $vCantimod['16'];
			$sEstupdf[$vPlnesp]['05'] = $vCantimod['05'];
		
		}	?>			
	  </form>
	  <a href="prnrescursomm.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	</div>
	
	<? include "../include/pie1.php"; ?>

</body>
</html>
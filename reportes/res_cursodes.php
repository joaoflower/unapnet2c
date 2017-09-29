<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	

	if(fsafetyselcar())
	{
		$sPDF = "";
		$sEstupdf = "";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		
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
			$vQuery .= "cm.sec_gru, count(*) as canti ";
			$vQuery .= "from $tCurmat cm left join unapnet.curso cu on cm.cod_car = cu.cod_car and ";
			$vQuery .= "cm.pln_est = cu.pln_est and cm.cod_cur = cu.cod_cur ";
			$vQuery .= "where cm.per_aca = '{$sUsercoo['per_aca']}' and cm.pln_est = '$vPlnesp' ";
			$vQuery .= "group by pln_est, cod_cur, sec_gru ";
			$vQuery .= "order by cu.niv_est, sem_anu, sec_gru, cod_esp, cod_cur";

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
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['can_mat'] = $aCurso['canti'];
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['can_apr'] = 0;
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['can_des'] = 0;
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['por_apr'] = 0;
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['por_des'] = 0;
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['can_ree'] = 0;
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['ree_apr'] = 0;
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['ree_des'] = 0;
			}
			
			$vQuery = "select cm.pln_est, cm.cod_cur, cm.sec_gru, count(*) as canti ";
			$vQuery .= "from $tCurmat cm left join $tNota no on cm.ano_aca = no.ano_aca and ";
			$vQuery .= "cm.per_aca = no.per_aca and cm.pln_est = no.pln_est and cm.cod_cur = no.cod_cur and ";
   			$vQuery .= "cm.num_mat = no.num_mat ";
			$vQuery .= "where cm.per_aca = '{$sUsercoo['per_aca']}' and cm.pln_est = '$vPlnesp' and no.mod_not != '08' and ";			
			$vQuery .= " no.not_cur > 10 group by pln_est, cod_cur, sec_gru order by pln_est, sec_gru, cod_cur";
			
			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['can_apr'] = $aCurso['canti'];
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['por_apr'] = round(($aCurso['canti']*100)/$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['can_mat'], 1);
			}
			
			$vQuery = "select cm.pln_est, cm.cod_cur, cm.sec_gru, count(*) as canti ";
			$vQuery .= "from $tCurmat cm left join $tNota no on cm.ano_aca = no.ano_aca and ";
			$vQuery .= "cm.per_aca = no.per_aca and cm.pln_est = no.pln_est and cm.cod_cur = no.cod_cur and ";
   			$vQuery .= "cm.num_mat = no.num_mat ";
			$vQuery .= "where cm.per_aca = '{$sUsercoo['per_aca']}' and cm.pln_est = '$vPlnesp' and no.mod_not != '08' and ";			
			$vQuery .= " no.not_cur < 11 group by pln_est, cod_cur, sec_gru order by pln_est, sec_gru, cod_cur";
			
			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['can_des'] = $aCurso['canti'];
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['por_des'] = 100 - $sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['por_apr'];
			}
			
			$vQuery = "select ap.pln_est, ap.cod_cur, ap.sec_gru, count(*) as canti ";
			$vQuery .= "from $tApla ap where ap.cod_car = '{$sUsercoo['cod_car']}' and ap.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "ap.pln_est = '$vPlnesp' group by pln_est, cod_cur, sec_gru order by pln_est, sec_gru, cod_cur";
			
			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['can_ree'] = $aCurso['canti'];
			}
			
			$vQuery = "select ap.pln_est, ap.cod_cur, ap.sec_gru, count(*) as canti ";
			$vQuery .= "from $tApla ap left join $tNota no on ap.ano_aca = no.ano_aca and ap.per_aca = no.per_aca and ";
			$vQuery .= "ap.pln_est = no.pln_est and ap.cod_cur = no.cod_cur and ap.num_mat = no.num_mat and ";
			$vQuery .= "ap.mod_mat = no.mod_not ";
			$vQuery .= "where ap.cod_car = '{$sUsercoo['cod_car']}' and ap.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "ap.pln_est = '$vPlnesp' and no.not_cur > 10 ";
			$vQuery .= "group by pln_est, cod_cur, sec_gru order by pln_est, sec_gru, cod_cur";
			
			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['ree_apr'] = $aCurso['canti'];
			}
			
			$vQuery = "select ap.pln_est, ap.cod_cur, ap.sec_gru, count(*) as canti ";
			$vQuery .= "from $tApla ap left join $tNota no on ap.ano_aca = no.ano_aca and ap.per_aca = no.per_aca and ";
			$vQuery .= "ap.pln_est = no.pln_est and ap.cod_cur = no.cod_cur and ap.num_mat = no.num_mat and ";
			$vQuery .= "ap.mod_mat = no.mod_not ";
			$vQuery .= "where ap.cod_car = '{$sUsercoo['cod_car']}' and ap.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "ap.pln_est = '$vPlnesp' and no.not_cur < 11 ";
			$vQuery .= "group by pln_est, cod_cur, sec_gru order by pln_est, sec_gru, cod_cur";
			
			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
				$sCancurso[$aCurso['cod_cur'].$aCurso['sec_gru']]['ree_des'] = $aCurso['canti'];
			}
			
		  ?>		  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="25">C</th>
              <th width="280">Nombre de Curso </th>
              <th width="30">Mat</th>
              <th width="30">Apr</th>
              <th width="30">Des</th>
              <th width="35">% Apr </th>
              <th width="35">% Des </th>
              <th width="30">Ree</th>
              <th width="30">Apr</th>
              <th width="30">Des</th>
            </tr>
			<?
				$vSem_anu = "";
				$vNiv_est = "";
				$vSec_gru = "";
				$vCod_esp = "00";
				$vCont = 1;
				if(!empty($sCancurso))
				foreach($sCancurso as $vCod_cur => $aCurso)
				{				
					if($vSem_anu != $aCurso['sem_anu'] or $vNiv_est != $aCurso['niv_est'] or $vSec_gru != $aCurso['sec_gru'])
					{
						$vSem_anu = $aCurso['sem_anu'];
						$vNiv_est = $aCurso['niv_est'];
						$vSec_gru = $aCurso['sec_gru'];
						
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordder">&nbsp;</td>
              <td colspan="9" class="wordizqb">&nbsp;NIVEL : <?=$sNivel[$aCurso['niv_est']]?> - SEMESTRE : <?=$sSemestre[$aCurso['sem_anu']]?> - GRUPO : <?=$sGrupo[$aCurso['sec_gru']]?> </td>
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
              <td class="wordizq">&nbsp;<?=$aCurso['cod_cur'];?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?> </td>
              <td class="wordder"><?=$aCurso['can_mat']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['can_apr']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['can_des']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['por_apr']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['por_des']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['can_ree']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['ree_apr']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['ree_des']?>&nbsp;</td>
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
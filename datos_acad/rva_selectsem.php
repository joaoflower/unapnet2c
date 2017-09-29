<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		$sCurso = "";

		$vQuery = "select distinct pln_est from $tApla where per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' order by pln_est ";
		$cPlnesp = fQuery($vQuery);
		while($aPlnesp = $cPlnesp->fetch_array())
		{
			$sPlnesp[$aPlnesp['pln_est']]['pln_est'] = $aPlnesp['pln_est'];
		}
		$aCarga ="";
		$vQuery = "select concat(pln_est, cod_cur, sec_gru) pcs, concat(paterno, ' ', materno, ', ', nombres) as nom_doc ";
		$vQuery .= "from $tCarga ca left join unapnet.docente do on ca.cod_prf = do.cod_prf ";
		$vQuery .= "where ca.per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "ca.cod_car = '{$sUsercoo['cod_car']}' and (ca.mod_mat = '08' or ca.mod_mat = '02') ";
		$cCarga = fQuery($vQuery);
		while($aCarga2 = $cCarga->fetch_array())
		{
			$aCarga[$aCarga2['pcs']] = $aCarga2['nom_doc'];
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
	function start()
	{

	}

//-->
</script>
</head>

<body  onLoad="start();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
<div class="wordcen" id="body1">
	  <form action="" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  
	  <?
	  	if(!empty($sPlnesp))
		foreach($sPlnesp as $vPlnesp => $aPlnesp)
		{
	  ?>
	  	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" ><?=($sPlan[$vPlnesp]=='1'?"Aplazados":"Reevaluaci&oacute;n")?> del Plan: <?=$vPlnesp." - ".$sTiposist[$sPlan[$vPlnesp]]?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="25">C</th>
              <th width="280">Nombre de Curso </th>
              <th width="80">Modalidad</th>
              <th width="180">Docente</th>
              <th width="16">&nbsp;</th>
            </tr>
			
			<?			  	
			$vNiv_est = "";
			$vSem_anu = "";
			$vSec_gru = "";
			$vCod_esp = "00";
			$vCont = 1;
			
			$vQuery = "select distinct cu.niv_est, cu.sem_anu, cu.pln_est, cu.cod_esp, cu.cod_cur, cu.nom_cur, ";
			$vQuery .= "ap.sec_gru, ap.mod_mat ";
			$vQuery .= "from $tApla ap left join unapnet.curso cu on ap.cod_car = cu.cod_car and ";
			$vQuery .= "ap.pln_est = cu.pln_est and ap.cod_cur = cu.cod_cur ";
			$vQuery .= "where ap.cod_car = '{$sUsercoo['cod_car']}' and ap.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "ap.pln_est = '$vPlnesp' ";
			$vQuery .= "order by cu.niv_est, sem_anu, sec_gru, cod_esp, cod_cur ";

			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
				if($vSem_anu != $aCurso['sem_anu'] or $vNiv_est != $aCurso['niv_est'] or $vSec_gru != $aCurso['sec_gru'])
				{
					$vSem_anu = $aCurso['sem_anu'];
					$vNiv_est = $aCurso['niv_est'];
					$vSec_gru = $aCurso['sec_gru'];
						
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordder">&nbsp;</td>
              <td colspan="4" class="wordizqb">&nbsp;NIVEL : <?=$sNivel[$aCurso['niv_est']]?> - SEMESTRE : <?=$sSemestre[$aCurso['sem_anu']]?> - GRUPO: <?=$sGrupo[$aCurso['sec_gru']]?></td>
            </tr>
			<?		
				} 	
				
				if($vCod_esp != $aCurso['cod_esp'])
				{
					$vCod_esp = $aCurso['cod_esp'];
					if($vCod_esp != '00')
					{
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td colspan="4" class="wordizqb">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mensi&oacute;n: <?=$sEspecial[$aCurso['pln_est'].$aCurso['cod_esp']]['esp_nom']?></td>
            </tr>
			<?	}	}	?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;<?=$aCurso['cod_cur']?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?> </td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aCurso['mod_mat']]))?>&nbsp;</td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCarga[$aCurso['pln_est'].$aCurso['cod_cur'].$aCurso['sec_gru']]))?></td>
              <td class="wordcen"><a href="rva_viewcursodata.php?rPln_est=<?=$aCurso['pln_est']?>&rCod_cur=<?=$aCurso['cod_cur']?>&rSec_gru=<?=$aCurso['sec_gru']?>&rMod_not=<?=$aCurso['mod_mat']?>" class="enlaceb"><img src="../images/browse.png" alt="Mostrar informaci&oacute;n" width="16" height="16" /></a></td>
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
	  	}
	  ?>

  </form>
	 
	<?
		if($sUsercoo['cod_car'] != '02'and $sUsercoo['cod_car'] != '03'  and $sUsercoo['cod_car'] != '04' and $sUsercoo['cod_car'] != '09' and $sUsercoo['cod_car'] != '37' and $sUsercoo['cod_car'] != '37' and $sUsercoo['cod_car'] != '14' and $sUsercoo['cod_car'] != '20' and $sUsercoo['cod_car'] != '37' and $sUsercoo['cod_car'] != '24' and $sUsercoo['cod_car'] != '26' and $sUsercoo['cod_car'] != '37' and $sUsercoo['cod_car'] != '29' and $sUsercoo['cod_car'] != '30' and $sUsercoo['cod_car'] != '31' and $sUsercoo['cod_car'] != '32' and $sUsercoo['cod_car'] != '33' and $sUsercoo['cod_car'] != '34' and $sUsercoo['cod_car'] != '35' and $sUsercoo['cod_car'] != '56' )
		{
	?>
	  
  <a href="rva_selectcurso.php" title="Nueva Notas" class="linkboton" ><img src="../images/bnuevoreeval.png" width="100" height="24"></a>  </div>
  	<?
		}
	?>
  
	<? include "../include/pie1.php"; ?>

</body>
</html>
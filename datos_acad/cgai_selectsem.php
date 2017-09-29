<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$tCarga = "unapnet.cargaint{$sUsercoo['ano_aca']}";
		$sCurso = "";
		
		$vQuery = "select distinct pln_est from $tCarga where per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' order by pln_est ";
		$cPlnesp = fQuery($vQuery);
		while($aPlnesp = $cPlnesp->fetch_array())
		{
			$sPlnesp[$aPlnesp['pln_est']]['pln_est'] = $aPlnesp['pln_est'];
		}
/*		
		$vQuery = "Select distinct cu.pln_est, cu.sem_anu, cu.cod_esp, ca.sec_gru ";
		$vQuery .= "from $tCarga ca left join unapnet.curso cu on cu.pln_est = ca.pln_est and ";
		$vQuery .= "cu.cod_cur = ca.cod_cur and cu.cod_car = ca.cod_car ";
		$vQuery .= "where ca.cod_car = '{$sUsercoo['cod_car']}' and ca.per_aca = '{$sUsercoo['per_aca']}' ";
		$vQuery .= "order by pln_est, sem_anu, cod_esp, sec_gru";
		$cSemgru = fQuery($vQuery);
		while($aSemgru = $cSemgru->fetch_array())
		{
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['pln_est'] = $aSemgru['pln_est'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['sem_anu'] = $aSemgru['sem_anu'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['sec_gru'] = $aSemgru['sec_gru'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['cod_esp'] = $aSemgru['cod_esp'];
		}*/
	
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
	function del_cargai(pln_est, cod_cur, sec_gru, mod_mat, cod_prf)
	{
		var vReturn;
		var vAtributo;
		vAtributo = "center=yes; dialogHeight=230px; dialogWidth=530px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=no; resizable=no; font-family=Arial; font-size=11px";

		vReturn = window.showModalDialog("msn_delcarga.php?rPln_est="+pln_est+"&rCod_cur="+cod_cur+"&rSec_gru="+sec_gru+"&rMod_mat="+mod_mat+"&rCod_prf="+cod_prf, "mensaje", vAtributo);
		if(vReturn == '1')
		{
			window.location.href = "cgai_delcarga.php";
		}
	}
//-->
</script>
</head>

<body  onLoad="start();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
<div class="wordcen" id="body1">
	<a href="cgai_getcarga.php" title="Nueva Notas" class="linkboton" ><img src="../images/bnuevocar.png" width="100" height="24"></a>
	  <form action="" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  
	 
	 <?
	  	if(!empty($sPlnesp))
		foreach($sPlnesp as $vPlnesp => $aPlnesp)
		{
	  ?>
	  	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Carga Acad&eacute;mica de INTERNET del Plan: <?=$vPlnesp." - ".$sTiposist[$sPlan[$vPlnesp]]?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="25">C</th>
              <th width="280">Nombre de Curso </th>
              <th width="70">Modalidad</th>
              <th width="190">Docente</th>
              <th width="16">&nbsp;</th>
            </tr>
			
			<?			  	
			$vNiv_est = "";
			$vSem_anu = "";
			$vSec_gru = "";
			$vCod_esp = "00";
			$vCont = 1;
			
			$vQuery = "select distinct cu.niv_est, cu.sem_anu, cu.pln_est, cu.cod_esp, cu.cod_cur, cu.nom_cur, ";
			$vQuery .= "cg.sec_gru, cg.mod_mat, do.cod_prf, concat(do.paterno, ' ', do.materno, ', ', do.nombres) as nom_doc ";
			$vQuery .= "from $tCarga cg left join unapnet.curso cu on cg.cod_car = cu.cod_car and ";
			$vQuery .= "cg.pln_est = cu.pln_est and cg.cod_cur = cu.cod_cur ";
			$vQuery .= "left join unapnet.docente do on cg.cod_prf = do.cod_prf ";
			$vQuery .= "where cg.cod_car = '{$sUsercoo['cod_car']}' and cg.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "cg.pln_est = '$vPlnesp' ";
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
              <td colspan="4" class="wordizqb">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menci&oacute;n: <?=$sEspecial[$aCurso['pln_est'].$aCurso['cod_esp']]['esp_nom']?></td>
            </tr>
			<?	}	}	?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;<?=$aCurso['cod_cur']?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?> </td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModnot[$aCurso['mod_mat']]))?>&nbsp;</td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_doc']))?></td>
              <td class="wordcen"><a href="" onclick="del_cargai('<?=$aCurso['pln_est']?>', '<?=$aCurso['cod_cur']?>', '<?=$aCurso['sec_gru']?>', '<?=$aCurso['mod_mat']?>', '<?=$aCurso['cod_prf']?>'); return false;" class="enlaceb"><img src="../images/drop.png" alt="Eliminar" width="16" height="16" /></a></td>
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
	  
  <a href="cgai_getcarga.php" title="Nueva Notas" class="linkboton" ><img src="../images/bnuevocar.png" width="100" height="24"></a>  </div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
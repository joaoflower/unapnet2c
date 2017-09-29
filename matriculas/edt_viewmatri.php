<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
		$sEstudia = "";
		
		$sEstudia['num_mat'] = $_GET['rNum_mat'];
		$sEstudia['cod_car'] = $_GET['rCod_car'];
		
		$sCurso = "";
		$sCurmat = "";
		$sCurmat2 = "";
		$sCurapto = "";
		
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		
		$vQuery = "Select num_mat, pln_est, cod_esp, mod_mat, tot_crd, max_crd, niv_est, sec_gru, tur_est, obs_est, fch_mat ";
		$vQuery .= "from $tEstumat where num_mat = '{$sEstudia['num_mat']}' and ano_aca = '{$sUsercoo['ano_aca']}' ";
		$vQuery .= "and per_aca = '{$sUsercoo['per_aca']}' ";
		$cEstumat = fQuery($vQuery);
		if($aEstumat = $cEstumat->fetch_array())
		{
			$sEstudia['pln_est'] = $aEstumat['pln_est'];
			$sEstudia['cod_esp'] = $aEstumat['cod_esp'];
			$sEstudia['mod_mat'] = $aEstumat['mod_mat'];
			$sEstudia['tot_crd'] = $aEstumat['tot_crd'];
			$sEstudia['max_crd2'] = $aEstumat['max_crd'];
			$sEstudia['niv_est'] = $aEstumat['niv_est'];
			$sEstudia['sec_gru'] = $aEstumat['sec_gru'];
			$sEstudia['tur_est'] = $aEstumat['tur_est'];
			$sEstudia['obs_est'] = $aEstumat['obs_est'];
			$sEstudia['tip_sist'] = $sPlan[$aEstumat['pln_est']];
			$sEstudia['fch_mat'] = $aEstumat['fch_mat'];
			
			$vQuery = "Select paterno, materno, nombres, passwd ";
			$vQuery .= "from unapnet.estudiante where num_mat = '{$sEstudia['num_mat']}' and cod_car = '{$sUsercoo['cod_car']}'";
				
			$cEstudia = fQuery($vQuery);
			if($aEstudia = $cEstudia->fetch_array())
			{			
				$sEstudia['paterno'] = $aEstudia['paterno'];			
				$sEstudia['materno'] = $aEstudia['materno'];
				$sEstudia['nombres'] = $aEstudia['nombres'];
				$sEstudia['passwd'] = $aEstudia['passwd'];
	
				$cEstudia->close();
				$sUsercoo['safetymatri'] = TRUE;
				
				$vQuery = "select cod_cur, cod_cat, nom_cur, sem_anu, cod_esp, crd_cur, tip_pre, tip_cur, crd_prq, niv_est ";
				$vQuery .= "from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' ";
				$vQuery .= "and con_cur = '1' ";
				if ($sUsercoo['cod_car'] == '01' or $sUsercoo['cod_car'] == '02' or $sUsercoo['cod_car'] == '32')
				{
					$vQuery .= " order by sem_anu, cod_cur";
				}
				else
				{
					$vQuery .= "and (cod_esp = '00' or cod_esp = '{$sEstudia['cod_esp']}') order by niv_est, sem_anu, cod_esp,  cod_cur";
				}
//				$vQuery .= "and (cod_esp = '00' or cod_esp = '{$sEstudia['cod_esp']}') order by sem_anu, cod_cur";
//				$vQuery .= "order by sem_anu, cod_cur";
				$cCurso = fQuery($vQuery);
				while($aCurso = $cCurso->fetch_array())
				{
					$sCurso[$aCurso['cod_cur']]['cod_cat'] = $aCurso['cod_cat'];
					$sCurso[$aCurso['cod_cur']]['niv_est'] = $aCurso['niv_est'];
					$sCurso[$aCurso['cod_cur']]['nom_cur'] = $aCurso['nom_cur'];
					$sCurso[$aCurso['cod_cur']]['sem_anu'] = $aCurso['sem_anu'];
					$sCurso[$aCurso['cod_cur']]['cod_esp'] = $aCurso['cod_esp'];
					$sCurso[$aCurso['cod_cur']]['crd_cur'] = $aCurso['crd_cur'];
					$sCurso[$aCurso['cod_cur']]['tip_pre'] = $aCurso['tip_pre'];
					$sCurso[$aCurso['cod_cur']]['tip_cur'] = $aCurso['tip_cur'];
					$sCurso[$aCurso['cod_cur']]['crd_prq'] = $aCurso['crd_prq'];
				}
				
				$vQuery = "Select cm.cod_cur, cm.mod_mat, cm.sec_gru, cm.tur_est, cm.cur_obli, cu.cod_esp, cu.cod_esp, ";
				$vQuery .= "cu.tip_cur from $tCurmat cm left join unapnet.curso cu on cm.cod_car = cu.cod_car and ";
				$vQuery .= "cm.pln_est = cu.pln_est and cm.cod_cur = cu.cod_cur ";
				$vQuery .= "where cm.num_mat = '{$sEstudia['num_mat']}' and per_aca = '{$sUsercoo['per_aca']}' ";
				$vQuery .= "order by niv_est, sem_anu, cod_esp, tip_cur, cod_cur ";
				$cCurmat = fQuery($vQuery);
				while($aCurmat = $cCurmat->fetch_array())
				{
					$sCurmat[$aCurmat['cod_cur']]['mod_mat'] = $aCurmat['mod_mat'];
					$sCurmat[$aCurmat['cod_cur']]['sec_gru'] = $aCurmat['sec_gru'];
					$sCurmat[$aCurmat['cod_cur']]['tur_est'] = $aCurmat['tur_est'];
					$sCurmat[$aCurmat['cod_cur']]['cur_obli'] = $aCurmat['cur_obli'];
				}

			}
			else
			{
				$cEstudia->close();
				header("Location:edt_getestu.php");
			}
		}
		else
		{
			$cEstumat->close();
			header("Location:edt_getestu.php");
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
	function del_curmat(cod_cur)
	{
		var vReturn;
		var vAtributo;
		vAtributo = "center=yes; dialogHeight=210px; dialogWidth=530px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=no; resizable=no; font-family=Arial; font-size=11px";

		vReturn = window.showModalDialog("msn_delcurmat.php?rCod_cur="+cod_cur, "mensaje", vAtributo);
		if(vReturn == '1')
		{
			window.location.href = "edt_delcurso.php";
		}
	}
	function del_estumat()
	{
		var vReturn;
		var vAtributo;
		vAtributo = "center=yes; dialogHeight=210px; dialogWidth=530px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=no; resizable=no; font-family=Arial; font-size=11px";

		vReturn = window.showModalDialog("msn_delestumat.php", "mensaje", vAtributo);
		if(vReturn == '1')
		{
			window.location.href = "edt_delmatri.php";
		}
	}
	function reservar_mat()
	{
		var vReturn;
		var vAtributo;
		vAtributo = "center=yes; dialogHeight=210px; dialogWidth=530px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=no; resizable=no; font-family=Arial; font-size=11px";

		vReturn = window.showModalDialog("msn_reservamat.php", "mensaje", vAtributo);
		if(vReturn == '1')
		{
			window.location.href = "edt_reservamat.php";
		}
	}
	function modify_obs()
	{
		var docu = document.fData;
		docu.rObs_est.disabled = "";
	}
	function save_obs()
	{
		var docu = document.fData;
		docu.rObs_est.disabled = "disabled";
		saveobsedtest(docu.rObs_est.value);
	}

//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="prnficha.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  <span class="wordi"> POR ACUERDO DE CONSEJO UNIVERSITARIO TERMINO EL PERIODO DE MATRÍCULAS <br>
		HA CONCLUIDO.</span>
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Edici&oacute;n de Matr&iacute;cula </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg"><table width="400" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <td width="75" class="wordder">Estudiante : </td>
                  <td colspan="3" class="wordizqb"><?=$sEstudia['num_mat']?> - <?=$sEstudia['paterno']?> <?=$sEstudia['materno']?>, <?=$sEstudia['nombres']?></td>
                </tr>
                <tr>
                  <td class="wordder">Plan : </td>
                  <td class="wordizqb"><?=$sEstudia['pln_est']?> - <?=$sTiposist[$sEstudia['tip_sist']]?></td>
                  <td class="wordder">Nivel/Semestre:</td>
                  <td class="wordizqb"><?=$sSemestre[$sEstudia['niv_est']]?></td>
                </tr>
                <tr>
                  <td class="wordder">Especialidad : </td>
                  <td colspan="3" class="wordizqb"><?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
                </tr>
                <tr>
                  <td class="wordder">Modalidad : </td>
                  <td width="125" class="wordizqb"><?=$sModmat[$sEstudia['mod_mat']]['mod_des']?></td>
                  <td width="80" class="wordder">Total  Cred : </td>
                  <td class="wordizqb"><?=$sEstudia['tot_crd']?>
            cr&eacute;ditos</td>
                </tr>
                <tr>
                  <td class="wordder">Grupo : </td>
                  <td class="wordizqb"><?=$sGrupo[$sEstudia['sec_gru']]?></td>
                  <td class="wordder">Fecha Matric.: </td>
                  <td class="wordizqb"><?=fFechad($sEstudia['fch_mat'])?></td>
                </tr>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
	    <? if(!empty($sCurmat)) {?>
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos Matriculados</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="15" scope="col">N</th>
                  <th width="25" scope="col">C&oacute;d</th>
                  <th width="280" scope="col">Nombre del Curso</th>
                  <th width="20" scope="col">N</th>
                  <th width="20" scope="col">S</th>
                  <th width="20" scope="col">Es</th>
                  <th width="60" scope="col">Mod.</th>
                  <th width="45" scope="col">Grupo</th>
                  <th width="30" scope="col">Crd</th>
                  <th width="16" scope="col">&nbsp;</th>
                  <th width="16" scope="col">&nbsp;</th>
                </tr>
                <? 	$vCont = 1; $sCursopdf = "";	foreach($sCurmat as $vCod_cur => $aCurmat) { 
				
						$sCursopdf[$vCod_cur]['num_cur'] = $vCont;
						$sCursopdf[$vCod_cur]['niv_est'] = $sCurso[$vCod_cur]['niv_est'];
						$sCursopdf[$vCod_cur]['sem_anu'] = $sSemestre[$sCurso[$vCod_cur]['sem_anu']];
						$sCursopdf[$vCod_cur]['nom_cur'] = $sCurso[$vCod_cur]['nom_cur'];						
						$sCursopdf[$vCod_cur]['sec_gru'] = $sGrupo[$aCurmat['sec_gru']];
						$sCursopdf[$vCod_cur]['mod_mat'] = $sModmat[$aCurmat['mod_mat']]['mod_des'];
						$sCursopdf[$vCod_cur]['crd_cur'] = $sCurso[$vCod_cur]['crd_cur'];
				
				?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td class="wordcen"><?=$vCont?></td>
                  <td class="wordizq">&nbsp;<?=$vCod_cur?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
                  <td class="wordizq">&nbsp;<?=$sCurso[$vCod_cur]['niv_est']?></td>
                  <td class="wordizq">&nbsp;<?=$sCurso[$vCod_cur]['sem_anu']?></td>
                  <td class="wordizq">&nbsp;<?=$sCurso[$vCod_cur]['cod_esp']?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModmat[$aCurmat['mod_mat']]['mod_des']))?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sGrupo[$aCurmat['sec_gru']]))?></td>
                  <td class="wordder"><?=$sCurso[$vCod_cur]['crd_cur']?></td>
                  <td class="wordcen"><? if($sMdfmat[$sUsercoo['cod_car']] === 'True') { ?><a href="edt_edtcurso.php?rCod_cur=<?=$vCod_cur?>" class="enlaceb"><img src="../images/browse.png" alt="Modificar" width="16" height="16" /></a><? } ?></td>
                  <td class="wordcen"><? if($sRatmat[$sUsercoo['cod_car']] === 'True') { ?><? if(empty($aCurmat['cur_obli'])) 	{	?><a href="" onclick="del_curmat('<?=$vCod_cur?>'); return false;" class="enlaceb"><img src="../images/drop.png" alt="Eliminar" width="16" height="16" /></a><?	}	} ?></td>
                </tr>
				<? $vCont++; 	} ?>                        
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>

        <? } ?>
		
			<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
		<tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> >
                  <td class="wordizq"><strong>Obs:</strong></td>
                  <td colspan="7" class="wordizq"><textarea name="rObs_est" cols="95" rows="2" id="rObs_est" onBlur="fupper(this)" disabled="disabled"><?=$sEstudia['obs_est']?></textarea></td>
                  <td class="wordcen"><? if($sMdfmat[$sUsercoo['cod_car']] === 'True' or $sResmat[$sUsercoo['cod_car']] === 'True') { ?><a href="" onclick="modify_obs(); return false;" class="enlaceb"><img src="../images/browse.png" alt="Modificar" width="16" height="16" /></a></td>
                  <td class="wordcen"><a href="" onclick="save_obs(); return false;" class="enlaceb"><img src="../images/save.png" alt="Guardar" width="16" height="16" /></a><? } ?></td>
              </tr>  
			</table>  
		
		<? if($sRatmat[$sUsercoo['cod_car']] === 'True') {  if(0) { ?><a href="" onclick="del_estumat(); return false;" title="Eliminar Matricula" class="linkboton" ><img src="../images/bdelmatri.png" width="100" height="24"></a>
		<? } if($sEstudia['tot_crd'] < $sEstudia['max_crd2'] )	{	?>
		<a href="edt_selectcurso.php" title="Agregar Cursos" class="linkboton" ><img src="../images/baddcur.png" width="100" height="24"></a>
		<?	}	}	?>
			
		<a href="prnficha1.php" title="Imprimir 1 Ficha de matr&iacute;cula en 1 Hoja" class="linkboton" target="frPdf"><img src="../images/bprint1.png" width="100" height="24"></a>
		<a href="prnficha<?=($sUsercoo['cod_fac'] == 18?'epg':'')?>.php" title="Imprimir 2 Fichas de matr&iacute;cula en 1 Hoja" class="linkboton" target="frPdf"><img src="../images/bprint2.png" width="100" height="24"></a>
		<a href="edt_getestu.php" title="Buscar estudiante" class="linkboton" ><img src="../images/bsearchest.png" width="100" height="24"></a> <br>
		<? if($sResmat[$sUsercoo['cod_car']] === 'True') { ?>
		<? if($sEstudia['mod_mat'] != '17')	{	?>
		<a href="" onclick="reservar_mat(); return false;" title="Reservar Matricula" class="linkboton" ><img src="../images/breservar.png" width="100" height="24"></a>
		<?	}	}	
			if($sMdfmat[$sUsercoo['cod_car']] === 'True') 
			{ 
		?>
		<a href="edt_edtestu.php" title="Modificar Condici&oacute;n" class="linkboton" ><img src="../images/bmodify.png" width="100" height="24"></a> 
		<? } ?><br>
	  </form>
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
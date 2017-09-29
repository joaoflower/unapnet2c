<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri3'])
		{
			$tNota = "unapnet.nota".$sUsercoo['cod_car'];
			
			$aSemnot = "";
			$aSemele = "";
	
			$aCurdes = "";
			$aCurapro = "";
			$aCurnot = "";
			$aCurobli = "";
			$aCurele = "";
			$aCuropta = "";
			
			$sCurmat = "";
			$sCurmat2 = "";
			$sCurapto = "";
			
			$sEstudia['crd_ini'] = 0;
		
			//-------------------------------------------------------------------------
			$vQuery = "Select no.cod_cur, count(*) as veces ";
			$vQuery .= "from $tNota no left join unapnet.curso cu on ";
			$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
			$vQuery .= "where no.pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "no.num_mat = '{$sEstudia['num_mat']}' and no.not_cur < 11 and ";
			$vQuery .= "(no.mod_not != '13' and no.mod_not != '08') and ";
			$vQuery .= "(cu.tip_cur='01' or cu.tip_cur='03') and (cu.cod_esp='00' or cu.cod_esp='{$sEstudia['cod_esp']}') and ";
			$vQuery .= "no.cod_car = '{$sUsercoo['cod_car']}' and cu.con_cur = '1' and no.cod_cur not in ";
			$vQuery .= "(Select cod_cur from $tNota where pln_est = '{$sEstudia['pln_est']}' and ";
			$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and not_cur > 10) group by cod_cur order by cod_cur";
			
			$cCurdes2 = fQuery($vQuery);				
			while($aCurdes2 = $cCurdes2->fetch_array())
			{
				if($sEstudia['mod_mat'] == '16')
					$sCurmat[$aCurdes2['cod_cur']]['mod_mat'] = $sEstudia['mod_mat'];
				else
					$sCurmat[$aCurdes2['cod_cur']]['mod_mat'] = fModcurso($aCurdes2['veces']);
				$sCurmat[$aCurdes2['cod_cur']]['tur_est'] = '1';
				$sCurmat[$aCurdes2['cod_cur']]['cur_obli'] = '1';
				$aCurdes[$aCurdes2['cod_cur']] = TRUE;			
				$sEstudia['crd_ini'] += $sCurso[$aCurdes2['cod_cur']]['crd_cur'];
				if ($sCurso[$aCurdes2['cod_cur']]['tip_cur'] == '02')
					$aSemnot[$sCurso[$aCurdes2['cod_cur']]['sem_anu']] = TRUE;
			}
			$cCurdes2->close();
			
			//-------------------------------------------------------------------------
			$vQuery = "Select $tNota.cod_cur from $tNota ";
			$vQuery .= "where $tNota.pln_est = '{$sEstudia['pln_est']}' and $tNota.num_mat = '{$sEstudia['num_mat']}' ";
			$vQuery .= "and $tNota.not_cur > 10 ";
			$cCurapro2 = fQuery($vQuery);	
			while($aCurapro2 = $cCurapro2->fetch_array())
			{
				$aCurapro[$aCurapro2['cod_cur']] = TRUE;
				if ($sCurso[$aCurapro2['cod_cur']]['tip_cur'] == '02')
					$aSemnot[$sCurso[$aCurapro2['cod_cur']]['sem_anu']] = TRUE;
			}
			$cCurapro2->close();
			
			//-------------------------------------------------------------------------
			if(($sEstudia['sem_anu'] != '09' and $sEstudia['sem_anu'] != '10'))
			{
				$vQuery = "Select cod_cur, cur_pre ";
				$vQuery .= "from unapnet.requ ";
				$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}'";
				$cCurpre = fQuery($vQuery);	
				while($aCurpre = $cCurpre->fetch_array())
				{
					if(!$aCurapro[$aCurpre['cur_pre']])
						$aCurnot[$aCurpre['cod_cur']] = TRUE;
				}
			}
			
			//-------------------------------------------------------------------------
			foreach($sCurso as $vCod_cur => $aCurso)
			{
				if(!$aCurapro[$vCod_cur] and !$aCurdes[$vCod_cur] and !$aCurnot[$vCod_cur] and $aCurso['tip_cur'] == '01')
				{
					if($aCurso['crd_prq'] == 0 or $aCurso['crd_prq'] <= $sEstudia['all_crd'])
					{
						$sCurapto[$vCod_cur] = TRUE;
						$aCurobli[$vCod_cur] = TRUE;
					}
				}				
				if(!$aCurapro[$vCod_cur] and !$aCurdes[$vCod_cur] and !$aCurnot[$vCod_cur] and $aCurso['tip_cur'] == '02' and 
					!$aSemnot[$aCurso['sem_anu']])
				{
					if($aCurso['crd_prq'] == 0 or $aCurso['crd_prq'] <= $sEstudia['all_crd'])
					{
						$sCurapto[$vCod_cur] = TRUE;
						$aCurele[$vCod_cur] = TRUE;
						$aSemele[$aCurso['sem_anu']] = TRUE;
					}
				}
				if(!$aCurapro[$vCod_cur] and !$aCurdes[$vCod_cur] and !$aCurnot[$vCod_cur] and $aCurso['tip_cur'] == '03')
				{
					if($aCurso['crd_prq'] == 0 or $aCurso['crd_prq'] <= $sEstudia['all_crd'])
					{
						$sCurapto[$vCod_cur] = TRUE;
						$aCuropta[$vCod_cur] = TRUE;
					}
				}				
			}
			
			//-------------------------------------------------------------------------
			if($sEstudia['crd_ini'] >= $sEstudia['max_crd'])
			{
				$sEstudia['crd_ini'] = 0;
				if($sUsercoo['cod_car'] != '27')
				{
					$aCurobli = "";
					$aCurele = "";
					$aSemele = "";
					$aCuropta = "";
					$sCurapto = "";
				}
				foreach($aCurdes as $vCod_cur => $bCod_cur)
				{
					$aCurdes[$vCod_cur] = FALSE;
					$sCurmat[$vCod_cur]['cur_obli'] = '';
				}
			}
			
			//-------------------------------------------------------------------------
			if($sUsercoo['cod_car'] == '04' and $sEstudia['mod_mat'] != '01' and $sEstudia['mod_mat'] != '07')
			{
				$sEstudia['crd_ini'] = 0;
				foreach($aCurdes as $vCod_cur => $bCod_cur)
				{
					$aCurdes[$vCod_cur] = FALSE;
					$sCurmat[$vCod_cur]['cur_obli'] = '';
				}
			}
			
			//-------------------------------------------------------------------------
			if($sUsercoo['cod_car'] == '27' or  $sUsercoo['cod_car'] == '04' or  $sUsercoo['cod_car'] == '29' or $sUsercoo['cod_car'] == '01' or $sUsercoo['cod_car'] == '02' or $sUsercoo['cod_car'] == '03')
			{
				$sEstudia['crd_ini'] = 0;
				foreach($aCurdes as $vCod_cur => $bCod_cur)
				{
					$aCurdes[$vCod_cur] = FALSE;
					$sCurmat[$vCod_cur]['cur_obli'] = '';
				}
			}
			
			//-------------------------------------------------------------------------
		//	$tEstutut = "unapnet.estutut{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
			if($sUsercoo['ano_aca'] == '2005')
			{
				$tCurtut = "unapnet.curtut{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
				
				$bCurtut = FALSE;
				$sCurtut = "";
				$vCrdtut = 0;
				$vQuery = "Select cod_cur, sec_gru from $tCurtut where num_mat = '{$sEstudia['num_mat']}' and per_aca = '{$sUsercoo['per_aca']}'";
				$cCurtut = fQuery($vQuery);
				while($aCurtut = $cCurtut->fetch_array())
				{
					$sCurtut[$aCurtut['cod_cur']] = $aCurtut['sec_gru'];
					$vCrdtut += $sCurso[$aCurtut['cod_cur']]['crd_cur'];
					$bCurtut = TRUE;
				}
				if($bCurtut)
					$sEstudia['crd_ini'] = $vCrdtut;
			}
			//-------------------------------------------------------------------------
		}
		else
			header("Location:ing_getestu.php");
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
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	
	var crd_ini = 0;
	var crd_max = <?=$sEstudia['max_crd']?>;

	function aumentar(cont, vCanti)
	{ 
		if(cont.checked)
		{
			document.fData.txtCantidad.value = parseFloat(document.fData.txtCantidad.value) + parseFloat(vCanti);
			sombrear(cont);
		}
		else
		{
			document.fData.txtCantidad.value = parseFloat(document.fData.txtCantidad.value) - parseFloat(vCanti);
			desombrear(cont);
		}
		if(parseFloat(document.fData.txtCantidad.value) > <?=$sEstudia['max_crd']?>)
		{
			alert("A sobrepasado el límite de créditos permitidos, se QUITARA el curso escogido");
			cont.checked = false;
			aumentar(cont, vCanti);
		}
		
	}


//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
<div class="wordcen" id="body1">
	  <form action="savematri.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Matricula de estudiantes </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg"><table width="400" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <td width="75" class="wordder">Estudiante : </td>
                  <td colspan="3" class="wordizqb"><?=$sEstudia['num_mat']?>
            -
              <?=$sEstudia['paterno']?>
              <?=$sEstudia['materno']?>
              ,
              <?=$sEstudia['nombres']?></td>
                </tr>
                <tr>
                  <td class="wordder">Plan : </td>
                  <td class="wordizqb"><?=$sEstudia['pln_est']?> - <?=$sTiposist[$sEstudia['tip_sist']]?></td>
                  <td class="wordder">Posible Sem.: </td>
                  <td class="wordizqb"><?=$sSemestre[$sEstudia['sem_anu']]?></td>
                </tr>
                <tr>
                  <td class="wordder">Especialidad : </td>
                  <td colspan="3" class="wordizqb"><?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
                </tr>
                <tr>
                  <td class="wordder">Modalidad : </td>
                  <td width="125" class="wordizqb"><?=$sModmat[$sEstudia['mod_mat']]['mod_des']?></td>
                  <td width="80" class="wordder">M&aacute;ximo. Cred : </td>
                  <td class="wordizqb"><?=$sEstudia['max_crd']?>  créditos</td>
                </tr>
                <tr>
                  <td class="wordder">&nbsp;</td>
                  <td class="wordizqb">&nbsp;</td>
                  <td class="wordder">Escogidos : </td>
                  <td class="wordizqb"><input name="txtCantidad" type="text" class="texto" id="txtCantidad" value="<?=$sEstudia['crd_ini']?>" size="2" maxlength="2" disabled="disabled"> Cr&eacute;ditos</td>
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
		<? if(!empty($aCurdes))  {?>
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos Desaprobados obligatorios a matricularse </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="600" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="20" scope="col">&nbsp;</th>
                  <th width="45" scope="col">C&oacute;d.</th>
                  <th scope="col">Curso</th>
                  <th width="60" scope="col">Sem.</th>
                  <th width="60" scope="col">Mod.</th>
                  <th width="80" scope="col">Grupo</th>
                  <th width="30" scope="col">Cred.</th>
                </tr>
                <? 	$vCont = 1;	foreach($aCurdes as $vCod_cur => $bCod_cur) { ?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?> title="<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?>" onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td>
				  <? if(!$bCod_cur)		{?>
				  <input name="rCurdes[<?=$vCod_cur?>]" type="checkbox" class="check" value="<?=$vCod_cur?>" onClick="aumentar(this, <?=$sCurso[$vCod_cur]['crd_cur']?>)" <? if(!empty($sCurtut[$vCod_cur])) echo "checked"; ?>>
				  <?	}	?>				  </td>
                  <td class="wordizq">&nbsp;<?=$sCurso[$vCod_cur]['cod_cat']?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sSemestre[$sCurso[$vCod_cur]['sem_anu']]))?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sModmat[$sCurmat[$vCod_cur]['mod_mat']]['mod_des']))?></td>
                  <td class="wordizq"><select name="rGrupo<?=$vCod_cur?>" id="rGrupo<?=$vCod_cur?>">
                      <? if(!empty($sCurtut[$vCod_cur])) echo fviewgrupo($sCurtut[$vCod_cur]); else echo fviewgrupo($sEstudia['sec_gru']); ?>
					  </select></td>
                  <td class="wordizq">&nbsp;
                      <?=$sCurso[$vCod_cur]['crd_cur']?></td>
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
		<? if(!empty($aCurobli)) {?>
		<table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos Obligatorios</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="600" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="20" scope="col">&nbsp;</th>
                  <th width="45" scope="col">C&oacute;d.</th>
                  <th scope="col">Curso</th>
                  <th width="60" scope="col">Sem.</th>
                  <th width="60" scope="col">Mod.</th>
                  <th width="80" scope="col">Grupo</th>
                  <th width="30" scope="col">Cred.</th>
                </tr>
                <? 	$vCont = 1;	foreach($aCurobli as $vCod_cur => $bCod_cur) { ?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?> title="<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?>" onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td>				  
				  	<input name="rCurobli[<?=$vCod_cur?>]" type="checkbox" class="check" value="<?=$vCod_cur?>" onClick="aumentar(this, <?=$sCurso[$vCod_cur]['crd_cur']?>)" <? if(!empty($sCurtut[$vCod_cur])) echo "checked"; ?>>
				  </td>
                  <td class="wordizq">&nbsp;<?=$sCurso[$vCod_cur]['cod_cat']?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
                  <td class="wordizq">&nbsp;<?=ucwords(strtolower($sSemestre[$sCurso[$vCod_cur]['sem_anu']]))?></td>
                  <td class="wordizq">&nbsp;<? if($sEstudia['mod_mat'] == '16') 
				  		echo ucwords(strtolower($sModmat[$sEstudia['mod_mat']]['mod_des']));
					else
				  		echo "Regular";
					?></td>
                  <td class="wordizq"><select name="rGrupo<?=$vCod_cur?>" id="rGrupo<?=$vCod_cur?>">
				  	<? if(!empty($sCurtut[$vCod_cur])) echo fviewgrupo($sCurtut[$vCod_cur]); else echo fviewgrupo($sEstudia['sec_gru']); ?>
                  </select></td>
                  <td class="wordizq">&nbsp;<?=$sCurso[$vCod_cur]['crd_cur']?></td>
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
        <? if(!empty($aCuropta)) {?>
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos Optativos - Mensi&oacute;n : <?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="600" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="20" scope="col">&nbsp;</th>
                  <th width="45" scope="col">C&oacute;d.</th>
                  <th scope="col">Curso</th>
                  <th width="60" scope="col">Sem.</th>
                  <th width="60" scope="col">Mod.</th>
                  <th width="80" scope="col">Grupo</th>
                  <th width="30" scope="col">Cred.</th>
                </tr>
                <? 	$vCont = 1;	foreach($aCuropta as $vCod_cur => $bCod_cur) { ?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?> title="<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?>" onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td><input name="rCuropta[<?=$vCod_cur?>]" type="checkbox" class="check" value="<?=$vCod_cur?>" onClick="aumentar(this, <?=$sCurso[$vCod_cur]['crd_cur']?>)" <? if(!empty($sCurtut[$vCod_cur])) echo "checked"; ?>></td>
                  <td class="wordizq">&nbsp;
                      <?=$sCurso[$vCod_cur]['cod_cat']?></td>
                  <td class="wordizq">&nbsp;
                      <?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
                  <td class="wordizq">&nbsp;
                      <?=ucwords(strtolower($sSemestre[$sCurso[$vCod_cur]['sem_anu']]))?></td>
                  <td class="wordizq">&nbsp;<? if($sEstudia['mod_mat'] == '16') 
				  		echo ucwords(strtolower($sModmat[$sEstudia['mod_mat']]['mod_des']));
					else
				  		echo "Regular";
					?></td>
                  <td class="wordizq"><select name="rGrupo<?=$vCod_cur?>" id="rGrupo<?=$vCod_cur?>">
                      <? if(!empty($sCurtut[$vCod_cur])) echo fviewgrupo($sCurtut[$vCod_cur]); else echo fviewgrupo($sEstudia['sec_gru']); ?>
                  </select></td>
                  <td class="wordizq">&nbsp;
                      <?=$sCurso[$vCod_cur]['crd_cur']?></td>
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
        <? if(!empty($aSemele)) { 	foreach($aSemele as $vSem_anu => $bSem_anu) {	?>
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos Electivos - Semestre :
                <?=$sSemestre[$vSem_anu]?></th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="600" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="20" scope="col">&nbsp;</th>
                  <th width="45" scope="col">C&oacute;d.</th>
                  <th scope="col">Curso</th>
                  <th width="60" scope="col">Sem.</th>
                  <th width="60" scope="col">Mod.</th>
                  <th width="80" scope="col">Grupo</th>
                  <th width="30" scope="col">Cred.</th>
                </tr>
                <? 	$vCont = 1;	foreach($aCurele as $vCod_cur => $bCod_cur) 	{ 	if($sCurso[$vCod_cur]['sem_anu'] == $vSem_anu)	{?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?> title="<?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?>" onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td><input name="rCurele[<?=$vSem_anu?>]" type="radio" class="radio" value="<?=$vCod_cur?>" onClick="aumentar(this, <?=$sCurso[$vCod_cur]['crd_cur']?>)" <? if(!empty($sCurtut[$vCod_cur])) echo "checked"; ?>></td>
                  <td class="wordizq">&nbsp;
                      <?=$sCurso[$vCod_cur]['cod_cat']?></td>
                  <td class="wordizq">&nbsp;
                      <?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
                  <td class="wordizq">&nbsp;
                      <?=ucwords(strtolower($sSemestre[$sCurso[$vCod_cur]['sem_anu']]))?></td>
                  <td class="wordizq">&nbsp;<? if($sEstudia['mod_mat'] == '16') 
				  		echo ucwords(strtolower($sModmat[$sEstudia['mod_mat']]['mod_des']));
					else
				  		echo "Regular";
					?></td>
                  <td class="wordizq"><select name="rGrupo<?=$vCod_cur?>" id="rGrupo<?=$vCod_cur?>">
                      <? if(!empty($sCurtut[$vCod_cur])) echo fviewgrupo($sCurtut[$vCod_cur]); else echo fviewgrupo($sEstudia['sec_gru']); ?>
                  </select></td>
                  <td class="wordizq">&nbsp;
                      <?=$sCurso[$vCod_cur]['crd_cur']?></td>
                </tr>
                <? $vCont++; 	}	} 	?>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
        <? } 	}?>
		<table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Observaciones</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><textarea name="rObs_est" cols="115" rows="2" id="rObs_est" onBlur="fupper(this)"></textarea></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>
	  </form>
  <a href="" title="Matricular" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bmatricular.png" width="100" height="24"></a> 
  <a href="<?=($sEstudia['ingreg'] == 'i'?"ing_getestu.php":"reg_getestu.php")?>" title="Cancelar" class="linkboton" ><img src="../images/bcancel.png" width="100" height="24"></a>  </div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
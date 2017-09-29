<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		
		if(!empty($sUsercoo['pln_est']))
		{
			$vPln_est = $sUsercoo['pln_est'];
			$sNiv_sem = "";
			$sRequ = "";
			
			$vQuery = "Select niv_est, sem_anu from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$vPln_est' ";
			$vQuery .= "order by niv_est, sem_anu";
			$cNiv_sem = fQuery($vQuery);
			while($aNiv_sem = $cNiv_sem->fetch_array())
			{
				$sNiv_sem[$aNiv_sem['niv_est'].$aNiv_sem['sem_anu']]['niv_est'] = $aNiv_sem['niv_est'];
				$sNiv_sem[$aNiv_sem['niv_est'].$aNiv_sem['sem_anu']]['sem_anu'] = $aNiv_sem['sem_anu'];
			}
			
			$vQuery = "Select cod_cur, cur_pre from unapnet.requ where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$vPln_est' order by cod_cur";
			$cRequ = fQuery($vQuery);
			while($aRequ = $cRequ->fetch_array())
			{
				if(!empty($sRequ[$aRequ['cod_cur']]))
					$sRequ[$aRequ['cod_cur']] .= "-{$aRequ['cur_pre']}";
				else
					$sRequ[$aRequ['cod_cur']] = $aRequ['cur_pre'];
			}


		}
		else
		{
			header("Location:pln_selectplan.php");
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
	<? include "../include/mmaestros.php"; ?>
	
	<div class="wordcen" id="body1">
		<form action="pln_saveplan.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	      <table border="0" cellpadding="0" cellspacing="0" id="ventana">
            <tr>
              <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
              <th align="center" background="../images/ventana_r1_c2.jpg" >Planes de Estudio </th>
              <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
            </tr>
            <tr>
              <td background="../images/ventana_r2_c1.jpg"></td>
              <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                  <tr>
                    <td width="100" class="wordder">Plan de Estudios : </td>
                    <td width="100" class="wordizqb"><?=$vPln_est?> - <?=$sTiposist[$sPlan[$vPln_est]]?></td>
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
          <?	if(!empty($sNiv_sem))	foreach($sNiv_sem as $vNiv_sem2 => $vNiv_sem)	{	?>
		  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
            <tr>
              <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
              <th align="center" background="../images/ventana_r1_c2.jpg" >Nivel : <?=$sNivel[$vNiv_sem['niv_est']]?> - Semestre : <?=$sSemestre[$vNiv_sem['sem_anu']]?> </th>
              <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
            </tr>
            <tr>
              <td background="../images/ventana_r2_c1.jpg"></td>
              <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                  <tr>
                    <th width="20" scope="col">C</th>
                    <th width="100" scope="col">Curso</th>
                    <th width="120" scope="col">Especialidad</th>
                    <th width="85" scope="col">Tipo</th>
                    <th width="75" scope="col">Tipo Req.</th>
                    <th width="60" scope="col"> Req.</th>
                  </tr>
                  <? 	$vCont = 1;	
				  		$vQuery = "Select cod_cur, cod_cat, nom_cur, cod_esp, tip_cur, tip_pre ";
						$vQuery .= "from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$vPln_est' and ";
						$vQuery .= "niv_est = '{$vNiv_sem['niv_est']}' and sem_anu = '{$vNiv_sem['sem_anu']}' order by tip_cur, cod_esp, cod_cur ";
						$cCurso = fQuery($vQuery);
						while($aCurso = $cCurso->fetch_array())
						{ 
					?>
                  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
                    <td class="wordcen"><?=$aCurso['cod_cur']?></td>
                    <td width="100" class="wordizq"><?=ucwords(strtolower($aCurso['nom_cur']))?></td>
                    <td class="wordizq"><select name="rCod_esp<?=$aCurso['cod_cur']?>" id="rCod_esp<?=$aCurso['cod_cur']?>">
                      <?=fviewespecial2($sUsercoo['pln_est'], $aCurso['cod_esp'])?>
                    </select></td>
                    <td class="wordizq"><select name="rTip_cur<?=$aCurso['cod_cur']?>" id="rTip_cur<?=$aCurso['cod_cur']?>">
                      <?=fviewtipcur($aCurso['tip_cur'])?>
                    </select></td>
                    <td class="wordizq"><select name="rTip_pre<?=$aCurso['cod_cur']?>" id="rTip_pre<?=$aCurso['cod_cur']?>">
                      <?=fviewtippre($aCurso['tip_pre'])?>
                    </select></td>
                    <td class="wordizq"><? if(!empty($sRequ[$aCurso['cod_cur']])) echo $sRequ[$aCurso['cod_cur']]; else echo "Ninguno";	?></td>
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
		  <?	}	?>
          <input name="Submit" type="submit" class="boton" value="Guardar">
      </form>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
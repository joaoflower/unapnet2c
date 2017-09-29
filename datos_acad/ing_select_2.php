<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	$vFile ="cur_select.php";
	if(fsafetyselcar())
	{
		if (!empty($_POST['rPln_est'])) $sUsercoo['pln_est'] = $_POST['rPln_est'];
		if (!empty($_POST['rSem_anu'])) $sUsercoo['sem_anu'] = $_POST['rSem_anu'];
		if (!empty($_POST['rCod_esp'])) $sUsercoo['cod_esp'] = $_POST['rCod_esp'];
		if (!empty($_POST['rSec_gru'])) $sUsercoo['sec_gru'] = $_POST['rSec_gru'];
		if (!empty($_POST['rCod_cur'])) $sUsercoo['cod_cur'] = $_POST['rCod_cur'];
		if (!empty($_POST['rMod_not'])) $sUsercoo['mod_not'] = $_POST['rMod_not'];

		$sHorario = "";
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
	  <form action="ing_select.php" method="post" enctype="multipart/form-data" name="fCambio" id="fCambio"> 
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Ingreso de Notas </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="0" class="tabled">
            <tr>
              <td width="100" class="wordder">Plan de Estudios : </td>
              <td width="400" class="wordizq">
                <select name="rPln_est" id="select" onChange="cambio();">
                  <?=fviewplanrep($sUsercoo['pln_est'])?>
                </select></td>
            </tr>
            <tr>
              <td class="wordder">Especialidad : </td>
              <td class="wordizq"><select name="rCod_esp" id="rCod_esp" onChange="cambio();">
                  <?=fviewespecialing($sUsercoo['pln_est'], $sUsercoo['cod_esp'])?>
              </select></td>
            </tr>
            <tr>
              <td class="wordder">Semestre : </td>
              <td class="wordizq"><select name="rSem_anu" id="rSem_anu" onChange="cambio();">
                <?=fviewsemestreing($sUsercoo['pln_est'], $sUsercoo['cod_esp'], $sUsercoo['sem_anu'])?>
              </select></td>
            </tr>
            <tr>
              <td class="wordder">Curso : </td>
              <td class="wordizq"><select name="rCod_cur" id="select3" onChange="cambio();">
                  <?=fviewcursoing($sUsercoo['pln_est'], $sUsercoo['cod_esp'], $sUsercoo['sem_anu'], $sUsercoo['cod_cur'])?>
                                          </select></td>
            </tr>
            <tr>
              <td class="wordder">Grupo : </td>
              <td class="wordizq"><select name="rSec_gru" id="rSec_gru" onChange="cambio();">
                <?=fviewgrupoing( $sUsercoo['sec_gru'], $sUsercoo['pln_est'], $sUsercoo['cod_cur'])?>
              </select></td>
            </tr>
            <tr>
              <td class="wordder">Modalidad : </td>
              <td class="wordizq"><select name="rMod_not" id="rMod_not" onChange="cambio();">
                <?=fviewmodnoting( $sUsercoo['sec_gru'], $sUsercoo['pln_est'], $sUsercoo['cod_cur'], $sUsercoo['mod_not'])?>
                            </select></td>
            </tr>
			<?
			  	$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
				$vQuery = "Select paterno, materno, nombres ";
				$vQuery .= "from $tCarga left join unapnet.docente on $tCarga.cod_prf = docente.cod_prf ";
				$vQuery .= "where $tCarga.cod_car = '{$sUsercoo['cod_car']}' and $tCarga.pln_est = '{$sUsercoo['pln_est']}' and ";
				$vQuery .= "$tCarga.cod_cur = '{$sUsercoo['cod_cur']}' and $tCarga.sec_gru = '{$sUsercoo['sec_gru']}'";
				$cDocente = fQuery($vQuery);
				if($aDocente = $cDocente->fetch_array())
					$vDocente = "{$aDocente['paterno']} {$aDocente['materno']}, {$aDocente['nombres']}";
			  ?>
            <tr>
              <td class="wordder">Docente : </td>
              <td class="wordizqb"><?=$vDocente?></td>
            </tr>
            <tr>
              <td colspan="2" class="wordcen">			  
			  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                  <tr>
                    <th width="30" scope="col">Nro</th>
                    <th width="55" scope="col">Num.mat</th>
                    <th width="250" scope="col">Apellidos y Nombres </th>
                    <th width="80" scope="col">Mod.</th>
                    <th width="25" scope="col">Nota</th>
                  </tr>
					<?		$vCont = 1;
						$aEstu = "";
						$sEstupdf = "";
						$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
						$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
						
						$vQuery = "Select num_mat, not_cur ";
						$vQuery .= "from $tNota ";
						$vQuery .= "where $tNota.pln_est = '{$sUsercoo['pln_est']}' and $tNota.cod_cur = '{$sUsercoo['cod_cur']}' and ";
						$vQuery .= "$tNota.mod_not = '{$sUsercoo['mod_not']}' and ano_aca = '{$sUsercoo['ano_aca']}' and ";
						$vQuery .= "$tNota.per_aca = '{$sUsercoo['per_aca']}' ";
						$cNota = fQuery($vQuery);
						while($aNota = $cNota->fetch_array())
						{
							$sNota[$aNota['num_mat']] = $aNota['not_cur'];
						}						
						
						$vQuery = "Select estudiante.num_mat, estudiante.paterno, estudiante.materno, estudiante.nombres, ";
						$vQuery .= "$tCurmat.mod_mat, modmat.mod_not ";
						$vQuery .= "from $tCurmat left join unapnet.estudiante on $tCurmat.num_mat = estudiante.num_mat and ";
						$vQuery .= "$tCurmat.cod_car = estudiante.cod_car ";
						$vQuery .= "left join unapnet.modmat on $tCurmat.mod_mat = modmat.mod_mat ";
						$vQuery .= "where $tCurmat.pln_est = '{$sUsercoo['pln_est']}' and $tCurmat.per_aca = '{$sUsercoo['per_aca']}' and ";
						$vQuery .= "$tCurmat.cod_cur = '{$sUsercoo['cod_cur']}' and $tCurmat.sec_gru = '{$sUsercoo['sec_gru']}' and ";
						$vQuery .= "modmat.mod_not = '{$sUsercoo['mod_not']}' ";
						$vQuery .= "order by paterno, materno, nombres";
						$cCurmat = fQuery($vQuery);
						while($aCurmat = $cCurmat->fetch_array())
						{
					?>
                  <tr  <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
                    <td class="wordcen"><?=$vCont?></td>
                    <td class="wordcen"><?=$aCurmat['num_mat']?></td>
                    <td class="wordizq"><?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
                    <td class="wordizq"><?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
                    <td class="wordder">
					<span class ="<?	if($sNota[$aCurmat['num_mat']] < 11) echo "notades"; else echo "notapro" ?>">
					<?=$sNota[$aCurmat['num_mat']]?>
					</span>
					</td>
                  </tr>
				  <?	$vCont++;	}	?>
                </table>                  </td>

            </tr>
            <tr>
              <td colspan="2" class="wordcen">
				<? if(empty($sNota)) 	{	?>
				  <a href="ing_getnota.php" class="enlace1">&lt; Ingresar Notas &gt;</a>
				<?	}	else	{	?>
			  <a href="ing_getnota.php" class="enlace1"> &lt; Modificar Nota &gt;</a>
			  	<?	}	?>
			  </td>
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
	  </form>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if(!empty($_GET['rNum_mat']))
			$vNum_mat = $_GET['rNum_mat'];
		else
			$vNum_mat = $sEstudia['num_mat'];
		
		$sEstudia = "";
		$sCurso = "";
		$sCurmat = "";
		$sCurmat2 = "";
		$sCurapto = "";
		$sCurso = "";
		$sAnoper = "";
		
		$vQuery = "Select num_mat, paterno, materno, nombres from unapnet.estudiante where num_mat = '$vNum_mat' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' ";
		$cEstudia = fQuery($vQuery);
		if($aEstudia2 = $cEstudia->fetch_array())
		{
			$sEstudia['num_mat'] = $aEstudia2['num_mat'];
			$sEstudia['paterno'] = $aEstudia2['paterno'];
			$sEstudia['materno'] = $aEstudia2['materno'];
			$sEstudia['nombres'] = $aEstudia2['nombres'];
			
			$vPln_est = $_GET['rPln_est'];
			$vCod_cur = $_GET['rCod_cur'];
			if(!empty($vPln_est) and !empty($vCod_cur))
			{
				$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
				$vQuery = "Select cod_esp, sem_anu from unapnet.curso where cod_car = '{$sUsercoo['cod_car']}' and ";
				$vQuery .= "pln_est = '$vPln_est' and cod_cur = '$vCod_cur'";
				$cCurso = fQuery($vQuery);
				if($aCurso = $cCurso->fetch_array())
				{
					$sUsercoo['pln_est'] = $vPln_est;
					$sUsercoo['cod_cur'] = $vCod_cur;
					$sUsercoo['cod_esp'] = $aCurso['cod_esp'];
					$sUsercoo['sem_anu'] = $aCurso['sem_anu'];
					
					$vQuery = "Select not_cur from $tNota where num_mat = '{$sEstudia['num_mat']}' and ";
					$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ";
					$vQuery .= "mod_not = '04'";
					$cNota = fQuery($vQuery);
					if($aNota = $cNota->fetch_array())
					{
						$sEstudia['not_cur'] = $aNota['not_cur'];
					}
				}
			}
		}
		else
		{
			header("Location:con_getestu.php");
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
	function verify()
	{
		document.fData.rPln_est.value = document.frameCambio.fCambio.rPln_est.value;
		document.fData.rCod_esp.value = document.frameCambio.fCambio.rCod_esp.value;
		document.fData.rSem_anu.value = document.frameCambio.fCambio.rSem_anu.value;
		document.fData.rCod_cur.value = document.frameCambio.fCambio.rCod_cur.value;
		if(document.fData.rNot_cur.value < 11 || document.fData.rNot_cur.value > 20)
		{
			alert("La nota ingresada no es VALIDA ... !");
			document.fData.rNot_cur.focus();
			return false;
		}
		return true;
	}

//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="con_savenota.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Datos principales del Estudiante </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg"><table border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <td width="100" class="wordder">Estudiante : </td>
                  <td width="350" class="wordizqb"><?=$sEstudia['num_mat']?> - <?=$sEstudia['paterno']?> <?=$sEstudia['materno']?> , <?=$sEstudia['nombres']?></td>
                </tr>
                <tr>
                  <td colspan="2" class="wordder"><iframe width="450"  name ="frameCambio"  height="90" id="frameCambio" src="con_curnota.php"  scrolling="no" frameborder="0" >                    
                </iframe><input name="rPln_est" type="hidden" id="rPln_est" value="">
                    <input name="rCod_esp" type="hidden" id="rCod_esp" value="">
                    <input name="rSem_anu" type="hidden" id="rSem_anu" value="">
                    <input name="rCod_cur" type="hidden" id="rCod_cur" value=""></td>
                </tr>
                <tr>
                  <td class="wordder">Nota : </td>
                  <td class="wordizq"><input name="rNot_cur" type="text" class="texto" id="rNot_cur" value="<?=$sEstudia['not_cur']?>" size="2" maxlength="2"></td>
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
        <input name="Submit" type="submit" class="boton" value="Guardar" onClick = "if(verify()){ document.fData.submit();} return false">
	  </form>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
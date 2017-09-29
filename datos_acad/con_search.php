<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vNum_mat = $_POST['rNum_mat'];
		$vPaterno = $_POST['rPaterno'];
		$vMaterno = $_POST['rMaterno'];
		$vNombres = $_POST['rNombres'];
		
		$vQuery = "Select num_mat, paterno, materno, nombres from unapnet.estudiante where cod_car = '{$sUsercoo['cod_car']}' ";
		
		if((!empty($vNum_mat) or !empty($vPaterno) or !empty($vMaterno) or !empty($vNombres)))
		{
			if(!empty($vNum_mat))
				$vQuery .= "and num_mat = '$vNum_mat'";
			if(!empty($vPaterno))
				$vQuery .= "and paterno = '$vPaterno'";
			if(!empty($vMaterno))
				$vQuery .= "and materno = '$vMaterno'";
			if(!empty($vNombres))
				$vQuery .= "and nombres = '$vNombres'";
				
			$aEstudia = "";
			$cEstudia = fQuery($vQuery);
			while($aEstudia2 = $cEstudia->fetch_array())
				$aEstudia[$aEstudia2['num_mat']] = "{$aEstudia2['paterno']} {$aEstudia2['materno']}, {$aEstudia2['nombres']}";
			$cEstudia->close();
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
//-->
</script>
</head>

<body >
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
		<form action="not_getestu.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Convalidaci&oacute;n  de Notas </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th scope="col">Num.Mat.</th>
              <th scope="col">Apellidos y Nombres</th>
            </tr>
            <? 	$vCont = 1;	 if(!empty($aEstudia)) foreach($aEstudia as $vNum_mat2 => $vApe_nom2) { ?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td><a href="con_viewnota.php?rNum_mat=<?=$vNum_mat2?>" class="enlace1"><?=$vNum_mat2?></a></td>
              <td class="wordizq">&nbsp;<?=$vApe_nom2?>&nbsp;</td>
            </tr>
			<? $vCont++; 	} ?>
			<tr>
			  <td colspan="2" class="wordcen"><input name="Submit" type="submit" class="boton" value="Nueva B&uacute;squeda"></td>
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
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{

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
	function enfocar()
	{
		//document.fData.rPln_est.focus();
	}
//-->
</script>
</head>

<body onLoad="enfocar();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmaestros.php"; ?>
	
	<div class="wordcen" id="body1">
		<form action="pln_savecursopre.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Cursos Pre-requisitos de: <?=$sUsercoo['nom_cur']?></th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="0" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
		  	<tr>
			  <th class="wordcen"></th>
			  <th class="wordizqb">&nbsp;Cod&nbsp;</th>
		      <th class="wordizqb">&nbsp;Sem&nbsp;</th>
		      <th class="wordizqb">&nbsp;Esp&nbsp;</th>
		      <th class="wordizqb">&nbsp;Nombre del Curso&nbsp;</th>
			</tr>
			<?
				$vQuery = "Select cod_cur, nom_cur, cod_esp, sem_anu from unapnet.curso where ";
				$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sUsercoo['pln_est']}' and ";
				$vQuery .= "sem_anu < '{$sUsercoo['sem_anu']}' and (cod_esp = '{$sUsercoo['cod_esp']}' or cod_esp = '00' ) ";
				$vQuery .= "order by sem_anu, cod_cur";
				$cCurso = fQuery($vQuery);
				while($aCurso = $cCurso->fetch_array())
				{
					if(!$sPre[$aCurso['cod_cur']])
					{
			?>			
			<tr <? if($aCurso['sem_anu'] % 2 == 0)  echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onMouseOver="mouseover(this)" onMouseOut="mouseout(this)"> 			
              <td width="30" class="wordcen"><input name="rCurpre[<?=$aCurso['cod_cur']?>]" type="checkbox" id="rCurobli[<?=$aCurso['cod_cur']?>]" value="checkbox"></td>
              <td class="wordcen">&nbsp;<?=$aCurso['cod_cur']?>&nbsp;</td>
              <td class="wordcen">&nbsp;<?=$aCurso['sem_anu']?>&nbsp;</td>
              <td class="wordcen">&nbsp;<?=$aCurso['cod_esp']?>&nbsp;</td>
              <td class="wordizq">&nbsp;<?=$aCurso['nom_cur']?>&nbsp;</td>
			</tr>
			<?
				}	}
			?>
			<tr>
			  <td colspan="5" class="wordcen"></td>
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
		<a href="" title="Guardar cursos pre-requisitos" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
		<a href="pln_viewcurso.php" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
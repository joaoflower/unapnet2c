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
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>	

//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="edt_edtsaveestu.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
        <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Cambio de Grupo de Matr&iacute;cula </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg"><table width="400" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <td class="wordder">Estudiante : </td>
                  <td class="wordizqb"><?=$sEstudia['num_mat']?> - <?=$sEstudia['paterno']?> <?=$sEstudia['materno']?>, <?=$sEstudia['nombres']?></td>
                </tr>
                <tr>
                  <td width="75" class="wordder">Plan : </td>
                  <td class="wordizqb"><?=$sEstudia['pln_est']?> - <?=$sTiposist[$sEstudia['tip_sist']]?></td>
                </tr>
                
                <tr>
                  <td class="wordder">Modalidad : </td>
                  <td class="wordizqb"><?=$sModmat[$sEstudia['mod_mat']]['mod_des']?></td>
                </tr>
                <tr>
                  <td class="wordder">Grupo : </td>
                  <td class="wordizqb"><span class="wordizq">
                    <select name="rSec_gru" id="rSec_gru">
                      <?=fviewgrupo($sEstudia['sec_gru'])?>
                  </select>
                  </span></td>
                </tr>
                <tr>
                  <td class="wordder">Especialidad : </td>
                  <td class="wordizqb"><select name="rCod_esp" id="rCod_esp" >
        <?=fviewespecial($sEstudia['pln_est'], $sEstudia['cod_esp'])?>
      </select></td>
                </tr>
                <tr>
                  <td class="wordcen">&nbsp;</td>
                  <td class="wordizq"><input name="rTodos" type="checkbox" class="check" id="rTodos">
                  Cambiar todos los cursos matriculados en el mismo grupo </td>
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
	  <a href="" title="Guardar" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bsave.png" width="100" height="24"></a> 
  <a href="edt_viewmatri.php?rNum_mat=<?=$sEstudia['num_mat']?>&rCod_car=<?=$sEstudia['cod_car']?>" title="Cancelar" class="linkboton" ><img src="../images/bcancel.png" width="100" height="24"></a>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
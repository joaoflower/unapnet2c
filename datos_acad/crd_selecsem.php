<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
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
	function gen_cuadro()
	{
		var vReturn;
		var vAtributo;
		var vCont;
		var vSem_anu;
		vAtributo = "center=yes; dialogHeight=575px; dialogWidth=800px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=yes; resizable=no; font-family=Arial; font-size=11px";
		var vCan_sem = document.fData.rSem_anu.length;
		for(vCont=0;vCont<vCan_sem;vCont++)
		{
			if(document.fData.rSem_anu[vCont].checked)
			{
				break;
			}
		}
		if(vCont >= 0 && vCont < vCan_sem)
		{
			switch(vCont)
			{
				case 0:	vSem_anu = '01'; break;
				case 1:	vSem_anu = '02'; break;
				case 2:	vSem_anu = '03'; break;
				case 3:	vSem_anu = '04'; break;
				case 4:	vSem_anu = '05'; break;
				case 5:	vSem_anu = '06'; break;
				case 6:	vSem_anu = '07'; break;
				case 7:	vSem_anu = '08'; break;
				case 8:	vSem_anu = '09'; break;
				case 9:	vSem_anu = '10'; break;
				case 10: vSem_anu = '11'; break;
				case 11: vSem_anu = '12'; break;
				case 12: vSem_anu = '13'; break;
				case 13: vSem_anu = '14'; break;
				case 14: vSem_anu = '15'; break;			
			}
			vReturn = window.showModalDialog("crd_gencuadro.php?rSem_anu="+vSem_anu, "mensaje", vAtributo);

		}
		else
		{
			alert("SELECCIONE UN SEMESTRE O NIVEL ...!!!!");
		}
	}
	
	function gen_cuadrosem()
	{
		var vReturn;
		var vAtributo;
		var vCont;
		var vSem_anu;
		vAtributo = "center=yes; dialogHeight=575px; dialogWidth=800px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=yes; resizable=no; font-family=Arial; font-size=11px";
		var vCan_sem = document.fData.rSem_anu.length;
		for(vCont=0;vCont<vCan_sem;vCont++)
		{
			if(document.fData.rSem_anu[vCont].checked)
			{
				break;
			}
		}
		if(vCont >= 0 && vCont < vCan_sem)
		{
			switch(vCont)
			{
				case 0:	vSem_anu = '01'; break;
				case 1:	vSem_anu = '02'; break;
				case 2:	vSem_anu = '03'; break;
				case 3:	vSem_anu = '04'; break;
				case 4:	vSem_anu = '05'; break;
				case 5:	vSem_anu = '06'; break;
				case 6:	vSem_anu = '07'; break;
				case 7:	vSem_anu = '08'; break;
				case 8:	vSem_anu = '09'; break;
				case 9:	vSem_anu = '10'; break;
				case 10: vSem_anu = '11'; break;
				case 11: vSem_anu = '12'; break;
				case 12: vSem_anu = '13'; break;
				case 13: vSem_anu = '14'; break;
				case 14: vSem_anu = '15'; break;			
			}
			vReturn = window.showModalDialog("crd_gencuadrosem.php?rSem_anu="+vSem_anu, "mensaje", vAtributo);

		}
		else
		{
			alert("SELECCIONE UN SEMESTRE O NIVEL ...!!!!");
		}
	}
	function gen_cuadropro()
	{
		var vReturn;
		var vAtributo;
		var vCont;
		var vSem_anu;
		vAtributo = "center=yes; dialogHeight=575px; dialogWidth=800px; dialogLeft=px; dialogTop=px; ";
		vAtributo += "help=no; status=no; scroll=yes; resizable=no; font-family=Arial; font-size=11px";
		var vCan_sem = document.fData.rSem_anu.length;
		
		vReturn = window.showModalDialog("crd_gencuadropro.php", "mensaje", vAtributo);
	}
//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mdatos_acad.php"; ?>
	
	<div class="wordcen" id="body1">
	
	<form action="" method="get" enctype="multipart/form-data" name="fData" id="fData">
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Semestres del Cuadro de M&eacute;ritos </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="20">&nbsp;</th>
              <th width="20">C</th>
              <th width="100">Semestre</th>
              <th width="40">Cred</th>
              <th width="50">Crd.ini</th>
              <th width="50">Crd.fin</th>
            </tr>		
			<?				
				$vCont = 1;
/*				$vQuery = "Select sem_anu, crd_sem, crd_ini, crd_fin from unapnet.credisem ";
				$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' order by sem_anu ";*/
				$vQuery = "Select distinct sem_anu from unapnet.credisem ";
				$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' order by sem_anu ";
				$cCredisem = fQuery($vQuery);
				while($aCredisem = $cCredisem->fetch_array())
				{
					
			?>	
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\"  id=\"i\"";?>  onmouseover="mouseover(this)" onmouseout="mouseout(this)"> 
              <td><input name="rSem_anu" type="radio" class="radio" value="<?=$aCredisem['sem_anu']?>"></td>
              <td>&nbsp;<?=$aCredisem['sem_anu']?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sSemestre[$aCredisem['sem_anu']]))?></td>
              <td class="wordder"><?=$aCredisem['crd_sem']?>&nbsp;</td>
              <td class="wordder"><?=$aCredisem['crd_ini']?>&nbsp;</td>
              <td class="wordder"><?=$aCredisem['crd_fin']?>&nbsp;</td>
            </tr>
			<?
				$vCont++;	}
			?>			
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
	  
	  <a href="" onclick="gen_cuadropro(); return false;" title="Generar Cuadro Promocional" class="linkboton"><img src="../images/bgencuapro.png" width="100" height="24"></a>
	  <!--<a href="" onclick="gen_cuadro(); return false;" title="Generar Cuadro de M�ritos" class="linkboton"><img src="../images/bgencuaanu.png" width="100" height="24"></a>   -->
	  <a href="" onclick="gen_cuadrosem(); return false;" title="Generar Cuadro de M�ritos" class="linkboton"><img src="../images/bgencuasem.png" width="100" height="24"></a>
	</form>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>

<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";

	if(fsafetyselcar())
	{
		if (!empty($_POST['rPln_est'])) $sUsercoo['pln_est'] = $_POST['rPln_est'];
		if (!empty($_POST['rSem_anu'])) $sUsercoo['sem_anu'] = $_POST['rSem_anu'];
		if (!empty($_POST['rCod_esp'])) $sUsercoo['cod_esp'] = $_POST['rCod_esp'];
		if (!empty($_POST['rSec_gru'])) $sUsercoo['sec_gru'] = $_POST['rSec_gru'];
		if (!empty($_POST['rTur_est'])) $sUsercoo['tur_est'] = $_POST['rTur_est'];
		if (!empty($_POST['rCod_cur'])) $sUsercoo['cod_cur'] = $_POST['rCod_cur'];

		$tHorario = "unapnet.hora{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
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
	function cambio(){
		document.fCambio.submit();	
}
//-->
</script>
</head>

<body background="../images/bgwhite.jpg" >

<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Ingreso de Horario </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  
		  <form action="hor_plancur.php" method="post" name="fCambio">



<table width="450" border="0" cellpadding="1" cellspacing="0" class="tabled">

  <tr>
    <td width="100" class="wordder">Plan de Estudios : </td>
    <td width="350" class="wordizq">
      <select name="rPln_est" id="rPln_est" onChange="cambio();">
        <?=fviewplan($sUsercoo['pln_est'])?>
      </select>
    </td>
  </tr>
  <tr>
    <td width="100" class="wordder">Semestre : </td>
    <td class="wordizq">
      <select name="rSem_anu" id="rSem_anu" onChange="cambio();">
        <?=fviewsemhora($sUsercoo['pln_est'], $sUsercoo['sem_anu'])?>
      </select>
    </td>
  </tr>
  <tr>
    <td class="wordder">Especialidad : </td>
    <td class="wordizq"><select name="rCod_esp" id="rCod_esp" onChange="cambio();">
      <?=fviewespecial($sUsercoo['pln_est'], $sUsercoo['cod_esp'])?>
        </select></td>
  </tr>
  <tr>
    <td class="wordder">Grupo : </td>
    <td class="wordizq"><select name="rSec_gru" id="rSec_gru" onChange="cambio();">
      <?=fviewgrupo($sUsercoo['sec_gru'])?>
        </select></td>
  </tr>
  <tr>
    <td class="wordder">Turno : </td>
    <td class="wordizq"><select name="rTur_est" id="select2" onChange="cambio();">
        <?=fviewturno($sUsercoo['tur_est'])?>
    </select></td>
  </tr>
  <tr>
    <td class="wordder">Curso : </td>
    <td class="wordizq"><select name="rCod_cur" id="select3" onChange="cambio();">
      <?=fviewcursohora($sUsercoo['pln_est'], $sUsercoo['sem_anu'], $sUsercoo['cod_cur'], $sUsercoo['cod_esp'])?>
        </select></td>
  </tr>
  </table>
</form>
<form action="hor_savehora.php" method="post" name="fCambio2">
<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
      <tr>
        <th width="50" scope="col">Hora</th>
        <th width="40" scope="col">Lunes</th>
        <th width="40" scope="col">Mart.</th>
        <th width="40" scope="col">Mierc.</th>
        <th width="40" scope="col">Juev.</th>
        <th width="40" scope="col">Vien.</th>
        <th width="40" scope="col">Sab</th>
        <th width="40" scope="col">Dom</th>
      </tr>
      <? 	$vCont = 1;	 
	  		if(!empty($sCodhora) and !empty($sUsercoo['pln_est']) and !empty($sUsercoo['sem_anu']) and !empty($sUsercoo['sec_gru']) and !empty($sUsercoo['tur_est']) and !empty($sUsercoo['cod_cur'])) 
			{
				$vQuery = "Select cod_dia, cod_hor from $tHorario where pln_est = '{$sUsercoo['pln_est']}' and ";
				$vQuery .= "cod_cur = '{$sUsercoo['cod_cur']}' and sec_gru = '{$sUsercoo['sec_gru']}' and ";
				$vQuery .= "per_aca = '{$sUsercoo['per_aca']}'";
				$cHorario = fQuery($vQuery);
				while($aHorario = $cHorario->fetch_array())
				{
					$sHorario[$aHorario['cod_dia'].$aHorario['cod_hor']] = TRUE;
				}
				
				foreach($sCodhora as $vCod_hor => $vCodhora) 
				{
					if($vCodhora['tur_est'] == $sUsercoo['tur_est']) 
					{					
	  ?>
      <tr>
        <td class="wordcen">&nbsp;<?=$vCodhora['hrs_ini']?> - <?=$vCodhora['hrs_fin']?></td>
        <td class="wordcen"><input name="rDia_hor[1<?=$vCod_hor?>]" type="checkbox" class="check" id="rDia_hor[1<?=$vCod_hor?>]" value="1<?=$vCod_hor?>" <? if($sHorario["1$vCod_hor"]) echo "checked" ?>></td>
        <td class="wordcen"><input name="rDia_hor[2<?=$vCod_hor?>]" type="checkbox" class="check" id="rDia_hor[2<?=$vCod_hor?>]" value="2<?=$vCod_hor?>" <? if($sHorario["2$vCod_hor"]) echo "checked" ?>></td>
        <td class="wordcen"><input name="rDia_hor[3<?=$vCod_hor?>]" type="checkbox" class="check" id="rDia_hor[3<?=$vCod_hor?>]" value="3<?=$vCod_hor?>" <? if($sHorario["3$vCod_hor"]) echo "checked" ?>></td>
        <td class="wordcen"><input name="rDia_hor[4<?=$vCod_hor?>]" type="checkbox" class="check" id="rDia_hor[4<?=$vCod_hor?>]" value="4<?=$vCod_hor?>" <? if($sHorario["4$vCod_hor"]) echo "checked" ?>></td>
        <td class="wordcen"><input name="rDia_hor[5<?=$vCod_hor?>]" type="checkbox" class="check" id="rDia_hor[5<?=$vCod_hor?>]" value="5<?=$vCod_hor?>" <? if($sHorario["5$vCod_hor"]) echo "checked" ?>></td>
        <td class="wordcen"><input name="rDia_hor[6<?=$vCod_hor?>]" type="checkbox" class="check" id="rDia_hor[6<?=$vCod_hor?>]" value="6<?=$vCod_hor?>" <? if($sHorario["6$vCod_hor"]) echo "checked" ?>></td>
        <td class="wordcen"><input name="rDia_hor[7<?=$vCod_hor?>]" type="checkbox" class="check" id="rDia_hor[7<?=$vCod_hor?>]" value="7<?=$vCod_hor?>" <? if($sHorario["7$vCod_hor"]) echo "checked" ?>></td>
      </tr>
      <?	} 	$vCont++;	} 	}	 ?>
  </table>
      
</form>
		  
		  </td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
</table>
<center>
<? if(!empty($sCodhora) and !empty($sUsercoo['pln_est']) and !empty($sUsercoo['sem_anu']) and !empty($sUsercoo['sec_gru']) and !empty($sUsercoo['tur_est']) and !empty($sUsercoo['cod_cur'])) 
			{ 
		?>
	  <a href="" title="Guardar" class="linkboton" onClick = "document.fCambio2.submit(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
	  	  <?	}	?>		
		<a href="hor_viewhora.php" title="Ver Horario" class="linkboton" target="_top"><img src="../images/bviewhora.png" width="100" height="24"></a>

</center>
</body>
</html>

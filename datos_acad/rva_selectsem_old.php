<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		$sCurso = "";
	
		$vQuery = "Select distinct cu.pln_est, cu.sem_anu, cu.cod_esp, ap.sec_gru ";
		$vQuery .= "from $tApla ap left join unapnet.curso cu on cu.pln_est = ap.pln_est and ";
		$vQuery .= "cu.cod_cur = ap.cod_cur and cu.cod_car = ap.cod_car ";
		$vQuery .= "where ap.cod_car = '{$sUsercoo['cod_car']}' and ap.per_aca = '{$sUsercoo['per_aca']}' ";
		$vQuery .= "order by pln_est, sem_anu, cod_esp, sec_gru";
		$cSemgru = fQuery($vQuery);
		while($aSemgru = $cSemgru->fetch_array())
		{
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['pln_est'] = $aSemgru['pln_est'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['sem_anu'] = $aSemgru['sem_anu'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['sec_gru'] = $aSemgru['sec_gru'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['cod_esp'].$aSemgru['sec_gru']]['cod_esp'] = $aSemgru['cod_esp'];
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
	function start()
	{
		document.fData.rPSGE.focus();
	}

//-->
</script>
</head>

<body  onLoad="start();">
	<? include "../include/header1.php"; ?>
	<? include "../include/mmatriculas.php"; ?>
	
<div class="wordcen" id="body1">
	  <form action="" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	  
	  
	  
	 <table border="0" cellpadding="0" cellspacing="0" id="ventana">
       <tr>
         <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
         <th align="center" background="../images/ventana_r1_c2.jpg" >Reevaluaciones</th>
         <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
       </tr>
       <tr>
         <td background="../images/ventana_r2_c1.jpg"></td>
         <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
             <tr>
               <td class="wordder">Plan-Sem-Grupo-Especialidad: </td>
               <td class="wordizq">&nbsp;
                   <select name="rPSGE" id="rPSGE" onChange="viewreeval(this.value)" onFocus="viewreeval(this.value)">
                     <?
						if(!empty($sSemgru)) 
						foreach($sSemgru as $vPSG => $aSemgru) 
						{ 
					?>
							<option value='<?=$aSemgru['pln_est']?><?=$aSemgru['sem_anu']?><?=$aSemgru['sec_gru']?><?=$aSemgru['cod_esp']?>' <?=(($aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['sec_gru'].$aSemgru['cod_esp'])==$sUsercoo['psge']?" Selected":"")?>><?=$aSemgru['pln_est']?>-<?=$aSemgru['sem_anu']?>-<?=ucwords(strtolower($sGrupo[$aSemgru['sec_gru']]))?>-<?=ucwords(strtolower($sEspecial[$aSemgru['pln_est'].$aSemgru['cod_esp']]['esp_nom']))?></option>	
					 <? } ?>
                   </select>
                 &nbsp;</td>
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
 	  <div id="dresultado"></div>

  </form>
	  
  <a href="rva_selectcurso.php" title="Nueva Notas" class="linkboton" ><img src="../images/bnuevoreeval.png" width="100" height="24"></a>  </div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vCod_prf = $_GET['rCod_prf'];
		$vPaterno = $_GET['rPaterno'];
		$vMaterno = $_GET['rMaterno'];
		$vNombres = $_GET['rNombres'];
		$bDatos = FALSE;
		
		$vQuery = "Select cod_prf, cod_car, paterno, materno, nombres from unapnet.docente where cod_car <> '' and cnd_act = '1' ";
		
		if((!empty($vCod_prf) or !empty($vPaterno) or !empty($vMaterno) or !empty($vNombres)))
		{
			if(!empty($vCod_prf))
				$vQuery .= "and cod_prf like '$vCod_prf%'";			
			if(!empty($vPaterno))
				$vQuery .= "and paterno like '$vPaterno%'";		
			if(!empty($vMaterno))
				$vQuery .= "and materno like '$vMaterno%'";			
			if(!empty($vNombres))
				$vQuery .= "and nombres like '$vNombres%'";			
				
			$vQuery .= " order by paterno, materno, nombres limit 5 ";
			$bDatos = TRUE;
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
  
  	<? 	
  	$vCont = 1;
	if($bDatos == TRUE)
	{
		$cEstudia = fQuery($vQuery);
		while($aEstudia = $cEstudia->fetch_array())
		{
  	?>
  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
    <td width="16" class="wordder"><?=$vCont?></td>
    <td width="58"><a href="" onClick="getcargacursoi('<?=$aEstudia['cod_prf']?>'); return false;" class="enlace1">
      <?=$aEstudia['cod_prf']?>
    </a></td>
    <td width="138" class="wordizq">&nbsp;<?=$aEstudia['paterno']?>&nbsp;</td>
    <td width="138" class="wordizq">&nbsp;<?=$aEstudia['materno']?>&nbsp;</td>
    <td width="168" class="wordizq">&nbsp;<?=$aEstudia['nombres']?>&nbsp;</td>
    <td width="16" class="wordizq"><a href="" onClick="getcargaicurso('<?=$aEstudia['cod_prf']?>', '<?=$sUsercoo['pln_est']?>', '<?=$sUsercoo['sec_gru']?>', '<?=$sUsercoo['mod_mat']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Mostrar informaci&oacute;n" width="16" height="16" /></a></td>
  </tr>
  	<? 
		$vCont++; 	
		} 
		$cEstudia->close();
	}
	?>
</table>
		

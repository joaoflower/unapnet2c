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
		
		$vQuery = "Select cod_prf, cod_car, paterno, materno, nombres from unapnet.docente where cod_car <> '' ";
		
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
    <td width="32" class="wordder"><?=$vCont?></td>
    <td width="60"><a href="" onClick="viewdatadoc('<?=$aEstudia['cod_prf']?>', '<?=$aEstudia['cod_car']?>'); return false;" class="enlace1">
      <?=$aEstudia['cod_prf']?>
    </a></td>
    <td width="140" class="wordizq">&nbsp;<?=$aEstudia['paterno']?>&nbsp;</td>
    <td width="140" class="wordizq">&nbsp;<?=$aEstudia['materno']?>&nbsp;</td>
    <td width="170" class="wordizq">&nbsp;<?=$aEstudia['nombres']?>&nbsp;</td>
  </tr>
  	<? 
		$vCont++; 	
		} 
		$cEstudia->close();
	}
	?>
</table>

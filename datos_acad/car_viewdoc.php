<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vNum_mat = $_GET['rNum_mat'];
		$vPaterno = $_GET['rPaterno'];
		$vMaterno = $_GET['rMaterno'];
		$vNombres = $_GET['rNombres'];
		$bDatos = FALSE;
		
		$vQuery = "Select num_mat, paterno, materno, nombres from unapnet.estudiante where cod_car = '{$sUsercoo['cod_car']}' ";
		
		if((!empty($vNum_mat) or !empty($vPaterno) or !empty($vMaterno) or !empty($vNombres)))
		{
			if(!empty($vNum_mat))
				$vQuery .= "and num_mat like '$vNum_mat%'";			
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Un@p.Net2</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
</head>

<body >
<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
  
  	<? 	
  	$vCont = 1;
	if($bDatos == TRUE)
	{
		$cEstudia = fQuery($vQuery);
		while($aEstudia = $cEstudia->fetch_array())
		{
  	?>
  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
    <td width="60"><a href="not_viewnota.php?rNum_mat=<?=$vNum_mat2?>" class="enlace1">
      <?=$aEstudia['num_mat']?>
    </a></td>
    <td width="100" class="wordizq">&nbsp;<?=$aEstudia['paterno']?>&nbsp;</td>
    <td width="100" class="wordizq">&nbsp;<?=$aEstudia['materno']?>&nbsp;</td>
    <td width="150" class="wordizq">&nbsp;<?=$aEstudia['nombres']?>&nbsp;</td>
  </tr>
  	<? 
		$vCont++; 	
		} 
		$cEstudia->close();
	}
	?>
</table>
</body>
</html>
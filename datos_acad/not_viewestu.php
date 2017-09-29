<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
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
		
		$vQuery = "Select num_mat, cod_car, paterno, materno, nombres from unapnet.estudiante where cod_car = '{$sUsercoo['cod_car']}' ";
		
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
				
			$vQuery .= " order by paterno, materno, nombres limit 2 ";
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
		
		$sUsercoo['can_est'] = $cEstudia->num_rows;
		
		while($aEstudia = $cEstudia->fetch_array())
		{
  	?>
  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
    <td width="15" class="wordder"><?=$vCont?></td>
    <td width="60"><a href="" onClick="viewnotaest('<?=$aEstudia['num_mat']?>'); return false;" class="enlace1">
      <?=$aEstudia['num_mat']?>
    </a></td>
    <td width="140" class="wordizq">&nbsp;<?=$aEstudia['paterno']?>&nbsp;</td>
    <td width="140" class="wordizq">&nbsp;<?=$aEstudia['materno']?>&nbsp;</td>
    <td width="154" class="wordizq">&nbsp;<?=$aEstudia['nombres']?>&nbsp;</td>
    <td width="16" class="wordizq"><a href="" onClick="viewnotaest('<?=$aEstudia['num_mat']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver Notas por Matr&iacute;cula" width="16" height="16" /></a></td>
    <td width="16" class="wordizq"><a href="" onClick="viewnotaestcur('<?=$aEstudia['num_mat']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver Notas por Curso" width="16" height="16" /></a></td>
    <td width="16" class="wordizq"><a href="" onClick="viewnotaestplan('<?=$aEstudia['num_mat']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver Notas en Plan de Estudios" width="16" height="16" /></a></td>
	<td width="16" class="wordizq"><a href="" onClick="viewnotagetano('<?=$aEstudia['num_mat']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver Notas de un a�o Acad�mico" width="16" height="16" /></a></td>
  </tr>
  	<? 
		$vCont++; 	
		} 
		$cEstudia->close();
	}
	?>
</table>


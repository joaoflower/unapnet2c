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
		
		$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		
		$vQuery = "Select es.num_mat, es.cod_car, es.paterno, es.materno, es.nombres ";
		$vQuery .= "from unapnet.estudiante es left join $tEstumat em on es.num_mat = em.num_mat and ";
		$vQuery .= "es.cod_car = em.cod_car where es.cod_car = '{$sUsercoo['cod_car']}' ";
		
		if((!empty($vNum_mat) or !empty($vPaterno) or !empty($vMaterno) or !empty($vNombres)))
		{
			if(!empty($vNum_mat))
				$vQuery .= " and es.num_mat like '$vNum_mat%' ";			
			if(!empty($vPaterno))
				$vQuery .= " and es.paterno like '$vPaterno%' ";		
			if(!empty($vMaterno))
				$vQuery .= " and es.materno like '$vMaterno%' ";			
			if(!empty($vNombres))
				$vQuery .= " and es.nombres like '$vNombres%' ";			
				
			$vQuery .= " and em.per_aca = '{$sUsercoo['per_aca']}' order by paterno, materno, nombres limit 10 ";
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
    <td width="15" class="wordder"><?=$vCont?></td>
    <td width="60"><a href="edt_viewmatri.php?rNum_mat=<?=$aEstudia['num_mat']?>&rCod_car=<?=$aEstudia['cod_car']?>" class="enlace1">
      <?=$aEstudia['num_mat']?>
    </a></td>
    <td width="140" class="wordizq">&nbsp;<?=$aEstudia['paterno']?>&nbsp;</td>
    <td width="140" class="wordizq">&nbsp;<?=$aEstudia['materno']?>&nbsp;</td>
    <td width="170" class="wordizq">&nbsp;<?=$aEstudia['nombres']?>&nbsp;</td>
    <td width="16" class="wordizq"><a href="edt_viewmatri.php?rNum_mat=<?=$aEstudia['num_mat']?>&rCod_car=<?=$aEstudia['cod_car']?>" class="enlaceb"><img src="../images/browse.png" alt="Mostrar informaci&oacute;n" width="16" height="16" /></a></td>
  </tr>
  	<? 
		$vCont++; 	
		} 
		$cEstudia->close();
	}
	?>
</table>


<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$rPln_est = $_GET['rPln_est'];
		if(!empty($rPln_est))
		{
			$sEstudia['pln_est'] = $rPln_est;
?>
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
	<select name="rPln_est" id="rPln_est" onChange="getnotacon(this.value)" onFocus="getnotacon(this.value)">
		<?=fviewespecial($sEstudia['pln_est'], $sEstudia['cod_esp'])?>
	</select>
<?
		}
		else
		{
?>
	<select name="rPln_est" id="rPln_est" onChange="getnotacon(this.value)" onFocus="getnotacon(this.value)" disabled="disabled">
		<option value="99">Seleccione Plan de Estudios ...</option>                  
	</select>
<?
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

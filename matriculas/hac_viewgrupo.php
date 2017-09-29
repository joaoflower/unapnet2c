<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$rPln_est = $_GET['rPln_est'];
		if(!empty($rPln_est))
		{
			$sUsercoo['pln_est'] = $rPln_est;
?>
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
	<select name="rSec_gru" id="rSec_gru" onChange="hac_getsem(this.value)" onFocus="hac_getsem(this.value)">
		<?=fviewgruposel('')?>
	</select>
<?
		}
		else
		{
?>
	<select name="rSec_gru" id="rSec_gru" disabled="disabled">
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

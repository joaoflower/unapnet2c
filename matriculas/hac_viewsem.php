<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$rSec_gru = $_GET['rSec_gru'];
		if(!empty($rSec_gru))
		{
			$sUsercoo['sec_gru'] = $rSec_gru;
?>
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
	<select name="rSem_anu" id="rSem_anu" onChange="hac_getcurso(this.value)" onFocus="hac_getcurso(this.value)">
		<?=fviewsemhora($sUsercoo['pln_est'], '')?>
	</select>
<?
		}
		else
		{
?>
	<select name="rSem_anu" id="rSem_anu" disabled="disabled">
    	<option value="99" selected>Seleccione Grupo ...</option>
	</select>
<?
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

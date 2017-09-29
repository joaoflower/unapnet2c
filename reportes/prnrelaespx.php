<?php
//header("Content-type: application/msword");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=relcurso.xls");
session_start();
?>

<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Facultad:</strong></td>
			  <td class="tdcampo">&nbsp;<?=$sFacultad[$sUsercoo['cod_fac']]?></td>
  </tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Escuela:</strong></td>
			  <td class="tdcampo">&nbsp;<?=$sCarrera[$sUsercoo['cod_car']]?></td>
  </tr>
			<tr>
			  <td width="20" class="wordderb">&nbsp;</td>
			  <td width="80" align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Mención:</strong></td>
			  <td width="400" class="tdcampo">&nbsp;<?=$sUsercoo['cod_esp']?></td>
		    </tr>
			
			<tr>
			  <td colspan="3" class="wordcen"></td>
		    </tr>					
</table>
<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
  <tr bgcolor="#CCCCCC">
    <th width="30" scope="col">Nro</th>
    <th width="50" scope="col">Num.Mat</th>
    <th width="280" scope="col">Apellidos y Nombres </th>
    <th width="100" scope="col">Modalidad</th>
  </tr>
<? 	if(!empty($sEstupdf))
	foreach($sEstupdf as $sEstu)
	{	
?>
  <tr>
    <td class="wordcen"><?=$sEstu['num_est']?></td>
    <td>&nbsp;<?=$sEstu['num_mat']?></td>
    <td>&nbsp;<?=$sEstu['nombre']?></td>
    <td>&nbsp;<?=$sEstu['mod_mat']?></td>
  </tr>
<? 	}	?>
</table>

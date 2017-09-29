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
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sFacultad[$sUsercoo['cod_fac']]?></td>
  </tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Escuela</strong></td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sCarrera[$sUsercoo['cod_car']]?></td>
  </tr>
			<tr>
			  <td width="20" class="wordderb">&nbsp;</td>
			  <td width="120" align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Curso:</strong></td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['nom_cur']?></td>
	        </tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Nivel:</strong></td>
			  <td width="110" class="tdcampo">&nbsp;<?=$sNivel[$sEstudia['niv_est']]?></td>
			  <td width="120" align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Semestre:</strong></td>
			  <td width="110" class="tdcampo">&nbsp;<?=$sSemestre[$sEstudia['sem_anu']]?></td>
			</tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Especialidad:</strong></td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
	        </tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
              <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Grupo: </strong></td>
			  <td class="tdcampo">&nbsp;<?=$sGrupo[$sEstudia['sec_gru']]?></td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Modalidad:</strong></td>
			  <td class="tdcampo">&nbsp;<?=$sModnot[$sEstudia['mod_act']]?></td>
		    </tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Docente:</strong></td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['nom_doc']?></td>
		    </tr>
			
			<tr>
			  <td colspan="5" class="wordcen"></td>
		    </tr>					
          </table>
<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
  <tr>
    <th width="30" bgcolor="#CCCCCC" scope="col">Nro</th>
    <th width="50" bgcolor="#CCCCCC" scope="col">Num.Mat</th>
    <th width="280" bgcolor="#CCCCCC" scope="col">Apellidos y Nombres </th>
    <th width="100" bgcolor="#CCCCCC" scope="col">Modalidad</th>
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

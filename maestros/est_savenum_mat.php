<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{		
		if($sUsercoo['safetymatri'])
		{
			$vNum_mat = $_GET['rNum_mat'];
			$vPaterno = $_GET['rPaterno'];
			$vMaterno = $_GET['rMaterno'];
			$vNombres = $_GET['rNombres'];
			
			$vFecha = getdate(time());
			$vFechan = "{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} - Hora: {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']} hrs.";
			
			$vObs_est = "<<<  INGRESO DE NUEVO ESTUDIANTE  >>> \n";
			$vObs_est .= " - IP: [{$sUsercoo['ip']}]. \n";
			$vObs_est .= " - Fecha: [$vFechan]. \n";
			
			$vQuery = "insert into unapnet.estudiante (num_mat, cod_car, paterno, materno, nombres, con_est, obs_est) ";
			$vQuery .= "values ('$vNum_mat', '{$sEstudia['cod_car']}', '$vPaterno', '$vMaterno', '$vNombres', '1', '$vObs_est') ";
			
			$bInsert = fInupde($vQuery);
			if($bInsert)
			{
				$sEstudia = "";
				$sUsercoo['safetymatri'] = FALSE;
				$sEstudia['num_mat'] = $vNum_mat;
				$sEstudia['paterno'] = $vPaterno;
				$sEstudia['materno'] = $vMaterno;
				$sEstudia['nombres'] = $vNombres;
				$sEstudia['obs_est'] = $vObs_est;
				$sEstudia['con_est'] = $vObs_est;
			}
			else
			{
				$sUsercoo['errorl'] = TRUE;
				$sUsercoo['msnerror'] = 'ERROR, NO SE GUARDARON LOS DATOS';
			}
			
		}
		else
			header("Location:est_getestu.php");
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
<table border="0" cellpadding="0" cellspacing="0" id="ventana">
    <tr>
      <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
      <th align="center" background="../images/ventana_r1_c2.jpg" >Datos Personales del estudiante </th>
      <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
    </tr>
    <tr>
      <td background="../images/ventana_r2_c1.jpg"></td>
      <td background="../images/ventana_r2_c2.jpg"><table width="550" border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
        <tr>
          <td class="wordder">Estudiante :</td>
          <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['num_mat']?> - <?=$sEstudia['paterno']?> <?=$sEstudia['materno']?>, <?=$sEstudia['nombres']?></td>
        </tr>
        <tr>
          <td class="wordder">Escuela Prof.: </td>
          <td colspan="3" class="tdcampo">&nbsp;<?=$sCarrera[$sEstudia['cod_car']]?></td>
        </tr>
        <tr>
          <td class="wordder">Condici&oacute;n : </td>
          <td colspan="3" class="tdcampo">&nbsp;ESTUDIANTE <?=$sCondestu[$sEstudia['con_est']]?></td>
        </tr>
        <tr>
          <td width="70" class="wordder">Tipo Docum.</td>
          <td width="140" class="tdcampo">&nbsp;<?=$sTipodoc[$sEstudia['tip_doc']]?></td>
          <td width="70" class="wordder">Num. Doc. : </td>
          <td width="250" class="tdcampo">&nbsp;<?=$sEstudia['num_doc']?></td>
        </tr>
        <tr>
          <td class="wordder">Fecha Nac. : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['dia']?>
            de
            <?=$sMes[$sEstudia['mes']]?>
            de 19<?=$sEstudia['ano']?></td>
          <td class="wordder">Sexo : </td>
          <td class="tdcampo">&nbsp;<?=$sSexo[$sEstudia['sexo']]?></td>
        </tr>
        <tr>
          <td class="wordder">Estado Civil : </td>
          <td class="tdcampo">&nbsp;<?=$sEstcivil[$sEstudia['est_civ']]?>          </td>
          <td class="wordder">Direcci&oacute;n : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['direc']?></td>
        </tr>
        <tr>
          <td class="wordder">Tel&eacute;fono : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['fono']?></td>
          <td class="wordder">Celular : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['celular']?></td>
        </tr>
        <tr>
          <td class="wordder">Ubigeo : </td>
          <td colspan="3" class="tdcampo">&nbsp;<?=fviewubigeo($sEstudia['cod_nac'], $sEstudia['cod_dep'], $sEstudia['cod_prv'], $sEstudia['cod_dis'])?></td>
        </tr>
        <tr>
          <td class="wordder">Otro e-mail: </td>
          <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['oemail']?></td>
        </tr>
        <tr>
          <td class="wordder">E-mail UNAP:</td>
          <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['email']?></td>
        </tr>
		<tr>
          <td class="wordder">Observacion: </td>
          <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['obs_est']?></td>
        </tr>
        <tr>
          <td colspan="4" class="wordcen"></td>
        </tr>        
      </table></td>
      <td background="../images/ventana_r2_c4.jpg"></td>
    </tr>
    <tr>
      <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
      <td background="../images/ventana_r4_c2.jpg"></td>
      <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
    </tr>
  </table>

<a href="" onclick="editdataest(); return false;" title="Modificar datos" class="linkboton"><img src="../images/bedit.png" width="100" height="24"></a>
<a href="" onclick="editnameest(); return false;" title="Modificar datos" class="linkboton"><img src="../images/beditname.png" width="100" height="24"></a>
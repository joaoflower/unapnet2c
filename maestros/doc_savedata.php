<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{		
		if($sUsercoo['safetymatri'])
		{
			$sEstudia['cod_car'] = $_GET['rCod_car'];
			$sEstudia['cnd_prf'] = $_GET['rCnd_prf'];
			$sEstudia['cod_cat'] = $_GET['rCod_cat'];
			$sEstudia['cod_gru'] = $_GET['rCod_gru'];
			$sEstudia['tip_doc'] = $_GET['rTip_doc'];
			$sEstudia['num_doc'] = $_GET['rNum_doc'];
			$sEstudia['dia'] = $_GET['rDia'];
			$sEstudia['mes'] = $_GET['rMes'];
			$sEstudia['ano'] = $_GET['rAno'];
			$sEstudia['fec_nac'] = "19{$sEstudia['ano']}-{$sEstudia['mes']}-{$sEstudia['dia']}";
			$sEstudia['sexo']    = $_GET['rSexo'];
			$sEstudia['est_civ'] = $_GET['rEst_civ'];
			$sEstudia['direc']   = $_GET['rDirec'];
			$sEstudia['fono']    = $_GET['rFono'];
			$sEstudia['celular'] = $_GET['rCelular'];
			$sEstudia['cod_nac'] = $_GET['rCod_nac'];
			$sEstudia['cod_dep'] = $_GET['rCod_dep'];
			$sEstudia['cod_prv'] = $_GET['rCod_prv'];
			$sEstudia['cod_dis'] = $_GET['rCod_dis'];
			$sEstudia['oemail'] = $_GET['rOemail'];
			$sEstudia['email'] = $_GET['rEmail'];
			
			$vQuery = "update unapnet.docente set cod_car = '{$sEstudia['cod_car']}', cnd_prf = '{$sEstudia['cnd_prf']}', ";
			$vQuery .= "cod_cat = '{$sEstudia['cod_cat']}', cod_gru = '{$sEstudia['cod_gru']}', ";
			$vQuery .= "tip_doc = '{$sEstudia['tip_doc']}', num_doc = '{$sEstudia['num_doc']}', ";
			$vQuery .= "fch_nac = '{$sEstudia['fec_nac']}', sexo = '{$sEstudia['sexo']}', est_civ = '{$sEstudia['est_civ']}', ";
			$vQuery .= "cod_nac = '{$sEstudia['cod_nac']}', cod_dep = '{$sEstudia['cod_dep']}', cod_prv = '{$sEstudia['cod_prv']}', ";
			$vQuery .= "cod_dis = '{$sEstudia['cod_dis']}', direc = '{$sEstudia['direc']}', fono = '{$sEstudia['fono']}', ";
			$vQuery .= "celular = '{$sEstudia['celular']}', email = '{$sEstudia['email']}' ";
			$vQuery .= "where cod_prf = '{$sEstudia['cod_prf']}' ";
			
			$bUpdate = fInupde($vQuery);
			if($bUpdate)
			{
				$sUsercoo['safetymatri'] = FALSE;
			}
			else
			{
				$sUsercoo['errorl'] = TRUE;
				$sUsercoo['msnerror'] = 'ERROR, NO SE GUARDARON LOS DATOS';
			}
			
/*			$vQuery = "update unapnet.usudoc set oemail = '{$sEstudia['oemail']}' ";
			$vQuery .= "where cod_prf = '{$sEstudia['cod_prf']}' and cod_car = '{$sEstudia['cod_car']}'";
			
			$bUpdate = fInupde($vQuery);*/
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
    <th><img src="../images/ventana_r1_c1.jpg" alt="" name="ventana_r1_c1" width="12" height="29" border="0" id="ventana_r1_c1" /></th>
    <th align="center" background="../images/ventana_r1_c2.jpg" >Datos Personales</th>
    <th><img src="../images/ventana_r1_c4.jpg" alt="" name="ventana_r1_c4" width="11" height="29" border="0" id="ventana_r1_c4" /></th>
  </tr>
  <tr>
    <td background="../images/ventana_r2_c1.jpg"></td>
    <td background="../images/ventana_r2_c2.jpg"><table width="550" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
      <tr>
        <td class="wordder">Docente :</td>
        <td colspan="3" class="wordizqb"><?=$sEstudia['cod_prf']?>
          -
          <?=$sEstudia['paterno']?>             <?=$sEstudia['materno']?>,
          <?=$sEstudia['nombres']?></td>
      </tr>
      <tr>
        <td class="wordder">Escuela Prof.: </td>
        <td colspan="3" class="wordizqb"><?=$sCarrera[$sEstudia['cod_car']]?></td>
      </tr>
      <tr>
        <td class="wordder">Condici&oacute;n:</td>
        <td colspan="3" class="wordizqb"><?=$sCondicion[$sEstudia['cnd_prf']]?>
          -
          <?=$sCategoria[$sEstudia['cod_cat']]?>
          -
          <?=$sGrupod[$sEstudia['cod_gru']]?></td>
      </tr>
      <tr>
        <td width="70" class="wordder">Tipo Docum.</td>
        <td width="140" class="wordizqb"><?=$sTipodoc[$sEstudia['tip_doc']]?></td>
        <td width="70" class="wordder">Num. Doc. : </td>
        <td width="250" class="wordizqb"><?=$sEstudia['num_doc']?></td>
      </tr>
      <tr>
        <td class="wordder">Fecha Nac. : </td>
        <td class="wordizqb"><?=$sEstudia['dia']?>
          de
          <?=$sMes[$sEstudia['mes']]?>
          de 19<?=$sEstudia['ano']?></td>
        <td class="wordder">Sexo : </td>
        <td class="wordizqb"><?=$sSexo[$sEstudia['sexo']]?></td>
      </tr>
      <tr>
        <td class="wordder">Estado Civil : </td>
        <td class="wordizqb"><?=$sEstcivil[$sEstudia['est_civ']]?>
        </td>
        <td class="wordder">Direcci&oacute;n : </td>
        <td class="wordizqb"><?=$sEstudia['direc']?></td>
      </tr>
      <tr>
        <td class="wordder">Tel&eacute;fono : </td>
        <td class="wordizqb"><?=$sEstudia['fono']?></td>
        <td class="wordder">Celular : </td>
        <td class="wordizqb"><?=$sEstudia['celular']?></td>
      </tr>
      <tr>
        <td class="wordder">Ubigeo : </td>
        <td colspan="3" class="wordizqb"><?=fviewubigeo($sEstudia['cod_nac'], $sEstudia['cod_dep'], $sEstudia['cod_prv'], $sEstudia['cod_dis'])?></td>
      </tr>
      <tr>
        <td class="wordder">Otro e-mail: </td>
        <td colspan="3" class="wordizqb"><?=$sEstudia['oemail']?></td>
      </tr>
      <tr>
        <td class="wordder">E-mail UNAP:</td>
        <td colspan="3" class="wordizqb"><?=$sEstudia['email']?></td>
      </tr>
      <tr>
        <td colspan="4" class="wordcen"><a href="" onclick="viewfamidoc(); return false;">&lt; Familiares &gt;</a> <a href="" onclick="editdatadoc(); return false;">&lt; Modificar &gt;
                <input name="rView" type="hidden" id="rView" />
        </a></td>
      </tr>
    </table></td>
    <td background="../images/ventana_r2_c4.jpg"></td>
  </tr>
  <tr>
    <td><img src="../images/ventana_r4_c1.jpg" alt="" name="ventana_r4_c1" width="12" height="10" border="0" id="ventana_r4_c1" /></td>
    <td background="../images/ventana_r4_c2.jpg"></td>
    <td><img src="../images/ventana_r4_c4.jpg" alt="" name="ventana_r4_c4" width="11" height="10" border="0" id="ventana_r4_c4" /></td>
  </tr>
</table>

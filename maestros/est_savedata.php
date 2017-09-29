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
			$sEstudia['tip_doc'] = $_GET['rTip_doc'];
			$sEstudia['num_doc'] = $_GET['rNum_doc'];
			$sEstudia['dia'] = $_GET['rDia'];
			$sEstudia['mes'] = $_GET['rMes'];
			$sEstudia['ano'] = $_GET['rAno'];
			$sEstudia['fch_nac'] = "{$sEstudia['ano']}-{$sEstudia['mes']}-{$sEstudia['dia']}";
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
			
			$sEstudia['mod_ing'] = $_GET['rMod_ing'];
			$sEstudia['diai'] = $_GET['rDiai'];
			$sEstudia['mesi'] = $_GET['rMesi'];
			$sEstudia['anoi'] = $_GET['rAnoi'];
			$sEstudia['fch_ing'] = "{$sEstudia['anoi']}-{$sEstudia['mesi']}-{$sEstudia['diai']}";
			$sEstudia['ano_ing'] = $_GET['rAno_ing'];
			$sEstudia['nro_ins'] = $_GET['rNro_ins'];
			$sEstudia['pun_ing'] = $_GET['rPun_ing'];			
			$sEstudia['pun_sob'] = $_GET['rPun_sob'];
			$sEstudia['ord_ing'] = $_GET['rOrd_ing'];
			$sEstudia['ord_sob'] = $_GET['rOrd_sob'];
			
			$vQuery = "update unapnet.estudiante set tip_doc = '{$sEstudia['tip_doc']}', num_doc = '{$sEstudia['num_doc']}', ";
			$vQuery .= "fch_nac = '{$sEstudia['fch_nac']}', sexo = '{$sEstudia['sexo']}', est_civ = '{$sEstudia['est_civ']}', ";
			$vQuery .= "cod_nac = '{$sEstudia['cod_nac']}',cod_dep='{$sEstudia['cod_dep']}', cod_prv='{$sEstudia['cod_prv']}', ";
			$vQuery .= "cod_dis = '{$sEstudia['cod_dis']}', direc = '{$sEstudia['direc']}', fono = '{$sEstudia['fono']}', ";
			$vQuery .= "celular = '{$sEstudia['celular']}', email = '{$sEstudia['email']}', ";
			$vQuery .= "mod_ing = '{$sEstudia['mod_ing']}', fch_ing = '{$sEstudia['fch_ing']}' ";
			$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and cod_car = '{$sEstudia['cod_car']}'";
			
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
			
			$vQuery = "update unapnet.usuest set oemail = '{$sEstudia['oemail']}' ";
			$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and cod_car = '{$sEstudia['cod_car']}'";
			$bUpdate = fInupde($vQuery);
			
			
			$vQuery = "update unapnet.estudata set ano_ing = '{$sEstudia['ano_ing']}', nro_ins = '{$sEstudia['nro_ins']}', ";
			$vQuery .= "pun_ing = '{$sEstudia['pun_ing']}', pun_sob = '{$sEstudia['pun_sob']}', ";
			$vQuery .= "ord_ing = '{$sEstudia['ord_ing']}', ord_sob = '{$sEstudia['ord_sob']}' ";
			$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and cod_car = '{$sEstudia['cod_car']}'";
			$bUpdate = fInupde($vQuery);
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
          <td class="wordder">Condici&oacute;n :</td>
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
          <td class="tdcampo">&nbsp;<?=$sEstudia['dia']?> de <?=$sMes[$sEstudia['mes']]?> de <?=$sEstudia['ano']?></td>
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
          <td class="wordder">Mod. Ingreso: </td>
          <td class="tdcampo">&nbsp;<?=$sModing[$sEstudia['mod_ing']]?></td>
          <td class="wordder">Fec. Ingreso : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['diai']?> de <?=$sMes[$sEstudia['mesi']]?> de <?=$sEstudia['anoi']?></td>
        </tr>
        <tr>
          <td class="wordder">A&ntilde;o Ingreso : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['ano_ing']?></td>
          <td class="wordder">Nro. Inscr.: </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['nro_ins']?></td>
        </tr>
        <tr>
          <td class="wordder">Punt. Ingr.: </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['pun_ing']?></td>
          <td class="wordder">Punt. Sobre : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['pun_sob']?></td>
        </tr>
        <tr>
          <td class="wordder">Orden Ingr. : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['ord_ing']?></td>
          <td class="wordder">Orden Sobre : </td>
          <td class="tdcampo">&nbsp;<?=$sEstudia['ord_sob']?></td>
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
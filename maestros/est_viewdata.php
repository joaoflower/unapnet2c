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
		$vCod_car = $_GET['rCod_car'];
		
		$sEstudia = "";
		$sCurso = "";
		$sCurmat = "";
		$sCurapto = "";
		
		$vQuery = "Select num_mat, cod_car, paterno, materno, nombres, tip_doc, num_doc, fch_nac, sexo, est_civ, ";
		$vQuery .= "cod_nac, cod_dep, cod_prv, cod_dis, direc, fono, email, mod_ing, fch_ing, celular, con_est, obs_est ";
		$vQuery .= "from unapnet.estudiante where num_mat = '{$vNum_mat}' and cod_car = '$vCod_car' ";
		
		$cEstudia = fQuery($vQuery);
		if($aEstudia = $cEstudia->fetch_array())
		{			
			$sEstudia['num_mat'] = $aEstudia['num_mat'];
			$sEstudia['cod_car'] = $aEstudia['cod_car'];
			$sEstudia['paterno'] = $aEstudia['paterno'];			
			$sEstudia['materno'] = $aEstudia['materno'];
			$sEstudia['nombres'] = $aEstudia['nombres'];
			$sEstudia['tip_doc'] = $aEstudia['tip_doc'];
			$sEstudia['num_doc'] = $aEstudia['num_doc'];
			$sEstudia['fch_nac'] = $aEstudia['fch_nac'];
			$sEstudia['dia'] = substr($aEstudia['fch_nac'], 8, 2);
			$sEstudia['mes'] = substr($aEstudia['fch_nac'], 5, 2);
			$sEstudia['ano'] = substr($aEstudia['fch_nac'], 0, 4);
			$sEstudia['sexo'] = $aEstudia['sexo'];
			$sEstudia['est_civ'] = $aEstudia['est_civ'];
			$sEstudia['cod_nac'] = $aEstudia['cod_nac'];
			$sEstudia['cod_dep'] = $aEstudia['cod_dep'];
			$sEstudia['cod_prv'] = $aEstudia['cod_prv'];
			$sEstudia['cod_dis'] = $aEstudia['cod_dis'];
			$sEstudia['direc'] = $aEstudia['direc'];
			$sEstudia['fono'] = $aEstudia['fono'];
			$sEstudia['email'] = $aEstudia['email'];
			$sEstudia['mod_ing'] = $aEstudia['mod_ing'];
			$sEstudia['fch_ing'] = $aEstudia['fch_ing'];
			$sEstudia['diai'] = substr($aEstudia['fch_ing'], 8, 2);
			$sEstudia['mesi'] = substr($aEstudia['fch_ing'], 5, 2);
			$sEstudia['anoi'] = substr($aEstudia['fch_ing'], 0, 4);
			$sEstudia['celular'] = $aEstudia['celular'];
			$sEstudia['con_est'] = $aEstudia['con_est'];
			$sEstudia['obs_est'] = $aEstudia['obs_est'];
			
			$cEstudia->close();
			$sUsercoo['safetymatri'] = TRUE;
			
			$vQuery = "Select oemail from unapnet.usuest where num_mat = '{$vNum_mat}' and cod_car = '$vCod_car' ";
			$cUsuest = fQuery($vQuery);
			if($aUsuest = $cUsuest->fetch_array())
			{			
				$sEstudia['oemail'] = $aUsuest['oemail'];
			}	
			//------------------------------------------------------------------------
			$vQuery = "Select num_mat, cod_car from unapnet.estudata ";
			$vQuery .= "where num_mat = '{$vNum_mat}' and cod_car = '{$vCod_car}' ";
			if(fCountq($vQuery) == 0)
			{
				$vQuery = "insert into unapnet.estudata (num_mat, cod_car) values ('$vNum_mat', '$vCod_car') ";
				fInupde($vQuery);
			}
			//------------------------------------------------------------------------
			$vQuery = "Select ano_ing, nro_ins, pun_ing, pun_sob, ord_ing, ord_sob from unapnet.estudata ";
			$vQuery .= "where num_mat = '{$vNum_mat}' and cod_car = '{$vCod_car}' ";
			$cEstudata = fQuery($vQuery);
			if($aEstudata = $cEstudata->fetch_array())
			{
				$sEstudia['ano_ing'] = $aEstudata['ano_ing'];
				$sEstudia['nro_ins'] = $aEstudata['nro_ins'];
				$sEstudia['pun_ing'] = $aEstudata['pun_ing'];
				$sEstudia['pun_sob'] = $aEstudata['pun_sob'];
				$sEstudia['ord_ing'] = $aEstudata['ord_ing'];
				$sEstudia['ord_sob'] = $aEstudata['ord_sob'];
			}
			
		}
		else
		{
			$cEstudia->close();
		}		
		
			
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>


  <span class="wordi">
  <? if($sUsercoo['error1']) echo $sUsercoo['msnerror'];  $sUsercoo['error1'] = false;?>
  </span>
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
<? if($sEstudia['cod_car'] == '53' or $sEstudia['cod_car'] == '19' or $sEstudia['cod_car'] == '62' or $sEstudia['cod_car'] == '63' or $sEstudia['cod_car'] == '64')
	{	?>
  <a href="" onclick="newnum_mat(); return false;" title="Nuevo estudiante" class="linkboton"><img src="../images/bnuevoest.png" width="100" height="24" /></a>
 <? }	?>
  <a href="" onclick="editnameest(); return false;" title="Modificar datos" class="linkboton"><img src="../images/beditname.png" width="100" height="24" /></a><a href="" onclick="editdataest(); return false;" title="Modificar datos" class="linkboton"><img src="../images/bedit.png" width="100" height="24" /></a>
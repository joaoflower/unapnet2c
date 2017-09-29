<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$vCod_prf = $_GET['rCod_prf'];
		$vCod_car = $_GET['rCod_car'];
		
		$sEstudia = "";
		$sCurso = "";
		$sCurmat = "";
		$sCurapto = "";
		
		$vQuery = "Select cod_prf, cod_car, paterno, materno, nombres, tip_doc, num_doc, fch_nac, sexo, est_civ, ";
		$vQuery .= "cod_nac, cod_dep, cod_prv, cod_dis, direc, fono, email, celular, cod_cat, cod_gru, cnd_prf ";
		$vQuery .= "from unapnet.docente where cod_prf = '{$vCod_prf}' and cod_car = '$vCod_car' ";
		
		$cEstudia = fQuery($vQuery);
		if($aEstudia = $cEstudia->fetch_array())
		{			
			$sEstudia['cod_prf'] = $aEstudia['cod_prf'];
			$sEstudia['cod_car'] = $aEstudia['cod_car'];
			$sEstudia['paterno'] = $aEstudia['paterno'];			
			$sEstudia['materno'] = $aEstudia['materno'];
			$sEstudia['nombres'] = $aEstudia['nombres'];
			$sEstudia['tip_doc'] = $aEstudia['tip_doc'];
			$sEstudia['num_doc'] = $aEstudia['num_doc'];
			$sEstudia['fch_nac'] = $aEstudia['fch_nac'];
			$sEstudia['dia'] = substr($aEstudia['fch_nac'], 8, 2);
			$sEstudia['mes'] = substr($aEstudia['fch_nac'], 5, 2);
			$sEstudia['ano'] = substr($aEstudia['fch_nac'], 2, 2);
			$sEstudia['sexo'] = $aEstudia['sexo'];
			$sEstudia['est_civ'] = $aEstudia['est_civ'];
			$sEstudia['cod_nac'] = $aEstudia['cod_nac'];
			$sEstudia['cod_dep'] = $aEstudia['cod_dep'];
			$sEstudia['cod_prv'] = $aEstudia['cod_prv'];
			$sEstudia['cod_dis'] = $aEstudia['cod_dis'];
			$sEstudia['direc'] = $aEstudia['direc'];
			$sEstudia['fono'] = $aEstudia['fono'];
			$sEstudia['email'] = $aEstudia['email'];
			$sEstudia['celular'] = $aEstudia['celular'];
			$sEstudia['cod_cat'] = $aEstudia['cod_cat'];
			$sEstudia['cod_gru'] = $aEstudia['cod_gru'];
			$sEstudia['cnd_prf'] = $aEstudia['cnd_prf'];
			
			$cEstudia->close();
			$sUsercoo['safetymatri'] = TRUE;
		}
		else
		{
			$cEstudia->close();
		}		
		
		$vQuery = "Select oemail from unapnet.usudoc where cod_prf = '{$vCod_prf}' and cod_car = '$vCod_car' ";
		
		$cUsuest = fQuery($vQuery);
		if($aUsuest = $cUsuest->fetch_array())
		{			
			$sEstudia['oemail'] = $aUsuest['oemail'];
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
      <th align="center" background="../images/ventana_r1_c2.jpg" >Datos Personales</th>
      <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
    </tr>
    <tr>
      <td background="../images/ventana_r2_c1.jpg"></td>
      <td background="../images/ventana_r2_c2.jpg"><table width="550" border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
        <tr>
          <td class="wordder">Docente :</td>
          <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['cod_prf']?> - <?=$sEstudia['paterno']?> <?=$sEstudia['materno']?>, <?=$sEstudia['nombres']?></td>
        </tr>
        <tr>
          <td class="wordder">Escuela Prof.: </td>
          <td colspan="3" class="tdcampo">&nbsp;<?=$sCarrera[$sEstudia['cod_car']]?></td>
        </tr>
        <tr>
          <td class="wordder">Condici&oacute;n:</td>
          <td colspan="3" class="tdcampo">&nbsp;<?=$sCondicion[$sEstudia['cnd_prf']]?> - 
           <?=$sCategoria[$sEstudia['cod_cat']]?> - <?=$sGrupod[$sEstudia['cod_gru']]?></td>
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
</form>

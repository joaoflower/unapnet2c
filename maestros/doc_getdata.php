<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$sUsercoo['safetymatri'] = TRUE;
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
      <td background="../images/ventana_r2_c2.jpg"><table width="550" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
        <tr>
          <td class="wordder">Estudiante :</td>
          <td colspan="3" class="wordizqb"><?=$sEstudia['cod_prf']?>
            -
            <?=$sEstudia['paterno']?>
      <?=$sEstudia['materno']?>
            ,
            <?=$sEstudia['nombres']?></td>
        </tr>
        <tr>
          <td class="wordder">Escuela Prof.: </td>
          <td colspan="3" class="wordizqb">
            <select name="rCod_car" id="rCod_car">
              <?=fviewcarrera($sEstudia['cod_car'])?>
            </select>
			</td>
        </tr>
        <tr>
          <td class="wordder">Condici&oacute;n:</td>
          <td colspan="3" class="wordizqb"><span class="wordizq">
            <select name="rCnd_prf" id="rCnd_prf">
              <?=fviewcondicion($sEstudia['cnd_prf'])?>
                                    </select>
            <select name="rCod_cat" id="rCod_cat">
              <?=fviewcategoria($sEstudia['cod_cat'])?>
                                                </select>
            <select name="rCod_gru" id="rCod_gru">
              <?=fviewgrupod($sEstudia['cod_gru'])?>
                                    </select>
          </span></td>
        </tr>
        
        <tr>
          <td width="70" class="wordder">Tipo Docum.</td>
          <td width="180" class="wordizqb"><span class="wordizq">
            <select name="rTip_doc" id="rTip_doc">
              <?=fviewtipodoc($sEstudia['tip_doc'])?>
            </select>
          </span></td>
          <td width="70" class="wordder">Num. Doc. : </td>
          <td width="230" class="wordizqb"><span class="wordizq">
            <input name="rNum_doc" type="text" class="texto" id="rNum_doc" value="<?=$sEstudia['num_doc']?>" size="10" maxlength="10" />
          </span></td>
        </tr>
        <tr>
          <td class="wordder">Fecha Nac. : </td>
          <td class="wordizq"><span class="wordizq">
            <input name="rDia" type="text" class="texto" id="rDia" value="<?=$sEstudia['dia']?>" size="2" maxlength="2" />
            <select name="rMes" class="ocombo" id="select6">
              <?=fviewmes($sEstudia['mes'])?>
            </select>
19<input name="rAno" type="text" class="texto" id="rAno" value="<?=$sEstudia['ano']?>" size="2" maxlength="2" />
          </span></td>
          <td class="wordder">Sexo : </td>
          <td class="wordizqb"><span class="wordizq">
            <select name="rSexo" id="select3">
              <?=fviewsexo($sEstudia['sexo'])?>
            </select>
          </span></td>
        </tr>
        <tr>
          <td class="wordder">Estado Civil : </td>
          <td class="wordizqb"><span class="wordizq">
            <select name="rEst_civ" id="select4">
              <?=fviewestcivil($sEstudia['est_civ'])?>
            </select>
          </span></td>
          <td class="wordder">Direcci&oacute;n : </td>
          <td class="wordizqb"><span class="wordizq">
            <input name="rDirec" type="text" class="texto" id="rNum_doc3" value="<?=$sEstudia['direc']?>" size="35" maxlength="50" />
          </span></td>
        </tr>
        <tr>
          <td class="wordder">Tel&eacute;fono : </td>
          <td class="wordizqb"><span class="wordizq">
            <input name="rFono" type="text" class="texto" id="rFono" value="<?=$sEstudia['fono']?>" size="10" maxlength="10" />
          </span></td>
          <td class="wordder">Celular : </td>
          <td class="wordizqb"><span class="wordizq">
            <input name="rCelular" type="text" class="texto" id="rCelular" value="<?=$sEstudia['celular']?>" size="10" maxlength="10" />
          </span></td>
        </tr>
        <tr>
          <td class="wordder">Otro e-mail:</td>
          <td colspan="3" class="wordizqb"><span class="wordizq">
            <input name="rOemail" type="text" class="texto" id="rOemail" value="<?=$sEstudia['oemail']?>" size="50" maxlength="50" />
          </span></td>
        </tr>
        <tr>
          <td class="wordder">E-mail UNAP:</td>
          <td colspan="3" class="wordizqb"><span class="wordizq">
            <input name="rEmail" type="text" class="texto" id="rEmail" value="<?=$sEstudia['email']?>" size="50" maxlength="50" />
          </span></td>
        </tr>
        <tr>
          <td colspan="4" class="wordizq"><iframe width="500"  name ="frameUbigeo"  height="50" id="frameUbigeo" src="ubigeo.php"  scrolling="no" frameborder="0" > </iframe>
                <input name="rCod_nac" type="hidden" id="rCod_nac" value="">
                <input name="rCod_dep" type="hidden" id="rCod_dep" value="">
                <input name="rCod_prv" type="hidden" id="rCod_prv" value="">
                <input name="rCod_dis" type="hidden" id="rCod_dis" value=""></td>
        </tr>
        <tr>
          <td colspan="4" class="wordcen"><a href="" onclick="savedatadoc(); return false;">&lt; Guardar &gt; </a><a href="" onclick="viewdatadoc('<?=$sEstudia['cod_prf']?>', '<?=$sEstudia['cod_car']?>'); return false;">&lt; Cancelar &gt; </a></td>
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

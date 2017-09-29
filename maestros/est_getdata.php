<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
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
          <td colspan="3" class="wordizqb"><?=$sEstudia['num_mat']?>
            -
            <?=$sEstudia['paterno']?>
      <?=$sEstudia['materno']?>
            ,
            <?=$sEstudia['nombres']?></td>
        </tr>
        <tr>
          <td class="wordder">Escuela Prof.: </td>
          <td colspan="3" class="wordizqb"><?=$sCarrera[$sEstudia['cod_car']]?></td>
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
          <td class="wordizq">
            <input name="rDia" type="text" class="texto" id="rDia" value="<?=$sEstudia['dia']?>" size="2" maxlength="2" />
            <select name="rMes" class="ocombo" id="select6">
              <?=fviewmes($sEstudia['mes'])?>
            </select>
            <input name="rAno" type="text" class="texto" id="rAno" value="<?=$sEstudia['ano']?>" size="4" maxlength="4" />
		  </td>
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
          <td class="wordder">Mod. Ingreso : </td>
          <td class="wordizq"><select name="rMod_ing" id="rMod_ing"> 
					<?=fviewmoding($sEstudia['mod_ing'])?>
          </select></td>
          <td class="wordder">Fec. Ingreso : </td>
          <td class="wordizq">
		    <input name="rDiai" type="text" class="texto" id="rDiai" value="<?=$sEstudia['diai']?>" size="2" maxlength="2" />
            <select name="rMesi" class="ocombo" id="rMesi">
              <?=fviewmes($sEstudia['mesi'])?>
            </select>
            <input name="rAnoi" type="text" class="texto" id="rAnoi" value="<?=$sEstudia['anoi']?>" size="4" maxlength="4" />
		  </td>
        </tr>
        <tr>
          <td class="wordder">A&ntilde;o Ingreso : </td>
          <td class="wordizq"><input name="rAno_ing" type="text" class="texto" id="rAno_ing" value="<?=$sEstudia['ano_ing']?>" size="4" maxlength="4" /></td>
          <td class="wordder">Nro. Inscr. : </td>
          <td class="wordizq"><input name="rNro_ins" type="text" class="texto" id="rNro_ins" value="<?=$sEstudia['nro_ins']?>" size="6" maxlength="6" /></td>
        </tr>
        <tr>
          <td class="wordder">Punt. Ingr. : </td>
          <td class="wordizq"><input name="rPun_ing" type="text" class="texto" id="rPun_ing" value="<?=$sEstudia['pun_ing']?>" size="9" maxlength="9" /></td>
          <td class="wordder">Punt. Sobre : </td>
          <td class="wordizq"><input name="rPun_sob" type="text" class="texto" id="rPun_sob" value="<?=$sEstudia['pun_sob']?>" size="9" maxlength="9" /></td>
        </tr>
        <tr>
          <td class="wordder">Orden Ingr. : </td>
          <td class="wordizq"><input name="rOrd_ing" type="text" class="texto" id="rOrd_ing" value="<?=$sEstudia['ord_ing']?>" size="4" maxlength="4" /></td>
          <td class="wordder">Orden Sobre : </td>
          <td class="wordizq"><input name="rOrd_sob" type="text" class="texto" id="rOrd_sob" value="<?=$sEstudia['ord_sob']?>" size="4" maxlength="4" /></td>
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

<a href="" title="Guardar" class="linkboton" onclick="savedataest(); return false;"><img src="../images/bsave.png" width="100" height="24"></a>
<a href="" title="Cancelar" class="linkboton" onclick="viewdataest('<?=$sEstudia['num_mat']?>', '<?=$sEstudia['cod_car']?>'); return false;"><img src="../images/bundo.png" width="100" height="24"></a>
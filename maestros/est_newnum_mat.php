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
      <th align="center" background="../images/ventana_r1_c2.jpg" >Nuevo Estudiante </th>
      <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
    </tr>
    <tr>
      <td background="../images/ventana_r2_c1.jpg"></td>
      <td background="../images/ventana_r2_c2.jpg"><table border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
        <tr>
          <td class="wordder">Escuela Prof.: </td>
          <td colspan="3" class="wordizqb"><?=$sCarrera[$sEstudia['cod_car']]?></td>
        </tr>
        <tr>
          <td width="120" class="wordder">Estudiante :</td>
          <td colspan="3" class="wordizqb"><input name="rNum_matn" type="text" class="texto" id="rNum_matn" size="6" maxlength="6" onBlur="fupper(this);"/></td>
        </tr>
        
        <tr>
          <td class="wordder">Paterno :</td>
          <td width="150" class="wordizqb"><span class="wordizq">
            <input name="rPaternon" type="text" class="texto" id="rPaternon" size="20" maxlength="20" onBlur="fupper(this);"/>
          </span></td>
          <td width="90" class="wordder">Materno : </td>
          <td width="150" class="wordizqb"><input name="rMaternon" type="text" class="texto" id="rMaternon" size="20" maxlength="20" onBlur="fupper(this);"/></td>
        </tr>
        <tr>
          <td class="wordder">Nombres : </td>
          <td class="wordizqb"><input name="rNombresn" type="text" class="texto" id="rNombresn" size="25" maxlength="30" onBlur="fupper(this);"/></td>
          <td class="wordder">&nbsp;</td>
          <td class="wordizqb">&nbsp;</td>
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

<a href="" title="Guardar" class="linkboton" onclick="savenum_mat(); return false;"><img src="../images/bsave.png" width="100" height="24"></a>
<a href="" title="Cancelar" class="linkboton" onclick="viewdataest('<?=$sEstudia['num_mat']?>', '<?=$sEstudia['cod_car']?>'); return false;"><img src="../images/bundo.png" width="100" height="24"></a>
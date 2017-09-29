<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{

		$vQuery = "Select num_doc, paterno, materno, nombres, fch_nac, sexo, cod_vin ";
		$vQuery .= "from unapnet.familia where num_dni = '{$sEstudia['num_doc']}' order by cod_vin";
		
		$cFamilia = fQuery($vQuery);
		if($aFamilia = $cFamilia->fetch_array())
		{	
	
  ?>
<table border="0" cellpadding="0" cellspacing="0" id="ventana">
    <tr>
      <th><img src="../images/ventana_r1_c1.jpg" alt="" name="ventana_r1_c1" width="12" height="29" border="0" id="ventana_r1_c1" /></th>
      <th align="center" background="../images/ventana_r1_c2.jpg" >Datos de Familiares </th>
      <th><img src="../images/ventana_r1_c4.jpg" alt="" name="ventana_r1_c4" width="11" height="29" border="0" id="ventana_r1_c4" /></th>
    </tr>
    <tr>
      <td background="../images/ventana_r2_c1.jpg"></td>
      <td background="../images/ventana_r2_c2.jpg"><table width="550" border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
          <tr>
            <th width="50" class="wordcen">Documen.</th>
            <th width="80" class="wordcen">Paterno</th>
            <th width="80" class="wordcen">Materno</th>
            <th class="wordcen">Nombres</th>
            <th width="60" class="wordcen">Fech.Nac.</th>
            <th width="60" class="wordcen">Sexo</th>
            <th width="60" class="wordcen">Vinculo</th>
          </tr>
		  <?
		  	$vCont = 1;
			do
			{
				$aFamilia['dia'] = substr($aFamilia['fch_nac'], 8, 2);
				$aFamilia['mes'] = substr($aFamilia['fch_nac'], 5, 2);
				$aFamilia['ano'] = substr($aFamilia['fch_nac'], 0, 4);
		  ?>
          <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
            <td class="wordizq">&nbsp;<?=$aFamilia['num_doc']?></td>
            <td class="wordizq">&nbsp;<?=$aFamilia['paterno']?></td>
            <td class="wordizq">&nbsp;<?=$aFamilia['materno']?></td>
            <td class="wordizq">&nbsp;<?=$aFamilia['nombres']?></td>
            <td class="wordizq">&nbsp;<?=$aFamilia['dia']?>/<?=$aFamilia['mes']?>/<?=$aFamilia['ano']?></td>
            <td class="wordizq">&nbsp;<?=$sSexo[$aFamilia['sexo']]?></td>
            <td class="wordizq">&nbsp;<?=$sVinculo[$aFamilia['sexo'].$aFamilia['cod_vin']]?></td>
          </tr>
		  <?
		  	$vCont++;
			}while($aFamilia = $cFamilia->fetch_array());
		  ?>

      </table></td>
      <td background="../images/ventana_r2_c4.jpg"></td>
    </tr>
    <tr>
      <td><img src="../images/ventana_r4_c1.jpg" alt="" name="ventana_r4_c1" width="12" height="10" border="0" id="ventana_r4_c1" /></td>
      <td background="../images/ventana_r4_c2.jpg"></td>
      <td><img src="../images/ventana_r4_c4.jpg" alt="" name="ventana_r4_c4" width="11" height="10" border="0" id="ventana_r4_c4" /></td>
    </tr>
  </table>
  <?
		}
		
	}
	else
	{
		header("Location:../index.php");
	}
  ?>


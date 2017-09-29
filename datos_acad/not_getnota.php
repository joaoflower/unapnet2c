<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<script language="JavaScript">
	document.fData.rNot_cur.focus();
</script>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
//		if(!empty($_GET['rCod_cur']) && )
		
		$sEstudia['pln_est'] = $_GET['rPln_est'];
		$sEstudia['cod_cur'] = $_GET['rCod_cur'];
		$sEstudia['mod_not'] = $_GET['rMod_not'];
		$sEstudia['ano_aca'] = $_GET['rAno_aca'];
		$sEstudia['per_aca'] = $_GET['rPer_aca'];

		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		
		$vQuery = "Select curso.nom_cur, curso.niv_est, curso.sem_anu, curso.cod_esp, $tNota.not_cur ";
		$vQuery .= "from unapnet.curso left join $tNota on curso.cod_car = $tNota.cod_car and curso.pln_est = $tNota.pln_est and ";
		$vQuery .= "curso.cod_cur = $tNota.cod_cur ";
		$vQuery .= "where curso.cod_car = '{$sUsercoo['cod_car']}' and curso.pln_est = '{$sEstudia['pln_est']}' and ";
		$vQuery .= "curso.cod_cur = '{$sEstudia['cod_cur']}' and $tNota.mod_not = '{$sEstudia['mod_not']}' and ";
		$vQuery .= "$tNota.ano_aca = '{$sEstudia['ano_aca']}' and $tNota.per_aca = '{$sEstudia['per_aca']}' and ";
		$vQuery .= "$tNota.num_mat = '{$sEstudia['num_mat']}' ";

		$cNota = fQuery($vQuery);
		if($aNota = $cNota->fetch_array())
		{			
			$sEstudia['nom_cur'] = $aNota['nom_cur'];
			$sEstudia['niv_est'] = $aNota['niv_est'];
			$sEstudia['sem_anu'] = $aNota['sem_anu'];
			$sEstudia['cod_esp'] = $aNota['cod_esp'];
			$sEstudia['not_cur'] = $aNota['not_cur'];
		}	
		else
		{
			header("Location:../index.php");
		}
		
		$sUsercoo['upin'] = 'u';
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Modificar de Nota</th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td width="130" class="wordder">C&oacute;digo:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$sEstudia['cod_cur']?></td>
              <td width="120" class="wordder">Plan:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$sEstudia['pln_est']?></td>
			</tr>
			<tr>
			  <td class="wordder">Nombre de Curso:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['nom_cur']?></td>
	        </tr>
			<tr>
			  <td class="wordder">Nivel:</td>
			  <td class="tdcampo">&nbsp;<?=$sNivel[$sEstudia['niv_est']]?></td>
			  <td class="wordder">Semestre:</td>
			  <td class="tdcampo">&nbsp;<?=$sSemestre[$sEstudia['sem_anu']]?></td>
			</tr>
			<tr>
			  <td class="wordder">Especialidad:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
	        </tr>
			<tr>
              <td class="wordder">A&ntilde;o: </td>
			  <td class="tdcampo">&nbsp;<?=$sEstudia['ano_aca']?></td>
			  <td class="wordder">Periodo:</td>
			  <td class="tdcampo">&nbsp;<?=$sPeriodo[$sEstudia['per_aca']]['per_des']?></td>
		    </tr>
			<tr>
			  <td class="wordder">Modalidad:</td>
			  <td class="tdcampo">&nbsp;<?=$sModnot[$sEstudia['mod_not']]?></td>
		      <td class="wordder">Nota: </td>
		      <td class="wordizq"><input name="rNot_cur" type="text" class="<?=($sEstudia['not_cur']>10?'textnotaap':'textnotade')?>" id="rNot_cur" value="<?=$sEstudia['not_cur']?>" size="2" maxlength="2" onKeyUp="checknota(this)"></td>
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
	  <a href="" title="Guardar" class="linkboton" onClick = "savenotaest(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="" onClick="viewnota<?=(($sUsercoo['hiscon'] == 'h')?'est':'con')?>('<?=$sEstudia['num_mat']?>'); return false;" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>

<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		$sEstudia = "";
		$aCurmatch = "";
		$sEstudia['pln_est'] = $_GET['rPln_est'];
		$sEstudia['cod_cur'] = $_GET['rCod_cur'];
		$sEstudia['sec_gru'] = $_GET['rSec_gru'];
		$sEstudia['mod_act'] = $_GET['rMod_act'];
		$sEstudia['ano_aca'] = $sUsercoo['ano_aca'];
		$sEstudia['per_aca'] = $sUsercoo['per_aca'];

		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		$tActa = "unapnet.acta{$sUsercoo['ano_aca']}";
		$tRegis = "unapnet.regis{$sUsercoo['ano_aca']}";
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		
		$vQuery = "Select nom_cur, niv_est, sem_anu, cod_esp, crd_cur ";
		$vQuery .= "from unapnet.curso ";
		$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' and pln_est = '{$sEstudia['pln_est']}' and ";
		$vQuery .= "cod_cur = '{$sEstudia['cod_cur']}' ";

		$cCurmat = fQuery($vQuery);
		if($aCurmat = $cCurmat->fetch_array())
		{			
			$sEstudia['nom_cur'] = $aCurmat['nom_cur'];
			$sEstudia['niv_est'] = $aCurmat['niv_est'];
			$sEstudia['sem_anu'] = $aCurmat['sem_anu'];
			$sEstudia['cod_esp'] = $aCurmat['cod_esp'];
			$sEstudia['crd_cur'] = $aCurmat['crd_cur'];
		}	
		else
		{
			header("Location:../index.php");
		}		
		
		///
		$vQuery = "Select cod_act from $tActa ";
		$vQuery .= "where cod_car = '{$sUsercoo['cod_car']}' and per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "pln_est = '{$sEstudia['pln_est']}' and cod_cur = '{$sEstudia['cod_cur']}' and ";
		$vQuery .= "sec_gru = '{$sEstudia['sec_gru']}' and mod_mat = '{$sEstudia['mod_act']}' ";

		$cActa = fQuery($vQuery);
		if($aActa = $cActa->fetch_array())
		{			
			$sEstudia['cod_act'] = $aActa['cod_act'];
			
			$vQuery = "Select cod_reg from $tRegis where cod_act = '{$sEstudia['cod_act']}' ";

			$cRegis = fQuery($vQuery);
			if($aRegis = $cRegis->fetch_array())
			{			
				$sEstudia['cod_reg'] = $aRegis['cod_reg'];
			}	
		}	
				
		///
		$vQuery = "Select ca.cod_prf, concat(do.paterno, ' ', do.materno, ', ', do.nombres) as nombre ";
		$vQuery .= "from $tCarga ca left join unapnet.docente do on ca.cod_prf = do.cod_prf ";
		$vQuery .= "where ca.cod_car = '{$sUsercoo['cod_car']}' and ca.per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "ca.pln_est = '{$sEstudia['pln_est']}' and ca.cod_cur = '{$sEstudia['cod_cur']}' and ";
		$vQuery .= "ca.sec_gru = '{$sEstudia['sec_gru']}' and ca.mod_mat = '{$sEstudia['mod_act']}' ";

		$cDocente = fQuery($vQuery);
		if($aDocente = $cDocente->fetch_array())
		{			
			$sEstudia['nom_doc'] = $aDocente['nombre'];
		}
		
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

	  <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Datos del Curso </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="0" cellpadding="1" cellspacing="1" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			<tr>
              <td width="120" class="wordder">Plan-C&oacute;digo:</td>
              <td width="110" class="tdcampo">&nbsp;<?=$sEstudia['cod_cur']?>-<?=$sEstudia['pln_est']?></td>
              <td width="120" class="wordder">Acta y Registro:</td>
              <td width="110" class="tdcampo">&nbsp;<?=(!empty($sEstudia['cod_act']))?($sEstudia['cod_act']." - ".$sEstudia['cod_reg']):("NO EMITIDO")?></td>
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
              <td class="wordder">Grupo: </td>
			  <td class="tdcampo">&nbsp;<?=$sGrupo[$sEstudia['sec_gru']]?></td>
			  <td class="wordder">Modalidad:</td>
			  <td class="tdcampo">&nbsp;<?=$sModnot[$sEstudia['mod_act']]?></td>
		    </tr>
			<tr>
			  <td class="wordder">Docente:</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['nom_doc']?></td>
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
	  
	  <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
	  <tr>
		<th width="30" scope="col">Nro</th>
		<th width="55" scope="col">Num.mat</th>
		<th width="270" scope="col">Apellidos y Nombres </th>
		<th width="90" scope="col">Mod. Mat. </th>
		</tr>
		<?	$vCont = 1;
			$sEstupdf = "";
			
			$vQuery = "Select est.num_mat, est.paterno, est.materno, est.nombres, cm.mod_mat ";
			$vQuery .= "from $tCurmat cm left join unapnet.estudiante est on cm.num_mat = est.num_mat and ";
			$vQuery .= "cm.cod_car = est.cod_car ";
			$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
			$vQuery .= "where cm.pln_est = '{$sEstudia['pln_est']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "cm.cod_cur = '{$sEstudia['cod_cur']}' and cm.sec_gru = '{$sEstudia['sec_gru']}' and ";
			$vQuery .= "mm.mod_act = '{$sEstudia['mod_act']}' ";
			$vQuery .= "order by paterno, materno, nombres";
			$cCurmat = fQuery($vQuery);
			while($aCurmat = $cCurmat->fetch_array())
			{		
				$sEstupdf[$aCurmat['num_mat']]['num_est'] = $vCont;
				$sEstupdf[$aCurmat['num_mat']]['num_mat'] = $aCurmat['num_mat'];
				$sEstupdf[$aCurmat['num_mat']]['nombre'] = "{$aCurmat['paterno']} {$aCurmat['materno']}, {$aCurmat['nombres']}"; 		
				$sEstupdf[$aCurmat['num_mat']]['mod_mat'] = $sModmat[$aCurmat['mod_mat']]['mod_des'];
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><?=$vCont?></td>
		<td class="wordcen"><?=$aCurmat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
		<td class="wordizq">&nbsp;<?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
		</tr>
	  <?	$vCont++;	
	  		}	  ?>	  
	</table>
	  
	  <a href="prnrelacurso.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a>
	  <a href="prnrelacursox.php" class="enlace1"><img src="../images/bexport.png" width="100" height="24" /></a>
	  <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
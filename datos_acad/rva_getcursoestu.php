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
		$sEstudia['pln_est'] = $_GET['rPln_est'];
		$sEstudia['cod_cur'] = $_GET['rCod_cur'];
		$sEstudia['sec_gru'] = $_GET['rSec_gru'];
		$sEstudia['mod_not'] = ($sPlan[$sEstudia['pln_est']]=='1'?"02":"08");
		$sEstudia['ano_aca'] = $sUsercoo['ano_aca'];
		$sEstudia['per_aca'] = $sUsercoo['per_aca'];

		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		$tApla = "unapnet.apla{$sUsercoo['ano_aca']}";
		$tCarga = "unapnet.carga{$sUsercoo['ano_aca']}";
		$tCargaint = "unapnet.cargaint{$sUsercoo['ano_aca']}";
		
		$vQuery = "Select curso.nom_cur, curso.niv_est, curso.sem_anu, curso.cod_esp ";
		$vQuery .= "from unapnet.curso ";
		$vQuery .= "where curso.cod_car = '{$sUsercoo['cod_car']}' and curso.pln_est = '{$sEstudia['pln_est']}' and ";
		$vQuery .= "curso.cod_cur = '{$sEstudia['cod_cur']}' ";

		$cCurmat = fQuery($vQuery);
		if($aCurmat = $cCurmat->fetch_array())
		{			
			$sEstudia['nom_cur'] = $aCurmat['nom_cur'];
			$sEstudia['niv_est'] = $aCurmat['niv_est'];
			$sEstudia['sem_anu'] = $aCurmat['sem_anu'];
			$sEstudia['cod_esp'] = $aCurmat['cod_esp'];
		}	
		else
		{
			header("Location:../index.php");
		}	
		
		$vQuery = "Select ca.cod_prf, concat(do.paterno, ' ', do.materno, ', ', do.nombres) as nombre ";
		$vQuery .= "from $tCarga ca left join unapnet.docente do on ca.cod_prf = do.cod_prf ";
		$vQuery .= "where ca.cod_car = '{$sUsercoo['cod_car']}' and ca.per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "ca.pln_est = '{$sEstudia['pln_est']}' and ca.cod_cur = '{$sEstudia['cod_cur']}' and ";
		$vQuery .= "ca.sec_gru = '{$sEstudia['sec_gru']}' and ca.mod_mat = '01' ";

		$cDocente = fQuery($vQuery);
		if($aDocente = $cDocente->fetch_array())
		{			
			$sEstudia['cod_prf'] = $aDocente['cod_prf'];
			$sEstudia['nom_doc'] = $aDocente['nombre'];
		}
		
		$vQuery = "Select ca.cod_prf, concat(do.paterno, ' ', do.materno, ', ', do.nombres) as nombre ";
		$vQuery .= "from $tCargaint ca left join unapnet.docente do on ca.cod_prf = do.cod_prf ";
		$vQuery .= "where ca.cod_car = '{$sUsercoo['cod_car']}' and ca.per_aca = '{$sUsercoo['per_aca']}' and ";
		$vQuery .= "ca.pln_est = '{$sEstudia['pln_est']}' and ca.cod_cur = '{$sEstudia['cod_cur']}' and ";
		$vQuery .= "ca.sec_gru = '{$sEstudia['sec_gru']}' and ca.mod_mat = '01' ";

		$cDocente2 = fQuery($vQuery);
		if($aDocente2 = $cDocente2->fetch_array())
		{			
			$sEstudia['cod_prf2'] = $aDocente2['cod_prf'];
			$sEstudia['nom_doc2'] = $aDocente2['nombre'];
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
              <td width="120" class="wordder">&nbsp;</td>
              <td width="110" class="wordder">&nbsp;</td>
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
			  <td class="wordder">&nbsp;</td>
			  <td class="wordder">&nbsp;</td>
		    </tr>
			<tr>
			  <td class="wordder">Docente(Regular):</td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sEstudia['nom_doc2']?></td>
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
		<th width="30" scope="col">&nbsp;</th>
		<th width="55" scope="col">Num.mat</th>
		<th width="270" scope="col">Apellidos y Nombres </th>
		<th width="90" scope="col">Mod. Mat. </th>
		<th width="25" scope="col">Nota</th>
	  </tr>
		<?	$vCont = 1;
			$sNota = "";
			
			$sEstupdf = "";
			
			$vQuery = "Select est.num_mat, est.paterno, est.materno, est.nombres, cm.mod_mat, no.not_cur ";
			$vQuery .= "from $tCurmat cm left join unapnet.estudiante est on cm.num_mat = est.num_mat and ";
			$vQuery .= "cm.cod_car = est.cod_car ";
			$vQuery .= "left join $tNota no on cm.num_mat = no.num_mat and cm.pln_est = no.pln_est and ";
			$vQuery .= "cm.cod_cur = no.cod_cur and cm.ano_aca = no.ano_aca and cm.per_aca = no.per_aca ";
			$vQuery .= "where cm.pln_est = '{$sEstudia['pln_est']}' and cm.per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "cm.cod_cur = '{$sEstudia['cod_cur']}' and cm.sec_gru = '{$sEstudia['sec_gru']}' and ";
			if($sPlan[$sEstudia['pln_est']]=='2')
				$vQuery .= "no.not_cur >= 8 and no.not_cur <= 10 and "; 
			else if($sPlan[$sEstudia['pln_est']]=='1')
				$vQuery .= "no.not_cur >= 6 and no.not_cur <= 10 and "; 
			$vQuery .= "cm.num_mat not in  (select num_mat from $tApla where ";
			$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' and per_aca = '{$sUsercoo['per_aca']}' and ";
			$vQuery .= "pln_est = '{$sEstudia['pln_est']}' and cod_cur = '{$sEstudia['cod_cur']}' and ";
			$vQuery .= "sec_gru = '{$sEstudia['sec_gru']}' ) ";
			$vQuery .= "order by paterno, materno, nombres";
			$cCurmat = fQuery($vQuery);
			while($aCurmat = $cCurmat->fetch_array())
			{
				$sEstupdf[$aCurmat['num_mat']]['num_est'] = $vCont;
				$sEstupdf[$aCurmat['num_mat']]['num_mat'] = $aCurmat['num_mat'];
				$sEstupdf[$aCurmat['num_mat']]['nombre'] = "{$aCurmat['paterno']} {$aCurmat['materno']}, {$aCurmat['nombres']}"; 		
				$sEstupdf[$aCurmat['num_mat']]['mod_mat'] = $sModnot[$aCurmat['mod_mat']];
		?>
	  <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
		<td class="wordcen"><input name="rEstureeval[<?=$aCurmat['num_mat']?>]" type="checkbox" id="rEstureeval[<?=$aCurmat['num_mat']?>]" value="checkbox" onClick="pintar(this)" checked="checked" /></td>
		<td class="wordcen"><?=$aCurmat['num_mat']?></td>
		<td class="wordizq">&nbsp;<?=$aCurmat['paterno']?> <?=$aCurmat['materno']?>, <?=$aCurmat['nombres']?></td>
		<td class="wordizq">&nbsp;<?=$sModmat[$aCurmat['mod_mat']]['mod_des']?></td>
		<td class="worizq">&nbsp;
		  <span class ="<?	if($aCurmat['not_cur'] < 11) echo "notades"; else echo "notapro" ?>">				  
		  <?=$aCurmat['not_cur']?>
		  </span></td>
	  </tr>
	  <?	$vCont++;	}	?>
	</table>
	<a href="" title="Guardar" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bsave.png" width="100" height="24"></a>
    <a href="rva_selectsem.php" onClick="" title="Cancelar" class="linkboton" ><img src="../images/bundo.png" width="100" height="24"></a>
	 <a href="prnintoree.php" title="Imprimir" class="linkboton" target="frPdf"><img src="../images/bprint.png" width="100" height="24" /></a> 
	 <div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div> 
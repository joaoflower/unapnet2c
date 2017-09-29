<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=relcurso.xls");

	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	

	if(fsafetyselcar2())
	{
		$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sUsercoo['ano_aca']}";
		$vQuery = "select distinct pln_est from $tCurmat where per_aca = '{$sUsercoo['per_aca']}' order by pln_est ";
		$cPlnesp = fQuery($vQuery);
		while($aPlnesp = $cPlnesp->fetch_array())
		{
			$sPlnesp[$aPlnesp['pln_est']]['pln_est'] = $aPlnesp['pln_est'];
		}
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>

	  <?
	  	if(!empty($sPlnesp))
		foreach($sPlnesp as $vPlnesp => $aPlnesp)
		{
			
	  ?>
		  <?			  	
			$sCancurso = "";

			$vQuery = "select distinct cu.niv_est, cu.sem_anu, cu.pln_est, cu.cod_esp, cu.cod_cur, cu.nom_cur, ";
			$vQuery .= "cm.sec_gru, count(*) as canti ";
			$vQuery .= "from $tCurmat cm left join unapnet.curso cu on cm.cod_car = cu.cod_car and ";
			$vQuery .= "cm.pln_est = cu.pln_est and cm.cod_cur = cu.cod_cur ";
			$vQuery .= "where cm.per_aca = '{$sUsercoo['per_aca']}' and cm.pln_est = '$vPlnesp' ";
			$vQuery .= "group by pln_est, cod_cur, sec_gru ";
			$vQuery .= "order by cu.niv_est, sem_anu, cod_esp, cod_cur, sec_gru ";

			$cCurso = fQuery($vQuery);
			while($aCurso = $cCurso->fetch_array())
			{
				$sCancurso[$aCurso['cod_cur']]['pln_est'] = $aCurso['pln_est'];
				$sCancurso[$aCurso['cod_cur']]['niv_est'] = $aCurso['niv_est'];
				$sCancurso[$aCurso['cod_cur']]['sem_anu'] = $aCurso['sem_anu'];
				$sCancurso[$aCurso['cod_cur']]['cod_esp'] = $aCurso['cod_esp'];
				$sCancurso[$aCurso['cod_cur']]['nom_cur'] = $aCurso['nom_cur'];
				$sCancurso[$aCurso['cod_cur']][$aCurso['sec_gru']] = $aCurso['canti'];
				
				
			}
		  ?>		  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="25">C</th>
              <th width="280">Nombre de Curso </th>
              <th width="30">Uni</th>
              <th width="30">Gr-A</th>
              <th width="30">Gr-B</th>
              <th width="30">Gr-C</th>
              <th width="30">Gr-D</th>
              <th width="30">Gr-E</th>
              <th width="35">Total</th>
            </tr>
			<?
				$vSem_anu = "";
				$vNiv_est = "";
				$vCod_esp = "00";
				$vCont = 1;
				if(!empty($sCancurso))
				foreach($sCancurso as $vCod_cur => $aCurso)
				{				
					if($vSem_anu != $aCurso['sem_anu'] or $vNiv_est != $aCurso['niv_est'])
					{
						$vSem_anu = $aCurso['sem_anu'];
						$vNiv_est = $aCurso['niv_est'];
						
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordder">&nbsp;</td>
              <td colspan="8" class="wordizq"><strong>&nbsp;NIVEL : <?=$sNivel[$aCurso['niv_est']]?>  - SEMESTRE :  <?=$sSemestre[$aCurso['sem_anu']]?></strong></td>
            </tr>
			<?		
					} 	
					
					if($vCod_esp != $aCurso['cod_esp'])
					{
						$vCod_esp = $aCurso['cod_esp'];
						if($vCod_esp != '00')
						{
			?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;</td>
              <td colspan="8" class="wordizqb"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mensi&oacute;n: <?=$sEspecial[$aCurso['pln_est'].$aCurso['cod_esp']]['esp_nom']?></strong></td>
            </tr>
			<?		}	}	?>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?>>
              <td class="wordizq">&nbsp;<?=$vCod_cur?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($aCurso['nom_cur']))?> </td>
              <td class="wordder"><?=$aCurso['01']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['02']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['03']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['04']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['05']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['06']?>&nbsp;</td>
              <td class="wordder"><?=$aCurso['01']+$aCurso['02']+$aCurso['03']+$aCurso['04']+$aCurso['05']?>&nbsp;</td>
            </tr>
			<?	$vCont++;	}	?>
          </table>
			  
	<? }	?>
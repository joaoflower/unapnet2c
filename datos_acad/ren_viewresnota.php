<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if(!empty($_GET['rNum_mat']))
			$vNum_mat = $_GET['rNum_mat'];
		else
			$vNum_mat = $sEstudia['num_mat'];
		
		$sEstudia = "";
		$sNotapdf = "";
		$sPDF = "";
		$aNotapr = "";
		$aNotades = "";
		
		$sUsercoo['hiscon'] = 'h';
		
		$vQuery = "Select num_mat, paterno, materno, nombres, mod_ing from unapnet.estudiante where num_mat = '$vNum_mat' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' ";
		$cEstudia = fQuery($vQuery);
		if($aEstudia2 = $cEstudia->fetch_array())
		{
			$sEstudia['num_mat'] = $aEstudia2['num_mat'];
			$sEstudia['paterno'] = $aEstudia2['paterno'];
			$sEstudia['materno'] = $aEstudia2['materno'];
			$sEstudia['nombres'] = $aEstudia2['nombres'];
			$sEstudia['mod_ing'] = $aEstudia2['mod_ing'];
		
			//--------------- Ultima matricula ----------------------			
			$bUltmat = FALSE;
			$vAno_ini = substr($sEstudia['num_mat'], 0, 2);
			if($vAno_ini < '50') 
				$vAno_ini = "20$vAno_ini";
			else
				$vAno_ini = "1999";
				
			for($vAno_aca = $sUsercoo['ano_aca']; $vAno_aca >= $vAno_ini and !$bUltmat; $vAno_aca--)
			{
				$tEstumat = "unapnet.estumat{$sUsercoo['cod_car']}$vAno_aca";
				$vQuery = "Select per_aca, pln_est, cod_esp from $tEstumat where num_mat = '{$sEstudia['num_mat']}' and ";
				$vQuery .= "(per_aca = '00' or per_aca = '01' or per_aca = '02') order by per_aca desc";
				
				$cEstumat = fQuery($vQuery);
				if($aEstumat = $cEstumat->fetch_array())
				{
					$sEstudia['pln_est'] = $aEstumat['pln_est'];
					$sEstudia['cod_esp'] = $aEstumat['cod_esp'];					
					$bUltmat = TRUE;
					break;
				}				
			}
			//-----------------------------------------			
		}
		else
		{
			header("Location:not_getestu.php");
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
            <th align="center" background="../images/ventana_r1_c2.jpg" >Resumen de notas </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th scope="col">&nbsp;</th>
                  <th colspan="5" scope="col">DATOS PARCIALES </th>
                  <th colspan="5" scope="col">DATOS ACULUMATIVOS </th>
                </tr>
                <tr>
                  <th width="60" scope="col">A&ntilde;o-Per</th>
                  <th width="40" scope="col">C Cu </th>
                  <th width="40" scope="col">C Ap </th>
                  <th width="40" scope="col">C Ds </th>
                  <th width="40" scope="col">Ptje</th>
                  <th width="40" scope="col">PPS</th>
                  <th width="40" scope="col">C Cu </th>
                  <th width="40" scope="col">C Ap </th>
                  <th width="40" scope="col">C Ds </th>
                  <th width="40" scope="col">Ptje</th>
                  <th width="40" scope="col">PPA</th>
                </tr>
        	<? 	
			if($bUltmat)
			{
				$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
		
				$vCont = 1;
				
				$vCrd_cur = 0;
				$vCrd_Apr = 0;
				$vCrd_Des = 0;
				$vPuntaje = 0;
				$vPro_acu = 0;
				
				$vQuery = "select no.ano_aca, no.per_aca, sum(cu.crd_cur) as crd_cur, sum(cu.crd_cur*no.not_cur) as puntaje, ";
				$vQuery .= "sum(if(no.not_cur > 10, cu.crd_cur, 0)) as crd_apr, ";
				$vQuery .= "sum(if(no.not_cur <= 10, cu.crd_cur, 0)) as crd_des, ";
				$vQuery .= "(sum(cu.crd_cur*no.not_cur)/sum(cu.crd_cur)) as pro_sem ";
				$vQuery .= "from (select ano_aca, per_aca, cod_car, pln_est, cod_cur, num_mat, not_cur ";
				$vQuery .= "   from $tNota where num_mat = '{$sEstudia['num_mat']}' and pln_est = '{$sEstudia['pln_est']}' "; //) no ";
				$vQuery .= "   and not_cur > 0) no ";
				$vQuery .= "left join unapnet.curso cu on no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and ";
				$vQuery .= "no.cod_cur = cu.cod_cur group by ano_aca, per_aca ";
			
				$cResnota = fQuery($vQuery);
				while($aResnota = $cResnota->fetch_array())
				{
					$vCrd_cur += $aResnota['crd_cur'];
					$vCrd_Apr += $aResnota['crd_apr'];
					$vCrd_Des += $aResnota['crd_des'];
					$vPuntaje += $aResnota['puntaje'];
					$vPro_acu = $vPuntaje / $vCrd_cur;
				?>
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td class="wordcen"><?=$aResnota['ano_aca']?>-<?=$sPeriodo[$aResnota['per_aca']]['abr_per']?></td>
                  <td class="wordder"><?=round($aResnota['crd_cur'], 2)?>&nbsp;</td>
                  <td class="wordder"><?=round($aResnota['crd_apr'], 2)?>&nbsp;</td>
                  <td class="wordder"><?=round($aResnota['crd_des'], 2)?>&nbsp;</td>
                  <td class="wordder"><?=round($aResnota['puntaje'], 2)?>&nbsp;</td>
                  <td class="wordder"><?=round($aResnota['pro_sem'], 2)?>&nbsp;</td>
                  <td class="wordder"><?=$vCrd_cur?>&nbsp;</td>
                  <td class="wordder"><?=$vCrd_Apr?>&nbsp;</td>
                  <td class="wordder"><?=$vCrd_Des?>&nbsp;</td>
                  <td class="wordder"><?=$vPuntaje?>&nbsp;</td>
                  <td class="wordder"><?=round($vPro_acu, 2)?>&nbsp;</td>
                </tr>
			<? 
					$vCont++; 	
				}
				$cResnota->close();
			}
			?>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>

		<div id="ddatos2"><iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe></div>
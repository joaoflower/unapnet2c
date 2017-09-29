<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar2())
	{
				
	}
	else
	{
		header("Location:../index.php");
	}	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Un@p.Net2</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<STYLE type=text/css>
@import url( ../style/unapnet2.css );
</STYLE>
<script language="JavaScript">
<!--
	<? include "../include/script1.php"; ?>
//-->
</script>
</head>

<body>
	<? include "../include/header1.php"; ?>
	<? include "../include/mdatos_acad.php"; ?>
	
	<div class="wordcen" id="body1">
	
	<table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Rendimiento Acad&eacute;mico </th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen">
		  
		 <table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
            <tr>
              <th width="25">C</th>
              <th width="190">Escuela Profesional </th>
              <th width="55">Sexo</th>
              <th width="25">Inv.</th>
              <th width="25">1Ds</th>
              <th width="25">2Ds</th>
              <th width="25">3Ds</th>
              <th width="25">4Ds</th>
              <th width="25">5Ds</th>
              <th width="25">6+Ds</th>
              <th width="40">Subtot.</th>
              <th width="35">Total</th>
            </tr>
			<?
				$vCont = 1;	
				foreach($sAcceso as $vCod_car => $aAcceso) 
				{
					//if($vCod_car <= '56' and $vCod_car != '19' and $vCod_car != '38' and $vCod_car != '47' and $vCod_car != '50' and $vCod_car != '51' and $vCod_car != '53' and $vCod_car != '62' and $vCod_car != '63' and $vCod_car != '64')
					if(($vCod_car <= '36' and $vCod_car != '19') or $vCod_car == '56')
					{
						$tNota = "unapnet.nota".$vCod_car;
						$tEstumat = "unapnet.estumat".$vCod_car.$sUsercoo['ano_aca'];
						
						$aCanota = "";
						$aCanota['1']['0'] = 0;
						$aCanota['1']['1'] = 0;
						$aCanota['1']['2'] = 0;
						$aCanota['1']['3'] = 0;
						$aCanota['1']['4'] = 0;
						$aCanota['1']['5'] = 0;
						$aCanota['1']['6'] = 0;
						$aCanota['1']['T'] = 0;
						
						$aCanota['2']['0'] = 0;
						$aCanota['2']['1'] = 0;
						$aCanota['2']['2'] = 0;
						$aCanota['2']['3'] = 0;
						$aCanota['2']['4'] = 0;
						$aCanota['2']['5'] = 0;
						$aCanota['2']['6'] = 0;
						$aCanota['2']['T'] = 0;
						
						$vQuery = "select ca.sexo, ca.can_des, count(*) as canti from ";
						$vQuery .= "(select no.num_mat, es.sexo, count(*) as can_des ";
						$vQuery .= "from $tNota no left join unapnet.estudiante es on no.num_mat = es.num_mat and ";
						$vQuery .= "no.cod_car = es.cod_car ";
						$vQuery .= "where ano_aca = '{$sUsercoo['ano_aca']}' and per_aca = '{$sUsercoo['per_aca']}' ";
						$vQuery .= "and not_cur < 11 and ";
						$vQuery .= "(mod_not = '01' or mod_not = '03' or mod_not = '06' or mod_not = '07' or mod_not = '09' or ";
						$vQuery .= "mod_not = '10' or mod_not = '11' or mod_not = '14' or mod_not = '15' or mod_not = '16' or ";
						$vQuery .= "mod_not = '17' or mod_not = '18' or mod_not = '20' or mod_not = '21' or mod_not = '22' or ";
						$vQuery .= "mod_not = '23' or mod_not = '24' or mod_not = '25' or mod_not = '26' or mod_not = '27' or ";
						$vQuery .= "mod_not = '28' or mod_not = '29' or mod_not = '30' or mod_not = '31') group by num_mat ) ca group by sexo, can_des";					
						
						$cRendicar = fQuery($vQuery);
						while($aRendicar = $cRendicar->fetch_array())
						{
							if($aRendicar['can_des'] <= 5)
								$aCanota[$aRendicar['sexo']][$aRendicar['can_des']] = $aRendicar['canti'];
							else
								$aCanota[$aRendicar['sexo']]['6'] += $aRendicar['canti'];
						}
						//--------------------------------------------------------
						$vQuery = "select es.sexo, count(*) as canti ";
						$vQuery .= "from $tEstumat em left join unapnet.estudiante es on em.num_mat = es.num_mat and ";
						$vQuery .= "em.cod_car = es.cod_car ";
						$vQuery .= "where ano_aca = '{$sUsercoo['ano_aca']}' and per_aca = '{$sUsercoo['per_aca']}' ";
						$vQuery .= "group by es.sexo";
						
						$cRendicar = fQuery($vQuery);
						while($aRendicar = $cRendicar->fetch_array())
						{
							$aCanota[$aRendicar['sexo']]['T'] = $aRendicar['canti'];
						}
						
						$aCanota['1']['0'] = $aCanota['1']['T'] - $aCanota['1']['1'] - $aCanota['1']['2'] - $aCanota['1']['3'] - $aCanota['1']['4'] - $aCanota['1']['5'] - $aCanota['1']['6'];
						$aCanota['2']['0'] = $aCanota['2']['T'] - $aCanota['2']['1'] - $aCanota['2']['2'] - $aCanota['2']['3'] - $aCanota['2']['4'] - $aCanota['2']['5'] - $aCanota['2']['6'];
				
			?>
			
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?> >
              <td>&nbsp;<?=$vCod_car?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCarrera[$vCod_car]))?></td>
              <td class="wordizq">&nbsp;Masculino</td>
              <td class="wordder"><?=$aCanota['1']['0']?></td>
              <td class="wordder"><?=$aCanota['1']['1']?></td>
              <td class="wordder"><?=$aCanota['1']['2']?></td>
              <td class="wordder"><?=$aCanota['1']['3']?></td>
              <td class="wordder"><?=$aCanota['1']['4']?></td>
              <td class="wordder"><?=$aCanota['1']['5']?></td>
              <td class="wordder"><?=$aCanota['1']['6']?></td>
              <td class="wordder"><?=$aCanota['1']['T']?></td>
              <td class="wordder"><?=($aCanota['1']['T']+$aCanota['2']['T'])?></td>
            </tr>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?> >
              <td>&nbsp;</td>
              <td class="wordizq">&nbsp;</td>
              <td class="wordizq">&nbsp;Femenino</td>
              <td class="wordder"><?=$aCanota['2']['0']?></td>
              <td class="wordder"><?=$aCanota['2']['1']?></td>
              <td class="wordder"><?=$aCanota['2']['2']?></td>
              <td class="wordder"><?=$aCanota['2']['3']?></td>
              <td class="wordder"><?=$aCanota['2']['4']?></td>
              <td class="wordder"><?=$aCanota['2']['5']?></td>
              <td class="wordder"><?=$aCanota['2']['6']?></td>
              <td class="wordder"><?=$aCanota['2']['T']?></td>
              <td class="wordder">&nbsp;</td>
            </tr>			
			<?
				$vCont++; 	}	}
			?>
          </table>
			  
		  </td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
      </table>
	
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
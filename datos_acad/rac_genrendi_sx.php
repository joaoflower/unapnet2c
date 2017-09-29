<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
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
              <th width="25">6Ds</th>
              <th width="30">Total</th>
            </tr>
			<?
				$vCont = 1;	
				foreach($sAcceso as $vCod_car => $aAcceso) 
				{
					if($vCod_car <= '66' and $vCod_car != '53'  and $vCod_car != '51')
					{
						$tNota = "unapnet.nota".$vCod_car;
						$tEstumat = "unapnet.estumat".$vCod_car.$sUsercoo['ano_aca'];
						
						$aCanota = "";
						$aCanota['0'] = 0;
						$aCanota['1'] = 0;
						$aCanota['2'] = 0;
						$aCanota['3'] = 0;
						$aCanota['4'] = 0;
						$aCanota['5'] = 0;
						$aCanota['6'] = 0;
						$aCanota['T'] = 0;
						
						$vQuery = "select count(*) as can_des from $tNota where ano_aca = '{$sUsercoo['ano_aca']}' and ";
						$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and not_cur < 11 and (mod_not = '01' or mod_not = '03' or ";
						$vQuery .= "mod_not = '06' or mod_not = '07' or mod_not = '09' or mod_not = '10' or mod_not = '11' or ";
						$vQuery .= "mod_not = '14' or mod_not = '15' or mod_not = '16' or mod_not = '17') ";					
						echo $vQuery .= "group by num_mat having count(*) = 1 ";
						$aCanota['1'] = fCountq($vQuery);
						
						$vQuery = "select count(*) as can_des from $tNota where ano_aca = '{$sUsercoo['ano_aca']}' and ";
						$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and not_cur < 11 and (mod_not = '01' or mod_not = '03' or ";
						$vQuery .= "mod_not = '06' or mod_not = '07' or mod_not = '09' or mod_not = '10' or mod_not = '11' or ";
						$vQuery .= "mod_not = '14' or mod_not = '15' or mod_not = '16' or mod_not = '17') ";					
						$vQuery .= "group by num_mat having count(*) = 2 ";
						$aCanota['2'] = fCountq($vQuery);					
						
						$vQuery = "select count(*) as can_des from $tNota where ano_aca = '{$sUsercoo['ano_aca']}' and ";
						$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and not_cur < 11 and (mod_not = '01' or mod_not = '03' or ";
						$vQuery .= "mod_not = '06' or mod_not = '07' or mod_not = '09' or mod_not = '10' or mod_not = '11' or ";
						$vQuery .= "mod_not = '14' or mod_not = '15' or mod_not = '16' or mod_not = '17') ";					
						$vQuery .= "group by num_mat having count(*) = 3 ";
						$aCanota['3'] = fCountq($vQuery);
						
						$vQuery = "select count(*) as can_des from $tNota where ano_aca = '{$sUsercoo['ano_aca']}' and ";
						$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and not_cur < 11 and (mod_not = '01' or mod_not = '03' or ";
						$vQuery .= "mod_not = '06' or mod_not = '07' or mod_not = '09' or mod_not = '10' or mod_not = '11' or ";
						$vQuery .= "mod_not = '14' or mod_not = '15' or mod_not = '16' or mod_not = '17') ";					
						$vQuery .= "group by num_mat having count(*) = 4 ";
						$aCanota['4'] = fCountq($vQuery);
						
						$vQuery = "select count(*) as can_des from $tNota where ano_aca = '{$sUsercoo['ano_aca']}' and ";
						$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and not_cur < 11 and (mod_not = '01' or mod_not = '03' or ";
						$vQuery .= "mod_not = '06' or mod_not = '07' or mod_not = '09' or mod_not = '10' or mod_not = '11' or ";
						$vQuery .= "mod_not = '14' or mod_not = '15' or mod_not = '16' or mod_not = '17') ";					
						$vQuery .= "group by num_mat having count(*) = 5 ";
						$aCanota['5'] = fCountq($vQuery);
						
						$vQuery = "select count(*) as can_des from $tNota where ano_aca = '{$sUsercoo['ano_aca']}' and ";
						$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' and not_cur < 11 and (mod_not = '01' or mod_not = '03' or ";
						$vQuery .= "mod_not = '06' or mod_not = '07' or mod_not = '09' or mod_not = '10' or mod_not = '11' or ";
						$vQuery .= "mod_not = '14' or mod_not = '15' or mod_not = '16' or mod_not = '17') ";					
						$vQuery .= "group by num_mat having count(*) >= 6 ";
						$aCanota['6'] = fCountq($vQuery);
						
						$vQuery = "select num_mat from $tEstumat where ano_aca = '{$sUsercoo['ano_aca']}' and ";
						$vQuery .= "per_aca = '{$sUsercoo['per_aca']}' ";
						$aCanota['T'] = fCountq($vQuery);		
						
						$aCanota['0'] = $aCanota['T'] - $aCanota['1'] - $aCanota['2'] - $aCanota['3'] - $aCanota['4'] - $aCanota['5'] - $aCanota['6'];
				
			?>
			
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?> >
              <td>&nbsp;<?=$vCod_car?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCarrera[$vCod_car]))?></td>
              <td class="wordizq">&nbsp;Masculino</td>
              <td class="wordder"><?=$aCanota['0']?></td>
              <td class="wordder"><?=$aCanota['1']?></td>
              <td class="wordder"><?=$aCanota['2']?></td>
              <td class="wordder"><?=$aCanota['3']?></td>
              <td class="wordder"><?=$aCanota['4']?></td>
              <td class="wordder"><?=$aCanota['5']?></td>
              <td class="wordder"><?=$aCanota['6']?></td>
              <td class="wordder"><?=$aCanota['T']?></td>
            </tr>
            <tr <? if($vCont % 2 == 0) echo "class=\"celpar\""; else echo "class=\"celinpar\"";?> >
              <td>&nbsp;</td>
              <td class="wordizq">&nbsp;</td>
              <td class="wordizq">&nbsp;Femenino</td>
              <td class="wordder">&nbsp;</td>
              <td class="wordder">&nbsp;</td>
              <td class="wordder">&nbsp;</td>
              <td class="wordder">&nbsp;</td>
              <td class="wordder">&nbsp;</td>
              <td class="wordder">&nbsp;</td>
              <td class="wordder">&nbsp;</td>
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
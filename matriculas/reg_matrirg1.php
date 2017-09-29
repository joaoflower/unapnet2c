<?php
	session_start();
	include "../include/function.php";
	include "../include/funcsql.php";
	
	if(fsafetyselcar())
	{
		if($sUsercoo['safetymatri'])
		{
			$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
			$tCurmat = "unapnet.curmat{$sUsercoo['cod_car']}{$sEstudia['ano_aca']}";			
			$tCurso = "unapnet.curso";
			
			$vCancur2 = 0;
			$vCurapr2 = 0;
			$vCurdes2 = 0;
			$vCurdes3 = 0;
			$vCredito = 0;
			$vPuntaje = 0;
			$vPromedio = 0;
			
			if(!empty($sEstudia['ano_aca']))
			{				
				$vQuery = "Select count(*) as can_cur from $tCurmat ";
				$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and per_aca = '{$sEstudia['per_aca']}' ";
			
				$cCancur = fQuery($vQuery);
				while($aCancur = $cCancur->fetch_array())
				{
					$vCancur2 = $aCancur['can_cur'];
					if(empty($vCancur2)) $vCancur2 = 0;
				}
				
				$vQuery = "Select count(*) as cur_des from $tNota ";
				$vQuery .= "where num_mat = '{$sEstudia['num_mat']}' and ano_aca = '{$sEstudia['ano_aca']}' and ";
				$vQuery .= "per_aca = '{$sEstudia['per_aca']}' and not_cur < 11 and pln_est = '{$sEstudia['pln_est']}' and ";
				$vQuery .= "mod_not != '02' and ";
				$vQuery .= "cod_cur not in (Select cod_cur from $tNota where pln_est = '{$sEstudia['pln_est']}' and ";
				$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and  not_cur > 10)";
				$cNota = fQuery($vQuery);
				if($aNota = $cNota->fetch_array())
				{
					$vCurdes2 = $aNota['cur_des'];
					if(empty($vCurdes2)) $vCurdes2 = 0;
				}
				
				$vQuery = "Select count(*) as cur_apr from $tNota where num_mat = '{$sEstudia['num_mat']}' and ";
				$vQuery .= "ano_aca = '{$sEstudia['ano_aca']}' and per_aca = '{$sEstudia['per_aca']}' and ";
				$vQuery .= "not_cur > 10 and pln_est = '{$sEstudia['pln_est']}' ";
				$cNota2 = fQuery($vQuery);
				if($aNota2 = $cNota2->fetch_array())
				{
					$vCurapr2 = $aNota2['cur_apr'];
					if(empty($vCurapr2)) $vCurapr2 = 0;
				}
				
				$vQuery = "Select no.cod_cur, cu.sem_anu from $tNota no left join $tCurso cu on ";
				$vQuery .= "no.cod_car = cu.cod_car and no.pln_est = cu.pln_est and no.cod_cur = cu.cod_cur ";
				$vQuery .= "where no.num_mat = '{$sEstudia['num_mat']}' and no.ano_aca = '{$sEstudia['ano_aca']}' and ";
				$vQuery .= "no.per_aca = '{$sEstudia['per_aca']}' and no.not_cur < 11 and no.pln_est = '{$sEstudia['pln_est']}' and ";
				$vQuery .= "no.mod_not != '02' and ";
				$vQuery .= "no.cod_cur not in (Select cod_cur from $tNota where pln_est = '{$sEstudia['pln_est']}' and ";
				$vQuery .= "num_mat = '{$sEstudia['num_mat']}' and  not_cur > 10) ";
				$cNota3 = fQuery($vQuery);
				while($aNota3 = $cNota3->fetch_array())
				{
					$vCurdes3++;
					if($aNota3['sem_anu'] == '00')
						$vCurdes3++;
				}
				$vQuery = "Select max(niv_est) as max_niv from $tCurso where cod_car = '{$sUsercoo['cod_car']}' and ";
				$vQuery .= "pln_est = '{$sEstudia['pln_est']}' ";
				$cNivel = fQuery($vQuery);
				while($aNivel = $cNivel->fetch_array())
				{
					$sEstudia['max_niv'] = $aNivel['max_niv'];
				}
							
				fModestudiarig($vCurdes3);
			}
			else
			{
				$sEstudia['max_niv'] = '01';
				fModestudiarig(0);
			}
			$sUsercoo['safetymatri'] = FALSE;
			$sUsercoo['safetymatri2'] = TRUE;

			
		}
		else
			header("Location:reg_getestu.php");
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
	<? include "../include/mmatriculas.php"; ?>
	
	<div class="wordcen" id="body1">
	  <form action="reg_matrirg2.php" method="post" enctype="multipart/form-data" name="fData" id="fData"> 
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Datos principales del Estudiante </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg"><table width="400" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <td width="130" class="wordder">Estudiante: </td>
                  <td class="wordizqb">&nbsp;<?=$sEstudia['num_mat']?> - <?=$sEstudia['paterno']?> <?=$sEstudia['materno']?>, <?=$sEstudia['nombres']?></td>
                </tr>
                <tr>
                  <td class="wordder">Plan de estudios:</td>
                  <td class="wordizqb">&nbsp;<?=$sEstudia['pln_est']?> - <?=$sTiposist[$sEstudia['tip_sist']]?></td>
                </tr>
                <tr>
                  <td class="wordder">Especialidad:</td>
                  <td class="wordizqb">&nbsp;<?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
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
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
          <tr>
            <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
            <th align="center" background="../images/ventana_r1_c2.jpg" >Condici&oacute;n de Matr&iacute;cula Anterior [<?=$sEstudia['ano_aca']?> - <?=$sPeriodo[$sEstudia['per_aca']]['per_des']?>]</th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="220" border="0" cellpadding="1" cellspacing="0" class="tabled">
                <tr>
                  <td class="wordder">Nivel : </td>
                  <td class="wordizqb"><?=$sNivel[$sEstudia['niv_est2']]?></td>
                </tr>
                <tr>
                  <td width="110" class="wordder">Modalidad : </td>
                  <td class="wordizqb"><?=$sModmat[$sEstudia['mod_mat2']]['mod_des']?></td>
                </tr>
                <tr>
                  <td class="wordder">Cursos matriculados : </td>
                  <td class="wordizqb"> <?=$vCancur2?> cursos </td>
                </tr>
                <tr>
                  <td class="wordder">Cursos aprobados : </td>
                  <td class="wordizqb"><?=$vCurapr2?> cursos </td>
                </tr>
                <tr>
                  <td class="wordder">Cursos desaprob. : </td>
                  <td class="wordizqb"><?=$vCurdes2?> cursos</td>
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
	    <table border="0" cellpadding="0" cellspacing="0" id="ventana">
        <tr>
          <th><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></th>
          <th align="center" background="../images/ventana_r1_c2.jpg" >Condici&oacute;n de Matr&iacute;cula Actual [<?=$sUsercoo['ano_aca']?> - <?=$sPeriodo[$sUsercoo['per_aca']]['per_des']?>]</th>
          <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table width="220" border="0" cellpadding="1" cellspacing="0" class="tabled">
              <tr>
                <td class="wordder">Nivel: </td>
                <td class="wordizqb"><select name="rNiv_est" id="rNiv_est">
				  <?=fviewnivelmat($sEstudia['niv_est'], $sEstudia['max_niv'])?>
                </select></td>
              </tr>
              <tr>
                <td width="110" class="wordder">Modalidad : </td>
                <td class="wordizqb"><select name="rMod_mat" id="rMod_mat">
				  <?=fviewmodmatest($sEstudia['mod_mat'])?>
                </select></td>
              </tr>
              <tr>
                <td class="wordder">Grupo : </td>
                <td class="wordizqb"><select name="rSec_gru" id="rSec_gru">
                      <?=fviewgrupo('01')?>
					  </select></td>
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
	  </form>
	  <a href="" title="Continuar" class="linkboton" onClick = "document.fData.submit(); return false"><img src="../images/bcontinue.png" width="100" height="24"></a> 
	  <a href="reg_getestu.php" title="Cancelar" class="linkboton" ><img src="../images/bcancel.png" width="100" height="24"></a>
	</div>
	<? include "../include/pie1.php"; ?>

</body>
</html>
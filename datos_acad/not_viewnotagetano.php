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
		$sCurso = "";
		$sCurmat = "";
		$sCurmat2 = "";
		$sCurapto = "";
		$sCurso = "";
		$sAnoper = "";
		$sNotapdf = "";
		$sPDF = "";
		
		$vQuery = "Select num_mat, paterno, materno, nombres from unapnet.estudiante where num_mat = '$vNum_mat' and ";
		$vQuery .= "cod_car = '{$sUsercoo['cod_car']}' ";
		$cEstudia = fQuery($vQuery);
		if($aEstudia2 = $cEstudia->fetch_array())
		{
			$sEstudia['num_mat'] = $aEstudia2['num_mat'];
			$sEstudia['paterno'] = $aEstudia2['paterno'];
			$sEstudia['materno'] = $aEstudia2['materno'];
			$sEstudia['nombres'] = $aEstudia2['nombres'];
			
			$tNota = "unapnet.nota{$sUsercoo['cod_car']}";
			$vQuery = "Select distinct ano_aca from $tNota where num_mat = '{$sEstudia['num_mat']}' order by ano_aca";
			$cAnoper = fQuery($vQuery);
			while($aAnoper = $cAnoper->fetch_array())
			{
				$sAnoper[$aAnoper['ano_aca']] = $aAnoper['ano_aca'];
			}			
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
            <th align="center" background="../images/ventana_r1_c2.jpg" >A&ntilde;os de notas  </th>
            <th><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></th>
          </tr>
          <tr>
            <td background="../images/ventana_r2_c1.jpg"></td>
            <td background="../images/ventana_r2_c2.jpg" class="wordcen"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
                <tr>
                  <th width="40" scope="col">A&ntilde;o</th>
                </tr>
				<?
					$vCont = 1;
					$sNotapdf = "";	
					if(!empty($sAnoper)) foreach($sAnoper as $vAno_aca)	
					{
				?>
			
                <tr <? if($vCont % 2 == 0) echo "class=\"celpar\" id=\"p\""; else echo "class=\"celinpar\" id=\"i\"";?> onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                  <td width="40" class="wordcen"><a href="" onClick="viewnotaestano('<?=$vAno_aca?>'); return false;" class="enlace1" title="Ver notas del año <?=$vAno_aca?>"><?=$vAno_aca?></a></td>
                </tr>
                <? $vCont++; 	} ?>
            </table></td>
            <td background="../images/ventana_r2_c4.jpg"></td>
          </tr>
          <tr>
            <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
            <td background="../images/ventana_r4_c2.jpg"></td>
            <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
          </tr>
        </table>      
        <div id="ddatos2"></div>
        
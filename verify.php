<?php
	session_start();
	include "include/function.php";
	include "include/funcsql.php";	

	$sUsercoo['login'] = $_POST['rLogin'];
	$sUsercoo['passwd'] = $_POST['rPasswd'];
	
	if(!(empty($sUsercoo['login']) or empty($sUsercoo['passwd'])))
	{
		$bUsucoo = FALSE;
		$bPasswd = FALSE;

		$vQuery = "Select passwd, cod_usu, niv_usu, paterno, materno, nombres from unapnet.usucoo where login = '{$sUsercoo['login']}'";
		$cUsucoo = fQuery($vQuery);
		if($aUsucoo = $cUsucoo->fetch_array())
		{
			$bUsucoo = TRUE;
			if($aUsucoo['passwd'] === fpassword($sUsercoo['passwd']))
			{
				$bPasswd = TRUE;
				$aUsucoo['passwd'];
			}
			
			if($bPasswd)
			{				
				$sUsercoo = "";
				$sUsercoo['passwd'] = "";
				$sUsercoo['cod_usu'] = $aUsucoo['cod_usu'];
				$sUsercoo['niv_usu'] = $aUsucoo['niv_usu'];
				$sUsercoo['paterno'] = $aUsucoo['paterno'];
				$sUsercoo['materno'] = $aUsucoo['materno'];
				$sUsercoo['nombres'] = $aUsucoo['nombres'];
				$sUsercoo['ip'] = $REMOTE_ADDR;
			}
		}
		$cUsucoo->close();
		
		if($bUsucoo)
		{
			if($bPasswd)
			{
				$sAcceso = "";
				$vCan_car = 0;
				$vQuery = "Select cod_car, pago, deuda from unapnet.acceso where cod_usu = '{$sUsercoo['cod_usu']}'";
				$cAcceso = fQuery($vQuery);
				while($aAcceso = $cAcceso->fetch_array())
				{
					$sAcceso[$aAcceso['cod_car']]['cod_car'] = $aAcceso['cod_car'];
					$sAcceso[$aAcceso['cod_car']]['pago'] = $aAcceso['pago'];
					$sAcceso[$aAcceso['cod_car']]['deuda'] = $aAcceso['deuda'];
					$vCan_car++;
				}
				$cAcceso->close();
				
				$sUsercoo['can_car'] = $vCan_car;
				$sUsercoo['safetylogin'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
				header("Location:selectcar.php");
			}
			else
			{
				$sUsercoo['errorl'] = TRUE;
				$sUsercoo['msnerror'] = 'ERROR, LA CONTRASEÑA ES INCORRECTA';
				header("Location:index2.php");				
			}		
		}
		else
		{
			$sUsercoo['errorl'] = TRUE;
			$sUsercoo['msnerror'] = 'ERROR, EL USUARIO NO EXISTE';
			header("Location:index2.php");
		}
	}
	else
		header("Location:index.php");		
?>
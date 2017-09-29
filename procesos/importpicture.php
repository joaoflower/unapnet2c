<?php

$vConexion = mysql_connect("localhost","ruth","ruthmaa2004");

$vConsulta = "select * from unap.base";
$cr_usuario = mysql_query($vConsulta, $vConexion);
$vContador = 1;

while ($ar_usuario = mysql_fetch_array($cr_usuario) )
{
        //if ($ar_usuario['cod_car'] == '23')
        //{
                $archivo = "/nauj/fotos/una/" .$ar_usuario['NUM_MAT']. ".jpg";

                $tamanio  = filesize($archivo);
                $tipo     = "image/jpg";
                $nombre  = $ar_usuario['NUM_MAT']. ".jpg";
                $titulo   = $ar_usuario['NUM_MAT'];

                echo $vContador++ . "<Br>";

                if ( $archivo != "" )
                {
                        $fp = fopen($archivo, "rb");
                        $contenido = fread($fp, $tamanio);
                        $contenido = addslashes($contenido);
                        fclose($fp);

                        //echo $contenido. "<br>";

                        //$conn = mysql_connect("localhost","bingo","holahola");

                        $qry = "insert into unap.picture values ('".$ar_usuario['NUM_MAT']."', '".$ar_usuario['COD_CAR']."', '$nombre', '$contenido', '$tipo')";
                        /*$qry = "insert into unap.picture set archivo = '$nombre', contenido = '$contenido', tipo = '$tipo' ";
                        $qry .= "where num_mat = '" .$ar_usuario['num_mat']. "'";*/

                        mysql_query($qry);

                        if(mysql_affected_rows($vConexion) > 0)
                                print "Se ha guardado el archivo en la base de datos.";
                        else
                                print "NO se ha podido guardar el archivo en la base de datos.";
                }
                else
                        echo "NO se pudo subir al servidor";
        //}

}

?>

/*------------------------------------------------------------------------------------------------------------*/
var MAX_MENUES  = 6
var MAX_ITEMS   = 18
var N4 = (document.layers)			? true : false
var IE = (document.all)    			? true : false
var N6 = (document.getElementById) 	? true : false
var BG_color_on  	= '#9BAE5A'
var BG_color_off 	= '#CDE18A'
/*var FONT_Face	 	= 'Arial'
var FONT_Size 		= '9'*/
var FONT_color_on	= '#FFFFFF'
var FONT_color_off 	= '#000000'
/*------------------------------------------------------------------------------------------------------------*/

function visibilidad(m,v)
{
	var menu="m" + m.toString(10)
   	if (v==0 && document.all)
    {	document.all[menu].style.visibility="hidden"	}
   	else if (v==1 && document.all)
    {	document.all[menu].style.visibility="visible"	}
   	else if (v==0 && document.layers)
    {	document.layers['m'+m].visibility="hide"	}
   	else if (v==1 && document.layers)
    {	document.layers['m'+m].visibility="show"	}
   	else if (v==0 && document.getElementById)
    {	document.getElementById(menu).style.visibility="hidden"		}
   	else if (v==1 && document.getElementById)
    {	document.getElementById(menu).style.visibility="visible"	}
}

function color(o,i,c)
{
	if (IE && c==0)
    {	o.style.backgroundColor=BG_color_on
	  	i.style.color=FONT_color_on		}
   	else if (IE && c==1)
    {	o.style.backgroundColor=BG_color_off
	  	i.style.color=FONT_color_off	}
   	else if (N6 && c==0)
    { 	op="op" + o.toString(10)
	  	item="item" + i.toString(10)
	  	document.getElementById(op).style.backgroundColor=BG_color_on
        document.getElementById(item).style.color=FONT_color_on		}
   	else if (N6 && c==1)
    {	document.getElementById(op).style.backgroundColor=BG_color_off
      	document.getElementById(item).style.color=FONT_color_off	}
}

function colorlay(m,o,c)
{	var capa="m" + m.toString(10)
//  alert(o)
   	if (document.layers && c==0)
   	{	document.layers[m].document.layers[o].visibility="hide"
       	document.layers[m].document.layers[o+1].visibility="inherit"	}
   	else if (document.layers && c==1)
    {	document.layers[m].document.layers[o+1].visibility="hide"
      	document.layers[m].document.layers[o].visibility="inherit"      }
}

function linker(i,o)
{	if (o==0)
    {	window.location.href=Menu_Item[i][1]	}
   	else
    {	window.location.href=Menu_Item[i][1]	}
}

/*- DEFINICION DE ITEMS DEL MENU-----------------------------------------------------------------------------------------------------------*/
var Menu_Item =new Array(MAX_ITEMS)
// Administración
	Menu_Item[ 1] = new Array ("Activar carrera y/o periodo", "../selectcar.php", "");
	Menu_Item[ 2] = new Array ("Activar usuario", 	"../index2.php", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
    Menu_Item[ 3] = new Array ("Cambiar Contrase&ntilde;a ", "../administracion/", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	Menu_Item[ 4] = new Array ("Salir del Sistema", "../cerrar.php", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
// Maestros
	Menu_Item[ 5] = new Array ("Estudiantes", 		"../maestros/est_getestu.php", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	Menu_Item[ 6] = new Array ("Docentes", 		"../maestros/doc_getdoce.php", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	Menu_Item[ 7] = new Array ("Especialidad", 		"../maestros/esp_viewesp.php", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	Menu_Item[ 8] = new Array ("Plan de Estudios", 	"../maestros/pln_selectplan.php", "&nbsp;");
// Matrículas
	Menu_Item[ 9] = new Array ("Matr&iacute;cula de Ingresantes", 	"../matriculas/ing_getestu.php", "&nbsp;");
	Menu_Item[10] = new Array ("Matr&iacute;cula de regulares", 	"../matriculas/reg_getestu.php", "&nbsp;&nbsp;&nbsp;");
	Menu_Item[11] = new Array ("Edici&oacute;n de Matr&iacute;cula","../matriculas/edt_getestu.php", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
// Datos Académicos	
	Menu_Item[12] = new Array ("Historial de notas", 			"../datos_acad/not_getestu.php", "&nbsp;&nbsp;&nbsp;&nbsp;");
	Menu_Item[13] = new Array ("Covalidaci&oacute;n de notas", 	"../datos_acad/con_getestu.php", "&nbsp;&nbsp;&nbsp;");
	Menu_Item[14] = new Array ("Ingreso de notas", 				"../datos_acad/ing_select.php", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	Menu_Item[15] = new Array ("Cuadro de m&eacute;ritos", 		"../datos_acad/", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	Menu_Item[16] = new Array ("Asignaci&oacute;n de carga",    "../datos_acad/", "&nbsp;&nbsp;&nbsp;");
	Menu_Item[17] = new Array ("Rendimiento Acad&eacute;mico",  "../datos_acad/", "&nbsp;");
	Menu_Item[18] = new Array ("Horarios",  					"../datos_acad/horario.php", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
// Reportes
	Menu_Item[19] = new Array ("Niveles y/o grupos", 		"../reportes/niv_select.php", "&nbsp;");
	Menu_Item[20] = new Array ("Relaci&oacute;n por curso", "../reportes/cur_select.php",  "&nbsp;");	
	Menu_Item[21] = new Array ("Resumen por modalidad", "../reportes/res_modmat.php",  "&nbsp;");	
	Menu_Item[22] = new Array ("Resumen por curso", "../reportes/res_curso.php",  "&nbsp;");	
// Ayuda
	Menu_Item[23] = new Array ("Acerca del sistema",     "../ayuda/", "&nbsp;");

	var Menu_Item_Pos_Ini =new Array(1,5,9,12, 19, 23,24);	

/*--CREACION DEL MENU IExplorer----------------------------------------------------------------------------------------------------------------*/
if (IE)
{
	var Menu_Pos_IE =new Array(MAX_MENUES)
//	Menu_Pos_IE[ Pos] = new Array (Left,Top,Width,Height);	
	Menu_Pos_IE[ 1] = new Array (203,63,140,140);
	Menu_Pos_IE[ 2] = new Array (300,63,90,124);
	Menu_Pos_IE[ 3] = new Array (371,63,130,140);
	Menu_Pos_IE[ 4] = new Array (446,63,125,140);
	Menu_Pos_IE[ 5] = new Array (566,63,125,140);
	Menu_Pos_IE[ 6] = new Array (635,63,110,140);

	for (var i=1;i<=MAX_MENUES;i++)
    {
		document.writeln("<div id=m" + i + " style='position:absolute;visibility:hidden;left:" + Menu_Pos_IE[i][0] + "px;top:" + Menu_Pos_IE[i][1]  + "px;width:" + Menu_Pos_IE[i][2]  + "px; height:" + Menu_Pos_IE[i][3]  + "'px OnMouseOver='visibilidad(" + i + ",1)' OnMouseOut='visibilidad(" + i + ",0)'>")
		document.writeln("<table width='" + Menu_Pos_IE[i][2] + "'  cellpadding='0' cellspacing='0' border='0' bgcolor='"+ BG_color_on +"'>")
        document.writeln("<tr><td >")
        document.writeln("    <table  width='" + Menu_Pos_IE[i][2]  + "'  border='0'  cellspacing='1' cellpadding='0' align='center'>")
	
		for (var j=Menu_Item_Pos_Ini[i-1];j<=(Menu_Item_Pos_Ini[i]-1);j++)
	    {
	    	document.writeln("<tr>")
	     	document.writeln("	  <td id=op" + j + " bgcolor='#CDE18A' height='18' valign='middle'  style='COLOR: #000000;FONT-FAMILY: MS Sans Serif, Geneva, Helvetica;FONT-SIZE: 8pt;text-decoration:none'><a href='javascript:linker(" + j + ",1)' style='COLOR: #000000;FONT-FAMILY: Arial;FONT-SIZE: 11px;text-decoration:none' OnMouseOver='color(op" + j + ",item" + j + ",0)' OnMouseOut='color(op" + j + ",item" + j + ",1)' OnClick='linker(" + j + ",1)'><span id=item" + j + ">" + "&nbsp;" + Menu_Item[j][0] + Menu_Item[j][2] + "</span></a></td>")
	     	document.writeln("</tr>")
	     }

		document.writeln("</table>")
		document.writeln("</td>")
		document.writeln("</tr>")
		document.writeln("</table>")
        document.writeln("</div>")
    }
} // end IE
/*--CREACION DEL MENU Netscape 4.x----------------------------------------------------------------------------------------------------------------*/
else if (N4)
{
	var Menu_Pos_N4 =new Array(MAX_MENUES)
//	Menu_Pos_N4[ Pos] = new Array (Left,Top,Width,Height);	
	Menu_Pos_N4[ 1] = new Array (126,124,155,140);
	Menu_Pos_N4[ 2] = new Array (286,124,154,124);
	Menu_Pos_N4[ 3] = new Array (435,124,154,140); 
		
   	for (var i=1;i<=MAX_MENUES;i++)
    {
    	document.writeln("<layer name='m" + i + "' left='" + Menu_Pos_N4[i][0] + "' top='" + Menu_Pos_N4[ i][1] + "' width='" + Menu_Pos_N4[ i][2] + "' height='" + Menu_Pos_N4[ i][3] + "' bgcolor='"+ BG_color_on +"' visibility='hide' onMouseOver='visibilidad(" + i + ",1)' onMouseOut='visibilidad(" + i + ",0)'>")
        ind0=0; cell_spacing=1
	
		for (j=Menu_Item_Pos_Ini[i-1];j<=(Menu_Item_Pos_Ini[i]-1);j++)
		{
			ind1=j*2-1
			ind2=j*2
            document.writeln("<layer name='op'" + ind1 + " width='" + Menu_Pos_N4[i][2] + "' height='19' left='2' top='" + cell_spacing + "' bgcolor='#8098CB' OnMouseOver='colorlay(" + i + "," + ind0 + ",0)' OnMouseOut='colorlay(" + i + "," + ind0 + ",1)'>")
            document.writeln("<div valign='center'><table width=100% height='19' cellspacing=0 cellpadding=0><td class='x'>" + Menu_Item[j][0] + "</td></table></div></layer>")
            document.writeln("<layer name='op'" + ind2 + " width='" + Menu_Pos_N4[ i][2] + "' height='19' left='2' top='" + cell_spacing + "' bgcolor='"+ BG_color_on +"' visibility='hide' OnMouseOver='colorlay(" + i + "," + ind0 + ",0)' OnMouseOut='colorlay(" + i + "," + ind0 + ",1)'>")
            document.writeln("<div valign='center'><table width=100% height='19' cellspacing=0 cellpadding=0><td><a href='" + Menu_Item[j][1] + "' class='y'>" + Menu_Item[j][0] + Menu_Item[j][2] + "</a></td></table></div></layer>")
            cell_spacing=cell_spacing+20;ind0=ind0+2;
      	}        
		document.writeln("</layer>")
	}
}
/*------------------------------------------------------------------------------------------------------------------*/	   
else if (N6)
{
	var Menu_Pos_N6 =new Array(MAX_MENUES)
//	Menu_Pos_N6[ Pos] = new Array (Left,Top,Width,Height,Width_option,height_option);	
	Menu_Pos_N6[ 1] = new Array (126,124,155,140,220,128);
	Menu_Pos_N6[ 2] = new Array (281,124,154,120,221,110);
	Menu_Pos_N6[ 3] = new Array (435,124,154,140,201,110); 
	  
   	for (var i=1;i<=MAX_MENUES;i++)
    {
		document.writeln("<div id=m" + i + " style='position:absolute;visibility:hidden;left:" + Menu_Pos_N6[ i][0] + ";top:" + Menu_Pos_N6[ i][1] + ";width:" + Menu_Pos_N6[ i][2] + "; height:" + Menu_Pos_N6[ i][3] + "' OnMouseOver='visibilidad(" + i + ",1)' OnMouseOut='visibilidad(" + i + ",0)'>")
		document.writeln("<table width='" + Menu_Pos_N6[ i][2] + "'  border='0' bgcolor='"+ BG_color_on +"'>")
		document.writeln("<tr>")
		document.writeln("   <td>")
		document.writeln("   <table border='0'  width='" + Menu_Pos_N6[ i][4] + "' height='" + Menu_Pos_N6[ i][5] + "' cellspacing='1' cellpadding='0' align='center'>")
		
		for (var j=Menu_Item_Pos_Ini[i-1];j<=(Menu_Item_Pos_Ini[i]-1);j++)
	    {
	    	document.writeln("<tr>")
	    	document.writeln("    <td bgcolor='#8098CB' id=op" + j + " height='18' valign='middle'  OnMouseOver='color(" + j + "," + j + "," + "0)' OnMouseOut='color(" + j + "," + j + ",1)'><a href='" + Menu_Item[j][1] + "' style='COLOR: #FFFFFF;FONT-FAMILY: "+ FONT_Face +";FONT-SIZE: "+ FONT_Size+"pt;TEXT-DECORATION: none'><span id=item" + j + ">&nbsp;" + Menu_Item[j][0] + Menu_Item[j][2] + "</span></a></td>")
	    	document.writeln("</tr>")
	    }
		document.writeln("</table>")
		document.writeln("</td>")
		document.writeln("</tr>")
		document.writeln("</table>")
		document.writeln("</div>")
	}
}
	   
/*------------------------------------------------------------------------------------------------------------------*/
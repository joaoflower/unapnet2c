// JavaScript Document
try{
    xmlhttp = new XMLHttpRequest();
}catch(ee){
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(E){
            xmlhttp = false;
        }
    }
}

function carrega(enlace, capa){

    //Exibe o texto carregando no div conteúdo
    var conteudo=document.getElementById(capa)
//    conteudo.innerHTML='<div class="carregando">Cargando ...</div>'

    //Guarda a página escolhida na variável atual

    //Abre a url
    xmlhttp.open("GET", enlace, true);

    //Executada quando o navegador obtiver o código
    xmlhttp.onreadystatechange=function() {

        if (xmlhttp.readyState==4){

            //Lê o texto
            var texto=xmlhttp.responseText

            //Desfaz o urlencode
            texto=texto.replace(/\+/g," ")
            texto=unescape(texto)

            //Exibe o texto no div conteúdo
            var conteudo=document.getElementById(capa)
            conteudo.innerHTML=texto

        }
    }
    xmlhttp.send(null)
}
function carrega2(enlace)
{
    xmlhttp.open("GET", enlace, true);
    xmlhttp.onreadystatechange=function() 
	{
        if (xmlhttp.readyState==4)
		{
            var texto=xmlhttp.responseText
            texto=texto.replace(/\+/g," ")
            texto=unescape(texto)
        }
    }
    xmlhttp.send(null)
}

//-------	Inicio Estudiante	---------------------------------
function searchest()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "est_viewestu.php?rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	clearcapa("ddatos");
	carrega(enlace, "dresultado");
/*	var vCan_est = document.fData.rCan_est.value;	
	if(vCan_est == "1")
	{
		var vNum_mat2 = document.fData.rNum_mat2.value;
		var vCod_car2 = document.fData.rCod_car2.value;
		viewdataest(vNum_mat2, vCod_car2);
	}*/
}

function viewdataest(num_mat, cod_car)
{
	var enlace = "est_viewdata.php?rNum_mat=" + num_mat + "&rCod_car=" + cod_car;
	carrega(enlace, "ddatos");
}

function editdataest()
{
	var enlace = "est_getdata.php"
	carrega(enlace, "ddatos");
}
function savedataest()
{

	if (verify())
	{
		var vTip_doc = document.fData.rTip_doc.value;
		var vNum_doc = document.fData.rNum_doc.value;		
		var vDia	 = document.fData.rDia.value;
		var vMes 	 = document.fData.rMes.value;				
		var vAno	 = document.fData.rAno.value;		
		var vSexo	 = document.fData.rSexo.value;
		var vEst_civ = document.fData.rEst_civ.value;
		var vDirec	 = document.fData.rDirec.value;
		var vFono	 = document.fData.rFono.value;
		var vCelular = document.fData.rCelular.value;
		var vOemail	 = document.fData.rOemail.value;
		var vEmail	 = document.fData.rEmail.value;
		var vCod_nac = document.fData.rCod_nac.value;
		var vCod_dep = document.fData.rCod_dep.value;
		var vCod_prv = document.fData.rCod_prv.value;
		var vCod_dis = document.fData.rCod_dis.value;
		
		var vMod_ing = document.fData.rMod_ing.value;
		var vDiai = document.fData.rDiai.value;
		var vMesi = document.fData.rMesi.value;
		var vAnoi = document.fData.rAnoi.value;
		var vAno_ing = document.fData.rAno_ing.value;
		var vNro_ins = document.fData.rNro_ins.value;
		var vPun_ing = document.fData.rPun_ing.value;
		var vPun_sob = document.fData.rPun_sob.value;
		var vOrd_ing = document.fData.rOrd_ing.value;
		var vOrd_sob = document.fData.rOrd_sob.value;
				
		var enlace = "est_savedata.php?rTip_doc=" + vTip_doc + "&rNum_doc=" + vNum_doc + "&rDia=" + vDia + "&rMes=" + vMes + "&rAno=" + vAno + "&rSexo=" + vSexo + "&rEst_civ=" + vEst_civ + "&rDirec=" + vDirec + "&rFono=" + vFono + "&rCelular=" + vCelular + "&rOemail=" + vOemail + "&rEmail=" + vEmail + "&rCod_nac=" + vCod_nac + "&rCod_dep=" + vCod_dep + "&rCod_prv=" + vCod_prv + "&rCod_dis=" + vCod_dis + "&rMod_ing=" + vMod_ing + "&rDiai=" + vDiai + "&rMesi=" + vMesi + "&rAnoi=" + vAnoi + "&rAno_ing=" + vAno_ing + "&rNro_ins=" + vNro_ins + "&rPun_ing=" + vPun_ing + "&rPun_sob=" + vPun_sob + "&rOrd_ing=" + vOrd_ing + "&rOrd_sob=" + vOrd_sob;
/*		var enlace = "est_savedata.php?rTip_doc=" + vTip_doc + "&rNum_doc=" + vNum_doc + "&rDia=" + vDia + "&rMes=" + vMes + "&rAno=" + vAno + "&rSexo=" + vSexo + "&rEst_civ=" + vEst_civ + "&rDirec=" + vDirec + "&rFono=" + vFono + "&rCelular=" + vCelular + "&rOemail=" + vOemail + "&rEmail=" + vEmail + "&rCod_nac=" + vCod_nac + "&rCod_dep=" + vCod_dep + "&rCod_prv=" + vCod_prv + "&rCod_dis=" + vCod_dis;*/
		
		carrega(enlace, "ddatos");
//		alert(enlace);
	}	
}
function editnameest()
{
	var enlace = "est_getname.php"
	carrega(enlace, "ddatos");
}
function savenameest()
{
	if (verifyname())
	{
		var vPaternon = document.fData.rPaternon.value;
		var vMaternon = document.fData.rMaternon.value;		
		var vNombresn = document.fData.rNombresn.value;
		var vRes_cam = document.fData.rRes_cam.value;				

		var enlace = "est_savename.php?rPaterno=" + vPaternon + "&rMaterno=" + vMaternon + "&rNombres=" + vNombresn + "&rRes_cam=" + vRes_cam;
		carrega(enlace, "ddatos");
	}	
}
function newnum_mat()
{
	var enlace = "est_newnum_mat.php"
	carrega(enlace, "ddatos");
}
function savenum_mat()
{
	var vNum_mat = document.fData.rNum_matn.value;
	var vPaterno = document.fData.rPaternon.value;
	var vMaterno = document.fData.rMaternon.value;		
	var vNombres = document.fData.rNombresn.value;

	var enlace = "est_savenum_mat.php?rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	carrega(enlace, "ddatos");
}
//-------	Fin Estudiante	---------------------------------

//-------	Inicio Docente	---------------------------------
function searchdoc()
{
	var vCod_prf = document.fData.rCod_prf.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "doc_viewdoce.php?rCod_prf=" + vCod_prf + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	carrega(enlace, "dresultado");
}

function viewdatadoc(cod_prf, cod_car)
{
	var conteudo=document.getElementById('dfamilia')
    conteudo.innerHTML=''	
	
	var enlace = "doc_viewdata.php?rCod_prf=" + cod_prf + "&rCod_car=" + cod_car;
	carrega(enlace, "ddatos");
}
function editdatadoc()
{
	var conteudo=document.getElementById('dfamilia')
    conteudo.innerHTML=''
	
	var enlace = "doc_getdata.php"
	carrega(enlace, "ddatos");
}
function viewfamidoc()
{
	var View = document.fData.rView.value;
	if (View == 2)
	{
		document.fData.rView.value = 1;
		var conteudo=document.getElementById('dfamilia')
	    conteudo.innerHTML=''	
	}
	else
	{
		document.fData.rView.value = 2;
		var enlace = "doc_viewfami.php"
		carrega(enlace, "dfamilia");
	}
}
function savedatadoc()
{

	if (verify())
	{
		var vCod_car = document.fData.rCod_car.value;
		var vCnd_prf = document.fData.rCnd_prf.value;
		var vCod_cat = document.fData.rCod_cat.value;
		var vCod_gru = document.fData.rCod_gru.value;
		var vTip_doc = document.fData.rTip_doc.value;
		var vNum_doc = document.fData.rNum_doc.value;		
		var vDia	 = document.fData.rDia.value;
		var vMes 	 = document.fData.rMes.value;				
		var vAno	 = document.fData.rAno.value;		
		var vSexo	 = document.fData.rSexo.value;
		var vEst_civ = document.fData.rEst_civ.value;
		var vDirec	 = document.fData.rDirec.value;
		var vFono	 = document.fData.rFono.value;
		var vCelular = document.fData.rCelular.value;
		var vOemail	 = document.fData.rOemail.value;
		var vEmail	 = document.fData.rEmail.value;
		var vCod_nac = document.fData.rCod_nac.value;
		var vCod_dep = document.fData.rCod_dep.value;
		var vCod_prv = document.fData.rCod_prv.value;
		var vCod_dis = document.fData.rCod_dis.value;	
		
		var enlace = "doc_savedata.php?rCod_car=" + vCod_car + "&rCnd_prf=" + vCnd_prf + "&rCod_cat=" + vCod_cat + "&rCod_gru=" + vCod_gru + "&rTip_doc=" + vTip_doc + "&rNum_doc=" + vNum_doc + "&rDia=" + vDia + "&rMes=" + vMes + "&rAno=" + vAno + "&rSexo=" + vSexo + "&rEst_civ=" + vEst_civ + "&rDirec=" + vDirec + "&rFono=" + vFono + "&rCelular=" + vCelular + "&rOemail=" + vOemail + "&rEmail=" + vEmail + "&rCod_nac=" + vCod_nac + "&rCod_dep=" + vCod_dep + "&rCod_prv=" + vCod_prv + "&rCod_dis=" + vCod_dis;
		
		carrega(enlace, "ddatos");
	}	
}
//-------	Fin Docente	---------------------------------

//-------	Inicio Administrativo	---------------------------------
function searchadm()
{
	var vCodigo  = document.fData.rCodigo.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "adm_viewadmi.php?rCodigo=" + vCodigo + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	carrega(enlace, "dresultado");
}

function viewdataadm(codigo)
{
	var conteudo=document.getElementById('dfamilia')
    conteudo.innerHTML=''	
	
	var enlace = "adm_viewdata.php?rCodigo=" + codigo;
	carrega(enlace, "ddatos");
}
function editdataadm()
{
	var conteudo=document.getElementById('dfamilia')
    conteudo.innerHTML=''
	
	var enlace = "adm_getdata.php"
	carrega(enlace, "ddatos");
}
function viewfamiadm()
{
	var View = document.fData.rView.value;
	if (View == 2)
	{
		document.fData.rView.value = 1;
		clearcapa('dfamilia');
	}
	else
	{
		document.fData.rView.value = 2;
		var enlace = "adm_viewfami.php"
		carrega(enlace, "dfamilia");
	}
}
function savedataadm()
{

	if (verify())
	{
		var vCnd_adm = document.fData.rCnd_adm.value;
		var vCod_cat = document.fData.rCod_cat.value;
		var vCod_gru = document.fData.rCod_gru.value;
		var vTip_doc = document.fData.rTip_doc.value;
		var vNum_doc = document.fData.rNum_doc.value;		
		var vDia	 = document.fData.rDia.value;
		var vMes 	 = document.fData.rMes.value;				
		var vAno	 = document.fData.rAno.value;		
		var vSexo	 = document.fData.rSexo.value;
		var vEst_civ = document.fData.rEst_civ.value;
		var vDirec	 = document.fData.rDirec.value;
		var vFono	 = document.fData.rFono.value;
		var vCelular = document.fData.rCelular.value;
		var vOemail	 = document.fData.rOemail.value;
		var vEmail	 = document.fData.rEmail.value;
		var vCod_nac = document.fData.rCod_nac.value;
		var vCod_dep = document.fData.rCod_dep.value;
		var vCod_prv = document.fData.rCod_prv.value;
		var vCod_dis = document.fData.rCod_dis.value;	
		
		var enlace = "adm_savedata.php?rCnd_adm=" + vCnd_adm + "&rCod_cat=" + vCod_cat + "&rCod_gru=" + vCod_gru + "&rTip_doc=" + vTip_doc + "&rNum_doc=" + vNum_doc + "&rDia=" + vDia + "&rMes=" + vMes + "&rAno=" + vAno + "&rSexo=" + vSexo + "&rEst_civ=" + vEst_civ + "&rDirec=" + vDirec + "&rFono=" + vFono + "&rCelular=" + vCelular + "&rOemail=" + vOemail + "&rEmail=" + vEmail + "&rCod_nac=" + vCod_nac + "&rCod_dep=" + vCod_dep + "&rCod_prv=" + vCod_prv + "&rCod_dis=" + vCod_dis;
		
		carrega(enlace, "ddatos");
	}	
}
//-------	Fin Administrativo ---------------------------------

//-------	Inicio Plan	---------------------------------
function viewplan(pln_est)
{
	var enlace = "pln_viewplan.php?rPln_est=" + pln_est;
	carrega(enlace, "dresultado");
}
//-------	Fin Plan	---------------------------------

//-------	Inicio Blanco	---------------------------------
function clearcapa(capa)
{
	var conteudo=document.getElementById(capa);
    conteudo.innerHTML="";
}
//-------	Fin  Blanco	---------------------------------


//-------	Inicio Notas	---------------------------------
function searchestnot()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "not_viewestu.php?rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	clearcapa("ddatos");
	clearcapa("ddatos2");
	carrega(enlace, "dresultado");
}
function viewnotaest(num_mat)
{
	var enlace = "not_viewnota.php?rNum_mat=" + num_mat;
	clearcapanota();
	carrega(enlace, "ddatos");
}
function viewnotaestcur(num_mat)
{
	var enlace = "not_viewnotacur.php?rNum_mat=" + num_mat;
	clearcapa("ddatos2");
	carrega(enlace, "ddatos");
}
function viewnotaestplan(num_mat)
{
	var enlace = "not_viewnotaplan.php?rNum_mat=" + num_mat;
	clearcapa("ddatos2");
	carrega(enlace, "ddatos");
}
function editnotaestplan(pln_est, cod_cur, mod_not, ano_aca, per_aca, upin)
{
	var enlace = "not_getnotaplan.php?rPln_est=" + pln_est + "&rCod_cur=" + cod_cur + "&rMod_not=" + mod_not + "&rAno_aca=" + ano_aca + "&rPer_aca=" + per_aca + "&rUpin=" + upin;
	clearcapa("ddatos2");
	carrega(enlace, "ddatos");
}
function viewnotagetano(num_mat)
{
	var enlace = "not_viewnotagetano.php?rNum_mat=" + num_mat;
	clearcapa("ddatos2");
	carrega(enlace, "ddatos");
}
function viewnotaestano(ano_aca)
{
	var enlace = "not_viewnotaano.php?rAno_aca=" + ano_aca;
	clearcapa("ddatos2");
	carrega(enlace, "ddatos");
}
function editnotaest(pln_est, cod_cur, mod_not, ano_aca, per_aca)
{
	var enlace = "not_getnota.php?rPln_est=" + pln_est + "&rCod_cur=" + cod_cur + "&rMod_not=" + mod_not + "&rAno_aca=" + ano_aca + "&rPer_aca=" + per_aca ;
	clearcapa("ddatos2");
	carrega(enlace, "ddatos");
}
function savenotaest()
{
	var vNota = parseInt(document.fData.rNot_cur.value);
	var enlace = "not_savenota.php?rNot_cur=" + vNota;
	carrega(enlace, "ddatos");
}
function savenotaestplan()
{	
	var vAno_aca = document.fData.rAno_aca.value;
	var vPer_aca = document.fData.rPer_aca.value;
	var vMod_not = document.fData.rMod_not.value;
	var vNot_cur = parseInt(document.fData.rNot_cur.value);
	var vCod_act = document.fData.rCod_act.value;
	var vObs_not = document.fData.rObs_not.value;
	var vCur_con = document.fData.rCur_con.value;
	var vFch_reg = document.fData.rFch_reg.value;
	
	var enlace = "not_savenotaplan.php?rAno_aca=" + vAno_aca + "&rPer_aca=" + vPer_aca + "&rMod_not=" + vMod_not +"&rNot_cur=" + vNot_cur + "&rCod_act=" + vCod_act + "&rObs_not=" + vObs_not + "&rCur_con=" + vCur_con + "&rFch_reg=" + vFch_reg;
//	alert(enlace);
	carrega(enlace, "ddatos");
}

function clearcapanota()
{
	var conteudo=document.getElementById("ddatos2")
    conteudo.innerHTML="<iframe width='75' name ='frPdf'  height='30' id='frPdf' src='' scrolling='no' frameborder='0' > </iframe>";	
}
function delnotaest()
{
	var enlace = "not_delnota.php";
	clearcapa("ddatos2");
	carrega(enlace, "ddatos");
}
//-------	Fin Notas	---------------------------------

//------- Inicio convalidacion --------------------------
function searchestnotcon()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "con_viewestu.php?rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	clearcapa("ddatos");
	clearcapa("ddatos2");
	carrega(enlace, "dresultado");
}
function viewnotacon(num_mat)
{
	var enlace = "con_viewnota.php?rNum_mat=" + num_mat;
	clearcapanota();
	carrega(enlace, "ddatos");
}
function selectplancon()
{
	var enlace = "con_selectplan.php";
	clearcapanota();
	carrega(enlace, "ddatos");
}
function getespcon(pln_est)
{
	var enlace = "con_viewespecial.php?rPln_est=" + pln_est;
	clearcapa("ddatoscon");
	carrega(enlace, "xEspecial");
}
function getnotacon(cod_esp)
{
	var enlace = "con_getnotacon.php?rCod_esp=" + cod_esp;
	clearcapanota();
	carrega(enlace, "ddatoscon");
}
function regnotacon(cod_cur, objeto)
{	
	var enlace = "con_regnotacon.php?rCod_cur=" + cod_cur;
	if(objeto.value.length > 0)
	{
		enlace = enlace + "&rNot_cur=" + objeto.value;
	}
	else
	{
		enlace = enlace + "&rNot_cur=sn";
	}
	carrega2(enlace);
}
function regnotaobs(objeto)
{	
	var enlace = "con_regnotaobs.php?rObs_not=" + objeto.value;
	carrega2(enlace);
}
function savenotacon()
{
	var enlace = "con_savenotacon.php";
	carrega(enlace, "ddatos");
}
//--------  Fin convalidacion ---------------------------

//------- Inicio Actualizacion de notas --------------------------
function searchestnotact()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "act_viewestu.php?rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	clearcapa("ddatos");
	clearcapa("ddatos2");
	carrega(enlace, "dresultado");
}
function viewnotaact(num_mat)
{
	var enlace = "act_viewnota.php?rNum_mat=" + num_mat;
	clearcapanota();
	carrega(enlace, "ddatos");
}
function not_viewactaesc(pcod_act, pano_aca)
{
	var vAtributo;
	vAtributo = "center=yes; dialogHeight=550px; dialogWidth=800px; dialogLeft=px; dialogTop=px; ";
	vAtributo += "help=no; status=no; scroll=yes; resizable=no; font-family=Arial; font-size=11px";
	
	vReturn = window.showModalDialog("not_viewactaesc.php?rCod_act=" + pcod_act + "&rAno_aca=" + pano_aca, "mensaje", vAtributo);
}
//--------  Fin Actualizacion de notas ---------------------------

//------- Inicio Ingr. nota --------------------------
function searchingcurso()
{
	var vPln_est = document.fData.rPln_est.value;
	var vCod_cur = document.fData.rCod_cur.value;
	var vNom_cur = document.fData.rNom_cur.value;
	var vNiv_est = document.fData.rNiv_est.value;
	var vSem_anu = document.fData.rSem_anu.value;
		
	var enlace = "ing_viewcurso.php?rPln_est=" + vPln_est + "&rCod_cur=" + vCod_cur + "&rNom_cur=" + vNom_cur + "&rNiv_est=" + vNiv_est + "&rSem_anu=" + vSem_anu;
	clearcapa("ddatos");
	clearcapa("ddatos2");
	carrega(enlace, "dresultado");
}
function searchingacta()
{
	var vCod_act = document.fData.rCod_act.value;
		
	var enlace = "ing_viewcursoacta.php?rCod_act=" + vCod_act;
	clearcapa("ddatos");
	clearcapa("ddatos2");
	carrega(enlace, "dresultado");
}
function viewingcurso(pln_est, cod_cur, sec_gru, mod_act)
{
	var enlace = "ing_viewcursodata.php?rPln_est=" + pln_est + "&rCod_cur=" + cod_cur + "&rSec_gru=" + sec_gru + "&rMod_act=" + mod_act;
	carrega(enlace, "ddatos");
}
function getnotaing()
{
	var enlace = "ing_getnota.php";
	carrega(enlace, "ddatos");
}
function regnotaing(num_mat, objeto)
{	
	var enlace = "ing_regnotaing.php?rNum_mat=" + num_mat;
	if(objeto.value.length > 0)
	{
		enlace = enlace + "&rNot_cur=" + objeto.value;
	}
	else
	{
		enlace = enlace + "&rNot_cur=sn";
	}
	carrega2(enlace);
}
function savenotaing()
{
	var enlace = "ing_savenotaing.php";
	carrega(enlace, "ddatos");
}
//--------  Fin Ingr. Nota ---------------------------


//------- Inicio horario --------------------------
function viewhorario(psge)
{
	var enlace = "hor_viewhorapsge.php?rPSGE=" + psge;
	carrega(enlace, "dresultado");
}

//--------  Fin horario ---------------------------

//------- Inicio carga --------------------------
function viewcarga(psge)
{
	var enlace = "cga_viewcarga.php?rPSGE=" + psge;
	carrega(enlace, "dresultado");
}
function searchcargadoc()
{
	var vCod_prf = document.fData.rCod_prf.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "cga_viewdoce.php?rCod_prf=" + vCod_prf + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	clearcapa("ddatos");
	carrega(enlace, "dresultado");
}
function getcargacurso(cod_prf, pln_est, sec_gru, mod_mat)
{
	var enlace = "cga_getcurso.php?rCod_prf=" + cod_prf + "&rPln_est=" + pln_est + "&rSec_gru=" + sec_gru + "&rMod_mat=" + mod_mat;
	carrega(enlace, "ddatos");
}

//-----------------------------
function viewcargai(psge)
{
	var enlace = "cgai_viewcarga.php?rPSGE=" + psge;
	carrega(enlace, "dresultado");
}
function searchcargaidoc()
{
	var vCod_prf = document.fData.rCod_prf.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "cgai_viewdoce.php?rCod_prf=" + vCod_prf + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	clearcapa("ddatos");
	carrega(enlace, "dresultado");
}
function getcargaicurso(cod_prf, pln_est, sec_gru, mod_mat)
{
	var enlace = "cgai_getcurso.php?rCod_prf=" + cod_prf + "&rPln_est=" + pln_est + "&rSec_gru=" + sec_gru + "&rMod_mat=" + mod_mat;
	carrega(enlace, "ddatos");
}

//--------  Fin carga ---------------------------

//------- Inicio Reevaluacion --------------------------
function viewreeval(psge)
{
	var enlace = "rva_viewreeval.php?rPSGE=" + psge;
	carrega(enlace, "dresultado");
}
function viewreevalnota()
{
	var enlace = "rva_viewnota.php";
	carrega(enlace, "ddatos");
}
function getreevalestu()
{
	var enlace = "rva_getestu.php";
	carrega(enlace, "ddatos");
}
function getreevalestu()
{
	var enlace = "rva_getestu.php";
	carrega(enlace, "ddatos");
}
function getnotareeval()
{
	var enlace = "rva_getnota.php";
	carrega(enlace, "ddatos");
}
function savenotareeval()
{
	var enlace = "rva_savenota.php";
	carrega(enlace, "ddatos");
}
function searchreevalcurso()
{
	var vPln_est = document.fData.rPln_est.value;
	var vCod_cur = document.fData.rCod_cur.value;
	var vNom_cur = document.fData.rNom_cur.value;
	var vNiv_est = document.fData.rNiv_est.value;
	var vSem_anu = document.fData.rSem_anu.value;
		
	var enlace = "rva_viewcurso.php?rPln_est=" + vPln_est + "&rCod_cur=" + vCod_cur + "&rNom_cur=" + vNom_cur + "&rNiv_est=" + vNiv_est + "&rSem_anu=" + vSem_anu;
	clearcapa("ddatos");
	clearcapa("ddatos2");
	carrega(enlace, "dresultado");
}
function viewreevalcurso(pln_est, cod_cur, sec_gru)
{
	var enlace = "rva_getcursoestu.php?rPln_est=" + pln_est + "&rCod_cur=" + cod_cur + "&rSec_gru=" + sec_gru;
	carrega(enlace, "ddatos");
}
//--------  Fin reevaluacion ---------------------------

//-------	Inicio Matricula regular	---------------------------------
function searchmregest()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "reg_viewestu.php?rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	clearcapa("ddatos");
	carrega(enlace, "dresultado");
}

function evaluamreg(num_mat, cod_car)
{
	var enlace = "reg_evalua.php?rNum_mat=" + num_mat + "&rCod_car=" + cod_car;
	carrega(enlace, "ddatos");
}
//--------  Fin Matricula regular ---------------------------

//-------	Inicio edicion de Matricula ---------------------------------
function searchedtmest()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "edt_viewestu.php?rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	clearcapa("ddatos");
	carrega(enlace, "dresultado");
}
function saveobsedtest(obs_est)
{
	var enlace = "edt_saveobs.php?rObs_est=" + obs_est;
	carrega2(enlace);
}

//--------  Fin edicion de Matricula  ---------------------------


//-------	Inicio Matricula ingresantes	---------------------------------
function searchmingest()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "ing_viewestu.php?rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	clearcapa("ddatos");
	carrega(enlace, "dresultado");
}
function viewpictureing(num_mat, cod_car)
{
	var enlace = "ing_viewpicture.php?rNum_mat=" + num_mat + "&rCod_car=" + cod_car;
	carrega(enlace, "ddatos");
}
//----------------------------------------------------

//------- Inicio Rep. Curso --------------------------
function searchrepcurso()
{
	var vPln_est = document.fData.rPln_est.value;
	var vCod_cur = document.fData.rCod_cur.value;
	var vNom_cur = document.fData.rNom_cur.value;
	var vNiv_est = document.fData.rNiv_est.value;
	var vSem_anu = document.fData.rSem_anu.value;
		
	var enlace = "cur_viewcurso.php?rPln_est=" + vPln_est + "&rCod_cur=" + vCod_cur + "&rNom_cur=" + vNom_cur + "&rNiv_est=" + vNiv_est + "&rSem_anu=" + vSem_anu;
	clearcapa("ddatos");
	clearcapa("ddatos2");
	carrega(enlace, "dresultado");
}
function viewrepcurso(pln_est, cod_cur, sec_gru, mod_act)
{
	var enlace = "cur_viewcursodata.php?rPln_est=" + pln_est + "&rCod_cur=" + cod_cur + "&rSec_gru=" + sec_gru + "&rMod_act=" + mod_act;
	carrega(enlace, "ddatos");
}
//----------------------------------------------------

//-------	Inicio Resumen de Notas	---------------------------------
function searchestren()
{
	var vNum_mat = document.fData.rNum_mat.value;
	var vPaterno = document.fData.rPaterno.value;
	var vMaterno = document.fData.rMaterno.value;
	var vNombres = document.fData.rNombres.value;
	
	var enlace = "ren_viewestu.php?rNum_mat=" + vNum_mat + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	clearcapa("ddatos");
	clearcapa("ddatos2");
	carrega(enlace, "dresultado");
}
function viewresnotaest(num_mat)
{
	var enlace = "ren_viewresnota.php?rNum_mat=" + num_mat;
	clearcapanota();
	carrega(enlace, "ddatos");
}

//----------------------------------------------------
function viewingresano(ano_aca)
{
	var enlace = "ing_viewestui.php?rAno_aca=" + ano_aca;
	carrega(enlace, "dresultado");
}

//----------------------------------------------------
//
//----------------------------------------------------
function hac_getgrupo(pln_est)
{
	var enlace = "hac_viewgrupo.php?rPln_est=" + pln_est;
	clearcapa("ddatos");
	carrega(enlace, "xGrupo");
}
function hac_getsem(sec_gru)
{
	var enlace = "hac_viewsem.php?rSec_gru=" + sec_gru;
	clearcapa("ddatos");
	carrega(enlace, "xSemestre");
}
function hac_getcurso(sem_anu)
{
	var enlace = "hac_getcurso.php?rSem_anu=" + sem_anu;
	carrega(enlace, "ddatos");
}
function hac_regcanvac(cod_cur, objeto)
{	
	var enlace = "hac_regcanvac.php?rCod_cur=" + cod_cur;
	if(objeto.value.length > 0)
	{
		enlace = enlace + "&rCan_vac=" + objeto.value;
	}
	else
	{
		enlace = enlace + "&rCan_vac=sn";
	}
	carrega2(enlace);
}
function hac_savecurso()
{
	var enlace = "hac_savecurso.php";
	carrega(enlace, "ddatos");
}
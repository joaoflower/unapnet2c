
	function pintar(objeto)
	{ 
		if(objeto.checked)
		{
			sombrear(objeto);
		}
		else
		{
			desombrear(objeto);
		}
	}

	function sombrear(E)
	{
		while (E.tagName!="TR")
		{
			E=E.parentElement;
		}
		E.className="celselect";
		if(E.id == "p")
		{
			E.id = "ps"
		}
		if(E.id == "i")
		{
			E.id = "is"
		}				
	}
	
	function desombrear(E)
	{
		while (E.tagName!="TR")
		{
			E=E.parentElement;
		}
		if(E.id == "ps")
		{
			E.className="celpar";
			E.id = "p";
		}
		if(E.id == "is")
		{
			E.className="celinpar";
			E.id = "i";
		}		
	}
	
	function mouseover(E)
	{
		E.className="celover";
	}
	function mouseout(E)
	{
		if(E.id == "p")
		{
			E.className="celpar";
		}
		if(E.id == "i")
		{
			E.className="celinpar";
		}				
		if(E.id == "ps" || E.id == "is")
		{
			E.className="celselect";
		}				

	}
	
	function checknota(E, oTabnext)
	{
		if(E.value.length > 0)
		{
			if(!isNaN(parseInt(E.value)))
			{
				E.value = parseInt(E.value)
				if(parseInt(E.value) > 10)
				{
					if(parseInt(E.value) > 20)
					{	
						E.value = E.value.substring(0,1);
						E.className = "textnotade";
					}
					else
					{
						E.className = "textnotaap";
					}
				}
				else
				{
					E.className = "textnotade";
				}
			}
			else
			{
				E.value = "";
			}
		}
		if(window.event.keyCode==13)
		{
			if(oTabnext != "end")
			{
				eval('document.fData.rNot_cur' + oTabnext + '.focus()');
			}
		}
	}
	
	function fupper(objeto)
	{		
		objeto.value = objeto.value.toUpperCase();
	}

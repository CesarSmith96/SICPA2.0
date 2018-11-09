window.addEventListener("load",function(){
	var btnImprimir = document.getElementById("btnImprimir");
	btnImprimir.addEventListener("click",function(){
		var divNuevaTabla = document.getElementById("divNuevaTabla");
		divNuevaTabla.innerHTML = "";
		var tabla = document.getElementById("tablaImprimir");
		var nuevaTabla = document.createElement("table");
		nuevaTabla.border = "1";
		nuevaTabla.id = "nuevaTabla";
		for (var i = 0; i < tabla.rows.length; i++) {

			var filanueva = document.createElement("tr");
			var filaantigua = tabla.rows[i];

			for (var j = 0; j < filaantigua.cells.length-1; j++) {
				var columna = document.createElement("td");
				var valor = tabla.rows[i].cells[j].innerHTML;
				columna.append(valor);
				filanueva.append(columna);
			}

			nuevaTabla.append(filanueva);	
		}

		divNuevaTabla.append(nuevaTabla);

		var prtContent = document.getElementById("divNuevaTabla");
		var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	});
})
var dadosHTML = "";
	
$(function(){
	$.get("ajax/status/"+$("#hiddenNome").val(),function(dados){

// glyphicon glyphicon-minus
		// • ' ' = unmodified
		// • M = modified
		// • A = added
		// • D = deleted
		// • R = renamed
		// • C = copied
		// • U = updated but unmerged
		$.each(dados,function(i,v){

			dadosHTML += "<p class=\"list-group-item\">" + getIcone( v.status )  + v.arq + "</p>";
		});
		$("#loadRepo").html( dadosHTML );
	},'json')
});

function getIcone( texto, pos )
{
	pos = pos || 0;
	console.log( texto, texto.charAt(pos) )
	var icone = "";
	switch(texto.charAt(pos) )
	{
		case 'M':
			icone = "glyphicon-pencil";
			break;
		case '?':
			icone = "glyphicon-pencil";
			break;
		case 'D':
		case ' D':
		case 'D ':
			icone = "glyphicon-pencil";
			break;
	}
	return "<i class='glyphicon " + icone + "'></i>";
}
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

			var icone2 = "";
				if( v.status.charAt(0) != v.status.charAt(1))
					icone2 = v.status;

			dadosHTML += "<p class=\"list-group-item\" data-statuc='" + v.status + "'>" + getIcone( v.status ) + getIcone( icone2, 1 )  + v.arq + "</p>";
		});
		$("#loadRepo").html( dadosHTML );
	},'json')
});

function getIcone( texto, pos )
{
	pos = pos || 0;
	
	var icone = "";
	switch(texto.charAt(pos) )
	{
		case 'M':
			icone = "glyphicon-pencil";
			break;
		case '?':
			icone = "glyphicon-eye-close";
			break;
		case 'D':
			icone = "glyphicon-trash";
			break;
		case 'A':
			icone = "glyphicon glyphicon-ok";
			break;
		case 'R':
			icone = "glyphicon glyphicon-erase";
			break;
		case 'C':
			icone = "glyphicon-trash";
			break;
		case 'U':
			icone = "glyphicon-trash";
			break;
	}
	return "<i class='glyphicon " + icone + "'></i>";
}

;(function(window,$){
	var App = function(){
		var app = this;
		$(function(){
			app._init();
		})
	};

	var app = App.prototype;
		app._init = function(){

			$(window).resize(function(){
				$("#loadRepo").height( $(this).height() - $("#navSuperior").outerHeight() - 20 );
			})
			.trigger('resize');
		}
	window.App = new App();
})(window, jQuery);
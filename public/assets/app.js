var dadosHTML = "";
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
		app.ang = angular.module('App', []);
		app.ang.controller('loadRepoControll', function($scope, $http) {
				

				$scope.atualizarStatus = function( $scope )
				{
					 $http({
						method : "GET",
						url : "ajax/status/"+$("#hiddenNome").val()
					})
					.then(function mySucces(response) {
					
						$scope.status = response.data;
					}, 
					
					function myError(response) {
					    $scope.status = response.statusText;
					});
				}

				$scope.tipoFiltro = '';

				$scope.tipo = function( item ){
					console.log( item.status )
					if( $scope.tipoFiltro != "" )
					{
						if( item.status.charAt(0) == $scope.tipoFiltro )
							return item;
					}
					else
						return item;
				}

				$scope.changeFiltro = function( $scope )
				{
					$scope.tipoFiltro= this;
				}


				$scope.atualizarStatus($scope,$http);
		});

		app._init = function(){


			$(window).resize(function(){
				$("#loadRepo").height( $(this).height() - $("#navSuperior").outerHeight() - 20 );
			})
			.trigger('resize');

			// this.status();
			var app = this;
			// $("body").on('click','#btnStatus',function(){
			// 	app.status()
			// });
			// app.preloader.on();
		}

		app.preloader = new $.materialPreloader({
				        position: 'top',
				        height: '5px',
				        col_1: '#159756',
				        col_2: '#da4733',
				        col_3: '#3b78e7',
				        col_4: '#fdba2c',
				        fadeIn: 200,
				        fadeOut: 200,
				       
				    });

		app.status = function(){
			// glyphicon glyphicon-minus
			// • ' ' = unmodified
			// • M = modified
			// • A = added
			// • D = deleted
			// • R = renamed
			// • C = copied
			// • U = updated but unmerged
			var app = this;
			app.preloader.on();
			dadosHTML = "";
			$("#loadRepo").html( "" );
			$.get("ajax/status/"+$("#hiddenNome").val(),function(dados){
				$.each(dados,function(i,v){
					var icone2 = "";
						if( v.status.charAt(0) != v.status.charAt(1))
							icone2 = v.status;
					dadosHTML += "<p class=\"list-group-item\" data-statuc='" + v.status + "'>" + getIcone( v.status ) + getIcone( icone2, 1 )  + v.arq + "</p>";
				});
				$("#loadRepo").html( dadosHTML );
				app.preloader.off();
			},'json');
		}
	window.App = new App();
})(window, jQuery);
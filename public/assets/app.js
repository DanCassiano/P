var dadosHTML = "";
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

				$scope.atualizarStatus = function( )
				{
					app.preloader.on();
					 $http({
						method : "GET",
						url : "ajax/status/"+$("#hiddenNome").val()
					})
					.then(function mySucces(response) {
						$scope.status = response.data;
						app.preloader.off();
					},
					function myError(response) {
						$scope.status = response.statusText;
						app.preloader.off();
					});
				}
				$scope.tipoFiltro = '';
				$scope.tipo = function( item ){
					
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

				$scope.icone = function( texto ){
					if( texto.charAt(0) == "" )
						texto = texto.charAt(1);

					if( texto.match(/\?/g) )
						if( texto.match(/\?/g).length > 1)
							texto = texto.charAt(0);

					
					var icone = "M";
					switch( texto.trim() )
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
					return "glyphicon " + icone ;
				}

				$scope.todos = true;
				$scope.tipoViewGit = function(input ){
					var result =[];
					angular.forEach( input,function(valor,key){
						
						if( $scope.todos == true )
							return input;
						else
							if( valor == 'M')
								this.push(input);
					}, result);

					console.log( $scope.todos )
					return result;
				}

			$scope.atualizarStatus($scope,$http);
		});

		app._init = function(){

			$(window)
				.resize(function(){
					$("#loadRepo").height( $(this).height() - $("#navSuperior").outerHeight() - 20 );
				})
				.trigger('resize');
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
	window.App = new App();
})(window, jQuery);
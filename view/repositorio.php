<style type="text/css">
	#loadRepo
	{
		overflow-y: auto;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			
		</div>
	</div>
	<div class="row">
		<input type="hidden" id="hiddenNome" value="<?=$nome ?>">
		<div class="col-md-8">
			<?php 
				if( empty($view)){

					if( !empty( $path ))
						if( is_dir( $dir_repo . "/". $path ))
						{
							$dir_repo = $dir_repo . "/". $path;
							echo '<a href="repositorio/' . $nome . '" class="list-group-item" >..</a>';
						}
					require "list.php";
				}
				else
				{
					require "view.php";
				}
			?>
	</div>
</div>

<div class="off-canvas right" ng-class="canvasShow == false ? 'off' : 'on' ">
	<div class="titulo">
		Comitando
	</div>
	<div class="body">
		<div class="form-group">
			<label for="inputCommit">Titulo</label>
			<input type="text" class="form-control" id="inputCommit" ng-model="commit.titulo" >
		</div>
		<div class="form-group">
			<label for="txtDescricao">Descrição</label>
			<textarea class="form-control" rows="15" cols="10" id="txtDescricao"  ng-model="commit.descicao"></textarea>
		</div>
		<div class="form-group text-right">
			<button class="btn btn-link" ng-click="showCanvas()">Cancelar</button>
			<button class="btn btn-success" ng-click="registrarCommit()" ng-disabled="!commit">Comitar</button>
		</div>
	{{commit}}
	</div>
</div>
<script type="text/javascript" src="<?= $baseURL?>/assets/app.js" ></script>
</div>
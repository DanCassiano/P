<style type="text/css">
	#loadRepo
	{
		overflow-y: auto;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<input type="hidden" id="hiddenNome" value="<?=$nome ?>">
		<div class="col-md-5">
			<?php 
				if( !empty( $path ))
					if( is_dir( $dir_repo . "/". $path ))
					{
						$dir_repo = $dir_repo . "/". $path;
						echo '<a href="repositorio/' . $nome . '" class="list-group-item" >..</a>';
					}

				$files = glob( $dir_repo . '/*' );
				$exclude_files = array('.', '..', 'index.php', 'index.html');
				if (!in_array($files, $exclude_files)) {
					array_multisort(
						array_map( 'filetype', $files ),
						SORT_ASC,
						$files
					);
				}
				
				$i = -1;
				foreach ($files as $file) {
					if (!in_array($file, $exclude_files)) {

						$icone = "glyphicon-folder-close";

						if( !is_dir( $file ))
							$icone = 'glyphicon-file';

						$p = pathinfo( $file );
						echo '<a href="repositorio/' . $nome .'?path='. ( $path !== null ? $path ."/" : "" ). $p['filename'].'" rel='.$i.'  class="list-group-item" > <i class="glyphicon ' . $icone . '"></i> '.utf8_encode($p['filename']);
						if (file_exists($file)) {
							echo '<span class="badge">'. date ("d/m/Y", filemtime($file)) .'</span>';
						}
						echo '</a>';
					}
				$i++;
				}
			?>
		</div>
		<div class="col-md-7"  ng-controller="loadRepoControll" >
			<div id="loadRepo" >
				<p class="list-group-item">
					<input type="checkbox" ng-model="all" > Marcar todos
					<span class="pull-right">
						<input type="checkbox" ng-model="todos" value="" checked="checked" > Todos
						<input type="checkbox" ng-model="novos" value="N" > N
						<input type="checkbox" ng-model="deletados" value="D"> D
					</span>
				</p>
				<p ng-repeat="st in status | filter:tipoViewGit" class="list-group-item" data-status="{{st.status}}"><input type="checkbox" value="{{st.arq}}" ng-checked="all" >  <i class='{{icone(st.status)}}'></i>  {{st.arq}}</p>
				
			</div>
		</div>
	</div>
</div>

<div class="off-canvas off right">
	<div class="titulo">
		Comitando
	</div>
	<div class="body">
		<div class="form-group">
			<label for="inputCommit">Titulo</label>
			<input type="text" class="form-control" id="inputCommit">
		</div>
		<div class="form-group">
			<label for="txtDescricao">Descrição</label>
			<textarea class="form-control" rols="10" cols="10" id="txtDescricao"></textarea>
		</div>
		<div class="form-group text-right">
			<button class="btn btn-success">Comitar</button>
		</div>

	</div>
</div>
<script type="text/javascript" src="<?= $baseURL?>/assets/app.js" ></script>
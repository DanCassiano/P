<?php
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
			$nomeArquivo = $p['filename'] . ( empty($p['extension']) ? "" : "." . $p['extension'] );

			$arg = "path=";

			if( !empty($p['extension']) )
				$arg = "view=";

			echo '<a href="repositorio/' . $nome .'?'. $arg . ( $path !== null ? $path ."/" : "" ). $nomeArquivo.'" rel='.$i.'  class="list-group-item" > <i class="glyphicon ' . $icone . '"></i> '.$nomeArquivo;
			if (file_exists($file)) {
				echo '<span class="badge">'. date ("d/m/Y", filemtime($file)) .'</span>';
			}
			echo '<span class="text-muted pull-right">' .$repo->run("log --pretty=tformat:%s  -n1 -- {$nomeArquivo}") . "&nbsp;&nbsp;&nbsp;</span>";
			echo '</a>';
		}
	$i++;
	}
	?>
		</div>
		<div class="col-md-4"   >
			<div id="loadRepo" ng-show="status.length" >

				<p class="list-group-item">
					<input type="checkbox" ng-click="checkedTodos()" ng-model="todos" > Marcar todos
					<span class="pull-right">
						<input type="checkbox" ng-model="todos" value="" checked="checked" > Todos
						<input type="checkbox" ng-model="novos" value="N" > N
						<input type="checkbox" ng-model="deletados" value="D"> D
					</span>
				</p>
				<p ng-repeat="st in status | filter:tipoViewGit" class="list-group-item" data-status="{{st.status}}">
					<input type="checkbox" value="{{st.arq}}" ng-model="st.checked" ng-click="habilitaCommit()" >
					<i class='{{icone(st.status)}}'></i>
					{{st.arq}}
				</p>
			</div>
		</div>
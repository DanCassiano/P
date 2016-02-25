<style type="text/css">
	#loadRepo
	{
		max-height: 420px;
		overflow: auto;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<input type="hidden" id="hiddenNome" value="<?=$nome?>">
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
		<div class="col-md-7" >
			<div class="panel-heading text-right">
				
			</div>
			<div id="loadRepo">
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= $baseURL?>/assets/app.js" ></script>
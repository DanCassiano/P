
<div class="container-fluid">
		
		<div class="col-xs-4">
			<div class="w3-card">
				<ul class="w3-ul w3-hoverable">
					<li>
						<a href="/" > <i class="glyphicon glyphicon-inbox"></i> Repositórios</a>
					</li>
					<li>
						<a href="config" > <i class="glyphicon glyphicon-cog"></i> Configurações</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-xs-8">
			<div class="list-group">
				<?php
				$files = glob( $dir_repo . '*' );
				
				$exclude_files = array('.', '..', 'index.php', 'index.html');
				if (!in_array($files, $exclude_files)) {
					array_multisort(
						array_map( 'filemtime', $files ),
						SORT_NUMERIC,
						SORT_DESC,
						$files
						);
				}
				$i = -1;
				foreach ($files as $file) {
					if (!in_array($file, $exclude_files)) {

						if( file_exists( $file . "/.git" )  )
						{
							$path = pathinfo( $file );

							echo '<a href="repositorio/'.$path['filename'].'" rel='.$i.'  class="list-group-item" > <i class="glyphicon glyphicon-folder-close"></i> '.utf8_encode($path['filename']);
							if (file_exists($file)) {
								echo '<span class="badge">'. date ("d/m/Y", filemtime($file)) .'</span>';
							}
							echo '</a>';
						}
					}
					$i++;
				}
				?>
			</div>
		</div>
	
</div>
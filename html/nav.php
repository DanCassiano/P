<?php 
	if(empty($nome))
		$nome = "Gip";

?>

<nav class="navbar ">
	<div class="container-fluid">
		<a class="navbar-brand" href="#"><?= $nome ?></a>

	<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<?php 
		if( !empty($repo))
		{
			$branches = $repo->list_branches();
			?>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $branches[0] ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php 	foreach ($branches as $branch) ?>
							<li><a href="#"><?php echo $branch ?></a></li>
					</ul>
				</li>
			</ul>
		<?php
		}
		?>
		</div><!-- /.navbar-collapse -->	
		<?php if( $nome != "Gip")?>
			<button class="btn btn-success navbar-btn btn-small navbar-right">Status</button>
	</div>
</nav>

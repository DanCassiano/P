<?php 
	if(empty($nome))
		$nome = "";
?>
<div ng-controller="loadRepoControll">
<nav class="navbar " id="navSuperior">
	<div class="container-fluid">
		<?php if( !empty($nome)) { ?>
			<a class="navbar-brand" href="">Home</a>
			<span class="navbar-brand" ><?= $nome ?></span>
		<?php }else{  ?>
		<a class="navbar-brand" href="index.php">Pit</a>
		<?php } ?>

	<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
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
		<div class="nav navbar-nav navbar-right">
			<?php if( !empty($nome)) {?>
				<div class="col-xs-5">
					<button class="btn btn-danger navbar-btn btn-xs navbar-right" ng-show="showButton"  ng-click="showCanvas()">Commitar</button>
				</div>
				<div class="col-xs-5">
					<button class="btn btn-success navbar-btn btn-xs navbar-right" id="btnStatus" ng-click="atualizarStatus()">Status</button>
				</div>
			<?php } ?>
		</div>
	</div>

</nav>

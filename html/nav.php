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
		<a class="navbar-brand" href="index.php">Gumball</a>
		<?php } ?>
		
		<?php if( !empty($usuario)){ ?>
		<div class="collapse navbar-collapse navbar-right" id="colapseUser">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<img src="assets/imagens/user.png" class="img-circle" width="24" height="24"> 
					<?=$usuario ?>
					<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
							<!-- <li class="dropdown-header">Usuário</li> -->
							<!-- <li role="separator" class="divider"></li> -->
							<li>
								<a href="logout">Sair</a>
							</li>
					</ul>
				</li>
			</ul>
		</div>
		<?php } ?>
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
		<div class="nav navbar-nav navbar-right" style="min-width:170px;">
			<?php if( !empty($nome) && empty($hash)) {?>
				<div class="col-xs-5">
					<button class="btn btn-danger navbar-btn btn-xs navbar-right" ng-show="showButton"  ng-click="showCanvas()">Commitar</button>
				</div>
				<div class="col-xs-5">
					<button class="btn btn-success navbar-btn btn-xs navbar-right" id="btnStatus" ng-click="atualizarStatus()">Status</button>
				</div>
			<?php } ?>
		</div>
		<?php if( !empty($nome) && empty($hash)) {?>
			<p class="navbar-text navbar-right text-right text-muted">
				Último commit 
				<?php echo $repo->run('log --pretty=tformat:"%s  <a href=\"repositorio/'.$nome .'/hash/%h\"> %h</a> %cr " -n1'); ?>
			</p>
		<?php } ?>
	</div>

</nav>

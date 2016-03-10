<div class="container-fluid">
	<div class="col-xs-4">
		<div class="w3-card">
			<ul class="w3-ul w3-hoverable ">
				<li>
					<a href="/" > <i class="glyphicon glyphicon-inbox"></i> Repositórios</a>
				</li>
				<li class="w3-blue">
					<a href="config" > <i class="glyphicon glyphicon-cog"></i> Configurações</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-xs-8">
		<h1>Configurações</h1>
		<form method="POST" action="config">
			<div class="form-group">
				<label for="nome">Localização dos repositórios</label>
				<input type="text" value="<?=$ini->repodir ?>" id="repoLocal"   name="repodir" placeholder="" class="form-control" required>
				<span class="help-block">Localizacao dos repositórios ex: /var/www.</span>
			</div>
			<div class="form-group">
				<label for="host">Host</label>
				<input type="text" id="host" name="host" value="<?=$ini->banco['host'] ?>" placeholder="" class="form-control" required>
				<span id="email" class="help-block"></span>
			</div>
			<div class="form-group">
				<label for="user">Usuário</label>
				<input type="text" value="<?=$ini->banco['user'] ?>" id="user" name="user" class="form-control" required>
				<span id="senha" class="help-block">Usuário do banco de dados.</span>
			</div>
			<div class="form-group">
				<label for="senha">Senha</label>
				<input type="password" value="<?=$ini->banco['senha'] ?>" id="senha" name="senha" class="form-control" required>
				<span id="senha" class="help-block">Senha do banco de dados.</span>
			</div>
			<div class="form-group text-right">
				<button class="btn btn-success">Salvar</button>
			</div>
		</form>
	</div>
</div>
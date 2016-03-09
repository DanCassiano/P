<div class="col-xs-3"></div>
<div class="col-xs-6">
	<h1>Cadastro</h1>
	<form method="POST" action="cadastro/novo">
		<div class="form-group">
			<label for="nome">Nome de usuário</label>
			<input type="text" value="" id="nome"   name="nome" placeholder="ex:joaquim" class="form-control" required>
			<span id="nome" class="help-block">Escolha um nome de usuário.</span>
		</div>
		<div class="form-group">
			<label for="email">E-mail</label>
			<input type="text" id="email" name="email" value="" placeholder="ex:joaquim@exemplo.com.br" class="form-control" required>
			<span id="email" class="help-block">Entre com seu e-mail.</span>
		</div>
		<div class="form-group">
			<label for="senha">Senha</label>
			<input type="password" value="" id="senha" name="senha" class="form-control" required>
			<span id="senha" class="help-block">Escolha uma boa senha, evite senhas óbvias ;).</span>
		</div>
		<div class="form-group text-right">
			<button class="btn btn-success">Criar conta</button>
		</div>
	</form>
</div>
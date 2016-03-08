<?php 
	$r =$db->fetchAll('SELECT * FROM usuario');
	var_dump( $r);
 ?>
<form method="POST" action="login" id="braintree-payment-form">
	<div class="panel panel-default panel-login">
		<div class="panel-body">
			<div class="form-group">
				<label>Usuário</label>
				<input type="text" name="usuario" required class="form-control" >
			</div>
			<div class="form-group">
				<label>Senha</label>
				<input type="password" name="senha" required class="form-control" >
			</div>
		</div>
		<div class="panel-footer text-right">
			<button class="btn btn-success">Login</button>
		</div>
	</div>
</form>
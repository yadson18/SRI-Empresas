<div class="container-fluid" id="login-content">
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12" id="message">
			<?= Flash::showMessage() ?>
		</div>
		<form method="POST" action="/Users/login" class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12" id="form-login">
			<div class="col-md-12 col-sm-12 col-xs-12" id="logo">
				<img src="../../../webroot/img/logo.png" class="col-md-12 col-sm-12 col-xs-12">
			</div>
			<div class="form-group">
				<label>Número de cadastro</label>
				<input type="number" min="1" max="9999" name="cod_cadastro" class="form-control" placeholder="Ex: 1234" required>
			</div>
			<div class="form-group">
				<label>Cnpj</label>
			    <input type="text" name="cnpj" class="form-control" placeholder="Ex: 00.000.000/0000-00" required>
			</div>
			<div class="form-group">
			    <button type="submit" class="btn btn-default form-control btn-success input-lg">
			    	Entrar <i class="fa fa-sign-in" aria-hidden="true"></i>
				</button>
			</div>
		</form>
	</div>
</div>
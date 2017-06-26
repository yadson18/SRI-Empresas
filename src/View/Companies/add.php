<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1" id="div-container-comp-add">
		<h1 class="text-center" id="title">Cadastro de Empresa</h1>
		<form action="/Companies/add" method="POST" id="form-cadastro-empresa" class="col-md-6 col-md-offset-3">
			<?= Flash::showMessage() ?>
			<div class="form-group">
				<label>
					Razão <span id="required">*</span>
				</label>
				<input type="text" name="razao" class="form-control" placeholder="Ex: Marca LTDA" required>
			</div>
			<div class="form-group">
				<label>
					Cnpj <span id="required">*</span>
				</label>
				<input type="text" name="cnpj" class="form-control" placeholder="Ex: 00.000.000/0000-00" required>
			</div>
			<div class="form-group">
				<label>
					Código de regime tributário <span id="required">*</span>
				</label>
				<div>
					<input type="radio" value="1" name="cod_reg_trib" checked>
					Simples Nacional.
				</div>
				<div>
					<input type="radio" value="2" name="cod_reg_trib">
					Simples Nacional - Excesso de sublimite da receita bruta.
				</div>
				<div>
					<input type="radio" value="3" name="cod_reg_trib">
					Regime Normal.
				</div>
			</div>
			<div class="form-group">
				<label>
					Cep <span id="required">*</span>
				</label>
				<input type="text" name="cep" class="form-control" placeholder="Ex: 00000-000" required>
			</div>
			<div class="form-inline col-md-12">
				<div class="col-md-4 col-sm-4 col-xs-4" id="estado">
					<label>Estado</label>
					<select class="form-control" name="estado">
					<?php foreach ($this_->getData("Estados") as $estado): ?>
						<option value="<?= $estado['SIGLA'] ?>"><?= $estado['SIGLA'] ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8" id="cidade">
					<label>Cidade</label>
					<select class="form-control" name="cidade">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>
					Endereço <span id="required">*</span>
				</label>
				<input type="text" name="endereco" class="form-control" placeholder="Ex: Rua São João" required>
			</div>
			<div class="form-group">
				<label>
					Bairro <span id="required">*</span>
				</label>
				<input type="text" name="bairro" class="form-control" placeholder="Ex: Centro" required>
			</div>
			<button id="btn-cadastrar-empresa" type="submit" class="btn btn-default form-control btn-success input-lg">
			    Cadastrar <i class="fa fa-floppy-o" aria-hidden="true"></i>
			</button>
		</form>
	</div>
</div>	
<?php 
	if( !isset($_POST['blocks']) ):
?>

<fieldset class="form-group addresses" id="fieldset<?php echo $blocks; ?>">
	<legend>Endereço <?php echo $blocks; ?></legend>

	<div class="form-group">
		<label for="desc<?php echo $blocks; ?>">Descrição</label>
		<input type="text" id="desc<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][desc]" class="form-control" placeholder="Casa, Escritório, Club..." value="<?php echo $add->display('name') ?>" />
		<input type="hidden" name="address[<?php echo $blocks; ?>][house]" value="<?php echo $add->display('id') ?>" />
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="cep<?php echo $blocks; ?>">CEP</label>
				<input 
					type="text" 
					id="cep<?php echo $blocks; ?>" 
					name="address[<?php echo $blocks; ?>][cep]" 
					class="form-control cep"
					data-id="<?php echo $blocks; ?>"
					placeholder=" Ex.: 01311-000" 
					value="<?php echo $add->display('cep') ?>"
				/>
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="cidade<?php echo $blocks; ?>">Cidade</label>
				<input type="text" id="cidade<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][city]" class="form-control" placeholder="Ex.: São Paulo" value="<?php echo $add->display('cidade') ?>" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-sm-10">
			<div class="form-group">
				<label for="endereco<?php echo $blocks; ?>">Seu endereço completo</label>
				<input type="text" id="endereco<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][address]" class="form-control" placeholder=" Ex.: Av. Paulista" value="<?php echo $add->display('endereco') ?>" />
			</div>
		</div>
		<div class="col-md-2 col-sm-2">
			<div class="form-group">
				<label for="num<?php echo $blocks; ?>">Nº</label>
				<input type="text" id="num<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][num]" class="form-control" placeholder="" value="<?php echo $add->display('numero') ?>" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="bairro<?php echo $blocks; ?>">Bairro</label>
				<input type="text" id="bairro<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][bairro]" class="form-control" placeholder=" Ex.: 01311-000" value="<?php echo $add->display('bairro') ?>" />
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="uf<?php echo $blocks; ?>">Estado</label>
				<input type="text" id="uf<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][state]" class="form-control" placeholder="Ex.: São Paulo" value="<?php echo $add->display('estado') ?>" />
			</div>
		</div>
	</div>
	
	<?php $check = ($add->display('estado') == 'yes')? 'checked="checked"': ''; ?>
	<div class="form-check">
		<label class="form-check-label">
		<input class="form-check-input" name="entrega" type="radio" <?php echo $check; ?> value="<?php echo $blocks; ?>" >
			Escolher este como endereço de entrega
		</label>
	</div>
</fieldset>


<?php else: ?>





<fieldset class="form-group addresses" id="fieldset<?php echo $blocks; ?>">
	<legend>Endereço <?php echo $blocks; ?></legend>

	<div class="form-group">
		<label for="desc<?php echo $blocks; ?>">Descrição</label>
		<input type="text" id="desc<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][desc]" class="form-control" placeholder="Casa, Escritório, Club..." value="" />
		<input type="hidden" name="address[<?php echo $blocks; ?>][house]" value="0" />
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="cep<?php echo $blocks; ?>">CEP</label>
				<input 
					type="text" 
					id="cep<?php echo $blocks; ?>" 
					name="address[<?php echo $blocks; ?>][cep]" 
					class="form-control cep"
					data-id="<?php echo $blocks; ?>"
					placeholder=" Ex.: 01311-000" 
					value=""
				/>
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="cidade<?php echo $blocks; ?>">Cidade</label>
				<input type="text" id="cidade<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][city]" class="form-control" placeholder="Ex.: São Paulo" value="" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-sm-10">
			<div class="form-group">
				<label for="endereco<?php echo $blocks; ?>">Seu endereço completo</label>
				<input type="text" id="endereco<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][address]" class="form-control" placeholder=" Ex.: Av. Paulista" value="" />
			</div>
		</div>
		<div class="col-md-2 col-sm-2">
			<div class="form-group">
				<label for="num<?php echo $blocks; ?>">Nº</label>
				<input type="text" id="num<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][num]" class="form-control" placeholder="" value="" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="bairro<?php echo $blocks; ?>">Bairro</label>
				<input type="text" id="bairro<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][bairro]" class="form-control" placeholder=" Ex.: 01311-000" value="" />
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="uf<?php echo $blocks; ?>">Estado</label>
				<input type="text" id="uf<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][state]" class="form-control" placeholder="Ex.: São Paulo" value="" />
			</div>
		</div>
	</div>
		
	<div class="form-check">
		<label class="form-check-label">
		<input class="form-check-input" name="entrega" type="radio" value="<?php echo $blocks; ?>">
			Escolher este como endereço de entrega
		</label>
	</div>
</fieldset>

<?php endif; ?>
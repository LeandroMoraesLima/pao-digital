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
					data-id="<?php echo $blocks; ?>" 
					name="address[<?php echo $blocks; ?>][cep]" 
					class="form-control cep"
					data-id="<?php echo $blocks; ?>"
					placeholder=" Ex.: 01311-000" 
					value="<?php echo $add->display('cep') ?>"
					required
				/>
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="cidade<?php echo $blocks; ?>">Cidade</label>
				<input type="text" id="cidade<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][city]" class="form-control" placeholder="Ex.: São Paulo" value="<?php echo $add->display('cidade') ?>" required />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-sm-10">
			<div class="form-group">
				<label for="endereco<?php echo $blocks; ?>">Seu endereço completo</label>
				<input type="text" id="endereco<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][address]" class="form-control" placeholder=" Ex.: Av. Paulista" value="<?php echo $add->display('endereco') ?>" required />
			</div>
		</div>
		<div class="col-md-2 col-sm-2">
			<div class="form-group">
				<label for="num<?php echo $blocks; ?>">Nº</label>
				<input type="text" id="num<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][num]" class="form-control" placeholder="" value="<?php echo $add->display('numero') ?>" required />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="bairro<?php echo $blocks; ?>">Bairro</label>
				<input type="text" id="bairro<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][bairro]" class="form-control" placeholder=" Ex.: Centro" value="<?php echo $add->display('bairro') ?>" required />
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="uf<?php echo $blocks; ?>">Estado</label>
				<input type="text" id="uf<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][state]" class="form-control" placeholder="Ex.: SP" value="<?php echo $add->display('estado') ?>" required />
			</div>
		</div>
	</div>
		

	<?php $check = ($add->display('entrega') == 'Yes')? 'checked="checked"': ''; ?>
	<div class="form-check">
		<label class="form-check-label">
		<input class="form-check-input" name="address[<?php echo $blocks; ?>][entrega]" type="checkbox" <?php echo $check; ?> value="1" >
			Escolher este como endereço de entrega
		</label>
	</div>
	<?php if( $blocks > 1 ): ?>
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<button 
					type="button" 
					style="margin-top: 10px;"
					data-item="<?php echo $blocks; ?>" 
					data-id="<?php echo $add->display('id') ?>" 
					class="btn btn-warning btn-sm btremove">
						Remover
				</button>
			</div>
		</div>
	<?php endif; ?>
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
					data-id="<?php echo $blocks; ?>" 
					name="address[<?php echo $blocks; ?>][cep]" 
					class="form-control cep"
					data-id="<?php echo $blocks; ?>"
					placeholder=" Ex.: 01311-000" 
					value=""
					required
				/>
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="cidade<?php echo $blocks; ?>">Cidade</label>
				<input type="text" id="cidade<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][city]" class="form-control" placeholder="Ex.: São Paulo" value="" required />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-sm-10">
			<div class="form-group">
				<label for="endereco<?php echo $blocks; ?>">Seu endereço completo</label>
				<input type="text" id="endereco<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][address]" class="form-control" placeholder=" Ex.: Av. Paulista" value="" required />
			</div>
		</div>
		<div class="col-md-2 col-sm-2">
			<div class="form-group">
				<label for="num<?php echo $blocks; ?>">Nº</label>
				<input type="text" id="num<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][num]" class="form-control" placeholder="" value="" required />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="bairro<?php echo $blocks; ?>">Bairro</label>
				<input type="text" id="bairro<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][bairro]" class="form-control" placeholder=" Ex.: Centro" value="" required />
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="uf<?php echo $blocks; ?>">Estado</label>
				<input type="text" id="uf<?php echo $blocks; ?>" name="address[<?php echo $blocks; ?>][state]" class="form-control" placeholder="Ex.: SP" value="" required />
			</div>
		</div>
	</div>
		
	<div class="form-check">
		<label class="form-check-label">
		<input class="form-check-input" name="address[<?php echo $blocks; ?>][entrega]" type="checkbox" value="1">
			Escolher este como endereço de entrega
		</label>
	</div>

	<?php if( $blocks > 1 ): ?>
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<button 
					type="button" 
					style="margin-top: 10px;"
					data-item="<?php echo $blocks; ?>" 
					data-id="" 
					class="btn btn-warning btn-sm btremove">
						Remover
				</button>
			</div>
		</div>
	<?php endif; ?>
</fieldset>

<?php endif; ?>
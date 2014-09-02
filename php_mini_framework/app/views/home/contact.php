<div class="box span12">
	<div class="box-header well">
		<h2><i class="icon-user"></i> Registrarse</h2>		
	</div>
	<div class="box-content">
		<p>Por favor diligencie el siguiente formulario.</p>		
		<form class="form-horizontal" id="frm-addcontact">
			<fieldset>
				<legend>Datos Personales</legend>
				<div class="control-group">
					<label class="control-label">Nombres:</label>
					<div class="controls">
						<input autofocus class="input-xlarge span5" name="cont[names]" id="names" type="text" maxlength="60" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Apellidos:</label>
					<div class="controls">
						<input class="input-xlarge span5" name="cont[surname]" id="surname" type="text" maxlength="60"/>
					</div>
				</div>
				
				<legend>Ubicación</legend>
				<div class="control-group">
					<label class="control-label">Domicilio:</label>
					<div class="controls">
						<input class="input-xlarge span5" name="cont[address]" id="address" type="text" maxlength="80"/>
					</div>
				</div>				
				<div class="control-group">
					<label class="control-label">Email:</label>
					<div class="controls">
						<input class="input-xlarge span5" name="cont[email]" id="email" type="text" maxlength="80"/>
					</div>
				</div>				
				<div class="form-actions">
					<input type="submit" class="btn btn-primary" value="Registro" />
					<button type="reset" class="btn">Cancelar</button>					
				</div>				
			</fieldset>
		</form>
	</div>	
</div>
<script>
	$(document).on("ready",function(){
		$('#frm-addcontact').on('submit',sendContact);
	})
</script>
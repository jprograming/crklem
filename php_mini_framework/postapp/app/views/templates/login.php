<div class="container-fluid">
	<div class="row-fluid">
	
		<div class="row-fluid">
			<div class="span12 center login-header">
				<h2>Autenticación de Usuarios</h2>
			</div><!--/span-->
		</div><!--/row-->
		
		<div class="row-fluid">
			<div class="well span5 center login-box">
				<div class="alert alert-info">
					Por favor ingrese su Email y Contraseña.
				</div>
				<form class="form-horizontal" id="frm-login">
					<fieldset>
						<div class="input-prepend" title="Username" data-rel="tooltip">
							<span class="add-on"><i class="icon-user"></i></span>
							<input autofocus class="input-large span10" name="user[email]" id="username" type="text" placeholder="Email" />
						</div>
						<div class="clearfix"></div>

						<div class="input-prepend" title="Password" data-rel="tooltip">
							<span class="add-on"><i class="icon-lock"></i></span>
							<input class="input-large span10" name="user[pass]" id="password" type="password" placeholder="Contraseña" />
						</div>
						<!--<div class="clearfix"></div>

						<div class="input-prepend">
						<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
						</div>-->
						<div class="clearfix"></div>

						<div class="center span5">
						<input type="submit" class="btn btn-primary" value="Ingresar" />
						</div>
					</fieldset>
				</form>
			</div><!--/span-->
		</div><!--/row-->
			</div><!--/fluid-row-->
	
</div><!--/.fluid-container-->
<script> $(document).on("ready",function(){
	$("#frm-login").on("submit",authenticate);
}); </script>

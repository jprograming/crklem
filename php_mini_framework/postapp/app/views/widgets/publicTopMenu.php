<div class="navbar">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#"><span> Admin</span></a>
						
			<!-- user dropdown starts -->
			<div class="btn-group pull-right" >
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<?  print img($_data['avatar'],'class="img-small"'); ?>
					<span class="hidden-phone"> 
					<? print $_data['name']; ?>
					</span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><? print link_to('#','Configuración')?></li>
					<li class="divider"></li>
					<li><?  print link_to('public/logout','Salir');  ?></li>
				</ul>
			</div>
			<!-- user dropdown ends -->
			<div class="top-nav nav-collapse">
				<ul class="nav">
					<li><? print link_to('@base','Inicio'); ?></li>	
					<li><a href="/" target="_new">Ir a la Página Principal</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div> <!-- end navbar-->

<div class="navbar">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#"><span> Nav</span></a>			
			<div class="top-nav nav-collapse">
				<ul class="nav">
					<li><? print link_to('@base','Inicio'); ?></li>	
					<li><? print link_to('home/contact','Contacto'); ?></li>
					<li><? print link_to('home/orm','Prueba Orm'); ?></li>					
					<li>
						<form class="navbar-search pull-left">
							<input placeholder="Buscar" class="search-query span2" name="query" type="text">
						</form>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div> <!-- end navbar-->
<script>
	$(document).on("ready",function(){
		//$("#local-date").text(" "+getLocalDate());
	})
</script>
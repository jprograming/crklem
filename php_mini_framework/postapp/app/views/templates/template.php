
<header>
 	<?php  putWidget('top_menu'); ?>
</header>

<section>		  
	<div class="container-fluid">
		<div class="row-fluid">
			<!-- menu izquierdo -->
			<div class="span2 main-menu-span">
				<?php putWidget('left_menu');  ?>
			</div>
		<!-- content starts -->
			<div id="content" class="span10">
				<!-- where am i? -->
				<?php putNavpath(); ?>
				
				<!-- require view -->
				<div class="row-fluid" id="dinamic-view">
					<?php require_once View::get(); ?>
				</div><!-- require view -->

				<div class="modal hide fade" id="myModal"></div>
			</div><!-- content end -->

		</div><!-- end row-fluid-->

		<footer>
			<p class="pull-left">
				&copy; 2012 | <a href="#" target="_new">Nav</a> | Reservados Todos los Derechos.
			</p>
			<p class="pull-right">Powered by: 
				<a href="http://usman.it/free-responsive-admin-template" target="_new">Charisma</a></p>
		</footer>
	

	</div><!-- end container-fluid-->	
  
</section>
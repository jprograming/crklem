<div class="box span12">
	<div class="box-header well">
		<h2><i class="icon-user"></i> Carga de Datos</h2>		
	</div>
	<div class="box-content">
		<table class="table table-striped table-bordered bootstrap-datatable hide" id="grid-bands">	
			<thead>
			  <tr>
				  <th>Nombre</th>				 
				  <th>Género</th>				 
			  </tr>
		    </thead>   
		    <tbody>
	<?php	
	foreach ($obj->bands as $b):
		echo '<tr>'.
				'<td>'.$b->bname.'</td>'.
				'<td>'.$b->bgenre.'</td>'.
			'</tr>';
	endforeach;
	?>	    	
		    </tbody>
		</table>	
	</div>	
</div>
<script>
	$(document).on("ready",function(){
		showTable('#grid-bands');
	});
</script>
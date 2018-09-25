<style>
	label{
		font-weight: bold;
	}
</style>
<?php 
	$visibilidades = $this->db_util->get('visibilidad');
	$item = $this->db_util->get('carousel',$id);
	$data_upload['aspectX'] = 4;
	$data_upload['aspectY'] = 1;
	$data_upload['titulo'] = 'Cargar imagen';
	$data_upload['imgSelector'] = '#resultado';
 ?>



<div class="container">
<div style="margin-top: 10px;" class="text-left">
	<a href="<?php echo base_url('carousel/listar') ?>"><button  style="cursor: pointer;" id="volver" class="btn btn-default btn-md"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Volver a la lista</button></a>
</div>
	<h2 style="margin-top: 15px;" class="text-center">Editar Item de Carousel</h2>
</div>

<div class="container contenedor">
	<form>
	  <fieldset>
	    <legend></legend>
	    <div class="form-group">
	      <label for="titulo">Título</label>
	      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título del item" value="<?php echo $item->titulo ?>">
	    </div>
	    <div class="form-group">
	      <label for="visibilidad"><strong>Visibilidad</strong></label><br>
	      <select name="visibilidad" id="visibilidad" style="width: 100%">
	      		<?php foreach ($visibilidades as $id => $visibilidad): ?>
	      			<?php if ($visibilidad->id == $item->estado): ?>
	      				<option value="<?php echo $visibilidad->id ?>" selected><?php echo $visibilidad->nombre ?></option>
	      			<?php else: ?>
	      				<option value="<?php echo $visibilidad->id ?>"><?php echo $visibilidad->nombre ?></option>
	      			<?php endif ?>
	      		<?php endforeach ?>
	      </select>
	    </div>
	    <div class="form-group">
	      <label for="texto">Texto</label>
	      <textarea class="form-control" id="texto" rows="3"><?php echo $item->texto; ?></textarea>
	    </div>
	    <div class="form-group">
	      <label for="texto_boton">Texto del botón</label>
	      <input type="text" class="form-control" id="texto_boton" name="texto_boton" placeholder="Texto que aparecerá en el botón. Ej: 'Ver Más'" value="<?php echo $item->texto_boton; ?>">
	    </div>
	    <div class="form-group">
	      <label for="referencia_boton">Referencia del botón</label>
	      <input type="text" class="form-control" id="referencia_boton" name="referencia_boton" placeholder="Direción donde te llevará el botón" value="<?php echo $item->referencia_boton; ?>">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputFile">Imagen para carousel</label><br>
	      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-upload-image"><i class="fa fa-picture-o" aria-hidden="true"></i> Importar imagen</button><br>
	      <?php if ($item->imagen): ?>
	      	<img src="<?php echo base_url('assets/img/carousel/' . $item->imagen) ?>" style="width: 50%;margin-top: 1rem" alt="" id="resultado">
	      	<br /><button class="btn btn-danger quitar-img-respuesta" type="button" role="button" style="margin-top: 1rem"><i class="fa fa-times" aria-hidden="true"></i> Quitar</button>
	      <?php else: ?>
	      	<img src="" style="width: 50%;margin-top: 1rem" alt="" id="resultado">
	      <?php endif ?>
	    </div>
	    <div class="text-center">
	    	<button type="button" class="btn btn-primary" id="guardar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
	    </div>
	  </fieldset>
	</form>
</div>

<?php $this->load->view('util/cutupload_image', $data_upload); ?>

<script>
	jQuery(document).ready(function($) {
		idItem = '<?php echo $item->id; ?>';
		$('#guardar').unbind().click(function(event) {
			$.ajax({
				type: "post",
				url: "<?php echo base_url('carousel/actualizar_datos'); ?>",
				cache: false,
				data: { 
			        'titulo': $('#titulo').val(),
			        'texto': $('#texto').val(),
			        'texto_boton': $('#texto_boton').val(),
			        'referencia_boton': $('#referencia_boton').val(),
			        'estado': $('#visibilidad').val(),
			        'id': idItem
			    }
			}).done(function(resp) {
				subirArchivo();
			}).fail(function() {
				console.log("error");
			});


		});

		function archivoCargado(){
			return $('#archivo_imagen').get(0).files.length > 0;
		}

		function subirArchivo(){
					var form_data_modal = new FormData();  
					var srcEditado = $('#resultado').attr('src');
					srcEditado = srcEditado.replace('data:image/png;base64,','');
					srcEditado = srcEditado.replace('data:image/jpeg;base64,','');
					form_data_modal.append('file', srcEditado);
					form_data_modal.append('path','assets/img/carousel/');
					form_data_modal.append('name',idItem + '.jpg');
					$.ajax({
			                url: '<?php echo base_url('upload_file/image') ?>', // point to server-side PHP script 
			                dataType: 'text',  // what to expect back from the PHP script, if anything
			                cache: false,
			                contentType: false,
			                processData: false,
			                data: form_data_modal,                        
			                type: 'post',
			                success: function(resp){
			                	window.location.replace("<?php echo base_url('carousel/listar') ?>");
			                }
					    });
		}

	});
</script>
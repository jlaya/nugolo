<style type="text/css">
	.select2-container--default .select2-selection--single .select2-selection__rendered {
	    color: #FFF !important;
	    line-height: 28px;
	}
	
	.botondebuscar{
	    width: 100%;
	    background-color: #8946d9 !important;
        border-color: #ffddf6 !important;
        color: white !important;
	}
	.btnvolver {
	  width: 140px;
	  margin-left: -8px;
	  margin-bottom: 11px;
	}
</style>
<?php
	$getCategory = $this->user_model->getCategory();
	$category = $this->input->get('category');
?>
<form action="<?php echo base_url('home/courses'); ?>" method="GET">
	<div class="row">
	  <a href="<?php echo base_url(); ?>" style="width: 140px;margin-left: 10px;margin-bottom: 11px;">
	  	<button type="button" class="btn btn-primary btnvolver">Volver</button>
	  </a>
  	</div>
	<div class="row">
		<div class="col-8">
			<select name="category" id="category" class="form-control select2">
				<option value="0">Todos</option>
				<?php foreach ($getCategory as $key => $value) { ?>
				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-4">
			<button type="submit" class="btn btn-primary botondebuscar">Buscar</button>
		</div>
	</div>
</form>
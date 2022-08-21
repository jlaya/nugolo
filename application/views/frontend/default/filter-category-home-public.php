<?php
	$getCategory = $this->user_model->getCategory();
	$category = $this->input->get('category');
?>

<form action="<?php echo base_url('home/courses'); ?>" method="GET">
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
	<button type="submit" class="btn btn-primary">Buscar</button>
	<button class="btn btn-default">
              <a style="color: #FFF;" href="<?php echo base_url(); ?>">Volver</a>
            </button>
	</div>
	</div>
</form>
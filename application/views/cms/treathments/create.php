<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
<div class="row g-4 settings-section">
	<?php $error = $this->session->flashdata('error') ?>

    <div class="col-12">
        <div class="app-card app-card-settings shadow-sm p-4">
		    
		    <div class="app-card-body">
			    <form class="settings-form" method="post" action="<?= base_url('treathments/store') ?>">
				    <div class="mb-3">
				    	<label for="parent_id" class="form-label">Parent</label>
					    <select name="parent_id" id="parent_id" class="form-control select2"  data-placeholder="Pilih Parent">
					    	<option ></option>
					    	<?php foreach ($parent as $key => $value): ?>
					    		<option value="<?= $value->id ?>"><?= $value->name ?></option>
					    	<?php endforeach ?>
					    </select>
					    <?= isset($error['parent_id']) ? $error['parent_id'] : ''  ?>
			    	</div>
			    	<div class="mb-3">
					    <label for="name" class="form-label">Nama Tindakan</label>
					    <input type="text" class="form-control" id="name" value="<?= set_value('name') ?>" name="name" required placeholder="">
					    <?= isset($error['name']) ? $error['name'] : ''  ?>
					</div>
					
					<div class="row">
						<div class="mb-3 col-lg-8 col-12">
						    <label for="price" class="form-label">Harga</label>
							<div class="input-group mb-3">
							  <span class="input-group-text">
							  	Rp.
							  </span>
							  <input type="number" value="<?= set_value('price',0) ?>" class="form-control" name="price" min="0" id="price" aria-describedby="group-price">
							</div>
						    <?= isset($error['price']) ? $error['price'] : ''  ?>
						</div>
						<div class="mb-3 col-lg-4 col-12">
							<label for="status">Status</label>
					    	<div class="form-check form-switch">
					    	  <input class="form-check-input" name="status" type="checkbox" checked id="status" value="Aktif">
					    	  <label class="form-check-label" id="text-status" for="status">Aktif</label>
					    	</div>
				    	</div>
					</div>
					<div class="mb-3">
					    <label for="medicine_query" class="form-label">Query</label>
					    <textarea class="form-control" id="medicine_query" name="medicine_query"><?= set_value('medicine_query') ?></textarea>
					    <?= isset($error['medicine_query']) ? $error['medicine_query'] : ''  ?>
					</div>
					<a href="<?= base_url('treathments') ?>" class="btn app-btn-secondary" >Kembali</a>
					<button type="submit" class="btn app-btn-primary" >Simpan</button>
			    </form>
		    </div><!--//app-card-body-->
		    
		</div><!--//app-card-->
    </div>
</div><!--//row-->

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$("#status").change(function(){
		if ($(this).is(':checked')) {
			$("#text-status").text('Aktif')
		}else{
			$("#text-status").text('Tidak Aktif')
		}
	})
	$(".select2").select2({
		theme:'bootstrap-5',
		placeholder: function(){
	        $(this).data('placeholder');
	    }
	});

	$(".select2-tags").select2({
		tags:true,
		theme:'bootstrap-5',
		placeholder: function(){
	        $(this).data('placeholder');
	    }
	});

</script>
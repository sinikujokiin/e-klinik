<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
<div class="row g-4 settings-section">
	<?php $error = $this->session->flashdata('error') ?>

    <div class="col-12">
        <div class="app-card app-card-settings shadow-sm p-4">
		    
		    <div class="app-card-body">
			    <form class="settings-form" method="post" action="<?= base_url('menus/store') ?>">
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
					    <label for="name" class="form-label">Nama Menu</label>
					    <input type="text" class="form-control" id="name" value="<?= set_value('name') ?>" name="name" required placeholder="">
					    <?= isset($error['name']) ? $error['name'] : ''  ?>
					</div>
					<div class="mb-3">
					    <label for="url" class="form-label">Url Menu</label>
					    <input type="text" class="form-control" id="url" value="<?= set_value('url') ?>" name="url" required placeholder="">
					    <?= isset($error['url']) ? $error['url'] : ''  ?>
					</div>
					<div class="row">
						<div class="mb-3 col-lg-8 col-12">
						    <label for="icon" class="form-label">Icon</label>
							<div class="input-group mb-3">
							  <span class="input-group-text" id="group-icon">
							  </span>
							  <input type="text" class="form-control" name="icon" id="icon" aria-describedby="group-icon">
							</div>
						    <?= isset($error['icon']) ? $error['icon'] : ''  ?>
						</div>
						<div class="mb-3 col-lg-4 col-12">
						    <label for="sort" class="form-label">Urutan Menu</label>
						    <input type="number" min="0" class="form-control" id="sort" value="<?= set_value('sort') ?>" name="sort" required placeholder="">
						    <?= isset($error['sort']) ? $error['sort'] : ''  ?>
						</div>
					</div>
					<div class="mb-3">
					    <label for="access" class="form-label">Akses</label>
					    <select name="access[]" id="access" class="form-control select2-tags" multiple data-placeholder="Buat Akses">
					    	<option ></option>
					    </select>
					    <?= isset($error['access']) ? $error['access'] : ''  ?>
					</div>
					<a href="<?= base_url('menus') ?>" class="btn app-btn-secondary" >Kembali</a>
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

	$("#icon").change(function(){
		var icon = $(this).val()
		console.log(icon)

		$("#group-icon").html(`<span class="${icon}"></span>`)
	})
</script>
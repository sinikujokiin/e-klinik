<style type="text/css">
	input[type="number"]::-webkit-inner-spin-button,
	input[type="number"]::-webkit-outer-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	input[type="number"] {
	  -moz-appearance: textfield;
	}
</style>

<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
<div class="row g-4 settings-section">
	<?php $error = $this->session->flashdata('error') ?>
<?php if ($this->session->flashdata('alert')): ?>
	<?= $this->session->flashdata('alert'); ?>
<?php endif ?>
    <div class="col-12">
        <div class="app-card app-card-settings shadow-sm p-4">
		    
		    <div class="app-card-body">
			    <form class="settings-form" method="post" enctype="multipart/form-data" action="<?= base_url('medicines/update/'.encrypt_decrypt('encrypt', $medicines->id)) ?>">
			    	<div class="row">
			    		<div class="col-lg-4 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="code" class="form-label">Kode</label>
							    <input type="text" class="form-control" id="code" value="<?= set_value('code', $medicines->code) ?>" name="code" required placeholder="">
							    <?= isset($error['code']) ? $error['code'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-8 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="name" class="form-label">Nama Obat</label>
							    <input type="text" class="form-control" id="name" value="<?= set_value('name', $medicines->name) ?>" name="name" required placeholder="">
							    <?= isset($error['name']) ? $error['name'] : ''  ?>
							</div>
			    		</div>
			    	</div>
					<div class="mb-3">
					    <label for="description" class="form-label">Deskripsi</label>
					    <textarea class="form-control" id="description" name="description"><?= set_value('description', $medicines->description) ?></textarea>
					    <?= isset($error['description']) ? $error['description'] : ''  ?>
					</div>
					<div class="row">
						<div class="col-lg-5 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="stock_min" class="form-label">Stock Minimal</label>
							    <input type="number" min="0" class="form-control" id="stock_min" value="<?= set_value('stock_min', $medicines->stock_min) ?>" name="stock_min" required placeholder="">
							    <?= isset($error['stock_min']) ? $error['stock_min'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-5 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="stock" class="form-label">Stock</label>
							    <input type="number" min="0" class="form-control" id="stock" value="<?= set_value('stock', $medicines->stock) ?>" name="stock" required placeholder="">
							    <?= isset($error['stock']) ? $error['stock'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-2 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="unit" class="form-label">Satuan</label>
							    <select class="form-control select2-tag" id="unit" name="unit" data-placeholder="Pilih Unit">
							    	<?php foreach ($units as $key => $value): ?>
								    	<option <?= $value->unit == set_value('unit', $medicines->unit) ?>><?= $value->unit ?></option>
							    	<?php endforeach ?>
							    </select>
							    <?= isset($error['unit']) ? $error['unit'] : ''  ?>
							</div>
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-lg-5 col-md-4 col-12">
					    	<div class="mb-3">
							    <label for="purchase_price" class="form-label">Harga Beli</label>
							    <input type="number" min="0" class="form-control" id="purchase_price" value="<?= set_value('purchase_price', $medicines->purchase_price) ?>" name="purchase_price" required placeholder="">

							    <?= isset($error['purchase_price']) ? $error['purchase_price'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-5 col-md-4 col-12">
					    	<div class="mb-3">
							    <label for="selling_price" class="form-label">Harga Jual</label>
							    <input type="number" min="0" class="form-control" id="selling_price" value="<?= set_value('selling_price', $medicines->selling_price) ?>" name="selling_price" required placeholder="">

							    <?= isset($error['selling_price']) ? $error['selling_price'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-2 col-md-4 col-12">
					    	<div class="mb-3">
							    <label for="type" class="form-label">Kategori Obat</label>
							    <select class="form-control select2-tag" name="type" id="type" data-placeholder="Pilih Kategori Obat">
							    	<option></option>
							    	<?php foreach ($type as $key => $value): ?>
								    	<option <?= set_value('type', $medicines->type) == $value->type ? 'selected' : '' ?>><?= $value->type ?></option>
							    	<?php endforeach ?>
							    </select>
							    <?= isset($error['type']) ? $error['type'] : ''  ?>
							</div>
			    		</div>
			    	</div>
			    	<div class="mb-3">
					    <label for="image" class="form-label">Image</label>
					    <input type="file" class="form-control" id="image" name="image" placeholder="">
					    <?= isset($error['image']) ? $error['image'] : ''  ?>
					</div>
			    	<div class="mb-3">
				    	<div class="form-check form-switch">
				    	  <input class="form-check-input" type="checkbox" <?= set_value('status', $medicines->status) == 'Aktif' ? 'checked' : ''  ?> id="status" name="status" value="Aktif">
				    	  <label class="form-check-label" id="text-status" for="status"><?= set_value('status', $medicines->status) == 'Aktif' ? 'Aktif' : 'Tidak Aktif'  ?></label>
				    	</div>
			    	</div>
					<a href="<?= base_url('medicines') ?>" class="btn app-btn-secondary" >Kembali</a>
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
	$(".select2-tag").select2({
		tags:true,
		theme:'bootstrap-5',
		placeholder: function(){
	        $(this).data('placeholder');
	    }
	});
</script>
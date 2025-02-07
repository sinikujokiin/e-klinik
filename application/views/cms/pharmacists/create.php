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
			    <form class="settings-form" enctype="multipart/form-data" method="post" action="<?= base_url('pharmacists/store') ?>">
			    	<div class="row">
			    		<div class="col-lg-4 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="code" class="form-label">Kode</label>
							    <input type="text" class="form-control" id="code" value="<?= set_value('code', $code) ?>" readonly name="code" required placeholder="">
							    <?= isset($error['code']) ? $error['code'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-8 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="no_reg" class="form-label">No Registrasi</label>
							    <input type="number" class="form-control" id="no_reg" value="<?= set_value('no_reg') ?>" name="no_reg" required placeholder="">
							    <?= isset($error['no_reg']) ? $error['no_reg'] : ''  ?>
							</div>
			    		</div>
			    	</div>
			    	<div class="mb-3">
					    <label for="name" class="form-label">Nama Apoteker</label>
					    <input type="text" class="form-control" id="name" value="<?= set_value('name') ?>" name="name" required placeholder="">
					    <?= isset($error['name']) ? $error['name'] : ''  ?>
					</div>
					<div class="row">
			    		<div class="col-lg-4 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="pob" class="form-label">Tempat Lahir</label>
							    <input type="text" class="form-control" id="pob" value="<?= set_value('pob') ?>" name="pob" required placeholder="">
							    <?= isset($error['pob']) ? $error['pob'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-8 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="dob" class="form-label">Tanggal Lahir</label>
							    <input type="date" class="form-control" id="dob" value="<?= set_value('dob') ?>" name="dob" required placeholder="">
							    <?= isset($error['dob']) ? $error['dob'] : ''  ?>
							</div>
			    		</div>
			    	</div>

			    	<div class="row">
			    		<div class="col-lg-6 col-md-6 col-6">
					    	<div class="mb-3">
							    <label for="gender" class="form-label">Jenis Kelamin</label>
				        		<div class="form-check">
				    			  <input class="form-check-input gender" type="radio" name="gender" checked value="Laki-Laki" id="laki-laki">
				    			  <label class="form-check-label" for="laki-laki">
				    			    Laki-Laki
				    			  </label>
				    			</div>
				    			<div class="form-check">
				    			  <input class="form-check-input gender" type="radio" name="gender" value="Perempuan" id="perempuan">
				    			  <label class="form-check-label" for="perempuan">
				    			    Perempuan
				    			  </label>
				    			</div>
							    <?= isset($error['gender']) ? $error['gender'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-6 col-md-6 col-6">
					    	<div class="mb-3">
						    	<div class="form-check form-switch">
						    	  <input class="form-check-input" name="status" type="checkbox" checked id="status" value="Aktif">
						    	  <label class="form-check-label" id="text-status" for="status">Aktif</label>
						    	</div>
					    	</div>
			    		</div>
			    	</div>
					<a href="<?= base_url('pharmacists') ?>" class="btn app-btn-secondary" >Kembali</a>
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
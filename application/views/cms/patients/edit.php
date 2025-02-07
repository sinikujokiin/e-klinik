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
			    <form class="settings-form" enctype="multipart/form-data" method="post" action="<?= base_url('patients/update/'.encrypt_decrypt('encrypt',$patients->id)) ?>">
			    	<div class="row">
			    		<div class="col-lg-4 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="code" class="form-label">Kode</label>
							    <input type="text" class="form-control" id="code" readonly value="<?= set_value('code', $patients->code) ?>" name="code" required placeholder="">
							    <?= isset($error['code']) ? $error['code'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-8 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="name" class="form-label">Nama Pasien</label>
							    <input type="text" class="form-control" id="name" value="<?= set_value('name', $patients->name) ?>" name="name" required placeholder="">
							    <?= isset($error['name']) ? $error['name'] : ''  ?>
							</div>
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-lg-4 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="pob" class="form-label">Tempat Lahir</label>
							    <input type="text" class="form-control" id="pob" value="<?= set_value('pob', $patients->pob) ?>" name="pob" required placeholder="">
							    <?= isset($error['pob']) ? $error['pob'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-8 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="dob" class="form-label">Tanggal Lahir</label>
							    <input type="date" max="<?= date('Y-m-d') ?>" class="form-control" id="dob" value="<?= set_value('dob', $patients->dob) ?>" name="dob" required placeholder="">
							    <?= isset($error['dob']) ? $error['dob'] : ''  ?>
							</div>
			    		</div>
			    	</div>
					<div class="mb-3">
					    <label for="address" class="form-label">Alamat</label>
					    <textarea class="form-control" id="address" name="address"><?= set_value('address', $patients->address) ?></textarea>
					    <?= isset($error['address']) ? $error['address'] : ''  ?>
					</div>
			    	<div class="row">
			    		<div class="col-lg-6 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="phone" class="form-label">No. HP</label>
							    <input type="number" min="0" class="form-control" id="phone" value="<?= set_value('phone', $patients->phone) ?>" name="phone" required placeholder="">
							    <?= isset($error['phone']) ? $error['phone'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-6 col-md-6 col-12">
					    	<div class="mb-3">
							    <label for="email" class="form-label">Email</label>
							    <input type="email" min="0" class="form-control" id="email" value="<?= set_value('email', $patients->email) ?>" name="email" required placeholder="">
							    <?= isset($error['email']) ? $error['email'] : ''  ?>
							</div>
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-lg-6 col-12">
					    	<div class="mb-3">
					    		<label for="type" class="form-label">Pengobatan</label>
					    		<div class="form-check">
								  <input class="form-check-input type" type="radio" name="type"  <?= set_value('gender', $patients->type) == 'UMUM' ? 'checked' : ''  ?> value="UMUM" id="umum">
								  <label class="form-check-label" for="umum">
								    UMUM
								  </label>
								</div>
								<div class="form-check">
								  <input class="form-check-input type" type="radio" name="type"  <?= set_value('gender', $patients->type) == 'BPJS' ? 'checked' : ''  ?> value="BPJS" id="bpjs">
								  <label class="form-check-label" for="bpjs">
								    BPJS
								  </label>
								</div>
							    <?= isset($error['type']) ? $error['type'] : ''  ?>
					    	</div>
			    		</div>
					<div class="col-lg-6 col-md-6 col-12" id="form-bpjs" <?= $patients->type == 'BPJS' ? '' : 'hidden' ?>>
					    	<div class="mb-3">
							    <label for="bpjs_number" class="form-label">Nomer BPJS</label>
							    <input type="number" class="form-control" id="bpjs_number" value="<?= set_value('bpjs_number', $patients->bpjs_number) ?>" name="bpjs_number" <?= $patients->type == 'BPJS' ? 'required' : '' ?> placeholder="">
							    <?= isset($error['bpjs_number']) ? $error['bpjs_number'] : ''  ?>
						</div>
			    		</div>
			    		
			    	</div>
			    	<div class="row">
			    		<div class="col-lg-6 col-6">
					    	<div class="mb-3">
							    <label class="form-label">Jenis Kelamin</label>
							    <div class="form-check">
								  <input class="form-check-input" type="radio" name="gender" <?= set_value('gender', $patients->gender) == 'Laki-Laki' ? 'checked' : ''  ?> value="Laki-Laki" id="lk">
								  <label class="form-check-label" for="lk">
								    Laki-Laki
								  </label>
								</div>
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="gender" <?= set_value('gender', $patients->gender) == 'Perempuan' ? 'checked' : ''  ?> value="Perempuan" id="pr">
								  <label class="form-check-label" for="pr">
								    Perempuan
								  </label>
								</div>
							    <?= isset($error['image']) ? $error['image'] : ''  ?>
							</div>
			    		</div>
			    		<div class="col-lg-6 col-6">
					    	<div class="mb-3">
						    	<div class="form-check form-switch">
						    	  <input class="form-check-input" type="checkbox" <?= set_value('status', $patients->status) == 'Aktif' ? 'checked' : ''  ?> id="status" name="status" value="Aktif">
						    	  <label class="form-check-label" id="text-status" for="status"><?= set_value('status', $patients->status) == 'Aktif' ? 'Aktif' : 'Tidak Aktif'  ?></label>
						    	</div>
					    	</div>
			    		</div>
			    	</div>
					<a href="<?= base_url('patients') ?>" class="btn app-btn-secondary" >Kembali</a>
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
	$(".type").change(function(){
		if ($(this).val() == 'BPJS') {
			$("#form-bpjs").attr('hidden',false);
		}else{
			$("#form-bpjs").attr('hidden',true);

		}
		// $('input[type="radio"].namaKelas:checked').val()
	})
	$("#status").change(function(){
		if ($(this).is(':checked')) {
			$("#text-status").text('Aktif')
			$("#bpjs_number").attr("required",true)
		}else{
			$("#text-status").text('Tidak Aktif')
			$("#bpjs_number").removeAttr("required")
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

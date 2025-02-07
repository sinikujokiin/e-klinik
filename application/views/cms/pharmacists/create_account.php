<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
<div class="row g-4 settings-section">
	<?php $error = $this->session->flashdata('error') ?>

    <div class="col-12">
        <div class="app-card app-card-settings shadow-sm p-4">
		    
		    <div class="app-card-body">
			    <form class="settings-form" method="post" action="<?= base_url('pharmacists/store_account/'.$this->uri->segment(3)) ?>">
			    	<div class="mb-3">
					    <label for="fullname" class="form-label">Nama Lengkap</label>
					    <input type="text" class="form-control" id="fullname" value="<?= set_value('fullname', $name) ?>" name="fullname" required placeholder="">
					    <?= isset($error['fullname']) ? $error['fullname'] : ''  ?>
					</div>
			    	<div class="mb-3">
					    <label for="username" class="form-label">Username</label>
					    <input type="text" class="form-control" id="username" value="<?= set_value('username') ?>" name="username" required placeholder="">
					    <?= isset($error['username']) ? $error['username'] : ''  ?>
					</div>
					<div class="row">
						<div class="mb-3 col-lg-6 col-12">
						    <label for="password" class="form-label">Password</label>
						    <input type="password" class="form-control" id="password" value="<?= set_value('password') ?>" name="password" required placeholder="">
						    <?= isset($error['password']) ? $error['password'] : ''  ?>
						</div>
						<div class="mb-3 col-lg-6 col-12">
						    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
						    <input type="password" class="form-control" id="confirm_password" value="<?= set_value('confirm_password') ?>" name="confirm_password" required placeholder="">
						    <?= isset($error['confirm_password']) ? $error['confirm_password'] : ''  ?>
						</div>
					</div>
					<div class="mb-3">
				    	<label for="role_id" class="form-label">Role</label>
					    <select name="role_id" id="role_id" class="form-control select2" data-placeholder="Pilih Role">
					    	<option ></option>
					    	<?php foreach ($role as $key => $value): ?>
					    		<option value="<?= $value->id ?>"><?= $value->name ?></option>
					    	<?php endforeach ?>
					    </select>
					    <?= isset($error['role_id']) ? $error['role_id'] : ''  ?>
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

	$(".select2").select2({
		theme:'bootstrap-5',
		placeholder: function(){
	        $(this).data('placeholder');
	    }
	});

</script>
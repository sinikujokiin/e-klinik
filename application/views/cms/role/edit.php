<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
<div class="row g-4 settings-section">
	<?php $error = $this->session->flashdata('error') ?>

    <div class="col-12">
        <div class="app-card app-card-settings shadow-sm p-4">
		    
		    <div class="app-card-body">
			    <form class="settings-form" method="post" action="<?= base_url('roles/update/'.encrypt_decrypt('encrypt', $role->id)) ?>">
			    	<div class="mb-3">
					    <label for="name" class="form-label">Nama Role</label>
					    <input type="text" class="form-control" id="name" value="<?= set_value('name', $role->name) ?>" name="name" required placeholder="">
					    <?= isset($error['name']) ? $error['name'] : ''  ?>
					</div>
					<div class="mb-3">
					    <label for="description" class="form-label">Deskripsi</label>
					    <textarea name="description" id="description" class="form-control"><?= set_value('description', $role->description) ?></textarea>
					    <?= isset($error['description']) ? $error['description'] : ''  ?>
					</div>
					<a href="<?= base_url('roles') ?>" class="btn app-btn-secondary" >Kembali</a>
					<button type="submit" class="btn app-btn-primary" >Simpan</button>
			    </form>
		    </div><!--//app-card-body-->
		    
		</div><!--//app-card-->
    </div>
</div><!--//row-->
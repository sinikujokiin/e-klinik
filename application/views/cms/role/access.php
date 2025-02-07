

<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
<div class="row g-4 settings-section">
	<?php $error = $this->session->flashdata('error') ?>
	<?php if ($this->session->flashdata('alert')): ?>
		<?= $this->session->flashdata('alert'); ?>
	<?php endif ?>

    <div class="col-12">
        <div class="app-card app-card-settings shadow-sm p-4">
		    
		    <div class="app-card-body">
			    <form class="settings-form" method="post" action="<?= base_url('roles/storeaccess/'.encrypt_decrypt('encrypt', $role->id)) ?>">
			    	<?php foreach ($menu as $value): ?>
				    	<div>
						    <label for="menu_id_<?= encrypt_decrypt('encrypt',$value->id)  ?>" class="form-label">
							    <input type="checkbox" name="menu_id[]" id="menu_id_<?= encrypt_decrypt('encrypt',$value->id)  ?>" <?= $value->checked ? 'checked' : ''  ?> value="<?= $value->id  ?>">
							    <?= $value->name ?>
						    </label>
						    <div class="mt-2 mb-2" style="margin-left: 1.5rem;">
						    	<?php 
						    	$access = json_decode($value->access);
						    	$access = $access ? $access : [];
						    	foreach ($access as $acc): ?>
						    	    <label for="access_<?= $acc ?>_<?= encrypt_decrypt('encrypt',$value->id)  ?>" class="form-label">
						    		    <input type="checkbox" name="access[<?= $value->id ?>][]" <?= is_int(array_search($acc, $value->accessible)) ? 'checked' : ''  ?> id="access_<?= $acc ?>_<?= encrypt_decrypt('encrypt',$value->id)  ?>" value="<?= $acc  ?>">
						    		    <?= $acc ?>
						    	    </label>
						    	<?php endforeach ?>
						    </div>
						</div>
						<?php foreach ($value->children as $value1): ?>
					    	<div style="margin-left: 2rem;">
							    <label for="menu_id_<?= encrypt_decrypt('encrypt',$value1->id)  ?>" class="form-label">
								    <input type="checkbox" name="menu_id[]" id="menu_id_<?= encrypt_decrypt('encrypt',$value1->id)  ?>" <?= $value1->checked ? 'checked' : ''  ?> value="<?= $value1->id  ?>">
								    <?= $value1->name ?>
							    </label>

							</div>
						    <div class="mt-2 mb-2" style="margin-left: 3rem;">
						    	<?php 
						    	$access = json_decode($value1->access);
						    	$access = $access ? $access : [];
						    	foreach ($access as $acc): ?>
						    	    <label for="access_<?= $acc ?>_<?= encrypt_decrypt('encrypt',$value1->id)  ?>" class="form-label">
						    		    <input type="checkbox" name="access[<?= $value1->id ?>][]" <?= is_int(array_search($acc, $value1->accessible)) ? 'checked' : ''  ?> id="access_<?= $acc ?>_<?= encrypt_decrypt('encrypt',$value1->id)  ?>" value="<?= $acc  ?>">
						    		    <?= $acc ?>
						    	    </label>
						    	<?php endforeach ?>
						    </div>
						<?php endforeach ?>
			    	<?php endforeach ?>
			    	<div class="mt-3">
						<a href="<?= base_url('roles') ?>" class="btn-sm btn app-btn-secondary" >Kembali</a>
						<button type="submit" class="btn-sm btn app-btn-primary" >Simpan</button>
			    	</div>
			    </form>
		    </div><!--//app-card-body-->
		    
		</div><!--//app-card-->
    </div>
</div><!--//row-->
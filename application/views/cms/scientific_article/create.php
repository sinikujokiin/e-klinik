<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
<div class="row g-4 settings-section">
	<?php $error = $this->session->flashdata('error') ?>

    <div class="col-12">
        <div class="app-card app-card-settings shadow-sm p-4">
		    
		    <div class="app-card-body">
			    <form class="settings-form" method="post" action="<?= base_url('scientific_articles/store') ?>">
			    	<div class="mb-3">
				    	<label for="lecture_id" class="form-label">Dosen</label>
					    <select name="lecture_id" id="lecture_id" class="form-control select2" data-placeholder="Pilih Dosen">
					    	<option ></option>
					    	<?php foreach ($lecture as $key => $value): ?>
					    		<option value="<?= $value->id ?>"><?= $value->name.' - '.$value->prodi->name ?></option>
					    	<?php endforeach ?>
					    </select>
					    <?= isset($error['lecture_id']) ? $error['lecture_id'] : ''  ?>
			    	</div>
					<div class="row">
						<div class="mb-3 col-lg-6 col-12">
						    <label for="na" class="form-label">Artikel Ilmiah Tingkat Internasional (NA)</label>
						    <input type="number" min="0" class="form-control" id="na" value="<?= set_value('na', 0) ?>" name="na" required placeholder="">
						    <?= isset($error['na']) ? $error['na'] : ''  ?>
						</div>
						<div class="mb-3 col-lg-6 col-12">
						    <label for="nb" class="form-label">Artikel Ilmiah Tingkat Nasional atau Buku (NB)</label>
						    <input type="number" min="0" class="form-control" id="nb" value="<?= set_value('nb', 0) ?>" name="nb" required placeholder="">
						    <?= isset($error['nb']) ? $error['nb'] : ''  ?>
						</div>
					</div>
					<div class="row">
						<div class="mb-3 col-lg-6 col-12">
						    <label for="nc" class="form-label">Artikel Ilmiah dalam jurnal yang belum terakreditasi Dikti, jurnal ilmiah, koran, diktat (NC)</label>
						    <input type="number" min="0" class="form-control" id="nc" value="<?= set_value('nc', 0) ?>" name="nc" required placeholder="">
						    <?= isset($error['nc']) ? $error['nc'] : ''  ?>
						</div>
						<div class="mb-3 col-lg-6 col-12">
						    <label for="haki" class="form-label">Artikel Ilmiah yang memperoleh HAKI</label>
						    <input type="number" min="0" class="form-control" id="haki" value="<?= set_value('haki', 0) ?>" name="haki" required placeholder="">
						    <?= isset($error['haki']) ? $error['haki'] : ''  ?>
						</div>
					</div>
					<a href="<?= base_url('scientific_articles') ?>" class="btn app-btn-secondary" >Kembali</a>
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
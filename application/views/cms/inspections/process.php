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
			    <form class="settings-form" enctype="multipart/form-data" method="post" action="<?= base_url('inspections/store_process/'.encrypt_decrypt('encrypt', $inspections->id)) ?>">
			    	<div class="row">
			    		<div class="col-lg-10 col-8">
					    	<div class="mb-3">
					    		<label for="patient_id" class="form-label">Pasien</label>
					    		<select class="form-control select2-tag" name="patient_id" id="patient_id">
					    			<option value="<?= $inspections->patient_id ?>" selected
						    				data-code="<?= $inspections->patient->code ?>"
						    				data-name="<?= $inspections->patient->name ?>"
						    				data-age='<?= $inspections->patient->age ?>'
						    				data-address="<?= $inspections->patient->address ?>"
						    				data-phone="<?= $inspections->patient->phone ?>"
						    				data-email="<?= $inspections->patient->email ?>"
						    				data-gender="<?= $inspections->patient->gender ?>"

					    				><?= $inspections->patient->name ?></option>
					    		</select>
					    		<?= isset($error['patient_id']) ? $error['patient_id'] : ''  ?>
					    	</div>
			    		</div>
			    		<div class="col-lg-1 col-2 text-end">
			    			<button type="button" class="btn mt-4  btn-sm btn-primary" onclick="showPatient()"><span class="fa fa-magnifying-glass"></span></button>
			    		</div>
			    		<div class="col-lg-1 col-1">
			    			<a class="btn mt-4  btn-sm btn-primary" target="_blank" href="<?= base_url('patients/create') ?>"><span class="fa fa-plus"></span></a>
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-lg-6 col-12 col-md-6">
					    	<div class="mb-2">
					    		<label for="code">Kode Pemeriksaan</label>
					    		<input type="text" readonly name="code" id="code" value="<?= $inspections->code ?>" class="form-control">
							    <?= isset($error['code']) ? $error['code'] : ''  ?>
					    	</div>
			    		</div>
			    		<div class="col-lg-6 col-12 col-md-6">
	    			    	<div class="mb-2">
	    			    		<label for="date">Tanggal Pemeriksaan</label>
	    			    		<input type="date" name="date" id="date" readonly value="<?= set_value('date', $inspections->date) ?>" class="form-control">
	    					    <?= isset($error['date']) ? $error['date'] : ''  ?>
	    			    	</div>
			    		</div>
			    	</div>
			    	<div class="row mb-3">
			    		<div class="col-lg-6 col-12 col-md-6">
			    			<div class="form-floating">
			    				<textarea class="form-control" placeholder="Masukkan Keluhan Pasien" id="symptom" name="symptom" style="height: 100px"><?= set_value('symptom', $inspections->symptom) ?></textarea>
			    				<label for="symptom">Keluhan</label>
							    <?= isset($error['symptom']) ? $error['symptom'] : ''  ?>
			    			</div>
			    		</div>
			    		<div class="col-lg-6 col-12 col-md-6">
	    			    	<div class="form-floating">
			    				<textarea class="form-control" placeholder="Masukkan Diagnosa" id="diagnosis" name="diagnosis" style="height: 100px"><?= set_value('diagnosis', $inspections->diagnosis) ?></textarea>
			    				<label for="diagnosis">Diagnosa</label>
							    <?= isset($error['diagnosis']) ? $error['diagnosis'] : ''  ?>
			    			</div>
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-lg-4 col-12 col-md-6">
					    	<div class="mb-2">
					    		<label for="tension">Tensi Darah</label>
					    		<input type="number" name="tension" id="tension" value="<?= $inspections->tension ?>" class="form-control">
							    <?= isset($error['tension']) ? $error['tension'] : ''  ?>
					    	</div>
			    		</div>
			    		<div class="col-lg-4 col-12 col-md-6">
	    			    	<div class="mb-2">
					    		<label for="height">Tinggi Badan</label>
					    		<input type="number" name="height" id="height" value="<?= $inspections->height ?>" class="form-control">
							    <?= isset($error['height']) ? $error['height'] : ''  ?>
					    	</div>
			    		</div>
			    		<div class="col-lg-4 col-12 col-md-6">
	    			    	<div class="mb-2">
					    		<label for="weight">Berat Badan</label>
					    		<input type="number" name="weight" id="weight" value="<?= $inspections->weight ?>" class="form-control">
							    <?= isset($error['weight']) ? $error['weight'] : ''  ?>
					    	</div>
			    		</div>
			    	</div>
			    	<div class="row mt-3">
		    			<label class="mb-2">Data Tindakan</label>

		    			<?php 
		    				$recipes = isset($inspections->recipe) ? $inspections->recipe->transaction->toArray() : [];
		    				// $recipe = json_decode($recipe);
		    				// $recipes = [];
		    				// foreach ($recipe as $key => $value) {
		    				// 	$recipes[] = (array) $value;
		    				// }
		    			foreach ($medicines as $key => $value):  ?>
		    				<div class="col-lg-6 col-md-6 col-12">
		    					<ul>
		    						<li>
		    							<?= $key ?>
		    						<?php foreach ($value as $key_med => $medic): $id= encrypt_decrypt('encrypt', $medic->id);
		    							$keys = array_search($medic->id, array_column($recipes, "medicine_id"));
		    						 ?>
		    							<ul>
			    							<li style="list-style-type: none;">
	    										<div class="col-lg-6 col-12">
						    		      			<div class="form-check">
						    		      			  <input 
						    		      			  		class="form-check-input treatment" 
						    		      			  		type="checkbox" 
		    										  		<?= $keys !== false ? 'checked' : ''  ?>
						    		      			  		value="<?= $medic->name ?>" 
						    		      			  		name="treatment[<?= $id ?>]" 
						    		      			  		id="treathment-<?= $id ?>">
				    		      					  <input type="hidden" 
				    		      					  value="<?= $medic->selling_price ?>" 
				    		      					  name="price[<?= $id ?>]" 
				    		      					  id="treathment-price-<?= $id ?>">
				    		      					  <input type="hidden" 
				    		      					  value="<?= $medic->id ?>" 
				    		      					  name="medic[<?= $id ?>]" 
				    		      					  id="medic-id-<?= $id ?>">

						    		      			  <label 
						    		      			  		class="form-check-label" 
						    		      			  		for="treathment-<?= $id ?>">
						    		      			    <?= $medic->name ?>
			    										    <div class="form-floating" <?= $keys !== false ? '' : 'hidden'  ?> id="form-qty-<?= $id ?>">

						    		      			    		
				    										    <input type="number" 
				    										    class="form-control form-control-sm" 
				    										    id="qty-<?= $id ?>" <?= $keys !== false ? '' : 'disabled'  ?> 
				    										    value="<?= isset($recipes[$keys]) ? $recipes[$keys]['qty'] : 1 ?>";
				    										    name="qty[<?= $id ?>]">
				    										    <label for="qty-<?= $id ?>">QTY</label>
							    		      			    </div>
						    		      			  </label>
						    		      			</div>
						    		      		</div>
			    							</li>
		    							</ul>
		    						<?php endforeach ?>
		    						</li>
		    					</ul>

					    		
				    		</div>
		    			<?php endforeach ?>

			    	</div>
			    	<div class="mb-3">
			    		<label for="cost">Biaya Pemeriksaan</label>
				    	<div class="input-group">
				    		<span class="input-group-text" id="basic-addon1">Rp.</span>
				    		<input type="number" name="cost" id="cost" value="<?= set_value('cost',$inspections->cost) ?>" class="form-control" placeholder="Biaya Pemeriksaan" >
				    	</div>
					    <?= isset($error['cost']) ? $error['cost'] : ''  ?>
			    	</div>
			    	<a href="<?= base_url($this->uri->segment(1)) ?>" class="btn btn-secondary">Kembali</a>
			    	<button class="btn btn-primary">Simpan</button>
			    </form>
		    </div>
		 </div>
	</div>
</div>

<div class="modal fade" id="modal-detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<table class="table" width="100%">
					<tbody id="data-valid">
						<tr>
							<td width="39%">Kode</td>
							<td width="1%">:</td>
							<td id="data-code"></td>
						</tr>
						<tr>
							<td width="39%">Nama</td>
							<td width="1%">:</td>
							<td id="data-name"></td>
						</tr>
						<tr>
							<td width="39%">Usia</td>
							<td width="1%">:</td>
							<td id="data-age"></td>
						</tr>
						<tr>
							<td width="39%">Jenis Kelamin</td>
							<td width="1%">:</td>
							<td id="data-gender"></td>
						</tr>
						<tr>
							<td width="39%">Alamat</td>
							<td width="1%">:</td>
							<td id="data-address"></td>
						</tr>
						<tr>
							<td width="39%">No. HP</td>
							<td width="1%">:</td>
							<td id="data-phone"></td>
						</tr>
						<tr>
							<td width="39%">Email</td>
							<td width="1%">:</td>
							<td id="data-email"></td>
						</tr>
					</tbody>
					<tbody id="data-invalid" class="text-center">
						<tr>
							<td>Silahkan Pilih Pasien Terlebih dahulu</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

	$(".treatment").change(function(){
		var id = $(this).attr('id');
		var ids = id.split('-');
		var idQty = `qty-${ids[1]}`;


		if ($(`#${id}`).is(':checked')) {
			$(`#form-${idQty}`).attr('hidden',false)
			$(`#${idQty}`).attr('disabled',false)
		}else{
			$(`#form-${idQty}`).attr('hidden',true)
			$(`#${idQty}`).attr('disabled',true)
		}
	})

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
	        // $(this).data('placeholder');
	    }
	});
	$(".select2-tag").select2({
		tags:true,
		theme:'bootstrap-5',
		placeholder: function(){
	        // $(this).data('placeholder');
	    }
	});

	function showPatient()
	{
		var patient 	= $("#patient_id option:selected");
		var patient_id 	= patient.val()
		var code 		= patient.data('code')
		var name 		= patient.data('name')
		var age 		= patient.data('age')
		var address 	= patient.data('address')
		var phone 		= patient.data('phone')
		var email 		= patient.data('email')
		var gender 		= patient.data('gender')



		if (patient_id) {
			$("#data-valid").attr('hidden',false)
			$("#data-invalid").attr('hidden',true)
			$("#data-code").text(code)
			$("#data-name").text(name)
			$("#data-age").text(`${age.year} Tahun ${age.month} Bulan`)
			$("#data-address").text(address)
			$("#data-gender").text(gender)
			$("#data-phone").text(phone)
			$("#data-email").text(email)
		}else{
			$("#data-valid").attr('hidden',true)
			$("#data-invalid").attr('hidden',false)
		}

		$("#modal-detail").modal('show')
	}
</script>
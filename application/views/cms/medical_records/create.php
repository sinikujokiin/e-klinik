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
			    <form class="settings-form" enctype="multipart/form-data" method="post" action="<?= base_url('create_medical_records/store') ?>">
			    	<div class="row">
			    		<div class="col-lg-10 col-8">
					    	<div class="mb-3">
					    		<label for="patient_id" class="form-label">Pasien</label>
					    		<select class="form-control select2-tag" name="patient_id" id="patient_id" data-placeholder="Pilih Pasien">
					    			<option></option>
					    			<?php foreach ($patients as $key => $value): ?>
						    			<option 
						    				data-code="<?= $value->code ?>"
						    				data-name="<?= $value->name ?>"
						    				data-age="<?= $value->age ?>"
						    				data-address="<?= $value->address ?>"
						    				data-phone="<?= $value->phone ?>"
						    				data-email="<?= $value->email ?>"
						    				data-gender="<?= $value->gender ?>"
						    				value="<?= $value->id ?>"><?= $value->name ?></option>
					    			<?php endforeach ?>
					    		</select>
					    		<?= isset($error['patient_id']) ? $error['patient_id'] : ''  ?>
					    	</div>
			    		</div>
			    		<div class="col-lg-1 col-2">
			    			<button type="button" class="btn btn-sm btn-primary" onclick="showPatient()">Lihat</button>
			    		</div>
			    		<div class="col-lg-1 col-1">
			    			<a class="btn btn-sm btn-primary" href="<?= base_url('patients/create') ?>"><span class="fa fa-plus"></span></a>
			    		</div>
			    	</div>
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
			$("#data-age").text(age)
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
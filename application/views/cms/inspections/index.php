<div class="row g-3 mb-4 align-items-center justify-content-between">
	<div class="col-auto">
		<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
	</div>
	<div class="col-auto">
		<div class="page-utilities">
			<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
				<div class="col-auto">						    
					<?php if (cekAccess($this->uri->segment(1), 'create')): ?>
					<a class="btn app-btn-secondary" href="<?= base_url('inspections/create') ?>">
						<i class="fa fa-plus"></i>
						Tambah <?= $title ?>
					</a>
					<?php endif ?>
				</div>
			</div><!--//row-->
		</div><!--//table-utilities-->
	</div><!--//col-auto-->
</div><!--//row-->
<div class="card mb-3">
	<?php $start = $this->input->get('start'); $end = $this->input->get('end'); ?>
	<form>
		
		<div class="card-body table-responsive">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-6">
					<div class="form-floating mb-3">
						<input type="date" class="form-control" value="<?= $start ? $start : ''  ?>" id="start" name="start">
						<label for="start">Awal</label>
					</div>
				</div>
				<div class="col-lg-5 col-md-5 col-6">
					<div class="form-floating mb-3">
						<input type="date" class="form-control" value="<?= $end ? $end : ''  ?>" id="end" max="<?= date("Y-m-d") ?>" name="end">
						<label for="end">Akhir</label>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-2 ">
					<button class="btn btn-primary"><span class="fa fa-filter"></span></button>
				</div>
			</div>
		</div>
	</form>
</div>

<?php if ($this->session->flashdata('alert')): ?>
	<?= $this->session->flashdata('alert'); ?>
<?php endif ?>

<div class="tab-content" id="orders-table-tab-content">
	<div class="card shadow-sm mb-5">
		<div class="card-body">
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th class="cell" width="1%">No</th>
							<th class="cell" width="10%">Tanggal Pemeriksaan</th>
							<th class="cell">Kode RM</th>
							<th class="cell text-center" width="15%">Kode Pemeriksaan</th>
							<th class="cell">Nama</th>
							<th class="cell">Keluhan</th>
							<th class="cell">Diagnosis</th>
							<th class="cell">Tindakan</th>
							<th class="cell text-center" width="10%">Status</th>
							<?php if (cekAccess($this->uri->segment(1), 'update') || cekAccess($this->uri->segment(1), 'detail') || cekAccess($this->uri->segment(1), 'delete') || cekAccess($this->uri->segment(1), 'process')) : ?>
							<th class="cell" width="5%">#</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($inspections as $value): ?>
						<tr>
							<td class="cell"><?= $no++ ?>.</td>
							<td class="cell"><?= date_format_indo($value->date) ?></td>
							<td class="cell"><?= $value->patient->code ?></td>
							<th class="cell text-center"><?= $value->code ?></th>
							<td class="cell"><?= $value->patient->name ?></td>
							<td class="cell"><?= $value->symptom ?></td>
							<td class="cell"><?= $value->diagnosis ?></td>
							<td class="cell">
								<?php if ($value->treatment): ?>
									
								<?php foreach (json_decode($value->treatment) as $key => $treat) {
									if ($key != count(json_decode($value->treatment))-1) {
										echo "$treat, ";
									}else{
										echo "$treat";
									}
								} ?>
								<?php endif ?>
							</td>
							<td class="cell text-center"><?= $value->status ?></td>
							<?php if (cekAccess($this->uri->segment(1), 'update') || cekAccess($this->uri->segment(1), 'delete') || (cekAccess($this->uri->segment(1), 'process') && $value->status != 'Telah mendapatkan resep' && $value->status != 'Selesai')): ?>
								
							<td class="cell">
								<div class="dropdown">
									<a class="btn app-btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
										Aksi
									</a>

									<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="z-index: 99999;">
										<?php if (cekAccess($this->uri->segment(1), 'process') && $value->status != 'Telah mendapatkan resep' && $value->status != 'Selesai'): ?>
											
										<li>
											<a class="dropdown-item" href="<?= base_url('inspections/process/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-refresh"></i> Proses
											</a>
										</li>
										<?php endif ?>
										<?php if (cekAccess($this->uri->segment(1), 'detail')): ?>
											
										<li>
											<a class="dropdown-item" href="<?= base_url('inspections/show/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-eye"></i> Detail
											</a>
										</li>
										<?php endif ?>
										<?php if (cekAccess($this->uri->segment(1), 'update') && (cekAccess($this->uri->segment(1), 'process') && $value->status != 'Selesai')): ?>
											
										<li>
											<a class="dropdown-item" href="<?= base_url('inspections/edit/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-pencil"></i> Ubah
											</a>
										</li>
										<?php endif ?>
										<?php if (cekAccess($this->uri->segment(1), 'delete') && $value->status != "Selesai"): ?>
											
										<li>

											<a class="dropdown-item" href="javascript:;" onclick="showModalDelete(this)" data-href="<?= base_url('inspections/destroy/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-trash"></i> Hapus
											</a>
										</li>
										<?php endif ?>
									</ul>
								</div>
							</td>
							<?php endif ?>
						</tr>

					<?php endforeach ?>

				</tbody>
			</table>
		</div><!--//table-responsive-->

	</div><!--//app-card-body-->		

</div><!--//app-card-->
</div><!--//tab-content-->

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
<script>
	$('.table').DataTable({
		dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column
                }
            }
        ],
        pageLength:50
	})
</script>
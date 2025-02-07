<div class="row g-3 mb-4 align-items-center justify-content-between">
	<div class="col-auto">
		<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
	</div>
	<div class="col-auto">
		<div class="page-utilities">
			<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
				<div class="col-auto">						    
					<?php if (cekAccess($this->uri->segment(1), 'create')): ?>
					<a class="btn app-btn-secondary" href="<?= base_url('recipes/create') ?>">
						<i class="fa fa-plus"></i>
						Tambah <?= $title ?>
					</a>
					<?php endif ?>
				</div>
			</div><!--//row-->
		</div><!--//table-utilities-->
	</div><!--//col-auto-->
</div><!--//row-->

<?php if ($this->session->flashdata('alert')): ?>
	<?= $this->session->flashdata('alert'); ?>
<?php endif ?>

<div class="tab-content" id="orders-table-tab-content">
	<div class="card shadow-sm mb-5">
		<div class="card-body">
			<div class="table-responsive">
				<table id="example" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th class="cell" width="1%">No</th>
							<th class="cell" width="10%">Code</th>
							<th class="cell">Nama Pasien</th>
							<th class="cell text-center" width="15%">Nama Dokter</th>
							<th class="cell text-center" width="15%">Nama Apoteker</th>
							<th class="cell text-nowrap" width="7%">Tanggal</th>
							<th class="cell text-center" width="10%">Status</th>
							<?php if (cekAccess($this->uri->segment(1), 'process') || cekAccess($this->uri->segment(1), 'print')): ?>
							<th class="cell" width="5%">#</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($recipes as $value): 
							$age = json_decode($value->age);
						?>
						<tr>
							<td class="cell text-nowrap"><?= $no++ ?>.</td>
							<td class="cell text-nowrap"><?= $value->code ?></td>
							<td class="cell text-nowrap"><?= $value->inspection->patient->name ?></td>
							<td class="cell text-nowrap"><?= isset($value->doctor) ? $value->doctor->name : '-' ?></td>
							<td class="cell text-nowrap"><?= isset($value->apoteker) ? $value->apoteker->name : '-' ?></td>
							<td class="cell text-nowrap"><?= $value->created_at ?></td>
							<td class="cell text-nowrap text-center"><?= $value->status ?></td>
							<?php if ((cekAccess($this->uri->segment(1), 'process') && $value->status != 'selesai') || cekAccess($this->uri->segment(1), 'print')): ?>
								
							<td class="cell text-nowrap">
								<div class="dropdown">
									<a class="btn app-btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
										Aksi
									</a>

									<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="z-index: 99999;">
								
										<?php if (cekAccess($this->uri->segment(1), 'process') && $value->status != 'selesai'): ?>
											
										<li>
											<a class="dropdown-item" href="<?= base_url('recipes/process/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-refresh"></i> Proses
											</a>
										</li>
										<?php endif ?>
										<?php if (cekAccess($this->uri->segment(1), 'print')): ?>
											
										<li>
											<a class="dropdown-item" href="<?= base_url('recipes/print/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-print"></i> Print
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


<script>
	$('#example').DataTable()
</script>
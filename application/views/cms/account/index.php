<div class="row g-3 mb-4 align-items-center justify-content-between">
	<div class="col-auto">
		<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
	</div>
	<div class="col-auto">
		<div class="page-utilities">
			<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
				<div class="col-auto">						    
					<?php if (cekAccess($this->uri->segment(1), 'create')): ?>
						
					<a class="btn app-btn-secondary" href="<?= base_url('accounts/create') ?>">
						<i class="fa fa-plus"></i>
						Tambah Data <?= $title ?>
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
							<th class="cell">Role</th>
							<th class="cell">Nama Lengkap</th>
							<th class="cell">Username</th>
							<th class="cell">Status</th>
							<th class="cell">Terakhir Login</th>
							<?php if (cekAccess($this->uri->segment(1), 'update') || cekAccess($this->uri->segment(1), 'delete')): ?>
								
							<th class="cell">#</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($account as $value): ?>
						<tr>
							<td class="cell"><?= $no++ ?>.</td>
							<td class="cell"><?= $value->role->name ?></td>
							<td class="cell"><?= $value->fullname ?></td>
							<td class="cell"><?= $value->username ?></td>
							<td class="cell"><?= $value->status ?></td>
							<td class="cell"><?= $value->last_login ? date_format_indo(date("Y-m-d", strtotime($value->last_login))) : '' ?></td>
							<?php if (cekAccess($this->uri->segment(1), 'update') || cekAccess($this->uri->segment(1), 'delete')): ?>
								
							<td class="cell">
								<div class="dropdown">
									<a class="btn app-btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
										Aksi
									</a>

									<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="z-index: 99999;">
										<?php if (cekAccess($this->uri->segment(1), 'update')): ?>
											
										<li>
											<a class="dropdown-item" href="<?= base_url('accounts/edit/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-pencil"></i> Ubah
											</a>
										</li>
										<?php endif ?>
										<?php if (cekAccess($this->uri->segment(1), 'delete')): ?>
											
										<li>

											<a class="dropdown-item" href="javascript:;" onclick="showModalDelete(this)" data-href="<?= base_url('accounts/destroy/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-trash"></i> Hapus
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
	$(document).ready(function () {
		$('#example').DataTable();
	});
</script>
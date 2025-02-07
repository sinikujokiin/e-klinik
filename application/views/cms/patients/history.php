<div class="row g-3 mb-4 align-items-center justify-content-between">
	<div class="col-auto">
		<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
	</div>
</div><!--//row-->
<?php $start = $this->input->get('start'); $end = $this->input->get('end') ?>
<div class="card mb-3">
	<div class="card-body">
			<form>
		<div class="row">
				<div class="col-lg-5 col-md-5 col-6">
					<div class="form-floating">
						<input type="date" name="start" value="<?= $start ?>" max="<?= date("Y-m-d") ?>" id="start" class="form-control">
						<label for="symptom">Awal</label>
					    <?= isset($error['start']) ? $error['start'] : ''  ?>
					</div>
				</div>
				<div class="col-lg-5 col-md-5 col-6">
					<div class="form-floating">
						<input type="date" name="end" value="<?= $end ?>" max="<?= date("Y-m-d") ?>" id="end" class="form-control">
						<label for="symptom">Akhir</label>
					    <?= isset($error['end']) ? $error['end'] : ''  ?>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-2 ">
					<button class="btn btn-primary"><span class="fa fa-filter"></span></button>
				</div>
		</div>
			</form>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table table-responsive">
			<table class="table table-striped" id="dt">
				<thead>
					<tr>
						<th>No. Periksa</th>
						<th>Tanggal</th>
						<th>Keluhan</th>
						<th>Diagnosa</th>
						<th>Tindakan</th>
						<th>Dokter</th>
						<th>Apoteker</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($patients->rm as $key => $value): ?>
					<tr>
						<th><?= $value->code ?></th>
						<td><?= date_format_indo($value->date) ?></td>
						<td><?= $value->symptom ?></td>
						<td><?= $value->diagnosis ?></td>
						<td>
								
							<?php if ($value->treatment): ?>
							<ol>
								<?php $no =1; foreach (json_decode($value->treatment) as $treat): ?>
									<li>
										<?= "$treat" ?>
										
									</li>
								<?php endforeach ?>
							</ol>
							<?php else: ?>
								-
							<?php endif ?>
						</td>
						<td><?= isset($value->recipe) ? isset($value->recipe->doctor) ? $value->recipe->doctor->name : '-' : '-'  ?></td>
						<td><?= isset($value->recipe) ? isset($value->recipe->apoteker) ? $value->recipe->apoteker->name : '-' : '-'  ?></td>
						<td><?= $value->status ?></td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
<script>
	$('#dt').DataTable({
		dom: 'Bfrtip',
        buttons: [
            'csv', 'excel'
        ],
        pageLength:50
	})
</script>
<!-- 
<div class="row">
	<?php foreach ($patients->rm as $key => $value): ?>
		<div class="col-xl-3 col-lg-4 col-md-6 col-12">
			<div class="card shadow-sm">
				<div class="card-body">
					<span class="card-title"><b><?= $value->code ?></b> - <?= date_format_indo($value->date) ?></span>
					<table width="100%" class="table">
						<tr>
							<td width="25%">Keluhan</td>
							<td width="1%">:</td>
							<td><?= $value->symptom ?></td>
						</tr>
						<tr>
							<td width="25%">Diagnosa</td>
							<td width="1%">:</td>
							<td><?= $value->diagnosis ?></td>
						</tr>
						<tr>
							<td width="25%">Tindakan</td>
							<td width="1%">:</td>
							<td>
								<?php if ($value->treatment): ?>
									<?php $no =1; foreach (json_decode($value->treatment) as $treat): ?>
										<?= $no++.".$treat" ?>
									<?php endforeach ?>
								<?php else: ?>
									-
								<?php endif ?>
									
							</td>
						</tr>
						<tr>
							<td width="25%">Dokter</td>
							<td width="1%">:</td>
							<td><?= isset($value->recipe) ? isset($value->recipe->doctor) ? $value->recipe->doctor->name : '-' : '-'  ?></td>
						</tr>
						<tr>
							<td width="25%">Apoteker</td>
							<td width="1%">:</td>
							<td><?= isset($value->recipe) ? isset($value->recipe->apoteker) ? $value->recipe->apoteker->name : '-' : '-'  ?></td>
						</tr>
						<tr>
							<td width="25%">Status</td>
							<td width="1%">:</td>
							<td><?= $value->status  ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div> -->
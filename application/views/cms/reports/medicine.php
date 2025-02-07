<div class="row g-3 mb-4 align-items-center justify-content-between">
	<div class="col-auto">
		<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
	</div>
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
<div class="card">
	<div class="card-body table-responsive">
		<table class="table" width="100%">
			<thead>
				<tr>
					<td width="1%">No.</td>
					<td>Tanggal</td>
					<td>Nama Obat</td>
					<td width="15%">QTY</td>
				</tr>
			</thead>
			<tbody>
				<?php $no =1 ;foreach ($reports as $key => $value): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= date_format_indo(date("Y-m-d", strtotime($value->created_at))).' '.date("H:i", strtotime($value->created_at)) ?></td>
						<td><?= $value->medicine->name ?></td>
						<td><?= $value->qty ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
<script>
	$('.table').DataTable({
		dom: 'Bfrtip',
        buttons: [
            'csv', 'excel'
        ],
        pageLength:50
	})
</script>
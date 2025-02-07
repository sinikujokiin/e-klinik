<div class="row g-3 mb-4 align-items-center justify-content-between">
	<div class="col-auto">
		<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
	</div>
</div><!--//row-->

<?php if ($this->session->flashdata('alert')): ?>
	<?= $this->session->flashdata('alert'); ?>
<?php endif ?>
<div class="card">
	<form method="POST">
		<div class="card-body">
			<table class="table">
				<tr>
					<td width="29%">Nama Pasien</td>
					<td width="1%">:</td>
					<td><?= $recipes->inspection->patient->name ?></td>
				</tr>
				<tr>
					<td width="29%">Keluhan</td>
					<td width="1%">:</td>
					<td><?= $recipes->inspection->symptom ?></td>
				</tr>
				<tr>
					<td width="29%">Diagnosa</td>
					<td width="1%">:</td>
					<td><?= $recipes->inspection->diagnosis ?></td>
				</tr>
				<tr>
					<td width="29%">Nama Dokter</td>
					<td width="1%">:</td>
					<td><?= isset($recipes->doctor) ? $recipes->doctor->name : '-' ?></td>
				</tr>
				<tr>
					<td width="29%">Nama Apoteker</td>
					<td width="1%">:</td>
					<td><?= isset($recipes->apoteker) ? $recipes->apoteker->name : '-' ?></td>
				</tr>
				<tr>
					<td width="29%">Resep</td>
					<td width="1%">:</td>
					<td>
						<ol>
							
						<?php foreach ($recipes->transaction as $key => $value): ?>
							<li><?= $value->medicine->name .' x '.$value->qty.' '.$value->medicine->unit ?></li>
						<?php endforeach ?>
						</ol>
					</td>
				</tr>
				<tr>
					<td width="29%">Status</td>
					<td width="1%">:</td>
					<td><?= $recipes->status ?></td>
				</tr>
			</table>
			<input type="hidden" name="process" value="true">
			<a href="<?= base_url('recipes') ?>" class="btn btn-secondary">Kembali</a>
			<?php if ($recipes->status == 'selesai'): ?>
			<a href="<?= base_url('recipes/print/'.encrypt_decrypt('encrypt', $recipes->id)) ?>" class="btn btn-secondary">Cetak</a>
			<?php else: ?>
			<button class="btn btn-primary">Selesai</button>
			<?php endif ?>
		</div>
	</form>
</div>
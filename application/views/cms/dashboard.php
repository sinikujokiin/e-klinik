<h1 class="app-page-title"><?= $title ?></h1>

<div class="row g-4 mb-4 justify-content-center">
	<div class="col-6 col-lg-3">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Jumlah Obat</h4>
				<div class="stats-figure"><?= $medicines ?></div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->

	<div class="col-6 col-lg-3">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Jumlah Pasien</h4>
				<div class="stats-figure"><?= $patients ?></div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->


	<div class="col-6 col-lg-3">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Jumlah Dokter</h4>
				<div class="stats-figure"><?= $doctors ?></div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->

	<div class="col-6 col-lg-3">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Jumlah Apoteker</h4>
				<div class="stats-figure"><?= $apoteker ?></div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->

	<div class="col-6 col-lg-3">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Jumlah Resep</h4>
				<div class="stats-figure"><?= $recipes ?></div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->

	<div class="col-6 col-lg-3">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Total Pemeriksaan</h4>
				<div class="stats-figure"><?= $inspections ?></div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->

</div><!--//row-->

<div class="row mt-3">
	<div class="col-lg-6 col-12">
		<div class="card">
			<div class="card-header text-center">
				Daftar Stok Lebih Kecil / Sama Dengan Batas Stok Minimal
			</div>
			<div class="card-body">
				<table class="table" width="100%">
					<thead>
						<tr>
							<th>Nama Obat</th>
							<th>Stok Minimal</th>
							<th>Stok</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($stockMin as $key => $value): ?>
							<tr>
								<td><?= $value->name ?></td>
								<td><?= $value->stock_min ?></td>
								<td><?= $value->stock ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
	<div class="col-lg-6 col-12">
		<div class="card">
			<div class="card-header text-center">
				Daftar Penggunaan Obat
			</div>
			<div class="card-body">
				<table class="table" width="100%">
					<thead>
						<tr>
							<th>Nama Obat</th>
							<th>Qty</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($lastOut as $key => $value): ?>
							<tr>
								<td><?= $value->medicine->name ?></td>
								<td><?= $value->qty ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>
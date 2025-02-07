<div id="print-include">
	
	<div class="row g-3 mb-4 align-items-center justify-content-between">
		<div class="col-auto">
			<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
		</div>
		<div class="col-auto" id="print-exclude">
			<div class="page-utilities">
				<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
					<div class="col-auto">						    
						<a href="<?= base_url('inspections') ?>" class="btn btn-secondary">Kembali</a>
						<button id="printButton" class="btn btn-secondary">Cetak</button>
					</div>
				</div><!--//row-->
			</div><!--//table-utilities-->
		</div><!--//col-auto-->
	</div><!--//row-->

	<div class="row">
		<div class="col-lg-4 col-12">
			<div class="card">
				<div class="card-header">
					<h5>Data Pasien</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-4">
							<b>
								No RM
							</b>
						</div>
						<div class="col-8">
							<?= $inspections->patient->code ?>
						</div>

						<div class="col-4">
							<b>
								Nama
							</b>
						</div>
						<div class="col-8">
							<?= $inspections->patient->name ?>
						</div>

						<div class="col-4">
							<b>
								Usia
							</b>
						</div>
						<div class="col-8">
							<?php $age = json_decode($inspections->patient->age) ?>
							<?= "$age->year Tahun $age->month Bulan" ?>
						</div>

						<div class="col-4">
							<b>
								JK
							</b>
						</div>
						<div class="col-8">
							<?= $inspections->patient->gender ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-12">
			<div class="card">
				<div class="card-header">
					<h5>Data Pemeriksaan</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-4">
							<b>
								Kode
							</b>
						</div>
						<div class="col-8">
							<?= $inspections->code ?>
						</div>

						<div class="col-4">
							<b>
								Tanggal
							</b>
						</div>
						<div class="col-8">
							<?= date_format_indo($inspections->date) ?>
						</div>

						<div class="col-4">
							<b>
								Tensi
							</b>
						</div>
						<div class="col-8">
							<?= "$inspections->tension mmHg" ?>
						</div>

						<div class="col-4">
							<b>
								Tinggi
							</b>
						</div>
						<div class="col-8">
							<?= "$inspections->height Cm" ?>
						</div>

						<div class="col-4">
							<b>
								Berat
							</b>
						</div>
						<div class="col-8">
							<?= "$inspections->weight Kg" ?>
						</div>

						<div class="col-4">
							<b>
								Keluhan
							</b>
						</div>
						<div class="col-8">
							<?= "$inspections->symptom" ?>
						</div>

						<div class="col-4">
							<b>
								Diagnosa
							</b>
						</div>
						<div class="col-8">
							<?= "$inspections->diagnosis" ?>
						</div>

						<div class="col-4">
							<b>
								Dokter
							</b>
						</div>
						<div class="col-8">
							<?= $inspections->doctor? $inspections->doctor->name : '-' ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if ($inspections->recipe): ?>	
			<div class="col-lg-4 col-12">
				<div class="card">
					<div class="card-header">
						<h5>Data Resep</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-4">
								<b>
									Kode Resep
								</b>
							</div>
							<div class="col-8">
								<?= $inspections->recipe->code ?>
							</div>

							<div class="col-12">
								<b>
									Obat / Tindakan
								</b>
							</div>

							<?php foreach ($inspections->recipe->transaction as $key => $value): ?>
								<div class="col-1">
								</div>
								<div class="col-8">
										<?= $value->medicine->name ?>
								</div>
								<div class="col-3">
										<?= "$value->qty ". $value->medicine->unit ?>
								</div>
							<?php endforeach ?>

							<div class="col-4">
								<b>
									Apoteker
								</b>
							</div>
							<div class="col-8">
								<?= isset($inspections->recipe->apoteker)?$inspections->recipe->apoteker->name : '-' ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>

	</div>
</div>

<script>
  $(document).ready(function() {
    $('#printButton').click(function() {
      var showpPrint = $('#print-include').clone();
      showpPrint.find('#print-exclude').remove();
      var content = showpPrint.html()
      // console.log(showpPrint)
      var newWindow = window.open('', '');
      newWindow.document.open();
      newWindow.document.write(`<html><head><title>Cetak</title></head>
		<link id="theme-style" rel="stylesheet" href="<?= base_url() ?>assets/css/portal.css">
		<style>.card{margin-bottom:5px}</style>
      	<body><div style="margin:25px">` + content + `</div>
      	</body>
      	</html>`);
      newWindow.document.close();
      newWindow.print();
    });
  });
</script>

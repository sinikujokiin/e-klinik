<div >
	
	<div class="row g-3 mb-4 align-items-center justify-content-between">
		<div class="col-auto">
			<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
		</div>
		<div class="col-auto" id="print-exclude">
			<div class="page-utilities">
				<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
					<div class="col-auto">						    
						<a href="<?= base_url('recipes') ?>" class="btn btn-secondary">Kembali</a>
						<button id="printButton" class="btn btn-secondary">Cetak</button>
					</div>
				</div><!--//row-->
			</div><!--//table-utilities-->
		</div><!--//col-auto-->
	</div><!--//row-->

	<div class="row justify-content-center" id="print-include">
		<div class="col-lg-6 col-12">
			<div class="card">
				<div class="card-header">
					<h5>Resep <?= $recipes->code ?></h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-4 col-6"><?= date_format_indo(date("Y-m-d", strtotime($recipes->created_at))).' '. date("H:i", strtotime($recipes->created_at)) ?></div>
						<div class="col-lg-8 col-6"></div>

						<div class="col-lg-4 col-6">Nama Pasien</div>
						<div class="col-lg-8 col-6"><?= $recipes->inspection->patient->name  ?></div>

						<div class="col-lg-4 col-6">Resep</div>
						<div class="col-lg-8 col-6">
							<ol>
								
							<?php foreach ($recipes->transaction as $key => $value): ?>
								<li><?= $value->medicine->name .' x '.$value->qty.' '.$value->medicine->unit ?></li>
							<?php endforeach ?>
							</ol>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1"></div>
						<div class="col-4">
							<div class="text-center">
								Dokter <hr>
								<?= isset($recipes->doctor) ? $recipes->doctor->name : '-'  ?>
							</div>
						</div>
						<div class="col-2"></div>
						<div class="col-4">
							<div class="text-center">
								Apoteker <hr>
								<?= isset($recipes->apoteker) ? $recipes->apoteker->name : '-'  ?>
							</div>
						</div>
						<div class="col-1"></div>
					</div>
				</div>
			</div>
		</div>
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

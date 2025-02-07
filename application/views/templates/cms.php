<!DOCTYPE html>
<html lang="en"> 
<head>
	<title> <?= web()->name ?> | <?= $title ?></title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="Website Penjamin Mutu Dosen">
	<meta name="author" content="Admin">    
	<link rel="shortcut icon" href="<?= base_url(web()->icon) ?>"> 

	<!-- FontAwesome JS-->
	<script defer src="<?= base_url() ?>assets/plugins/fontawesome/js/all.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

	<style type="text/css">
		i.bi {
			font-size: 1.3rem !important;
		}
	</style>

	<!-- App CSS -->  
	<link id="theme-style" rel="stylesheet" href="<?= base_url() ?>assets/css/portal.css">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript" charset="utf-8"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript"> var base_url =  `<?= base_url()?>`</script>
</head> 

<body class="app">   	
	<header class="app-header fixed-top">	   	            
		<div class="app-header-inner">  
			<div class="container-fluid py-2">
				<div class="app-header-content"> 
					<div class="row justify-content-between align-items-center">

						<div class="col-auto">
							<a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
							</a>
						</div><!--//col-->
						<div class="app-utilities col-auto">
							<div class="app-utility-item app-notifications-dropdown dropdown">    
												        
							</div><!--//app-utility-item-->

							<div class="app-utility-item app-user-dropdown dropdown">
								<a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
									<?= strtoupper(user()->fullname ? user()->fullname : user()->username) ?>
								</a>
								<ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
									<!-- <li><a class="dropdown-item" href="<?= base_url('account') ?>">Akun</a></li>
									<li><a class="dropdown-item" href="<?= base_url('settings') ?>">Pengaturan</a></li> -->
									<!-- <li><hr class="dropdown-divider"></li> -->
									<li><a class="dropdown-item" href="<?= base_url('logout') ?>">Keluar</a></li>
								</ul>
							</div><!--//app-user-dropdown--> 
						</div><!--//app-utilities-->
					</div><!--//row-->
				</div><!--//app-header-content-->
			</div><!--//container-fluid-->
		</div><!--//app-header-inner-->
		<div id="app-sidepanel" class="app-sidepanel"> 
			<div id="sidepanel-drop" class="sidepanel-drop"></div>
			<div class="sidepanel-inner d-flex flex-column">
				<a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
				<div class="app-branding text-center">
					<a class="app-logo" href="<?= base_url('dashboard') ?>">
						<img class="logo-icon me-2" src="<?= base_url(web()->logo) ?>" alt="logo">
						<!-- <span class="logo-text"></span> -->
						<br>
						<small><?= web()->name ?></small>
					</a>

				</div><!--//app-branding-->  

				<nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
					<ul class="app-menu list-unstyled accordion" id="menu-accordion">
						<?php 
						$menus = getMenu();
						// var_dump($menu->toArray());die;
						foreach ($menus as $lv1): ?>

							<?php if (count($lv1->children) == 0): ?>
								<li class="nav-item">
									<a class="nav-link" orihref="<?= encrypt_decrypt('encrypt', $lv1->url) ?>" href="<?= base_url($lv1->url) ?>">
										<span class="nav-icon">
											<i class="<?= $lv1->icon ?>"></i>
										</span>
										<span class="nav-link-text"><?= $lv1->name ?></span>
									</a><!--//nav-link-->
								</li><!--//nav-item-->
							<?php else: ?>
								<li class="nav-item has-submenu">
						        <a class="nav-link submenu-toggle" id="<?= encrypt_decrypt('encrypt', $lv1->id) ?>" href="#" orihref="<?= encrypt_decrypt('encrypt', $lv1->url) ?>" data-bs-toggle="collapse" data-bs-target="#submenu-<?= encrypt_decrypt('encrypt', $lv1->id) ?>" aria-expanded="false" aria-controls="submenu-<?= encrypt_decrypt('encrypt', $lv1->id) ?>">
							        <span class="nav-icon"><i class="<?= $lv1->icon ?>"></i></span>
			                         <span class="nav-link-text"><?= $lv1->name ?></span>
			                         <span class="submenu-arrow">
			                         	<span class="bi bi-chevron-down"></span>
		                             </span><!--//submenu-arrow-->
						        </a><!--//nav-link-->
						        <div id="submenu-<?= encrypt_decrypt('encrypt', $lv1->id) ?>" class="collapse submenu submenu-<?= encrypt_decrypt('encrypt', $lv1->id) ?>" data-bs-parent="#menu-accordion">
							        <ul class="submenu-list list-unstyled">
							        	<?php foreach ($lv1->children as $lv2): ?>
									        <li class="submenu-item"><a class="submenu-link"
									        orihref="<?= encrypt_decrypt('encrypt', $lv2->url) ?>"
									         parent="<?= encrypt_decrypt('encrypt', $lv1->id) ?>" href="<?= base_url($lv2->url) ?>"><?= $lv2->name ?></a></li>
							        	<?php endforeach ?>
							        </ul>
						        </div>
						    </li><!--//nav-item-->

							<?php endif ?>
						<?php endforeach ?>
					    </nav><!--//app-nav-->

					  </div><!--//sidepanel-inner-->
					</div><!--//app-sidepanel-->
				</header><!--//app-header-->

				<div class="app-wrapper">

					<div class="app-content pt-3 p-md-3 p-lg-4">
						<div class="container-xl">					
							<?= $contents ?>

						</div><!--//container-fluid-->
					</div><!--//app-content-->
					<div class="modal fade" id="modal-delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-body text-center">
									<span style="font-size: 20px; font-weight: bold;">
										Yakin ingin menghapus data ?
									</span>
									<p>Data yang sudah dihapus tidak bisa dikembalikan lagi.</p>
								</div>
								<div class="modal-footer text-center">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
									<a href="#" title="Hapus Data" class="btn app-btn-primary" id="btn-submit-delete">Ya</a>
								</div>
							</div>
						</div>
					</div>
	    <!-- <footer class="app-footer fixed-bottom" style="bottom: 0;">
		    <div class="container text-center py-3">
            <small class="copyright">&copy; '.date('Y') ?> </small>
		       
		    </div>
		  </footer> -->

		</div><!--//app-wrapper-->    	


		<!-- Javascript -->          
		<script src="<?= base_url() ?>assets/plugins/popper.min.js"></script>
		<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>  



		<!-- Page Specific JS -->
		<script src="<?= base_url() ?>assets/js/app.js"></script> 
		<script>
			window.setTimeout(function(){
				$('.alert').fadeTo(500, 0).slideUp(500,function(){
					$(this).remove();
				});
			}, 3000);

			function showModalDelete(dt)
			{
				var href = $(dt).data('href');

				$("#modal-delete").modal('show')
				$("#btn-submit-delete").attr('href', href);

			}

			// Get the current URL
			var currentUrl = `<?= encrypt_decrypt('encrypt',$this->uri->segment(1))?>`;
			// console.log(currentUrl)
			// Select all menu items
			var menuItems = $('#menu-accordion a');

			var active = $(menuItems).filter(function() {
			    return $(this).attr('orihref') == currentUrl;
			});

			var parent_id = active.attr('parent');
			$(`#${parent_id}`).addClass('active').siblings().removeClass('active')
			$(`#submenu-${parent_id}`).addClass('show').siblings().removeClass('show')
			active.addClass('active').siblings().removeClass('active'); 


		</script>

	</body>
	</html> 


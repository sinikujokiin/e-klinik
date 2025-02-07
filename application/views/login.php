<!DOCTYPE html>
<html lang="en"> 
<head>
    <title><?= $title ?></title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="<?= base_url() ?>assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="<?= base_url() ?>assets/css/portal.css">

</head> 

<body class="app app-login p-0">    	
    <div class="row g-0 justify-content-center app-auth-wrapper" style="background-color: unset !important;">
	    <div class="col-12 col-md-8 col-lg-6 auth-main-col text-center p-5">
	    	<div class="card">
			    <div class="d-flex card-body flex-column align-content-end" style="margin-top: 2rem; margin-bottom: 2rem;">
				    <div class="app-auth-body my-auto mx-auto">	
					    <div class="app-auth-branding mb-4">
					    	<a class="app-logo" href="<?= base_url() ?>">
					    		<img class="me-2" width="50%" src="<?= base_url(web()->logo) ?>"  alt="logo">
					    	</a>
						<h4 class="text-center mb-5"><?= web()->name ?></h4>
					    </div>
				        <div class="auth-form-container text-start">
				        	<?php if ($this->session->flashdata('alert')): ?>
				        		<?= $this->session->flashdata('alert'); ?>
				        	<?php endif ?>
							<form class="auth-form login-form" method="POST">         
								<div class="email mb-3">
									<label class="sr-only" for="username">Username</label>
									<input id="username" name="username" value="<?= set_value('username') ?>" type="text" class="form-control username" placeholder="Username" required="required">
								</div><!--//form-group-->
								<div class="password mb-3">
									<label class="sr-only" for="password">Password</label>
									<input id="password" name="password" type="password" class="form-control password" placeholder="Password" required="required">
								</div><!--//form-group-->
								<div class="text-center">
									<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Masuk</button>
								</div>
							</form>
							
							<!-- <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="signup.html" >here</a>.</div> -->
						</div><!--//auth-form-container-->	

				    </div><!--//auth-body-->
			    </div><!--//flex-column-->   
	    		
	    	</div>
	    </div><!--//auth-main-col-->
	    
    
    </div><!--//row-->
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript" charset="utf-8"></script>


    <script>
    		window.setTimeout(function(){
    	      $('.alert').fadeTo(500, 0).slideUp(500,function(){
    	        $(this).remove();
    	      });
    	    }, 3000);
    </script>
</body>
</html> 


<style>
	body, .container-login100, .container-logo, .limiter {
		background-color: rgba(129, 58, 0, 1);
	}
	.login100-form-title{
		color: rgba(129, 58, 0, 1);
	}
	.wrap-login100{
		width: 430px;
	}
	.sign-in-login100{
		background-color: rgba(129, 58, 0, 1);
		border-radius: 10px;
		height: 45px;
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.logo-login100{
		width: 150px;
		align-content: center;
	}
	.input100{
		height: 44px !important;
	}
</style>
<div class="limiter">
	<div class="flex-row p-t-40 m-b-30 container-logo justify-content-center">
			<a href="<?php echo base_url() ?>" class="logo-login100">
				<img class="logo-login100" src="<?php echo base_url('assets/upload/image/'.$site->logo) ?>" alt="<?php echo $site->namaweb ?> | <?php echo $site->tagline ?>">
			</a>
	</div>
	<div class="container-login100">
		<div class="wrap-login100 p-l-40 p-r-40 p-t-30 p-b-30">
			<!-- <form class="login100-form validate-form"> -->
				<span class="login100-form-title p-b-33">
					<?php echo $title ?>
				</span>

				<?php 
				// Display error
				echo validation_errors('<div class="alert alert-warning">','</div>');
				// Display notifikasi error login
				if($this->session->flashdata('warning')){
					echo '<div class="alert alert-warning">';
					echo $this->session->flashdata('warning');
					echo '</div>';
				}
				// Display notifikasi sukses logout
				if($this->session->flashdata('logout')){
					echo '<div class="alert alert-success">';
					echo $this->session->flashdata('logout');
					echo '</div>';
				}
				// form open
				echo form_open(base_url('masuk'), 'class="leave-comment"'); 
				?>

				
				
				<!-- EMAIL -->
				<div class="wrap-input100 validate-input">
					<input class="input100 form-control" type="email" name="email" placeholder="Email">
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>
				
				<!-- PASSWORD -->
				<div class="wrap-input100 rs1 validate-input m-t-10">
					<input class="input100 form-control" type="password" name="password" placeholder="Password">
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>

				<div class="container-login100-form-btn m-t-20">
					<button class="login100-form-btn sign-in-login100" type="submit">
						Masuk
					</button>
				</div>

				<div class="text-center p-t-15 p-b-4">
					<span class="txt1">
						Lupa
					</span>

					<a href="#" class="txt2 hov1">
						password?
					</a>
				</div>

				<div class="text-center p-b-20">
					<span class="txt1">
						Belum memiliki akun? Silahkan
					</span>
					<a href="<?php echo base_url('registrasi') ?>" class="txt2 hov1">
						registrasi di sini
					</a>
				</div>

				<div class="text-center p-b-10">
					<span class="txt1">
						Atau masuk dengan
					</span>
				</div>

				<!-- Login dengan Google -->
				<div class="row text-center social-btn justify-content-center">
					<div class="col-6 p-r-3">
				    	<a href="<?php echo base_url('google') ?>" class="btn btn-danger btn-block"><i class="fa fa-google"></i> <b class="flex">Google</b></a>
				    </div>
					<div class="col-6 p-l-3">
				    	<a href="#" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> <b>Facebook</b></a>	
				    </div>
				</div>
			<?php echo form_close(); ?>
		</div>
		
	</div>
</div>
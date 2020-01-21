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
				if($this->session->flashdata('sukses')) {
					echo '<div class="alert alert-warning">';
					echo $this->session->flashdata('sukses');
					echo '</div>';
				} 
	
				// form open
				echo form_open(base_url('masuk/lupa'), 'class="leave-comment"'); 
				?>
				
				<!-- EMAIL -->
				<div class="wrap-input100 validate-input">
					<input class="input100 form-control" type="email" name="email" placeholder="Masukkan Email Anda..." required>
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>

				<div class="container-login100-form-btn m-t-20">
					<button class="login100-form-btn sign-in-login100" type="submit">
						Reset Password
					</button>
				</div>

				<div class="text-center p-t-25 p-b-20">
					<a href="<?php echo base_url('masuk') ?>" class="txt2 hov1">
						Kembali ke halaman masuk
					</a>
				</div>

			<?php echo form_close(); ?>
		</div>
		
	</div>
</div>
<style>
	.container-login100{
		background-color: rgba(129, 58, 0, 1);
	}
	.wrap-login100{
		width: 430px;
	}
	.sign-in-login100{
		background-color: rgba(129, 58, 0, 1);
		border-radius: 30px;
	}
	.logo-login100{
		width: 150px;
		align-content: center;
	}
	.container-logo{
		/*display: inline;*/
	}
</style>
<div class="limiter">
	<div class="container-login100">
		<div class="flex-row p-l-55 p-r-55 p-t-65 p-b-50 container-logo">
			<a href="<?php echo base_url() ?>" class="logo-login100 justify-content-center">
				<img class="logo-login100" src="<?php echo base_url('assets/upload/image/'.$site->logo) ?>" alt="<?php echo $site->namaweb ?> | <?php echo $site->tagline ?>">
			</a>
		</div>
		
		<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
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
				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input class="input100" type="text" name="email" placeholder="Email">
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>
				
				<!-- PASSWORD -->
				<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
					<input class="input100" type="password" name="pass" placeholder="Password">
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>

				<div class="container-login100-form-btn m-t-20 ">
					<button class="login100-form-btn sign-in-login100">
						Login
					</button>
				</div>

				<div class="text-center p-t-25 p-b-4">
					<span class="txt1">
						Lupa
					</span>

					<a href="#" class="txt2 hov1">
						Password?
					</a>
				</div>

				<div class="text-center">
					<span class="txt1">
						Belum memiliki akun? Silahkan
					</span>

					<a href="<?php echo base_url('registrasi') ?>" class="txt2 hov1">
						Registrasi Disini
					</a>
				</div>
			<?php echo form_close(); ?>
		</div>
		
	</div>
</div>
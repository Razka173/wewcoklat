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
	<div class="flex-row p-t-20 m-b-15 container-logo justify-content-center">
			<a href="<?php echo base_url() ?>" class="logo-login100">
				<img class="logo-login100" src="<?php echo base_url('assets/upload/image/'.$site->logo) ?>" alt="<?php echo $site->namaweb ?> | <?php echo $site->tagline ?>">
			</a>
	</div>
	<div class="container-login100">
		<div class="wrap-login100 p-l-40 p-r-40 p-t-25 p-b-25">
			<!-- <form class="login100-form validate-form"> -->
				<span class="login100-form-title p-b-30">
					<?php echo $title ?>
				</span>

				<?php 
				if($this->session->flashdata('warning')){
					echo '<div class="alert alert-warning">';
					echo $this->session->flashdata('warning');
					echo '</div>';
				}
				if($this->session->flashdata('sukses')) {
					echo '<div class="alert alert-warning">';
					echo $this->session->flashdata('sukses');
					echo '</div>';
				} 
				// Display error
				echo validation_errors('<div class="alert alert-warning">','</div>');
	
				// form open
				echo form_open(base_url('registrasi'), 'class="leave-comment"'); 
				?>

				<!-- NAMA -->
				<div class="wrap-input100 validate-input">
					<input class="input100 form-control" type="text" name="nama_pelanggan" placeholder="Nama Lengkap" value="<?php echo set_value('nama_pelanggan') ?>" required>
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>
				
				<!-- EMAIL -->
				<div class="wrap-input100 rs1 validate-input m-t-10">
					<input class="input100 form-control" type="email" name="email" placeholder="Email" value="<?php echo set_value('email') ?>" required>
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>
				
				<!-- PASSWORD -->
				<div class="wrap-input100 rs1 validate-input m-t-10">
					<input class="input100 form-control" type="password" name="password" placeholder="Password (minimal 6 karakter)" required="">
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>

				<!-- PASSWORD -->
				<div class="wrap-input100 rs1 validate-input m-t-10">
					<input class="input100 form-control" type="password" name="cfpassword" placeholder="Konfirmasi Password" required="">
					<span class="focus-input100-1"></span>
					<span class="focus-input100-2"></span>
				</div>
				
				<div class="wrap-input100 rs1 validate-input m-t-10">
					<select name="status_reseller" class="input100 form-control" width="20%">
						<option value="Tidak">Daftar menjadi Member</option>
						<option value="Pending">Daftar menjadi Reseller</option>
					</select>
				</div>

				<div class="container-login100-form-btn m-t-20">
					<button class="login100-form-btn sign-in-login100" type="submit">
						Daftar
					</button>
				</div>

				<div class="text-center m-t-15">
					<span class="txt1">
						Sudah memiliki akun? Silahkan
					</span>
					<a href="<?php echo base_url('masuk') ?>" class="txt2 hov1">
						masuk di sini
					</a>
				</div>

			<?php echo form_close(); ?>
		</div>
		
	</div>
</div>
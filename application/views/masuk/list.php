<style type="text/css">
	.social-btn .btn {
        margin: 10px 0;
        font-size: 15px;
        text-align: left; 
        line-height: 24px;       
    }
	.social-btn .btn i {
		float: left;
		margin: 4px 15px  0 5px;
        min-width: 15px;
	}
</style>

<!-- Cart -->
<section class="bgwhite p-t-70 p-b-100" style="background-color: white;">
<div class="container">
<!-- Cart item -->
<div class="pos-relative">
<div class="" style="background-color: white;">

	<h1><?php echo $title ?></h1><hr>
	<div class="clearfix"></div>
	<br><br>

	<?php if($this->session->flashdata('sukses')) {
		echo '<div class="alert alert-warning">';
		echo $this->session->flashdata('sukses');
		echo '</div>';
	} 
	?>

	<p class="alert alert-success">Belum memiliki akun? Silahkan <a href="<?php echo base_url('registrasi') ?>" class="btn btn-info btn-sm">Registrasi di sini</a></p>

	<div class="col-md-12 border border-primary">
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
		echo form_open(base_url('masuk'), 'class="leave-comment"'); ?>

		<!-- Login dengan Google -->
		<div class="row text-center social-btn justify-content-center border border-warning">
			<div class="col-md-3">
		    	<a href="<?php echo base_url('google') ?>" class="btn btn-danger btn-block"><i class="fa fa-google"></i> Masuk dengan <b>Google</b></a>
		    </div>
			<div class="col-md-3">
		    	<a href="#" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> Masuk dengan <b>Facebook</b></a>	
		    </div>
		</div>
		<br>

		<!-- USERNAME -->
		<div>
		<div class="row justify-content-center pb-2">
			<div class="col-md-2">
				<label for="email">Email (username)</label>
			</div>
			<div class="col-md-3" style="border: 1px solid black; border-radius: 20px;">
				<input id="email" type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>" required>
			</div>
		</div>
		
		<!-- PASSWORD -->
		<div class="row justify-content-center">
			<div class="col-md-2">
				<label for="password">Password</label>
			</div>
			<div class="col-md-3" style="border: 1px solid black; border-radius: 20px;">
				<input id="password" type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>" required>
			</div>
		</div>
		<br>
		<div class="row justify-content-center">
			<div class="col-md-2">
				<button class="btn btn-success btn-lg" type="submit">
					<i class="fa fa-save"></i> Login
				</button>
			</div>
			<div class="col-md-2">
				<button class="btn btn-default btn-lg" type="reset">
					<i class="fa fa-times"></i> Reset
				</button>
			</div>
		</div>
		</div>
		
		<?php echo form_close(); ?>
	</div>

	
</div>
</div>

</div>
</section>
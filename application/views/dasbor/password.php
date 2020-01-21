<style>
	.container {
		max-width: 1240px;
	}
	.konten{
		overflow-x: auto;
	}
@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
	.container {
		padding-left: 2px;
		margin-left: 2px;
	}
	.menu {
		/*background-color: lightblue;*/
		margin: -50px 0px -25px 50px;
		padding: 0px;
	}
</style>

<!-- ISI -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container m-l-30">
	<div class="row">

		<!-- KONTEN SEBELAH KIRI -->
		<div class="col-sm-6 col-md-4 col-lg-2 p-b-50 menu">
			<div class="leftbar p-r-0 p-r-0-sm">
				<!-- MENU -->
				<?php include('menu.php') ?>
			</div>
		</div>

		<!-- KONTEN SEBELAH KANAN -->
		<div class="col-sm-12 col-md-12 col-lg-10 p-b-50 konten">
			<h2><?php echo $title ?></h2>
			
			<?php 
			// Notifikasi
			if($this->session->flashdata('sukses')) {
			echo '<div class="alert alert-warning">';
			echo $this->session->flashdata('sukses');
			echo '</div>';
			}

			if($this->session->flashdata('warning')) {
			echo '<div class="alert alert-warning">';
			echo $this->session->flashdata('warning');
			echo '</div>';
			}

			// Display error
			echo validation_errors('<div class="alert alert-warning">','</div>');

			// form open
			echo form_open(base_url('dasbor/password'), 'class="leave-comment"'); 
			?>

			<div class="form-group m-t-30">
                <label for="old_password">Password Lama</label>
                <input type="password" class="form-control border border-dark" id="old_password" name="old_password" placeholder="Masukkan password lama anda...">
            </div>

            <div class="form-group m-t-30">
                <label for="new_password">Password Baru</label>
                <input type="password" class="form-control border border-dark" id="new_password" name="new_password" placeholder="Password baru anda..." required>
            </div>

            <div class="form-group m-t-30">
                <label for="cfnew_password">Konfirmasi Password Baru</label>
                <input type="password" class="form-control border border-dark" id="cfnew_password" name="cfnew_password" placeholder="Konfirmasi password baru anda..." required>
            </div>
			
			<button class="btn btn-success" type="submit">
				<i class="fa fa-save"></i> Simpan
			</button>
			<button class="btn btn-default" type="reset">
				<i class="fa fa-times"></i> Reset
			</button>

			<?php echo form_close(); ?>

		</div>
	</div>
</div>
</section>
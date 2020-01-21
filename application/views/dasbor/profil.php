<style>
	.container {
		max-width: 1300px;
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
		<div class="col-sm-6 col-md-8 col-lg-10 p-b-50 konten">
			<h2><?php echo $title ?></h2>
			<hr>
			
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
			echo form_open(base_url('dasbor/profil'), 'class="leave-comment"'); 
			?>

			<div>
				<img src="<?php echo $pelanggan->foto ?>" alt="" width="100">
			</div>

			<div class="form-group m-t-30">
                <label for="nama_pelanggan">Nama</label>
                <input type="text" class="form-control border border-dark" id="nama_pelanggan" name="nama_pelanggan" placeholder="Nama Lengkap" value="<?php echo $pelanggan->nama_pelanggan ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control border border-dark" id="email" name="email" placeholder="email" value="<?php echo $pelanggan->email ?>" readonly>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <a href="<?php echo base_url('dasbor/password') ?>"><button class="btn btn-default"></button>Ganti Password?</a>
            </div>

            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="tel" class="form-control border border-dark" id="telepon" name="telepon" placeholder="Silahkan isi nomor telepon anda..." value="<?php echo $pelanggan->telepon ?>" required>
            </div>

            <button class="btn btn-success" type="submit">
				<i class="fa fa-save"></i> Update Profil
			</button>
			<button class="btn btn-default" type="reset">
				<i class="fa fa-times"></i> Reset
			</button>
				
			<?php echo form_close(); ?>
			
		</div>
	</div>
</div>
</section>